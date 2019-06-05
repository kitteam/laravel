@php
use Reg;
use App\UserDomain;


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

@endphp
