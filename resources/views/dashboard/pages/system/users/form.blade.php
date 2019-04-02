@extends('dashboard.pages.layout')
@section('title_page')
    @if($user->exists) Usuario: {{ $user->name }} @else Nuevo usuario @endif
@endsection
@section('breadcrumbs') {!! Breadcrumbs::render('users.create', $user) !!} @endsection
@section('content_body_page')
	<div class="row">
	    <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
	        <div class="block">
	            <div class="block-title">
	                <h2>Datos del Usuario</h2>
	            </div>
                
                {!! Form::model($user, $form_data + array('id' => 'form-users', 'class' => 'form-horizontal form-bordered'))!!}

                    {!! Field::text('username', null, ['template' => 'horizontal', 'placeholder' => 'Nombre de usuario']) !!}

                    {!! Field::password('password', ['template' => 'horizontal', 'placeholder' => 'Contraseña']) !!}

                    {!! Field::password('password_confirmation', ['template' => 'horizontal', 'placeholder' => 'Repita la Contraseña']) !!}

                    {!! Field::text('name', null, ['template' => 'horizontal', 'placeholder' => 'Nombre Completo']) !!}

                    {!! Field::email('email', null, ['template' => 'horizontal', 'placeholder' => 'Correo Electrónico']) !!}

                    {!! Field::select('type_id', $user_types, null, ['template' => 'horizontal', 'data-placeholder' => 'Tipos de Usuario']) !!}
 
	                <div class="form-group form-actions">
	                    <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar</button>
	                    </div>
	                </div>

	            {!! Form::close()!!}

	        </div>
	    </div>
	</div>
@endsection
@section('js_aditional')
	{!! Html::script('assets/js/pages/formUsers.js') !!}
	<!-- Load and execute javascript code used only in this page -->
    <script> $(function (){ FormUsers.init(); });</script>
@endsection