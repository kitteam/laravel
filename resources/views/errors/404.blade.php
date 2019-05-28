@extends('layouts.app')

@section('title', '404 - Страница не найдена | '. config('app.name'))
@section('body.class', 'page page--center')

@section('content')
<div class="page__card">

    <div class="card mb-small">
        <header class="card__header text-center pt-large">
            <span class="card__icon">
                <i class="fa fa-chain-broken"></i>
            </span>
            <h1 class="text-big mb-zero">
                404 <em class="block text-mute text-large">Страница не найдена</em>
            </h1>
        </header>

        <div class="card__body">
            <h2 class="h5 text-center mb-medium">
                Зарпошенная вами страница не существует. Чуть позже вы сможете воспользоваться поиском.
            </h2>

            <form>
                <div class="field has-icon-right mb-xsmall">
                    <span class="field__icon">
                        <i class="fa fa-search"></i>
                    </span>
                    <label class="field__label hidden-visually" for="input-search">Поиск</label>
                    <input class="input" id="input-search" type="text" placeholder="Что нужно найти?" disabled>
                </div>
                <button class="btn btn--info btn--fullwidth" disabled>Найти</button>
            </form>
        </div>
    </div>

    <div class="line justify-center">
        <a class="text-mute" href="/">
            <i class="fa fa-long-arrow-left mr-xsmall"></i> Вернуться на главную
        </a>
    </div>

</div>
@endsection
