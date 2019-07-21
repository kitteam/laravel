@extends('control-panel')

@section('title', 'Аккаунт | '. config('app.name'))
@section('page.title', 'Аккаунт')

@php
$security = request()->get('password');
@endphp

@section('container')
<div class="row u-mb-large">
    <div class="col-12">
        <div class="c-tabs">

            <ul class="c-tabs__list nav nav-tabs" id="account" role="tablist">
                <li class="c-tabs__item">
                    <a class="c-tabs__link {{ $security ?: 'active' }}" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="true">Мои даннные</a>
                </li>

                <li class="c-tabs__item">
                    <a class="c-tabs__link {{ !$security ?: 'active' }}" id="nav-security-tab" data-toggle="tab" href="#nav-security" role="tab" aria-controls="nav-security" aria-selected="false">Пароль</a>
                </li>
            </ul>

            <div class="c-tabs__content tab-content" id="nav-tab-content">
                <form method="post" class="c-tabs__pane {{ $security ?: 'active' }}" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="c-field">
                                <label class="c-field__label" for="email">Email</label>
                                <input class="c-input" type="text" id="email" name="email" value="{{ $collection->email }}" placeholder="Email" required>
                                {{--
                                <small class="c-field__message u-color-success">
                                    <i class="fa fa-check-circle"></i>Подтвержден
                                </small>
                                --}}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="c-field">
                                <label class="c-field__label" for="phone">Телефон</label>
                                <input class="c-input" type="text" id="phone" name="phone" value="{{ $collection->phone }}" placeholder="Телефон">
                                {{--
                                <small class="c-field__message">
                                    <i class="fa fa-info-circle"></i>Не задан
                                </small>
                                --}}
                            </div>
                        </div>
                    </div>
                    <span class="c-divider has-text u-mt-large u-mb-large">Персональные данные</span>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="c-field u-mb-small">
                                <label class="c-field__label" for="name">Имя</label>
                                <input class="c-input" type="text" id="name" name="name" value="{{ $collection->name }}" placeholder="Имя">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="c-field u-mb-small">
                                <label class="c-field__label" for="middlename">Отчество</label>
                                <input class="c-input" type="text" id="middlename" name="middlename" value="{{ $collection->middlename }}" placeholder="Отчество (если есть)">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="c-field u-mb-small">
                                <label class="c-field__label" for="surname">Фамилия</label>
                                <input class="c-input" type="text" id="surname" name="surname" value="{{ $collection->surname }}" placeholder="Фамилия">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="c-field u-mb-small">
                                <label class="c-field__label" for="birthdate">Дата рождения</label>
                                <input class="c-input" data-toggle="datepicker" type="text" id="birthdate" name="birthdate" value="{{ $collection->birthdate->format('d.m.Y') }}" placeholder="Дата рождения">
                            </div>
                        </div>
                    </div>

                    <span class="c-divider has-text u-mt-large u-mb-large">Паспортные данные</span>

                    <div class="row">
                        <div class="col-lg-3">
                            <div class="c-field u-mb-small">
                                <label class="c-field__label" for="passport_number">Серия, номер паспорта</label>
                                <input class="c-input" type="text" id="passport_number" name="passport[number]" value="{{ $collection->passport['number'] }}" placeholder="Серия, номер паспорта">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="c-field u-mb-small">
                                <label class="c-field__label" for="passport_date">Дата выдачи паспорта</label>
                                <input class="c-input" data-toggle="datepicker" type="text" id="passport_date" name="passport[date]" value="{{ $collection->passport['date'] }}" placeholder="Дата выдачи паспорта">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="c-field u-mb-small">
                                <label class="c-field__label" for="passport_issued">Кем выдан паспорт</label>
                                <input class="c-input" type="text" id="passport_issued" name="passport[issued]" value="{{ $collection->passport['issued'] }}" id="passport_issued" placeholder="Кем выдан паспорт">
                            </div>
                        </div>
                    </div>

                    <span class="c-divider has-text u-mt-large u-mb-large">Адрес регистрации</span>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="c-field u-mb-small">
                                <label class="c-field__label" for="address_city">Город</label>
                                <input class="c-input" type="text" id="address_city" name="address[city]" value="{{ $collection->address['city'] }}" placeholder="Город">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="c-field u-mb-small">
                                <label class="c-field__label" for="address_region">Область</label>
                                <input class="c-input" type="text" id="address_region" name="address[region]" value="{{ $collection->address['region'] }}" placeholder="Область">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="c-field u-mb-small">
                                <label class="c-field__label" for="address_district">Район</label>
                                <input class="c-input" type="text" id="address_district" name="address[district]" value="{{ $collection->address['district'] }}" placeholder="Район">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="c-field u-mb-small">
                                <label class="c-field__label" for="address_street">Улица</label>
                                <input class="c-input" type="text" id="address_street" name="address[street]" value="{{ $collection->address['street'] }}" placeholder="Улица">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="c-field u-mb-small">
                                <label class="c-field__label" for="address_house">Номер дома</label>
                                <input class="c-input" type="text" id="address_house" name="address[house]" value="{{ $collection->address['house'] }}" pplaceholder="Номер дома">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="c-field u-mb-small">
                                <label class="c-field__label" for="address_apartment">Номер квартиры</label>
                                <input class="c-input" type="text" id="address_apartment" name="address[apartment]" value="{{ $collection->address['apartment'] }}" placeholder="Номер квартиры">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="c-field u-mb-small">
                                <label class="c-field__label" for="address_postcode">Индекс</label>
                                <input class="c-input" type="text" id="address_postcode" name="address[postcode]" value="{{ $collection->address['postcode'] }}" placeholder="Индекс">
                            </div>
                        </div>
                    </div>

                    <div class="u-flex u-mt-medium">
                        <a href="" class="c-btn c-btn--secondary">Отменить изменения</a>
                        <button type="submit" class="c-btn c-btn--success u-ml-auto">Сохранить изменения</button>
                    </div>

                </form>

                <form method="post" class="c-tabs__pane {{ !$security ?: 'active' }}" id="nav-security" role="tabpanel" aria-labelledby="nav-security-tab">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="c-field">
                                <label class="c-field__label" for="current">Текущий пароль</label>
                                <input class="c-input" type="password" id="current" name="password_current" placeholder="Текущий пароль" required>
                                {{--
                                <small class="c-field__message u-color-success">
                                    <i class="fa fa-check-circle"></i>Подтвержден
                                </small>
                                --}}
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="c-field">
                                <label class="c-field__label" for="password">Новый пароль</label>
                                <input class="c-input" type="password" id="password" name="password" placeholder="Новый пароль" required>
                                {{--
                                <small class="c-field__message u-color-success">
                                    <i class="fa fa-check-circle"></i>Подтвержден
                                </small>
                                --}}
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="c-field">
                                <label class="c-field__label" for="confirmation">Подтверждение пароля</label>
                                <input class="c-input" type="password" id="confirmation" name="password_confirmation" placeholder="Подтверждение" required>
                                {{--
                                <small class="c-field__message">
                                    <i class="fa fa-info-circle"></i>Не задан
                                </small>
                                --}}
                            </div>
                        </div>
                    </div>



{{--
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
--}}
                    <div class="u-flex u-mt-medium">
                        <a href="" class="c-btn c-btn--secondary">Отменить изменения</a>
                        <button type="submit" class="c-btn c-btn--success u-ml-auto">Сохранить изменения</button>
                    </div>
                </form>
            </div>
        </div>

    </div><!-- // .col-12 -->
</div>
@endsection
