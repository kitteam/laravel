@extends('layouts.app')

@section('title', 'Восстановление пароля | '. config('app.name'))
@section('body.class', 'page page--center')

@section('content')
<div class="page__card">
    <div class="card mb-xsmall">
        <header class="card__header text-center">
            <div class="row justify-center">
                <div class="col-9">
                    <h1 class="h3">Восстановление пароля</h1>
                    <p class="h6 text-mute">
                        Для получения инструкции по сбросу пароля введите свой адрес электронной почты
                    </p>
                </div>
            </div>
        </header>

        <form class="card__body" method="POST" action="{{ route('password.email') }}">
            {{ csrf_field() }}

            @if (session('status'))
            <div class="alert alert--success">
                <i class="alert__icon fa fa-check-circle"></i> {{ session('status') }}
            </div>
            @endif

            <div class="field mb-small">
                <label class="field__label" for="email">Адрес электронной почты</label>
                <input class="input{{ $errors->has('email') ? ' input--danger' : '' }}" type="email" id="email" name="email" value="{{ old('email') }}" placeholder="E-mail" required>

                @if ($errors->has('email'))
                <small class="field__message color-danger">
                    <i class="fa fa-times-circle"></i> {{ $errors->first('email') }}
                </small>
                @endif
            </div>

            <button class="btn btn--info btn--fullwidth" type="submit">Отправить инструкцию</button>
        </form>
    </div>
@if (Route::has('register'))
    <a class="text-mute text-small" href="{{ route('register') }}">
        Ещё нет аккаунта? Зарегистрируйтесь
    </a>
@endif
</div>
@endsection
