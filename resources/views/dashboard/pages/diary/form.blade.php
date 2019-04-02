@extends('dashboard.pages.layout')
@section('title_page') Agendar @endsection
@section('breadcrumbs') {!! Breadcrumbs::render('diary.create', $diary) !!} @endsection
@section('content_body_page')
	<div class="row">		
		<div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
			<div class="block">
	            <div class="block-title">
	                <h2>@if($diary->exists) Editar evento: {{ $diary->name }} @else Crear Evento @endif </h2>
	                @if($diary->exists)
		                <div class="block-options pull-right">
		                	{!! Form::open(['route' => ['diary.destroy', $diary->id], 'method' => 'DELETE']) !!}
								<button type="submit" class="btn btn-effect-ripple btn-danger" data-toggle="tooltip" title="¿Seguro desea Borrar el evento?"><i class="gi gi-skull"></i></a>
							{!! Form::close() !!}
						</div>
					@endif
	            </div>	            
	            <div class="form-horizontal form-bordered">
		        	{!! Form::model($diary, $form_data) !!}

			            {!! Field::text('name', null, array('template' => 'horizontal', 'placeholder' => 'Nombre del evento')) !!}

			        	{!! Field::select('organizer_id', $team, null, ['template' => 'horizontal', 'data-placeholder' => 'Seleccione la persona que organiza la reunión']) !!}					            

			            {!! Field::select('delegate_id', $delegates, null, ['template' => 'horizontal', 'data-placeholder' => 'Seleccione un delegado']) !!}				            

                        {!! Field::text('date', null, array('template' => 'horizontal', 'class' => 'input-datepicker', 'placeholder' => 'Año-Mes-Día', 'data-date-format' => 'yyyy-mm-dd')) !!}

                        <div id="input-times">
			            	{!! Field::text('time', null, array('template' => 'horizontal', 'placeholder' => 'Hora', 'class' => 'time start'))!!}
			            	{!! Field::text('endtime', null, array('template' => 'horizontal', 'placeholder' => 'Hora de Finalización', 'class' => 'time end'))!!}
			           	</div> 

			            {!! Field::select('location_id', $locations, null, array('template' => 'horizontal', 'data-placeholder' => 'Seleccione alguna Ubicación (Ciudad, Comuna o Barrio)'))!!}

			            {!! Field::text('place', null, array('template' => 'horizontal', 'placeholder' => 'Dirección o lugar donde se realizará el evento')) !!}

			            {!! Field::number('people', null, array('template' => 'horizontal', 'placeholder' => 'Número de personas')) !!}

			            {!! Field::text('logistic', null, ['class' => 'input-tags', 'template' => 'horizontal']) !!}

			            {!! Field::text('advertising', null, ['class' => 'input-tags', 'template' => 'horizontal']) !!}
			
			            {!! Field::textarea('description', null, array('template' => 'horizontal', 'placeholder' => 'Escribe las notas necesaria para este evento')) !!}

						<div class="form-group form-actions">
		                    <div class="col-md-8 col-md-offset-4">
	                            <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar</button>
		                    </div>
		                </div>
					{!! Form::close() !!}						
				</div>
	        </div>		
        </div>
	</div>
@endsection
@section('js_aditional')		
    <script>     	
    	$('#input-times .time').timepicker({
		    'showDuration': true,
		    'timeFormat': 'g:i A',
		    'lang': { am: 'am', pm: 'pm', AM: 'AM', PM: 'PM', decimal: '.', mins: 'Minutos', hr: 'Hora', hrs: 'Horas' },
		    'disableTextInput': true,
		    'disableTouchKeyboard': true,
		    'scrollDefault': 'now'
		});

		var times = document.getElementById('input-times');
		console.log(times);
		var timeOnlyDatepair = new Datepair(times);

	</script>
@endsection