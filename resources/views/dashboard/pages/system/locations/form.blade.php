@extends('dashboard.pages.layout')
@section('title_page')
    @if($location->exists) Ubicación: {{ $location->name }} @else Nueva Ubicación @endif
@endsection
@section('breadcrumbs') {!! Breadcrumbs::render('locations.create', $location) !!} @endsection
@section('content_body_page')
	<div class="row">
	    <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
            {!! Form::model($location, $form_data + ['id' => 'form-locations']) !!}
    	        <div class="block">
    	            <div class="block-title">
    	                <h2>Datos de la ubicación</h2>
    	            </div>
                    
                    <div class="form-horizontal form-bordered">

                        {!! Field::text('name', null, ['template' => 'horizontal', 'placeholder' => 'Nombre']) !!}

                        {!! Field::select('type_id', $types, null, ['template' => 'horizontal', 'data-placeholder' => 'Seleccione un tipo']) !!}

                        {!! Field::select('superior', $locations, null, ['template' => 'horizontal', 'data-placeholder' => 'Seleccione la ubicación superior']) !!}

                        {!! Field::number('electoral_potential', null, ['template' => 'horizontal', 'placeholder' => 'Potencial electoral']) !!}
                       
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
	{!! Html::script('assets/js/pages/formlocations.js') !!}
	<!-- Load and execute javascript code used only in this page -->
    <script> $(function (){ Formlocations.init(); });</script>
@endsection