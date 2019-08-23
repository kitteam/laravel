@extends('mission-control')

@section('title', 'Короткие ссылки | '. config('app.name'))
@section('page.title', 'Короткие ссылки')

@section('container')
<div class="c-table-responsive@desktop">
    <table class="c-table">

        <caption class="c-table__title">
            Список коротких ссылок<small>{{ count($collections) }} {{ trans_choice('ссылка|ссылки|ссылок', count($collections)) }}</small>
        </caption>

        <thead class="c-table__head c-table__head--slim">
            <tr class="c-table__row">
                <th class="c-table__cell c-table__cell--head">Короткая ссылка</th>
                <th class="c-table__cell c-table__cell--head">Адрес</th>
                <th class="c-table__cell c-table__cell--head">
                    <span class="u-hidden-visually">Управление</span>
                </th>
            </tr>
        </thead>

        <tbody>
        @foreach ($collections as $collection)
            <tr class="c-table__row">
                <td class="c-table__cell">
                    <span class="u-block">{{ $collection->shortlink }}</span>
                    <small>
                        <a href="https://www.kit.team/go/{{ $collection->shortlink }}"
                            title="{{ $collection->shortlink }}" target="_blank">https://www.kit.team/go/{{ $collection->shortlink }}</a>
                    </small>
                </td>

                <td class="c-table__cell u-wrap">
                    {{ $collection->url }}
                </td>

                <td class="c-table__cell u-text-right">
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
