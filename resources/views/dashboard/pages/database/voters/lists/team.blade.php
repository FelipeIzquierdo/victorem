@extends('dashboard.pages.database.voters.lists.layout')

@section('title_page') Equipo de Campaña @endsection

@section('breadcrumbs') {!! Breadcrumbs::render('team') !!} @endsection

@section('form_voters')
    @include('dashboard.pages.database.voters.lists.include.form', ['route' => 'database.team.redirect', 'value_submit' => 'Agregar al equipo'])
    <a href="/database/roles" class="btn btn-info"><i class="fa fa-users"></i> Ver Estructura</a>
@endsection

