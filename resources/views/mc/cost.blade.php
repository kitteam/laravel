@extends('mission-control')

@section('title', 'Стоимость доменов | '. config('app.name'))
@section('page.title', 'Стоимость доменов')

@section('toolbar')
<div class="c-toolbar u-mb-medium">
    <nav class="c-toolbar__nav u-mr-auto">
        <a class="c-toolbar__nav-item {{ 'cis' == $group ? 'is-active' : '' }}" href="{{ route('mc.cost.tld') }}?group=cis" title="Россия и СНГ">Россия и СНГ</a>
        <a class="c-toolbar__nav-item {{ 'international' == $group ? 'is-active' : '' }}" href="{{ route('mc.cost.tld') }}?group=international" title="Международные">Международные</a>
        <a class="c-toolbar__nav-item {{ 'europe' == $group ? 'is-active' : '' }}" href="{{ route('mc.cost.tld') }}?group=europe" title="Европа">Европа</a>
        <a class="c-toolbar__nav-item {{ 'asia' == $group ? 'is-active' : '' }}" href="{{ route('mc.cost.tld') }}?group=asia" title="Азия">Азия</a>
        <a class="c-toolbar__nav-item {{ 'america' == $group ? 'is-active' : '' }}" href="{{ route('mc.cost.tld') }}?group=america" title="Америка">Америка</a>
        <a class="c-toolbar__nav-item {{ 'thematic' == $group ? 'is-active' : '' }}" href="{{ route('mc.cost.tld') }}?group=thematic" title="Тематические">Тематические</a>
        <a class="c-toolbar__nav-item {{ 'other' == $group ? 'is-active' : '' }}" href="{{ route('mc.cost.tld') }}?group=other" title="Другие">Другие</a>
    </nav>

    <div class="c-field u-ml-auto col-3">
        <label class="c-field__label u-hidden-visually" for="search">Поиск</label>
        <input class="c-input" id="search" type="text" placeholder="Поиск">
    </div>
</div>
@endsection

@section('container')
<div class="c-table-responsive@desktop">
    <table class="c-table" id="datatable" data-page-length="50">

        <caption class="c-table__title">
            Стоимость <small>{{ count($collections) }} {{ trans_choice('зона|зоны|зон', count($collections)) }}</small>
        </caption>

        <thead class="c-table__head c-table__head--slim">
            <tr class="c-table__row">
                <th class="c-table__cell c-table__cell--head">Tld</th>
                <th class="c-table__cell c-table__cell--head no-sort">Регистрация</th>
                <th class="c-table__cell c-table__cell--head no-sort"></th>
                <th class="c-table__cell c-table__cell--head no-sort">Продление</th>
                <th class="c-table__cell c-table__cell--head no-sort"></th>
            </tr>
        </thead>

        <tbody>
        @foreach ($collections as $collection)
            <tr class="c-table__row">
                <td class="c-table__cell u-wrap">
                    {{ $collection->tld }}
                @if ($collection->idn)
                    <span class="c-badge c-badge--info c-badge--xsmall c-tooltip--top u-ml-xsmall" aria-label="IDN — International domain names. Доменное имя содержит символы национальной кодировки.">IDN</span>
                @endif
                </td>
                <td class="c-table__cell u-wrap">
                    {{ $collection->retail_reg_price }} руб.
                @if ($collection->retail_reg_price != $collection->reg_price)<br>
                    {{ $collection->reg_price }} руб.
                @endif
                </td>
                <td class="c-table__cell u-wrap">
                    {{ $collection->our_reg_price }} руб.
                @if (($diff = $collection->our_reg_price - $collection->reg_price) > 0)
                    <small class="u-block u-text-success">+{{ $diff }}</small>
                @endif
                </td>
                <td class="c-table__cell u-wrap">
                    {{ $collection->retail_renew_price }} руб.<br>
                    {{ $collection->renew_price }} руб.
                </td>
                <td class="c-table__cell u-wrap">
                    {{ $collection->our_renew_price }} руб.
                @if (($diff = $collection->our_renew_price - $collection->renew_price) > 0)
                    <small class="u-block u-text-success">+{{ $diff }}</small>
                @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
