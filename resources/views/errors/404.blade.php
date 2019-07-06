@extends('layouts.app')

@section('title', '404 - Страница не найдена | '. config('app.name'))
@section('body.class', 'o-page o-page--center')

@section('body')
<div class="o-page__card">

    <div class="c-card u-mb-small">
        <header class="c-card__header u-text-center u-pt-large">
            <span class="c-card__icon">
                <i class="fa fa-chain-broken"></i>
            </span>
            <h1 class="u-text-big u-mb-zero">
                404 <em class="u-block u-text-mute u-text-large">Страница не найдена</em>
            </h1>
        </header>

        <div class="c-card__body">
            <h2 class="u-h5 u-text-center u-mb-medium">
                Запрошенная вами страница не существует. Чуть позже вы сможете воспользоваться поиском.
            </h2>

            <form>
                <div class="c-field has-icon-right u-mb-xsmall">
                    <span class="c-field__icon">
                        <i class="fa fa-search"></i>
                    </span>
                    <label class="c-field__label u-hidden-visually" for="input-search">Поиск</label>
                    <input class="c-input" id="input-search" type="text" placeholder="Что нужно найти?" disabled>
                </div>
                <button class="c-btn c-btn--info c-btn--fullwidth" disabled>Найти</button>
            </form>
        </div>
    </div>
    @if (Route::has('home'))
    <div class="o-line u-justify-center">
        <a class="u-text-mute" href="{{ route('home') }}">
            <i class="fa fa-long-arrow-left u-mr-xsmall"></i> Вернуться на главную
        </a>
    </div>
    @endif
</div>
@endsection
