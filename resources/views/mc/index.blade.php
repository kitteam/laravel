@extends('mission-control')

@section('title', 'Список аккаунтов | '. config('app.name'))
@section('page.title', 'Аккаунты')

@section('container')
<div class="c-table-responsive@desktop">
    <table class="c-table">

        <caption class="c-table__title">
            Список входящих за неделю <small>{{ count($collections) }} {{ trans_choice('вызов|вызова|вызовов', count($collections)) }}</small>
        </caption>

        <thead class="c-table__head c-table__head--slim">
            <tr class="c-table__row">
                <th class="c-table__cell c-table__cell--head">Дата</th>
                <th class="c-table__cell c-table__cell--head">Номер</th>
                <th class="c-table__cell c-table__cell--head">Оператор</th>
                <th class="c-table__cell c-table__cell--head">Длительность</th>
                <th class="c-table__cell c-table__cell--head">Статус</th>
                <th class="c-table__cell c-table__cell--head">
                    <span class="u-hidden-visually">Управление</span>
                </th>
            </tr>
        </thead>
{{--
    Array (
        [callType] => MULTI_CHANNEL
        [destinationNumber] => 3513993282
        [calleeNumber] => 79089388860
        [calleeName] => Антон Попов
        [callDuration] => 50
        [conversationDuration] => 23
        [callStatus] => ANSWERED_BY_ORIGINAL_CLIENT
    )
     Array (
        [callType] => MULTI_CHANNEL
        [callerNumber] => 3432860314
        [callDuration] => 21
        [callStatus] => NOT_ANSWERED_COMMON
        )
    )

    --}}
        <tbody>
        @foreach ($collections as $collection)
            <tr class="c-table__row {{ $collection->callStatus == 'NOT_ANSWERED_COMMON' ? 'c-table__row--danger' : '' }}">
                <td class="c-table__cell">
                    {{ Carbon\Carbon::createFromTimestamp($collection->callTimestamp)->addHours(5)->format('d.m.Y H:i:s') }}
                </td>

                <td class="c-table__cell u-wrap">
                    {{ phone($collection->callerNumber, 'RU', 'international') }}
                </td>

                <td class="c-table__cell u-wrap">
                    {{ isset($collection->calleeNumber) ? phone($collection->calleeNumber, 'RU', 'international') : '—' }}
                </td>

                <td class="c-table__cell">
                    {{ $collection->callDuration }} сек.

                    {{--
                        callDuration - длительность вызова (начиная от попадания на АТС), в секундах,
                        conversationDuration - длительность разговора (с конкретным абонентом), в секундах,
                        --}}
                </td>

                <td class="c-table__cell">
                    {{ $statuses[$collection->callStatus] }}
                </td>

                <td class="c-table__cell u-text-right">
                    {{--<div class="c-board__actions dropdown">
                        <a class="dropdown-toggle" href="#" id="dropdwonMenuBoard{{ $collection->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="u-width-initial" src="/img/icon-dots.svg" alt="Управление">
                        </a>
                        <div class="c-dropdown__menu dropdown-menu dropdown-menu-right" aria-labelledby="dropdwonMenuBoard{{ $collection->id }}">
                            <a href="/{{ Request::path() }}/auth/{{ $collection->id }}" class="c-dropdown__item">Авторизоваться</a>
                        </div>
                    </div>--}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
