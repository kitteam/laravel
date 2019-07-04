@extends('user')

@section('title', 'Список доменов | '. config('app.name'))
@section('page.title', 'Доменные имена')

@section('container')
<div class="c-table-responsive@desktop">
    <table class="c-table">

        <caption class="c-table__title">
            Список доменов <small>{{ count($collections) }} {{ trans_choice('домен|домена|доменов', count($collections)) }}</small>
        </caption>

        <thead class="c-table__head c-table__head--slim">
                <tr class="c-table__row">
                  <th class="c-table__cell c-table__cell--head">Домен</th>
                  <th class="c-table__cell c-table__cell--head">Администратор</th>
                  <th class="c-table__cell c-table__cell--head">Окончание</th>
                  <th class="c-table__cell c-table__cell--head">NS сервера</th>
                  <th class="c-table__cell c-table__cell--head">Статус</th>
                  <th class="c-table__cell c-table__cell--head">
                      <span class="u-hidden-visually">Управление</span>
                  </th>
                </tr>
        </thead>

        <tbody>
        @foreach ($collections as $collection)
            <tr class="c-table__row">
                <td class="c-table__cell">{{ $collection->domain }}
                    <small class="u-block u-text-mute">{{ $collection->provider }}</small>
                </td>

                <td class="c-table__cell u-wrap">
                @if ($details = json_decode($collection->details))
                    @php
                        @$contacts = [
                            array_diff( [
                                $details->a_company,
                                $details->org_r
                            ], ['', ' '] ),
                            array_diff( [
                                $details->a_first_name .' '. $details->a_last_name,
                                $details->o_first_name_ru .' '. $details->o_last_name_ru,
                                $details->person_r
                            ], ['', ' '] )
                        ];
                        $contacts = array_diff( [
                            current($contacts[0]),
                            current($contacts[1])
                        ], ['']);
                    @endphp
                    {{ implode(', ', $contacts) }}
                @endif
                </td>

                <td class="c-table__cell">
                    {{ $collection->expiration_at->format('d.m.Y') ?? '—' }}
                </td>

                <td class="c-table__cell">
                @if ($nss = json_decode($collection->ns))
                    @foreach ($nss as $ns)
                    <span class="u-block">{{ $ns->ns }}</span>
                    @endforeach
                @endif
                </td>

                <td class="c-table__cell">
                @switch($collection->state)
                    @case('activated')

                        <i class="fa fa-circle-o u-color-success u-mr-xsmall"></i>Активен

                        @break
                    @case('suspended')
                        <i class="fa fa-circle-o u-color-danger u-mr-xsmall"></i>Приостановлен
                        @break
                    @case('deleted')
                        <i class="fa fa-circle-o u-text-mute u-mr-xsmall"></i>Удалён
                        @break
                    @case('transferred')
                        <i class="fa fa-circle-o u-text-mute u-mr-xsmall"></i>Перенесён
                        @break
                    @case('inactivated')
                    @default
                        <i class="fa fa-circle-o u-text-mute u-mr-xsmall"></i>Неактивен
                @endswitch
                </td>

                <td class="c-table__cell u-text-right">
                    <div class="c-board__actions dropdown">
                        <a class="dropdown-toggle" href="#" id="dropdwonMenuBoard{{ $collection->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="u-width-initial" src="/img/icon-dots.svg" alt="Управление">
                        </a>
                        <div class="c-dropdown__menu dropdown-menu dropdown-menu-right" aria-labelledby="dropdwonMenuBoard{{ $collection->id }}">
                            <a href="/{{ Request::path() }}/{{ $collection->id }}" class="c-dropdown__item">Управление</a>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
{{-- <h3>Возможные статусы:</h3>
<div class="row">
    <div class="col-12">
//        <i class="fa fa-circle-o u-color-warning u-mr-xsmall"></i> «A» – домен активен, требуется продление
    </div>
</div> --}}
@endsection
