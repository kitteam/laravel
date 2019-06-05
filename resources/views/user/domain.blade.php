@extends('user')

@section('title', 'Список доменов | '. config('app.name'))
@section('page.title', 'Доменные имена')

@section('container')
<div class="table-responsive@desktop">
    <table class="table">

        <caption class="table__title">
            Список доменов <small>{{ count($collections) }} {{ trans_choice('домен|домена|доменов', count($collections)) }}</small>
        </caption>

        <thead class="table__head table__head--slim">
                <tr class="table__row">
                  <th class="table__cell table__cell--head">Домен</th>
                  <th class="table__cell table__cell--head">Администратор</th>
                  <th class="table__cell table__cell--head">Окончание</th>
                  <th class="table__cell table__cell--head">NS сервера</th>
                  <th class="table__cell table__cell--head">Статус</th>
                  <th class="table__cell table__cell--head">
                      <span class="hidden-visually">Управление</span>
                  </th>
                </tr>
        </thead>

        <tbody>
        @foreach ($collections as $collection)
            <tr class="table__row">
                <td class="table__cell">{{ $collection->domain }}
                    <small class="block text-mute">{{ $collection->provider }}</small>
                </td>

                <td class="table__cell wrap">
                @if ($details = json_decode($collection->details))
                    @php
                        @$contacts = [
                            $details->a_company ?: $details->org_r,
                            $details->a_first_name ?
                                $details->a_first_name .' '. $details->a_last_name : $details->person_r
                        ];
                        $contacts = array_diff($contacts, ['']);
                    @endphp
                @endif
                    {{ implode(', ', $contacts) }}
                </td>

                <td class="table__cell">
                    {{ $collection->expiration_at->format('d.m.Y') ?? '—' }}
                </td>

                <td class="table__cell">
                @if ($nss = json_decode($collection->ns))
                    @foreach ($nss as $ns)
                    <span class="block">{{ $ns->ns }}</span>
                    @endforeach
                @endif
                </td>

                <td class="table__cell">
                @if ($collection->state === 'suspended')
                    <i class="fa fa-circle-o color-danger mr-xsmall"></i>Приостановлен
                @elseif ($collection->state === 'locked')
                    <i class="fa fa-circle-o color-primary mr-xsmall"></i>Заблокирован
                @else ($collection->state === 'activated')
                    <i class="fa fa-circle-o color-success mr-xsmall"></i>Активен
                @endif
                </td>

                <td class="table__cell text-right">

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
