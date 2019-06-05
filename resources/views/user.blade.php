@extends('layouts.app')

@php
//Auth::loginUsingId(4);
@endphp

@section('container')
<div class="alert alert--info mb-medium">
    <i class="alert__icon fa fa-info-circle"></i> Личный кабинет работает в тестовом режиме.
    На данный момент вы можете просмотреть информацию о доменах и действующих услугах.
</div>
@endsection

@section('content')
<div class="page__sidebar js-page-sidebar">
  <div class="sidebar">
    <a class="sidebar__brand" href="{{ route('user') }}">
      Kit.team
    </a>

  @if (Route::has('user.domain'))
    <h4 class="sidebar__title"><a href="{{ route('user.domain') }}">Доменные имена</a></h4>
    <ul class="sidebar__list">
        <li class="sidebar__item">
            <a class="sidebar__link {{ route::is('user.domain') ? 'is-active' : '' }}"
                href="{{ route('user.domain') }}"><i class="fa mr-xsmall"></i> Список доменов
            </a>
        </li>
    </ul>
  @endif

  @if (Route::has('user.hosting'))
    <h4 class="sidebar__title"><a href="{{ route('user.hosting') }}">Виртуальный хостинг</a></h4>
    <ul class="sidebar__list">
        <li class="sidebar__item">
            <a class="sidebar__link {{ route::is('user.hosting') ? 'is-active' : '' }}"
                href="{{ route('user.hosting') }}"><i class="fa mr-xsmall"></i>Список услуг
            </a>
        </li>
    </ul>
  @endif
  </div>
</div>
<main class="page__content">
  <header class="navbar">
    <button class="sidebar-toggle mr-small">
      <span class="sidebar-toggle__bar"></span>
      <span class="sidebar-toggle__bar"></span>
      <span class="sidebar-toggle__bar"></span>
    </button>

    <h2 class="navbar__title mr-auto">@yield('page.title', 'Панель управления')</h2>

    <div class="dropdown dropdown u-text-right">
        <a  class="avatar text-mute mb-zero has-dropdown dropdown-toggle" href="#" id="dropdwonMenuAvatar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ Auth::user()->name }}
        </a>

        <div class="dropdown__menu dropdown-menu dropdown-menu-right" aria-labelledby="dropdwonMenuAvatar">
        @if (Route::has('user.invoice.refill'))
            <a class="dropdown__item dropdown-item" href="{{ route('user.invoice.refill') }}">Пополнить баланс</a>
        @endif
            <a class="dropdown__item dropdown-item" href="{{ route('logout') }}">Выход</a>
        </div>
    </div>

  </header>

  <div class="container-fluid mt-medium">
    @yield('container')
  </div>
</main>
@endsection
