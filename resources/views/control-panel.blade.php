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

        <div class="c-dropdown dropdown u-mr-medium u-ml-small u-hidden-down@mobile">
            <a class="dropdown-toggle" href="#" id="dropdownMenuAlerts" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-wallet u-mr-xsmall"></i>
                {{ money_format('%.2n', Auth::user()->balance / 100) }} ₽
            </a>

            <div class="c-dropdown__menu c-dropdown__menu--large dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuAlerts">
                <a href="#" class="c-dropdown__item dropdown-item o-media">
                    <span class="o-media__img u-mr-xsmall">
                        <span class="c-avatar c-avatar--xsmall">
                            <span class="c-avatar__img u-bg-fancy u-flex u-justify-center u-align-items-center">
                                <i class="fa fa-calendar u-text-large u-color-white"></i>
                            </span>
                        </span>

                    </span>
                    <div class="o-media__body">
                        <h6 class="u-mb-zero">История операций</h6>
                        <p class="u-text-mute">Информация о движении средств на лицевом счете</p>
                    </div>
                </a>
            </div>
        </div>

        <div class="c-dropdown dropdown">
            <a  class="c-avatar c-avatar--xsmall has-dropdown dropdown-toggle" href="#" id="dropdwonMenuAvatar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="c-avatar__img" src="https://ui-avatars.com/api/?name={{ Auth::user()->name .'+'. Auth::user()->surname }}&background=2ea1f8&color=fff&rounded=true" alt="{{ Auth::user()->name ?? Auth::user()->email }}">
            </a>

            <div class="c-dropdown__menu dropdown-menu dropdown-menu-right" aria-labelledby="dropdwonMenuAvatar">
                @if (Route::has('cp.account.info'))
                <a class="c-dropdown__item dropdown-item" href="{{ route('cp.account.info') }}">Профиль аккаунта</a>
                @endif
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
