@extends('dashboard.pages.layout')
@section('title_page')
    {{ $poll->name }} : Pregunta
@endsection
@section('breadcrumbs')
	{!! Breadcrumbs::render('polls.question', $poll, $question) !!}
@endsection
@section('content_body_page')
	<div class="row">
        <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
        	<div class="block">
	            <div class="block-title">
	            	<h2>DETALLE DE LA PREGUNTA</h2>
	            </div>
	            	{!! Form::model($question, $form_data + array('class' => 'form-horizontal form-bordered', 'id' => 'form-validation')) !!}
	            		{!! Form::hidden('poll_id', $poll->id) !!}
	            		{!!  Field::text('text' , null, ['template' => 'horizontal', 'placeholder' => 'Pregunta']) !!} 
	            		{!!  Field::select('type', ['unic' => 'Unica Respuesta', 'multiple' => 'Multiple Respuesta'], null, ['template' => 'horizontal', 'data-placeholder' => 'Seleccione un tipo']) !!} 
	            		
	            		@foreach($question->answers as $answer)
	            			<div class="form-group">
	            				{!! Form::label('answer['.$answer->id.']', 'Respuesta', ['class' => 'col-md-4 control-label']) !!}
								<div class="col-md-6">
								  <div class="input-group">
							  		{!!  Form::text('answer['.$answer->id.']', $answer->text, ['class' => 'form-control', 'required']) !!}
							      	<span class="input-group-addon">
							      		<a href="#" title="Borrar" class="text-danger" data-id="{{ $answer->id }}" 
							      			id="btn-delete-{{$answer->id}}" onclick="deleteAnswer('btn-delete-{{$answer->id}}')">
											<i class="fa fa-trash-o"></i>
										</a>
									</span>
								  </div>
								</div>
							</div>
	            			
	            		@endforeach

	            		{!!  Field::text('new_answers' , null, ['template' => 'horizontal', 'class' => 'input-tags', 'placeholder' => 'Nuevas Respuestas']) !!} 
	            		
	            		<div class="form-group form-actions">
		                    <div class="col-md-8 col-md-offset-4">
	                            <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar</button>
		                    </div>
		                </div>

	            	{!! Form::close() !!}
    		</div>
        </div>
    </div>

    {!! Form::open(array('route' => array('answers.destroy', 'ID') , 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete')) !!}

@endsection

@section('js_aditional')
	{!! Html::script('assets/js/pages/poll/formQuestion.js') !!}
	<!-- Load and execute javascript code used only in this page -->
    <script> $(function(){ FormsValidation.init(); });</script>
@endsection

