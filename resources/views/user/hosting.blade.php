@extends('user')

@section('title', 'Список хостинг услуг | '. config('app.name'))
@section('page.title', 'Виртуальный хостинг')

@section('container')
<div class="table-responsive@desktop">
    <table class="table">

            <caption class="table__title">
                Список услуг <small>{{ count($collections) }} {{ trans_choice('аккаунт|аккаунта|аккаунтов', count($collections)) }}</small>
            </caption>

        <thead class="table__head table__head--slim">
                <tr class="table__row">
                  <th class="table__cell table__cell--head">Тариф</th>
                  <th class="table__cell table__cell--head">Аккаунт</th>
                  <th class="table__cell table__cell--head">Сайты</th>
                  <th class="table__cell table__cell--head">Окончание</th>
                  <th class="table__cell table__cell--head">Статус</th>
                  <th class="table__cell table__cell--head">
                      <span class="hidden-visually">Управление</span>
                  </th>
                </tr>
        </thead>

        <tbody>
        @foreach ($collections as $collection)

            @php
                $vesta = Vesta::server($collection->server)->setUserName($collection->account);
                $data = $vesta->listUserAccount();
                $data = current($data);
                $domains = array_keys($vesta->listWebDomain());
            @endphp

            <tr class="table__row">
                <td class="table__cell">
                    {{ $collection->hosting->name }}
                    <small class="block text-mute">{{ $data['WEB_DOMAINS'] }} {{ trans_choice('сайт|сайта|сайтов', $data['WEB_DOMAINS']) }} / {{ is_numeric($data['DISK_QUOTA']) ? round($data['DISK_QUOTA'] / 1024, 2) : '∞' }} Gb</small>
                </td>

                <td class="table__cell">
                    <div class="media">
                        <div class="media__body">
                            {{ $collection->account }}<span class="text-mute">@</span><span class="text-mute">{{ $collection->server }}</span>
                            <small class="block text-mute">{{ $data['FNAME'] ." ".$data['LNAME'] }}</small>
                        </div>
                    </div>
                </td>

                <td class="table__cell">
                    <ul>
                    @foreach ($domains as $domain)
                        <li>
                            <a href="http://{{ $domain }}" target="_blank">{{ $domain }}</a>
                        </li>
                    @endforeach
                    </ul>
                </td>

                <td class="table__cell">
                    {{ $collection->expiration_at ? $collection->expiration_at->format('d.m.Y') : '—' }}
                </td>

                <td class="table__cell">
                    <i class="fa fa-circle-o color-success mr-xsmall"></i>Активен
                </td>

                <td class="table__cell text-right">

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
