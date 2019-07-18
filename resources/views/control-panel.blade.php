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
        <a class="c-sidebar__brand" href="{{ route('cp.index') }}" title="Панель управления">
            <img class="c-sidebar__brand-img" src="/img/logo-cp.png" alt="logo"> Панель управления
        </a>

        @if (Route::has('cp.domain.list'))
        <h4 class="c-sidebar__title">Доменные имена</h4>
        <ul class="c-sidebar__list">
            <li class="c-sidebar__item">
                <a class="c-sidebar__link {{ route::is('cp.domain.*') ? 'is-active' : '' }}"
                    href="{{ route('cp.domain.list') }}"><i class="fa fa-globe u-mr-xsmall"></i>Список доменов
                </a>
            </li>
        </ul>
        @endif

        @if (Route::has('cp.hosting.list'))
        <h4 class="c-sidebar__title">Виртуальный хостинг</h4>
        <ul class="c-sidebar__list">
            <li class="c-sidebar__item">
                <a class="c-sidebar__link {{ route::is('cp.hosting.*') ? 'is-active' : '' }}"
                    href="{{ route('cp.hosting.list') }}"><i class="fa fa-list-alt u-mr-xsmall"></i>Список услуг
                </a>
            </li>
        </ul>
        @endif

        @if (in_array(Auth::user()->id, [1,2,3]))
        <div class="c-sidebar__footer">
            <a href="{{ route('cp.index') }}" class="c-sidebar__footer-link is-active" title="Панель управления">Панель</a>
            <a href="{{ route('mc.index') }}" class="c-sidebar__footer-link" title="Центр управления полётом">ЦУП</a>
        </div>
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
                {{ Auth::user()->name ?? Auth::user()->email }}
            </a>

            <div class="c-dropdown__menu dropdown-menu dropdown-menu-right" aria-labelledby="dropdwonMenuAvatar">
                @if (Route::has('cp.invoice.refill'))
                <a class="c-dropdown__item dropdown-item" href="{{ route('cp.invoice.refill') }}">Пополнить баланс</a>
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
