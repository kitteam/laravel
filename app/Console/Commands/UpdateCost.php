<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

use Reg;
use App\Tld;

class UpdateCost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updates:cost';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update cost';

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
        $data = Reg::send('domain/get_prices', ['show_renew_data' => 1, 'show_update_data' => 1]);
        if (isset($data['prices']) && ($items = $data['prices'])) {

            //$items = array_filter($items, function ($v, $k) {
            //    $tlds = ['ru', 'рф', 'рус', 'com', 'org', 'net', 'info', 'biz', 'ru.net'];
            //    return in_array($k, $tlds);
            //}, ARRAY_FILTER_USE_BOTH);

            foreach ($items as $key => $item) {
                $data = array_merge(['tld' => $key], $item);
                unset($data['extcreate_price_eq_renew']);
                foreach ($data as $k => $v) {
                    if (false !== strrpos($k, 'price')) {
                        $data[$k] = $data[$k] * 100;
                    }
                }
                Tld::updateOrInsert(['tld' => $key], $data);
            }
        }
    }
}
