@extends('dashboard.pages.layout')
@section('title_page')
    @if($module->exists) Modulo: {{ $module->name }} @else Nuevo modulo @endif
@endsection
@section('breadcrumbs') {!! Breadcrumbs::render('crud-modules.create', $module) !!} @endsection
@section('content_body_page')
	<div class="row">
	    <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
            {!! Form::model($module, $form_data + array('id' => 'form-modules'))!!}
    	        <div class="block">
    	            <div class="block-title">
    	                <h2>Datos del modulo</h2>
                        <label class="switch switch-primary" style="padding: 5px 15px 4px; float:right;" title="¿Producto Visible?">
                            @if($module->active)
                                <input type="checkbox" value="1" name="active" checked><span></span> 
                            @else
                                <input type="checkbox" value="1" name="active"><span></span>
                            @endif
                        </label>
    	            </div>
                    <div class="form-horizontal form-bordered">

                        {!! Field::select('superior', $modules, null, ['template' => 'horizontal', 'data-placeholder' => 'Seleccione el módulo superior']) !!}
                
                        {!! Field::select('type', $types, null, ['template' => 'horizontal', 'data-placeholder' => 'Seleccione un tipo']) !!}

                        {!! Field::text('name', null, ['template' => 'horizontal', 'placeholder' => 'Nombre']) !!}

                        {!! Field::text('description', null, ['template' => 'horizontal', 'placeholder' => 'Descripción']) !!}

                        {!! Field::text('url', null, ['template' => 'horizontal', 'placeholder' => 'Url']) !!}

                        {!! Field::text('image', null, ['template' => 'horizontal', 'placeholder' => 'Imagen']) !!}

                        {!! Field::text('color_class', null, ['template' => 'horizontal', 'placeholder' => 'Clase CSS de Color Boostrap ']) !!}

                        {!! Field::text('icon_class', null, ['template' => 'horizontal', 'placeholder' => 'Clase CSS de Icono Boostrap ']) !!}
                                                    
                        <div class="form-group form-actions">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar</button>
                            </div>
                        </div>
                    </div>

                </div>
            {!! Form::close()!!}
	    </div>
	</div>
@endsection
@section('js_aditional')
	{!! Html::script('assets/js/pages/formModules.js') !!}
	<!-- Load and execute javascript code used only in this page -->
    <script> $(function (){ FieldModules.init(); });</script>
@endsection