@extends('mission-control')

@section('title', 'Короткие ссылки | '. config('app.name'))
@section('page.title', 'Короткие ссылки')

@section('container')
<div class="c-table-responsive@desktop">
    <table class="c-table">

        <caption class="c-table__title">
            Список коротких ссылок<small>{{ count($collections) }} {{ trans_choice('ссылка|ссылки|ссылок', count($collections)) }}</small>

            <button type="button" class="c-btn u-float-right" data-toggle="modal" data-target="#modal">
                Добавить ссылку
            </button>
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
                    <div class="c-board__actions dropdown">
                        <a class="dropdown-toggle" href="#" id="dropdwonMenuBoard{{ $collection->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="u-width-initial" src="/img/icon-dots.svg" alt="Управление">
                        </a>
                        <div class="c-dropdown__menu dropdown-menu dropdown-menu-right" aria-labelledby="dropdwonMenuBoard{{ $collection->id }}">
                            <a href="{{ route('mc.seo.shortlink.edit', $collection->id) }}" id="edit" class="c-dropdown__item" data-toggle="modal" data-target="#modal2" data-source="{{ route('mc.seo.shortlink.edit', $collection->id) }}">Изменение</a>
                            <a href="{{ route('mc.seo.shortlink.delete', $collection->id) }}" class="c-dropdown__item u-text-danger">Удаление</a>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="c-modal c-modal--small modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" data-backdrop="static">
        <div class="c-modal__dialog modal-dialog" role="document">
            <div class="c-modal__content">

                <div class="c-modal__header">
                    <h3 class="c-modal__title">Добавление новой ссылки</h3>

                    <span class="c-modal__close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-close"></i>
                    </span>
                </div>

                <div class="c-modal__body">
                    <form action="{{ route('mc.seo.shortlink.add') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="c-field u-mb-small">
                            <label class="c-field__label" for="url">Адрес ссылки</label>

                            <textarea name="url" class="c-input" id="url"></textarea>
                            <small class="c-field__message">Данное поле обязательно для заполнения</small>
                        </div>

                        <button class="c-btn c-btn--success c-btn--fullwidth" type="submit">
                            Добавить ссылку
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="c-modal c-modal--small modal modal-fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="modal" data-backdrop="static">
        <div class="c-modal__dialog modal-dialog" role="document">
            <div class="c-modal__content">

            </div>
        </div>
    </div>
</div>
@endsection
