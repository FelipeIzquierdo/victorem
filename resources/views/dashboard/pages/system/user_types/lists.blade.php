@extends('dashboard.pages.layout')
@section('class_icon_page') fa fa-users @endsection
@section('title_page') Tipos de usuario @endsection
@section('breadcrumbs') {!! Breadcrumbs::render('user-types') !!} @endsection
@section('content_body_page')
    <div class="row" id="title_page" style="margin-bottom: 10px;">
    	<div class="col-md-12">
            <a href="{{ route('system.user-types.create')}}" class="btn btn-primary"><i class="fa fa-user"></i> Nuevo tipo de usuario</a>
        </div>
    </div>
    <div class="block full">
        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th title="Nombre">Nombre</th>
                        <th title="Modulos">Modulos</th>
                        <th title="Puede ver todos los registros en sus modulos con permiso">
                            <i class="fa fa-eye"></i>
                        </th>
                        <th class="text-center" style="width: 115px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user_types as $user_type)
                        <tr>
                            <td>{{ $user_type->name }}</td>
                            <td>
                                @foreach($user_type->modules as $module)
                                    <span class="label label-info"> {{ $module->description }} </span> &nbsp;
                                @endforeach
                            </td>
                            <td class="text-center"> {{ $user_type->can_view_all_text }} </td>
                            <td class="text-center">
                                @if(! $user_type->system)
                                    <a href="{{ route('system.user-types.edit', $user_type->id)}}" data-toggle="tooltip" title="Editar tipo de usuario" class="btn btn-effect-ripple btn-warning">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="#" data-id="{{ $user_type->id }}" id="btn-delete-{{ $user_type->id}}" onclick="deleteModel('btn-delete-{{ $user_type->id!!}')"  data-toggle="tooltip" title="Borrar tipo de usuario" class="btn btn-effect-ripple btn-danger">
                                        <i class="fa fa-times"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Datatables Block -->
    {!! Form::open(array('route' => array('system.user-types.destroy', 'ID') , 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete'))!!}
@endsection
@section('js_aditional')
	<!-- Load and execute javascript code used only in this page -->
    {!! Html::script('assets/js/lists.js') !!}
	{!! Html::script('assets/js/pages/uiTables.js') !!}
    <script>$(function(){ UiTables.init(); });</script>
@endsection