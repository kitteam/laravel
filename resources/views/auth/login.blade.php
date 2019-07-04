@extends('layouts.app')

@section('title', 'Вход для клиентов | '. config('app.name'))
@section('body.class', 'o-page o-page--center')

@section('content')
<div class="o-page__card">
    <div class="c-card u-mb-small">
        <header class="c-card__header">
            <h1 class="u-h3 u-text-center u-mb-zero">Вход для клиентов</h1>
        </header>

        <form class="c-card__body" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            @include('flash-message')

            <div class="c-field u-mb-small">
                <label class="c-field__label" for="email">Адрес электронной почты</label>
                <input id="email" type="email" class="c-input{{ $errors->has('email') ? ' u-input--danger' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-mail" required autofocus>

                @if ($errors->has('email'))
                    <small class="c-field__message u-color-danger">
                        <i class="fa fa-times-circle"></i> {{ $errors->first('email') }}
                    </small>
                @endif
            </div>

            <div class="c-field u-mb-small">
                <label class="c-field__label" for="password">Пароль</label>
                <input id="password" type="password" class="c-input{{ $errors->has('password') ? ' u-input--danger' : '' }}" name="password" placeholder="Цифры, Буквы..." required>

                @if ($errors->has('password'))
                    <small class="c-field__message u-color-danger">
                        <i class="fa fa-times-circle"></i> {{ $errors->first('password') }}
                    </small>
                @endif
            </div>

            <div class="c-choice c-choice--checkbox">
                <input class="c-choice__input" id="remember" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                <label class="c-choice__label" for="remember">Запомнить</label>
            </div>

            <button class="c-btn c-btn--info c-btn--fullwidth" type="submit">Войти</button>

            @if (Route::has('home'))
            <div class="u-mt-small u-text-center">
                <a class="u-text-mute u-text-small" href="{{ route('home') }}">Вернуться на главную</a>
            </div>
            @endif
        </form>
    </div>

    <div class="o-line">
    @if (Route::has('register'))
        <a class="u-text-mute u-text-small" href="{{ route('register') }}">Ещё нет аккаунта? Зарегистрируйтесь</a>
    @endif
    @if (Route::has('password.request'))
        <a class="u-text-mute u-text-small" href="{{ route('password.request') }}">Забыли пароль?</a>
    @endif
    </div>
</div>
@endsection
