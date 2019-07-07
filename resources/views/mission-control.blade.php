@extends('layouts.app')

@section('content')
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
@endsection

@section('body')
<div class="o-page__sidebar js-page-sidebar">
    @section('sidebar')
    <div class="c-sidebar">
        <a class="c-sidebar__brand" href="{{ route('mcc.index') }}">
            <a class="c-sidebar__brand" href="{{ route('mcc.index') }}">
                <img class="c-sidebar__brand-img" src="/img/logo-cp.png" alt="logo"> ЦУП
            </a>

        @if (Route::has('crm.tele2'))
        <h4 class="c-sidebar__title"><a href="{{ route('crm.tele2') }}">Телефония</a></h4>
        <ul class="c-sidebar__list">
            <li class="c-sidebar__item">
                <a class="c-sidebar__link {{ route::is('crm.tele2.history') ? 'is-active' : '' }}"
                    href="{{ route('crm.tele2.history') }}"><i class="fa u-mr-xsmall"></i> Список вызовов
                </a>
            </li>
        </ul>
        @endif

        @if (Route::has('crm.account'))
        <h4 class="c-sidebar__title"><a href="{{ route('crm.account') }}">Аккаунты</a></h4>
        <ul class="c-sidebar__list">
            <li class="c-sidebar__item">
                <a class="c-sidebar__link {{ route::is('crm.account') ? 'is-active' : '' }}"
                    href="{{ route('crm.account') }}"><i class="fa u-mr-xsmall"></i> Список аккаунтов
                </a>
            </li>
        </ul>
        @endif

    </div>
    @show
</div>

<main class="o-page__content">
    @section('main')
    <header class="c-navbar">
        <button class="c-sidebar-toggle mr-small">
            <span class="c-sidebar-toggle__bar"></span>
            <span class="c-sidebar-toggle__bar"></span>
            <span class="c-sidebar-toggle__bar"></span>
        </button>

        <h2 class="c-navbar__title u-mr-auto">@yield('page.title', 'Панель управления')</h2>

        <div class="c-dropdown dropdown u-text-right">
            <a  class="c-avatar u-text-mute u-mb-zero has-dropdown dropdown-toggle" href="#" id="dropdwonMenuAvatar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->name }}
            </a>

            <div class="c-dropdown__menu dropdown-menu dropdown-menu-right" aria-labelledby="dropdwonMenuAvatar">
                @if (Route::has('user.invoice.refill'))
                <a class="c-dropdown__item dropdown-item" href="{{ route('user.invoice.refill') }}">Пополнить баланс</a>
                @endif
                <a class="c-dropdown__item dropdown-item" href="{{ route('logout') }}">Выход</a>
            </div>
        </div>
    </header>

    <div class="container-fluid u-mt-medium u-mb-xlarge">
        @yield('container')
    </div>
    @show
</main>
@endsection
