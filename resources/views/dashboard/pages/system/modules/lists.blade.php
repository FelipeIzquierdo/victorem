@extends('dashboard.pages.layout')
@section('class_icon_page') fa fa-users @endsection
@section('title_page') Modulos @endsection
@section('breadcrumbs') {!! Breadcrumbs::render('crud-modules') !!} @endsection
@section('content_body_page')
    <div class="row" id="title_page" style="margin-bottom: 10px;">
    	<div class="col-md-12">
            <a href="{{ route('system.modules.create')}}" class="btn btn-primary"><i class="fa fa-user"></i> Nuevo modulo</a>
        </div>
    </div>
    <div class="block full">
        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th title="Nombre">Nombre</th>
                        <th title="Descripción">Descripción</th>
                        <th title="Descripción">Tipo</th>
                        <th title="Superior">Url</th>
                        <th title="Superior">Superior</th>
                        <th class="text-center" style="max-width: 115px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($modules as $module)
                        <tr>
                            <td>{{ $module->name }}</td>
                            <td><strong>{{ $module->description }}</strong></td>
                            <td>{{ $module->type }}</td>
                            <td>{{ $module->url }}</td>
                            <td>{{ $module->superiorDescription }}</td>
                            <td class="text-center">
                                <a href="{{ route('system.modules.edit', $module->id)}}" data-toggle="tooltip" title="Editar  modulo" class="btn btn-effect-ripple btn-warning">
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