@extends('layouts.app')

@section('title', 'Сброс пароля | '. config('app.name'))
@section('body.class', 'o-page o-page--center')

@section('content')
<div class="o-page__card">
    <div class="c-card u-mb-xsmall">
        <header class="c-card__header u-text-center">
            <div class="row u-justify-center">
                <div class="col-9">
                    <h1 class="u-h3 u-mb-zero">Сброс пароля</h1>
                </div>
            </div>
        </header>

        <form class="c-card__body" method="POST" action="{{ route('password.request') }}">
            {{ csrf_field() }}

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="c-field u-mb-small">
                <label class="c-field__label" for="email">Адрес электронной почты</label>
                <input class="c-input{{ $errors->has('email') ? ' c-input--danger' : '' }}" type="email" id="email" name="email" value="{{ $email ?? old('email') }}" placeholder="E-mail" required autofocus>

                @if ($errors->has('email'))
                <small class="c-field__message u-color-danger">
                    <i class="fa fa-times-circle"></i> {{ $errors->first('email') }}
                </small>
                @endif
            </div>

            <div class="c-field u-mb-small">
                <label class="c-field__label" for="password">Новый пароль</label>
                <input class="c-input{{ $errors->has('password') ? ' c-input--danger' : '' }}" type="password" id="password" name="password" placeholder="Цифры, Буквы..." required>

                @if ($errors->has('password'))
                <small class="c-field__message u-color-danger">
                    <i class="fa fa-times-circle"></i> {{ $errors->first('password') }}
                </small>
                @endif
            </div>

            <div class="c-field u-mb-small">
                <label class="c-field__label" for="password_confirmation">Повторно введите пароль</label>
                <input class="c-input" type="password" id="password_confirmation" name="password_confirmation" placeholder="Подтверждение пароля" required>
            </div>

            <button class="c-btn c-btn--info c-btn--fullwidth" type="submit">Сброс пароля</button>
        </form>
    </div>

    <a class="u-text-mute u-text-small" href="{{ route('login') }}">
        Вспомнили пароль? Войдите
    </a>
</div>
@endsection
