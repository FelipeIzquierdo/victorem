@extends('dashboard.pages.layout')
@section('title_page')
    @if($user_type->exists) Tipo de usuario: {{ $user_type->name }} @else Nuevo tipo de usuario @endif
@endsection
@section('breadcrumbs') {!! Breadcrumbs::render('user-types.create', $user_type) !!}
@endsection
@section('content_body_page')
	<div class="row">
	    <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
	        <div class="block">
	            <div class="block-title">
	                <h2>Datos del tipo de usuario</h2>
	            </div>

                {!! Form::model($user_type, $form_data + array('id' => 'form-usertypes', 'class' => 'form-horizontal form-bordered'))!!}

                    {!! Field::text('name', null, ['template' => 'horizontal', 'placeholder' => 'Nombre']) !!}

                    {!! Field::text('description', null, ['template' => 'horizontal', 'placeholder' => 'Descripción']) !!}

                    {!! Field::checkbox('can_view_all', 1, ['template' => 'switche-large']) !!}

                    {!! Field::select('modules[]', $modules, $user_type->module_ids, ['template' => 'horizontal', 'data-placeholder' => 'Seleccione los módulos con acceso', 'multiple']) !!}
                                
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
	{!! Html::script('assets/js/pages/formUserTypes.js') !!}
	<!-- Load and execute javascript code used only in this page -->
    <script> $(function (){ FormUserTypes.init(); });</script>
@endsection