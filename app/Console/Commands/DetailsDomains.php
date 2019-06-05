<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

use Reg;
use App\UserDomain;

class DetailsDomains extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'domains:details';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update details user domains';

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
        if ($domains = UserDomain::get()) {
            foreach ($domains->pluck('domain')->all() as $key => $dname) {
                $dnames[$key] = ['dname' => $dname];
            }

            $data = Reg::send('service/get_details', ['domains' => $dnames], 'json');
            if (isset($data['services']) && ($services = $data['services'])) {
                foreach ($domains as $domain) {
                    if ($key = array_search($domain->domain, array_column($services, 'dname'))) {
                        if (isset($services[$key]['details'])) {
                            $domain->details = json_encode($services[$key]['details'], JSON_UNESCAPED_UNICODE);
                            $domain->save();
                        }
                    }
                }
            }
        }
    }
}
