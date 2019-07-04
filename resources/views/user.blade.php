@extends('layouts.app')

@php
@endphp

@section('container')
<div class="c-alert c-alert--info u-mb-medium">
    <i class="c-alert__icon fa fa-info-circle"></i> Личный кабинет работает в тестовом режиме.
    На данный момент вы можете просмотреть информацию о доменах и действующих услугах.
</div>
@endsection

@section('content')
<div class="o-page__sidebar js-page-sidebar">
  <div class="c-sidebar">
    <a class="c-sidebar__brand" href="{{ route('user') }}">
      Kit.team
    </a>

  @if (Route::has('user.domain'))
    <h4 class="c-sidebar__title"><a href="{{ route('user.domain') }}">Доменные имена</a></h4>
    <ul class="c-sidebar__list">
        <li class="c-sidebar__item">
            <a class="c-sidebar__link {{ route::is('user.domain') ? 'is-active' : '' }}"
                href="{{ route('user.domain') }}"><i class="fa u-mr-xsmall"></i> Список доменов
            </a>
        </li>
    </ul>
  @endif

  @if (Route::has('user.hosting'))
    <h4 class="c-sidebar__title"><a href="{{ route('user.hosting') }}">Виртуальный хостинг</a></h4>
    <ul class="c-sidebar__list">
        <li class="c-sidebar__item">
            <a class="c-sidebar__link {{ route::is('user.hosting') ? 'is-active' : '' }}"
                href="{{ route('user.hosting') }}"><i class="fa u-mr-xsmall"></i>Список услуг
            </a>
        </li>
    </ul>
  @endif
  </div>
</div>
<main class="o-page__content">
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
</main>
@endsection
