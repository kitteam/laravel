@extends('control-panel')

@section('title', 'Список хостинг услуг | '. config('app.name'))
@section('page.title', 'Виртуальный хостинг')

@section('container')
<div class="c-table-responsive@desktop">
    <table class="c-table">

        <caption class="c-table__title">
            Список услуг <small>{{ count($collections) }} {{ trans_choice('аккаунт|аккаунта|аккаунтов', count($collections)) }}</small>
        </caption>

        <thead class="c-table__head c-table__head--slim">
            <tr class="c-table__row">
                <th class="c-table__cell c-table__cell--head">Тариф</th>
                <th class="c-table__cell c-table__cell--head">Аккаунт</th>
                <th class="c-table__cell c-table__cell--head">Сайты</th>
                <th class="c-table__cell c-table__cell--head">Окончание</th>
                <th class="c-table__cell c-table__cell--head">Статус</th>
                <th class="c-table__cell c-table__cell--head">
                    <span class="u-hidden-visually">Управление</span>
                </th>
            </tr>
        </thead>

        <tbody>
        @foreach ($collections as $collection)
            @if (($data = $collection->vesta()->listUserAccount()) && $data = current($data))
            <tr class="c-table__row">
                <td class="c-table__cell">
                    {{ $collection->hosting->name }}
                    <small class="u-block u-text-mute">
                        {{ $data['WEB_DOMAINS'] == 'unlimited' ? '∞' : $data['WEB_DOMAINS'] }} 
                        {{ trans_choice('сайт|сайта|сайтов', (int) $data['WEB_DOMAINS']) }}
                        /
                        {{ is_numeric($data['DISK_QUOTA']) ? round($data['DISK_QUOTA'] / 1024, 2) : '∞' }} Gb
                    </small>
                </td>

                <td class="c-table__cell">
                    <div class="o-media">
                        <div class="o-media__body">
                            {{ $collection->account }}<span class="u-text-mute">@</span><span class="u-text-mute">{{ $collection->server }}</span>
                            <small class="u-block u-text-mute">{{ $data['FNAME'] ." ".$data['LNAME'] }}</small>
                        </div>
                    </div>
                </td>

                <td class="c-table__cell">
                    <ul>
                    @foreach (array_keys($collection->vesta()->listWebDomain()) as $domain)
                        <li>
                            <a href="http://{{ $domain }}" target="_blank">{{ $domain }}</a>
                        </li>
                    @endforeach
                    </ul>
                </td>

                <td class="c-table__cell">
                    {{ $collection->expiration_at ? $collection->expiration_at->format('d.m.Y') : '—' }}
                </td>

                <td class="c-table__cell">
                    @switch($collection->state)
                        @case('activated')
                            <i class="fa fa-circle u-color-success u-mr-xsmall"></i>Активен
                            @break
                        @case('suspended')
                            <i class="fa fa-circle u-color-danger u-mr-xsmall"></i>Приостановлен
                            @break
                        @case('deleted')
                            <i class="fa fa-circle u-text-mute u-mr-xsmall"></i>Удалён
                            @break
                        @case('transferred')
                            <i class="fa fa-circle u-text-mute u-mr-xsmall"></i>Перенесён
                            @break
                        @case('inactivated')
                        @default
                            <i class="fa fa-circle u-text-mute u-mr-xsmall"></i>Неактивен
                    @endswitch
                </td>

                <td class="c-table__cell u-text-right">
                    <div class="c-board__actions dropdown">
                        <a class="dropdown-toggle" href="#" id="dropdwonMenuBoard{{ $collection->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="/img/icon-dots.svg" alt="Управление">
                        </a>
                        <div class="c-dropdown__menu dropdown-menu dropdown-menu-right" aria-labelledby="dropdwonMenuBoard{{ $collection->id }}">
                            <a href="/{{ Request::path() }}/{{ $collection->id }}" class="c-dropdown__item" target="_blank">Управление</a>
                        </div>
                    </div>
                </td>
            </tr>
            @else
            <tr class="c-table__row">
                <td class="c-table__cell">
                    {{ $collection->hosting->name }}
                    <small class="u-block u-text-mute"></small>
                </td>

                <td class="c-table__cell">
                    <div class="o-media">
                        <div class="o-media__body">
                            {{ $collection->account }}<span class="u-text-mute">@</span><span class="u-text-mute">{{ $collection->server }}</span>
                            <small class="u-block u-text-mute"></small>
                        </div>
                    </div>
                </td>

                <td class="c-table__cell"></td>

                <td class="c-table__cell">
                    {{ $collection->expiration_at ? $collection->expiration_at->format('d.m.Y') : '—' }}
                </td>

                <td class="c-table__cell">
                    <i class="fa fa-circle u-text-mute u-mr-xsmall"></i>Неопределен
                </td>

                <td class="c-table__cell u-text-right"></td>
            </tr>
            @endif
        @endforeach
        </tbody>
    </table>
</div>
@endsection
