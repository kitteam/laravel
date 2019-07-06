@extends('layouts.app')

@section('title', 'Восстановление пароля | '. config('app.name'))
@section('body.class', 'o-page o-page--center')

@section('body')
<div class="o-page__card">
    <div class="c-card u-mb-xsmall">
        <header class="c-card__header u-text-center">
            <div class="row u-justify-center">
                <div class="col-9">
                    <h1 class="u-h3">Восстановление пароля</h1>
                    <p class="u-h6 u-text-mute">
                        Для получения инструкции по сбросу пароля введите свой адрес электронной почты
                    </p>
                </div>
            </div>
        </header>

        <form class="c-card__body" method="POST" action="{{ route('password.email') }}">
            {{ csrf_field() }}

            @if (session('status'))
            <div class="c-alert c-alert--success">
                <i class="c-alert__icon fa fa-check-circle"></i> {{ session('status') }}
            </div>
            @endif

            <div class="c-field u-mb-small">
                <label class="c-field__label" for="email">Адрес электронной почты</label>
                <input class="c-input{{ $errors->has('email') ? ' c-input--danger' : '' }}" type="email" id="email" name="email" value="{{ old('email') }}" placeholder="E-mail" required>

                @if ($errors->has('email'))
                <small class="c-field__message u-color-danger">
                    <i class="fa fa-times-circle"></i> {{ $errors->first('email') }}
                </small>
                @endif
            </div>

            <button class="c-btn c-btn--info c-btn--fullwidth" type="submit">Отправить инструкцию</button>
        </form>
    </div>
@if (Route::has('register'))
    <a class="u-text-mute u-text-small" href="{{ route('register') }}">
        Ещё нет аккаунта? Зарегистрируйтесь
    </a>
@endif
</div>
@endsection
