@extends('dashboard.pages.layout')
@section('title_page')
    @if($poll->exists) Sondeo: {{ $poll->name }} @else Nuevo Sondeo de Opinión @endif
@endsection
@section('breadcrumbs') {!! Breadcrumbs::render('polls.show', $poll) !!}
@endsection
@section('content_body_page')
	<div class="row">
	    <div class="col-sm-10 col-md-9" id="show-poll">
	    	<div class="col-xs-12">
		        <div class="block">
		        	{!! Form::model($poll, $form_data) !!}
			            <div class="block-title">
			            	<div class="block-options pull-right">
			            		<label class="switch switch-primary" style="padding: 2px 0 0 0" title="Sondeo Visible?">
		                            @if($poll->active)
		                                <input type="checkbox" value="1" name="active" checked><span></span> 
		                            @else
		                                <input type="checkbox" value="1" name="active"><span></span>
		                            @endif
		                        </label>

			            		<a href="#" class="btn btn-effect-ripple btn-danger" data-toggle="tooltip" title="Borrar">
									<i class="fa fa-trash-o"></i>
								</a>

			            		
							</div>
			                <h2>DETALLE DEL SONDEO</h2>
			            </div>
			            <div class="form-horizontal">
			            	<div class="row">
				            	<div class="col-md-10">
				            		{!! Field::text('name', null, ['template' => 'horizontal-poll', 'placeholder' => 'Nombre del Sondeo']) !!}
				            		{!! Field::text('description', null, ['template' => 'horizontal-poll', 'placeholder' => 'Nombre del Sondeo']) !!}
				            		{!! Field::textarea('protocol', null, ['template' => 'horizontal-poll', 'placeholder' => 'Nombre del Sondeo']) !!}
				            	</div>
				            	
			                    <div class="col-md-2">
			                        <button type="submit" class="btn btn-effect-ripple btn-success">Actualizar</button>
			                        <a href="{{ route('polls.questions.create', $poll->id) }}" class="btn btn-effect-ripple btn-info" title="Nueva Pregunta">
			                        	<i class="fa fa-plus"></i> Pregunta
			                        </a>
			                    </div>
		                    </div>
		                </div>
		            {!! Form::close()!!}
		        </div>
	        </div>
	    
		    @foreach($poll->questions as $key => $question)
		    	<div class="col-xs-12 widget-question">
			        <div class="block">
			            <div class="block-title">
			            	<div class="block-options pull-right">
			            		<span>{{ $question->type_name }} </span>
								<a href="{{ route('polls.questions.edit', [$poll->id, $question->id]) }}" class="btn btn-effect-ripple btn-warning" data-toggle="tooltip" title="Editar">
									<i class="fa fa-pencil"></i>
								</a>
								<a href="#" class="btn btn-effect-ripple btn-danger" data-toggle="tooltip" title="Borrar"
									data-id="{{ $question->id }}" id="btn-delete-{{$question->id}}" onclick="deleteQuestion('btn-delete-{{$question->id}}')">
									<i class="fa fa-trash-o"></i>
								</a>
							</div>
			                <h2>{{ $question->text }}</h2>
			            </div>
	        			
	        			<div class="row" style="margin-bottom: 15px;">
	        				<div class="col-md-12">
		        				<ul class="fa-ul">
					        		@foreach($question->answers as $answer)
					        			<li class="col-md-6" style="font-size:16px;">
					        				<i class="fa fa-arrow-right fa-li"></i> 
					        				{{ $answer->text }} 
					        			</li>
					        		@endforeach
				        		</ul>
			        		</div>
		        		</div>

	    			</div>
	    		</div>
	        @endforeach
        </div>

        <div class="col-sm-2 col-md-3">
        	<a href="javascript:void(0)" class="widget">
				<div class="widget-content themed-background-danger text-light-op">
					<i class="fa fa-fw fa-chevron-right"></i> <strong>Cantidad de Encuestados</strong>
				</div>
				<div class="widget-content themed-background-muted text-center">
					<i class="fa fa-line-chart fa-3x text-danger"></i>
				</div>
					<div class="widget-content text-center">
				<h3 class="widget-heading text-dark">+{{ $poll->voterPolls->count() }}</h3>
				</div>
			</a>
        </div>

	</div>

	{!! Form::open(array('route' => array('polls.questions.destroy', $poll->id, 'ID') , 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete')) !!}

@endsection
@section('js_aditional')
	
@endsection