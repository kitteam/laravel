@extends('layouts.app')

@section('body.class', 'page page--center')

@section('content')
<div class="page__card">
    <div class="card mb-xsmall">
        <header class="card__header">
            <h1 class="h3 text-center mb-zero">Вход для клиентов</h1>
        </header>

        <form class="card__body" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            @include('flash-message')

            <div class="field mb-small">
                <label class="field__label" for="email">Адрес электронной почты</label>
                <input id="email" type="email" class="input{{ $errors->has('email') ? ' input--danger' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-mail" required autofocus>

                @if ($errors->has('email'))
                    <small class="field__message color-danger">
                        <i class="fa fa-times-circle"></i> {{ $errors->first('email') }}
                    </small>
                @endif
            </div>

            <div class="field mb-small">
                <label class="field__label" for="password">Пароль</label>
                <input id="password" type="password" class="input{{ $errors->has('password') ? ' input--danger' : '' }}" name="password" placeholder="Цифры, Буквы..." required>

                @if ($errors->has('password'))
                    <small class="field__message color-danger">
                        <i class="fa fa-times-circle"></i> {{ $errors->first('password') }}
                    </small>
                @endif
            </div>

            <div class="choice choice--checkbox">
                <input class="choice__input" id="remember" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                <label class="choice__label" for="remember">Запомнить</label>
            </div>

            <button class="btn btn--info btn--fullwidth" type="submit">Войти</button>

            @if (Route::has('home'))
            <div class="mt-small text-center">
                <a class="text-mute text-small" href="{{ route('home') }}">Вернуться на главную</a>
            </div>
            @endif
        </form>
    </div>

    <div class="line">
    @if (Route::has('register'))
        <a class="text-mute text-small" href="{{ route('register') }}">Ещё нет аккаунта? Зарегистрируйтесь</a>
    @endif
    @if (Route::has('password.request'))
        <a class="text-mute text-small" href="{{ route('password.request') }}">Забыли пароль?</a>
    @endif
    </div>
</div>
@endsection
