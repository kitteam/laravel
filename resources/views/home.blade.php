@extends('layouts.app')

@php
$theme_settings = [
    'string1',
    'string2',
    'string3',
    ' ',
    'string1',
    'string1'
];

$counts = array_count_values($theme_settings);

print_r($counts);
@endphp

@section('body')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
