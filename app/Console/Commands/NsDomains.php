<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

use Reg;
use App\UserDomain;

class NsDomains extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'domains:ns';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update NS user domains';

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

            $data = Reg::send('domain/get_nss', ['domains' => $dnames], 'json');
            if (isset($data['domains']) && ($nss = $data['domains'])) {

                foreach ($domains as $domain) {
                    if ($key = array_search($domain->domain, array_column($nss, 'dname'))) {
                        $domain->ns = json_encode($nss[$key]['nss']);
                        $domain->save();
                    }
                }

            }
        }
    }
}
