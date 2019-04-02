@extends('dashboard.pages.layout')
@section('title_page') Asistencia: {{ $diary->name }} @endsection
@section('breadcrumbs') {!! Breadcrumbs::render('diary.people', $diary) !!} @endsection
@section('content_body_page')
	<span id="diary" data-diary="{{ $diary->id }}"></span>
	<div class="row">	
		<div class="col-md-4">
			<div class="block">
	            <div class="block-title">
	                <h2>{{ $diary->name }}</h2>
	            </div>	            
	            <div class="row">
	                <div class="col-xs-12">
	                    <h4 class="col-xs-2"><i class="hi hi-map-marker"></i> </h4>
	                    <h4 class="col-xs-10">{{ $diary->location->name }} - {{ $diary->place }} </h4>
	                </div>

	                <div class="col-xs-12">
	                    <h4 class="col-xs-2"><i class="gi gi-calendar"></i> </h4>
	                    <h4 class="col-xs-10">{{ $diary->date }}</h4>
	                </div>
	                
	                <div class="col-xs-12">
	                    <h4 class="col-xs-2"><i class="hi hi-time"></i> </h4>
	                    <h4 class="col-xs-10">De {{ $diary->time }} a {{ $diary->endtime }}</h4>
	                </div>

	                <div class="col-xs-12">
	                    <h4 class="col-xs-2"><i class="gi gi-old_man"></i> </h4>
	                    <h4 class="col-xs-10">{{ $diary->delegate->name }}</h4>
	                </div>

	                <div class="col-xs-12">
	                    <h4 class="col-xs-2"><i class="gi gi-old_man"></i> </h4>
	                    <h4 class="col-xs-10">{{ $diary->organizer->name }}</h4>
	                </div>

	                <div class="col-xs-12">
	                    <h4 class="col-xs-2"><i class="fa fa-users"></i> </h4>
	                    <h4 class="col-xs-10">{{ $diary->people }}</h4>
	                </div>

	                <div class="col-xs-12">
	                    <h4 class="col-xs-2"><i class="fa fa-automobile"></i> </h4>
	                    <h4 class="col-xs-10">{{ $diary->logistic }} </h4>
	                </div>

	                <div class="col-xs-12">
	                    <h4 class="col-xs-2"><i class="fa fa-bullhorn"></i> </h4>
	                    <h4 class="col-xs-10">{{ $diary->advertising }} </h4>
	                </div>

	                <div class="col-xs-12">
	                    <h4 class="col-xs-2"><i class="fa fa-calendar-o"></i> </h4>
	                    <h4 class="col-xs-10">{{ $diary->description }} </h4>
	                </div>

	                <div class="form-group col-xs-12">
	                	<a href="{{ route('diary.edit', $diary->id) }}" class="btn btn-effect-ripple btn-primary pull-right">
	                		<i class="fa fa-pencil"></i> Editar
	                	</a>
	                </div>

	                
               	</div>
	        </div>		
        </div>

        <div class="col-md-8">
			<div class="block">
	            <div class="block-title">
	                <h2>Asistencia</h2>
	            </div>

	            <div class="row">
    					{!! Form::open(['route' => ['diary.people.add-masive', $diary->id], 'method' => 'POST', 'id' => 'form-diary', 'class' => 'form-horizontal', 'style' => 'display: inline-block; width:100%;']) !!}
						    						    
					    	<div class="col-md-7">
					    		{!! Form::text('docs', null, ['class' => 'form-control input-tags', 'required']) !!}
					    	</div>

						    <div class="col-md-5">
						    	<button class="btn btn-primary"><i class="fa fa-users"></i> Agregar Masivamente</button>
						    </div>

						{!! Form::close() !!}
	            </div>
	            
	            @if(session('unregisteredDocs'))
	            	<div class="alert alert-info alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4><strong>Atención</strong> Los siguientes números de cédula no se encuentran registrados</h4>
						
						@foreach(session('unregisteredDocs') as $doc)
			            	<span class="label label-primary">{{ $doc }}</span>
			            @endforeach
					</div>
		        @endif
		        
	            <hr>

	            <div class="row">
    				<div class="form-group col-md-12">
    					{!! Form::open(['route' => 'database.voters.redirect', 'method' => 'POST', 'class' => 'form-inline', 'style' => 'display: inline-block;']) !!}
						    
						    {!! Form::hidden('diary', $diary->id) !!}
						    
						    <div class="form-group">
						        {!! Form::select('type', ['voter' => 'Votante', 'team' => 'Equipo'], null, ['class' => 'form-control', 'id' => 'select-type', 'required']) !!}
						    </div>
						    <div class="form-group" style="min-width:230px;">
						        {!! Form::select('colaborator', $team, $teamSession, ['class' => 'select-chosen form-control','required' => 'required', 'data-placeholder' => 'Persona Jefe', 'style' => 'width:250px;']) !!}
						    </div>
						    <div class="form-group">
						        {!! Form::number('doc', null, ['class' => 'form-control', 'placeholder' => 'Número de Cédula', 'required' => 'required']) !!}
						    </div>
						    <div class="form-group">
						        <button class="btn btn-info"><i class="gi gi-old_man"></i> Agregar</button>
						    </div>
						{!! Form::close() !!}
	            	</div>
	            </div>	            

	            @include('dashboard.pages.database.voters.lists.include.table', ['voters' => $diary->voters_paginate])


        		@include('dashboard.pages.database.voters.lists.include.modal')



        		{!! Form::open(array('route' => array('database.voters.destroy', 'ID') , 'method' => 'POST', 'role' => 'form', 'id' => 'form-delete')) !!} 
        		{!! Form::close() !!}

        		{!! Form::open(array('route' => array('diary.people.remove', $diary->id, 'ID') , 'method' => 'POST', 'role' => 'form', 'id' => 'form-diary-remove')) !!}
        		{!! Form::close() !!}

	        </div>		
        </div>

	</div>
@endsection
@section('js_aditional')
    {!! Html::script('assets/js/pages/voter/lists.js'); !!}

    <script type="text/javascript">
    	$( "#select-type" ).change(function() {
    		if($( "#select-type" ).val() == 'voter')
    		{
    			$('#form-diary').attr('action', '/database/voters/redirect');
    		}
    		else
    		{
    			$('#form-diary').attr('action', '/database/team/redirect');
    		}
		});
    </script>

@endsection