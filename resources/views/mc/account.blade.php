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
                    <div>{{ $collection->name ? $collection->name .' '. $collection->surname : '—' }}</div>
                    @if (($count = $collection->domain()->count())
                        && $expiration = $collection->domain()->select('expiration_at')->orderBy('expiration_at', 'asc')->first())
                        @if (date('Y-m-d H:i:s', time()) > $expiration->expiration_at)
                        <small class="u-text-danger u-mr-small">
                        @elseif (date('Y-m-d H:i:s', time()) > $expiration->expiration_at->add('-2 month'))
                        <small class="u-color-warning u-mr-small">
                        @else
                        <small class="u-text-mute u-mr-small">
                        @endif
                            {{ $count }} {{ trans_choice('домен|домена|доменов', $count) }}
                        </small>
                    @endif
                    @if (($count = $collection->hosting()->count())
                        && $expiration = $collection->hosting()->select('expiration_at')->orderBy('expiration_at', 'asc')->first())
                        @if ($expiration->expiration_at && date('Y-m-d H:i:s', time()) > $expiration->expiration_at)
                        <small class="u-text-danger u-mr-small">
                        @elseif ($expiration->expiration_at && date('Y-m-d H:i:s', time()) > $expiration->expiration_at->add('-2 month'))
                        <small class="u-color-warning u-mr-small">
                        @else
                        <small class="u-text-mute u-mr-small">
                        @endif
                            {{ $count }} {{ trans_choice('аккаунт|аккаунта|аккаунтов', $count) }}
                        </small>
                    @endif
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
