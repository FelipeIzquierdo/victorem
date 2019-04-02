@extends('dashboard.pages.layout')
@section('class_icon_page') fa fa-users @endsection
@section('title_page') Puestos de Votación @endsection
@section('breadcrumbs') {!! Breadcrumbs::render('polling-stations') !!} @endsection
@section('content_body_page')
    <div class="block full">
        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th title="Nombre">Nombre</th>
                        <th title="Descripción">Descripción</th>
                        <th title="Ubicación">Ubicación</th>
                        <th title="Dirección">Dirección</th>
                        <th title="Potencial">Potencial Electoral</th>
                        <th title="Potencial">Mesas</th>
                        <th class="text-center" style="max-width: 115px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($polling_stations as $polling_station)
                        <tr>
                            <td> {{ $polling_station->name }} </td>
                            <td> {{ $polling_station->description }} </td>
                            <td> {{ $polling_station->locationName }} </td>
                            <td> {{ $polling_station->address }} </td>
                            <td> {{ $polling_station->electoral_potential }} </td>
                            <td> {{ $polling_station->tables }} </td>
                            <td class="text-center">
                                <a href="{{ route('system.polling-stations.edit', $polling_station->id)}}" data-toggle="tooltip" title="Editar" class="btn btn-effect-ripple btn-warning">
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