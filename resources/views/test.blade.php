@extends('layouts.main')

@section('main')
<div class="container">
@parent
 asd
</div>

<h1>{{$activrType}}</h1>

@component('modal')
   test
    {{-- @slot('title')
        New title
    @endslot --}}
@endcomponent

@endsection
