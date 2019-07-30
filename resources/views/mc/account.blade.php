@extends('mission-control')

@section('title', 'Список аккаунтов | '. config('app.name'))
@section('page.title', 'Аккаунты')

@section('container')
<div class="c-table-responsive@desktop">
    <table class="c-table" id="datatable" data-page-length="25">

        <caption class="c-table__title">
            Список аккаунтов <small>{{ count($collections) }} {{ trans_choice('аккаунт|аккаунта|аккаунтов', count($collections)) }}</small>
        </caption>

        <thead class="c-table__head c-table__head--slim">
            <tr class="c-table__row">
                <th class="c-table__cell c-table__cell--head no-sort">id</th>
                <th class="c-table__cell c-table__cell--head">Имя</th>
                <th class="c-table__cell c-table__cell--head">Email</th>
                <th class="c-table__cell c-table__cell--head">Дата регистрации</th>
                <th class="c-table__cell c-table__cell--head no-sort">
                    <span class="u-hidden-visually">Управление</span>
                </th>
            </tr>
        </thead>

        <tbody>
        @foreach ($collections as $collection)
            <tr class="c-table__row">
                <td class="c-table__cell">
                    <small class="u-block u-text-mute">{{ $collection->id }}</small>
                </td>

                <td class="c-table__cell u-wrap">
                    {{ $collection->name ? $collection->name .' '. $collection->surname : '—' }}
                </td>

                <td class="c-table__cell">
                    {{ $collection->email }}
                </td>

                <td class="c-table__cell">
                    {{ $collection->created_at->format('d.m.Y H:i') ?? '—' }}
                </td>

                <td class="c-table__cell u-text-right">
                    <div class="c-board__actions dropdown">
                        <a class="dropdown-toggle" href="#" id="dropdwonMenuBoard{{ $collection->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="u-width-initial" src="/img/icon-dots.svg" alt="Управление">
                        </a>
                        <div class="c-dropdown__menu dropdown-menu dropdown-menu-right" aria-labelledby="dropdwonMenuBoard{{ $collection->id }}">
                            <a href="/{{ Request::path() }}/auth/{{ $collection->id }}" class="c-dropdown__item">Авторизоваться</a>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
