@extends('layouts.app')

@section('title', 'Сброс пароля | '. config('app.name'))
@section('body.class', 'page page--center')

@section('content')
<div class="page__card">
    <div class="card mb-xsmall">
        <header class="card__header text-center">
            <div class="row justify-center">
                <div class="col-9">
                    <h1 class="h3 mb-zero">Сброс пароля</h1>
                </div>
            </div>
        </header>

        <form class="card__body" method="POST" action="{{ route('password.request') }}">
            {{ csrf_field() }}

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="field mb-small">
                <label class="field__label" for="email">Адрес электронной почты</label>
                <input class="input{{ $errors->has('email') ? ' input--danger' : '' }}" type="email" id="email" name="email" value="{{ $email ?? old('email') }}" placeholder="E-mail" required autofocus>

                @if ($errors->has('email'))
                <small class="field__message color-danger">
                    <i class="fa fa-times-circle"></i> {{ $errors->first('email') }}
                </small>
                @endif
            </div>

            <div class="field mb-small">
                <label class="field__label" for="password">Новый пароль</label>
                <input class="input{{ $errors->has('password') ? ' input--danger' : '' }}" type="password" id="password" name="password" placeholder="Цифры, Буквы..." required>

                @if ($errors->has('password'))
                <small class="field__message color-danger">
                    <i class="fa fa-times-circle"></i> {{ $errors->first('password') }}
                </small>
                @endif
            </div>

            <div class="field mb-small">
                <label class="field__label" for="password_confirmation">Повторно введите пароль</label>
                <input class="input" type="password" id="password_confirmation" name="password_confirmation" placeholder="Подтверждение пароля" required>
            </div>

            <button class="btn btn--info btn--fullwidth" type="submit">Сброс пароля</button>
        </form>
    </div>

    <a class="text-mute text-small" href="{{ route('login') }}">
        Вспомнили пароль? Войдите
    </a>
</div>
@endsection
