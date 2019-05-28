@extends('layouts.app')

@section('title', 'Регистрация | '. config('app.name'))
@section('body.class', 'page page--center')

@section('content')
<div class="page__card">
    <div class="card mb-xsmall">
        <header class="card__header">
            <h1 class="h3 text-center mb-zero">Регистрация</h1>
        </header>

        <form class="card__body" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            @if (session('verify_email'))
            <div class="alert alert--info">
                <i class="alert__icon fa fa-info-circle"></i> На адрес {{ session('verify_email') }} отправлена информация для подтверждения регистрации
            </div>
            @endif

            <div class="field mb-small">
                <label class="field__label" for="name">Имя</label>
                <input id="name" class="input{{ $errors->has('name') ? ' input--danger' : '' }}" type="text" name="name" value="{{ old('name') }}" placeholder="Ваше имя" required autofocus>

                @if ($errors->has('name'))
                <small class="field__message color-danger">
                    <i class="fa fa-times-circle"></i> {{ $errors->first('name') }}
                </small>
                @endif
            </div>

            <div class="field mb-small">
                <label class="field__label" for="email">Адрес электронной почты</label>
                <input id="email" class="input{{ $errors->has('email') ? ' input--danger' : '' }}" type="email" name="email" value="{{ old('email') }}" placeholder="E-mail" required>

                @if ($errors->has('email'))
                <small class="field__message color-danger">
                    <i class="fa fa-times-circle"></i> {{ $errors->first('email') }}
                </small>
                @endif
            </div>

            {{--<div class="field mb-small">
                <label class="field__label" for="password">Пароль</label>
                <input id="password" class="input{{ $errors->has('password') ? ' input--danger' : '' }}" type="password" name="password" placeholder="Цифры, Буквы..." required>

                @if ($errors->has('password'))
                <small class="field__message color-danger">
                    <i class="fa fa-times-circle"></i> {{ $errors->first('password') }}
                </small>
                @endif
            </div>

            <div class="field mb-small">
                <label class="field__label" for="password-confirm">Повторно введите пароль</label>
                <input id="password-confirm" class="input" type="password" name="password_confirmation" placeholder="Подтверждение пароля" required>
            </div>
            --}}

            <button class="btn btn--info btn--fullwidth" type="submit">Зарегистрироваться</button>

            @if (Route::has('home'))
            <div class="mt-small text-center">
                <a class="text-mute text-small" href="{{ route('home') }}">Вернуться на главную</a>
            </div>
            @endif
        </form>
    </div>

    <div class="line">
        <a class="text-mute text-small" href="{{ route('login') }}" title="Вход для клиентов">
            Уже зарегистрированы? Войдите
        </a>
    </div>

</div>
@endsection
