<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

use Image;
use DB;
use App\UserDomain;
use App\UserHosting;
use App\Portfolio;
use ATehnix\VkClient\Client as VkClient;
use GuzzleHttp\Client as HttpClient;

class CoverPhotoUpload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cover_photo:upload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload cover photo Vkontakte';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $vkClient = new VkClient();
        $vkClient->setDefaultToken(env('VKONTAKTE_TOKEN'));
        $response = $vkClient->request('photos.getOwnerCoverPhotoUploadServer', [
            'group_id' => 51846451,
            'crop_x2' => 1590,
            'crop_y2' => 400
        ]);

        if (!isset($response['error']) && ($upload_url = $response['response']['upload_url'])) {
            $url_parts = parse_url($upload_url);
            $url = $url_parts['path'] .'?'. $url_parts['query'];

            $config = [
                'base_uri' => $url_parts['scheme'] .'://'. $url_parts['host'],
                'verify' => false
            ];

            $httpClient = new HttpClient($config);
            $content = $httpClient->request('POST', $url, [
                'multipart' => [
                    [
                        'name' => 'photo',
                        'contents' => $this->gererateImage(),
                        'filename' => 'cover.jpg'
                    ]
                ]
            ])->getBody()->getContents();

            if ($params = json_decode($content, true)) {
                $response = $vkClient->request('photos.saveOwnerCoverPhoto', $params);
            }
        }
    }

    protected function gererateImage()
    {
        $img = Image::make(public_path('img/cover-vk.jpg'));

        $array = [
            DB::table('user_domains')->count(),
            DB::table('user_hostings')->count(),
            DB::table('portfolio')->count(),
        ];

        $img->text($array[0], 784, 99, $font = function($font) {
            $font->file(public_path('fonts/OpenSans-ExtraBold.ttf'));
            $font->size(44);
            $font->color('#ffffff');
            $font->align('left');
            $font->valign('top');
        });
        $img->text($array[1], 784, 181, $font);
        $img->text($array[2], 784, 260, $font);

        $text = trans_choice("Зарегистрированный\nдомен|Зарегистрированных\nдомена|Зарегистрированных\nдоменов", $array[0]);
        $img->text(mb_strtoupper($text), 876, 138, $font = function($font) {
            $font->file(public_path('fonts/RobotoSlab-Regular.ttf'));
            $font->size(18);
            $font->color('#ffffff');
            $font->align('left');
            $font->valign('bottom');
        });
        $text = trans_choice("Активный\nхостинг аккаунт|Активных\nхостинг аккаунта|Активных\nхостинг аккаунтов", $array[1]);
        $img->text(mb_strtoupper($text), 876, 216, $font);
        $text = trans_choice("Разработанный\nсайт|Разработанных\nсайта|Разработанных\nсайтов", $array[2]);
        $img->text(mb_strtoupper($text), 876, 295, $font);

        return $img->encode('jpg', 100);
    }
}
