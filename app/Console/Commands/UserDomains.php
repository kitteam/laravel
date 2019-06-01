<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

use Reg;
use App\UserDomain;

class UserDomains extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'domains:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update user domains';

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
        $data = Reg::send('service/get_list', ['servtype' => 'domain']);
        if (isset($data['services']) && ($items = $data['services'])) {
            foreach ($items as $key => $item) {
                $data = [
                    'id_code' => $item['service_id'],
                    'domain' => $item['dname'],
                    'expiration_at' => $item['expiration_date'],
                ];
                switch ($item['state']) {
                    case 'S':
                        $data['state'] = 'suspended';
                        break;
                    case 'N':
                        $data['state'] = 'locked';
                        break;
                    default:
                        $data['state'] = 'activated';
                }
                UserDomain::updateOrInsert(['domain' => $item['dname']], $data);
            }
            
            if ($domains = array_column($items, 'dname')) {
                UserDomain::whereNotIn('domain', $domains)->where('provider', 'reg.ru')->delete();
            }
        }
    }
}
