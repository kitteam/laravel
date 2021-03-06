@extends('layouts.app')

@section('title', 'Регистрация | '. config('app.name'))
@section('body.class', 'o-page o-page--center')

@section('body')
<div class="o-page__card">
    <div class="c-card u-mb-xsmall">
        <header class="c-card__header">
            <h1 class="u-h3 u-text-center u-mb-zero">Регистрация</h1>
        </header>

        <form class="c-card__body" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            @if (session('verify_email'))
            <div class="c-alert c-alert--info">
                <i class="c-alert__icon fa fa-info-circle"></i> На адрес {{ session('verify_email') }} отправлена информация для подтверждения регистрации
            </div>
            @endif

            <div class="c-field">
                <input id="name" class="c-input u-hidden" type="text" name="name" value="{{ old('name') }}" placeholder="Ваше имя">
                <input id="_name" class="c-input u-hidden" type="text" name="_name" value="{{ old('_name') ?: 'esquimau' }}" placeholder="Ваше имя">
            </div>

            <div class="c-field u-mb-small">
                <label class="c-field__label" for="email">Адрес электронной почты</label>
                <input id="email" class="c-input{{ $errors->has('email') ? ' c-input--danger' : '' }}" type="email" name="email" value="{{ old('email') }}" placeholder="E-mail" required autofocus>

                @if ($errors->has('email'))
                <small class="c-field__message u-color-danger">
                    <i class="fa fa-times-circle"></i> {{ $errors->first('email') }}
                </small>
                @endif
            </div>

            <button class="c-btn c-btn--info c-btn--fullwidth" type="submit">Зарегистрироваться</button>

            @if (Route::has('home'))
            <div class="u-mt-small u-text-center">
                <a class="u-text-mute u-text-small" href="{{ route('home') }}">Вернуться на главную</a>
            </div>
            @endif
        </form>
    </div>

    <div class="o-line">
        <a class="u-text-mute u-text-small" href="{{ route('login') }}" title="Вход для клиентов">
            Уже зарегистрированы? Войдите
        </a>
    </div>

</div>
@endsection
