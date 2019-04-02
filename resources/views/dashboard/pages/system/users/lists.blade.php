@extends('dashboard.pages.layout')
@section('class_icon_page') fa fa-user @endsection
@section('title_page') Usuarios @endsection
@section('breadcrumbs') {!! Breadcrumbs::render('users') !!} @endsection
@section('content_body_page')
    <div class="row" id="title_page" style="margin-bottom: 10px;">
    	<div class="col-md-12">
            <a href="{{ route('system.users.create')}}" class="btn btn-primary"><i class="fa fa-user"></i> Nuevo usuario</a>
        </div>
    </div>
    <div class="block full">
        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th title="Nombre de Usuario">Username</th>
                        <th title="Nombre">Nombre</th>
                        <th title="Correo">Email</th>
                        <th title="Tipo">Tipo de usuario</th>
                        <th class="text-center" style="width: 115px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            
                            <td>{{ $user->username }}</td>
                            <td><strong>{{ $user->name }}</strong></td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->type->name }}</td>
                            <td class="text-center">
                                <a href="{{ route('system.users.edit', $user->id)}}" data-toggle="tooltip" title="Editar tipo de usuario" class="btn btn-effect-ripple btn-warning">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="#" data-id="{{ $user->id }}" id="btn-delete-{{ $user->id }}" onclick="deleteModel('btn-delete-{{ $user->id }}')"  data-toggle="tooltip" title="Borrar tipo de usuario" class="btn btn-effect-ripple btn-danger">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {!! $users->render() !!}
    </div>
    <!-- END Datatables Block -->
    {!! Form::open(array('route' => array('system.users.destroy', 'ID') , 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete'))!!}
@endsection
@section('js_aditional')
	
@endsection