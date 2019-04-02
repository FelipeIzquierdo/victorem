@extends('dashboard.pages.database.voters.lists.layout')
@section('title_page') Busqueda de Votantes: {{ $text }} @endsection
@section('breadcrumbs') {!! Breadcrumbs::render('voters.search', $text) !!} @endsection
@section('before-table')
    <div class="row" id="title_page"> </div>
@endsection
