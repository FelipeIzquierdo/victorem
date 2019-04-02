@extends('dashboard.pages.layout')
@section('class_icon_page') fa fa-users @endsection
@section('title_page') Ubicaciones @endsection
@section('breadcrumbs') {!! Breadcrumbs::render('locations') !!} @endsection
@section('content_body_page')
    <div class="row" id="title_page" style="margin-bottom: 10px;">
    	<div class="col-md-12">
            <a href="{{ route('system.locations.create')}}" class="btn btn-primary"><i class="fa fa-user"></i> Nueva Ubicación</a>
        </div>
    </div>
    <div class="block full">
        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th title="Id">Id</th>
                        <th title="Nombre">Nombre</th>
                        <th title="Descripción">Tipo</th>
                        <th title="Descripción">Potencial electoral</th>
                        <th title="Superior">Superior</th>
                        <th class="text-center" style="max-width: 115px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($locations as $location)
                        <tr>
                            <td> {{ $location->id }} </td>
                            <td> {{ $location->name }} </td>
                            <td> {{ $location->type_name }} </td>
                            <td> {{ $location->electoral_potential }} </td>
                            <td> {{ $location->superior_name }} </td>

                            <td class="text-center">
                                <a href="{{ route('system.locations.edit', $location->id)}}" data-toggle="tooltip" title="Editar" class="btn btn-effect-ripple btn-warning">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
@section('js_aditional')
	<!-- Load and execute javascript code used only in this page -->
    {!! Html::script('assets/js/lists.js') !!}
	{!! Html::script('assets/js/pages/uiTables.js') !!}
    <script>$(function(){ UiTables.init(); });</script>
@endsection