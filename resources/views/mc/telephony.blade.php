@extends('mission-control')

@section('title', 'Список вызовов | '. config('app.name'))
@section('page.title', 'Список вызовов')

@section('container')
<div class="c-table-responsive@desktop">
    <table class="c-table">

        <caption class="c-table__title">
            Список входящих за 3 дня<small>{{ count($collections) }} {{ trans_choice('вызов|вызова|вызовов', count($collections)) }}</small>
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
            <tr class="c-table__row">
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
                @switch($collection->callStatus)
                    @case('NOT_ANSWERED_COMMON')
                        <i class="fa fa-circle-o u-color-danger u-mr-xsmall"></i>
                        {{ $statuses[$collection->callStatus] }}
                        @break
                    @default
                        <i class="fa fa-circle-o u-color-success u-mr-xsmall"></i>
                        {{ $statuses[$collection->callStatus] }}
                @endswitch
                </td>
                <td class="c-table__cell u-text-right">
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
