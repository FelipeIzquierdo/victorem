@extends('dashboard.pages.database.voters.lists.layout')
@section('title_page') Lista de Votantes @endsection
@section('breadcrumbs') {!! Breadcrumbs::render('voters') !!} @endsection

@section('form_voters')
    @include('dashboard.pages.database.voters.lists.include.form', ['route' => 'database.voters.redirect', 'value_submit' => 'Agregar Votante'])
@endsection
