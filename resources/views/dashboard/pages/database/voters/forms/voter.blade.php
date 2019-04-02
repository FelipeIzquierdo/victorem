@extends('dashboard.pages.database.voters.forms.layout')

@section('title_page')
    @if($voter->exists) Votante: {{ $voter->name }} @else Nuevo Votante @endif
@endsection 

@section('breadcrumbs')
	{!! Breadcrumbs::render('voters.create', $voter) !!}
@endsection
