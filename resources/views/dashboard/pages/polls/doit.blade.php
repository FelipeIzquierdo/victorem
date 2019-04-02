@extends('dashboard.pages.layout')
@section('title_page')
    Aplicando Sondeo: {{ $voterPoll->poll->name }}
@endsection
@section('breadcrumbs')
	{!! Breadcrumbs::render('polls.voterPoll', $voterPoll) !!}
@endsection
@section('content_body_page')
	<div class="row">
	    <div class="col-sm-6 col-md-7">
		        <div class="block">
		        	{!! Form::model($voterPoll, $form_data) !!}
			            <div class="block-title">
			                <h2>DETALLE DEL SONDEO</h2>
			            </div>

			            <div class="row">
				            <div class="col-sm-offset-1 col-sm-10">
				            	<div class="form-group">
				            		<p style="font-size:15px;">
				            			{{ $voterPoll->poll->protocol_show }}
				            		</p>
				            	</div>
				            	<div class="form-group">
			            			{!! Form::label('result', 'Resultado', ['style' => 'font-size:17px;']) !!}
				            		{!!  Form::select('result', ['answer' => 'Si Contestó', 'not_answer' => 'No contestó', 'off' => 'Celular apagado'], 'answer', ['class' => 'form-control select-chosen']) !!} 
				            	</div>

			            		@foreach($voterPoll->poll->questions as $key => $question)
			            			<div class="form-group">
			            				{!! Form::label('question', $question->text, ['style' => 'font-size:17px;']) !!}
			            				<div class="col-md-12">
			            					@if($question->type == 'unic')
					            				@foreach($question->answers as $answer)
													<div class="radio">
														<label for="answer-{{ $answer->id }}" style="font-size:16px;">
															<input type="radio" id="answer-{{ $answer->id }}" name="questions[{{ $question->id }}][]" value="{{ $answer->id }}">
															{{ $answer->text }}
														</label>
													</div>
												@endforeach
											@else
												@foreach($question->answers as $answer)
													<div class="checkbox">
														<label for="answer[{{ $answer->id }}]" style="font-size:16px;">
															<input type="checkbox" id="answer[{{ $answer->id }}]" name="questions[{{ $question->id }}][]" value="{{ $answer->id }}">
															{{ $answer->text }}
														</label>
													</div>
												@endforeach
											@endif
										</div>
			            			</div>
			            		@endforeach

			            		<div class="form-group">
			            			{!! Form::label('observation', 'Observación', ['style' => 'font-size:17px;']) !!}
				            		{!! Form::textarea('observation', null, ['class' => 'form-control', 'placeholder' => 'Observación']) !!}
				            	</div>

			                    <div class="form-group form-actions">
			                        <button type="submit" class="btn btn-effect-ripple btn-large btn-primary"><i class="fa fa-check"></i> Guardar llamada</button>
			                    </div>
		                    </div>
	                    </div>

		            {!! Form::close()!!}
		        </div>
        </div>

        <div class="col-sm-6 col-md-5">
	        <div class="block">
	            <div class="block-title">
	                <h2>DATOS DEL VOTANTE</h2>
	            </div>
	            <div class="row">
	            	<div class="col-xs-12">
			            <h4 class="col-sm-4 col-xs-4"><i class="fa fa-user"></i> <strong>Nombre: </strong></h4>
		                <h4 class="col-sm-8 col-xs-8">{{ $voterPoll->voter->name }}</h4>
	                </div>

	                <div class="col-xs-12">
	                	<h4 class="col-sm-4 col-xs-4"><i class="fa fa-phone-square"></i></i> <strong>Celular: </strong></h4>
	                	<h4 class="col-sm-8 col-xs-8">{{ $voterPoll->voter->telephone }}</h4>
	                </div>

	                <div class="col-xs-12">
	                	<h4 class="col-sm-4 col-xs-4"><i class="gi gi-old_man"></i> <strong>Referido: </strong></h4>
	                	<h4 class="col-sm-8 col-xs-8">{{ $voterPoll->voter->superior_name }}</h4>
	                </div>

	                <div class="col-xs-12">
	                	<h4 class="col-sm-4 col-xs-4"><i class="fa fa-home"></i> <strong>Dirección: </strong></h4>
	                	<h4 class="col-sm-8 col-xs-8">{{ $voterPoll->voter->address }} - {{ $voterPoll->voter->location_name }}</h4>
	                </div>

	                <div class="col-xs-12">
	                	<h4 class="col-sm-4 col-xs-4"><i class="fa fa-user-secret"></i> <strong>Ocupación: </strong></h4>
	                	<h4 class="col-sm-8 col-xs-8">{{ $voterPoll->voter->occupation_name }} </h4>
	                </div>

                </div>
	        </div>

	        <div class="row">
	        	<h3 class="text-info col-md-12">Realizadas hoy</h3>
		        <div class="col-sm-4">
					<a href="javascript:void(0)" class="widget">
						<div class="widget-content themed-background-info text-light-op">
							<i class="fa fa-fw fa-chevron-right"></i> <strong>Llamadas</strong>
						</div>
						<div class="widget-content themed-background-muted text-center">
							<i class="gi gi-iphone_shake fa-3x text-info"></i>
						</div>
						<div class="widget-content text-center">
							<h2 class="widget-heading text-dark">+{{ Auth::user()->voterPollsRealizedToday($voterPoll->poll->id) }}</h2>
						</div>
					</a>
				</div>

				<div class="col-sm-4">
					<a href="javascript:void(0)" class="widget">
						<div class="widget-content themed-background-success text-light-op">
							<i class="fa fa-fw fa-chevron-right"></i> <strong>Efectivas</strong>
						</div>
						<div class="widget-content themed-background-muted text-center">
							<i class="hi hi-thumbs-up fa-3x text-success"></i>
						</div>
						<div class="widget-content text-center">
							<h2 class="widget-heading text-dark">+{{ Auth::user()->voterPollsAnsweredToday($voterPoll->poll->id) }}</h2>
						</div>
					</a>
				</div>

				<div class="col-sm-4">
					<a href="javascript:void(0)" class="widget">
						<div class="widget-content themed-background-danger text-light-op">
							<i class="fa fa-fw fa-chevron-right"></i> <strong>Todas</strong>
						</div>
						<div class="widget-content themed-background-muted text-center">
							<i class="hi hi-stats fa-3x text-danger"></i>
						</div>
						<div class="widget-content text-center">
							<h2 class="widget-heading text-dark">+{{ $allPollsToday }}</h2>
						</div>
					</a>
				</div>
			</div>

			<div class="row">
				<h3 class="text-info col-md-12">Total</h3>
		        <div class="col-sm-4">
					<a href="javascript:void(0)" class="widget">
						<div class="widget-content themed-background-info text-light-op">
							<i class="fa fa-fw fa-chevron-right"></i> <strong>Llamadas</strong>
						</div>
						<div class="widget-content themed-background-muted text-center">
							<i class="gi gi-iphone_shake fa-3x text-info"></i>
						</div>
						<div class="widget-content text-center">
							<h2 class="widget-heading text-dark">+{{ Auth::user()->voterPollsRealized($voterPoll->poll->id) }}</h2>
						</div>
					</a>
				</div>

				<div class="col-sm-4">
					<a href="javascript:void(0)" class="widget">
						<div class="widget-content themed-background-success text-light-op">
							<i class="fa fa-fw fa-chevron-right"></i> <strong>Efectivas</strong>
						</div>
						<div class="widget-content themed-background-muted text-center">
							<i class="hi hi-thumbs-up fa-3x text-success"></i>
						</div>
						<div class="widget-content text-center">
							<h2 class="widget-heading text-dark">+{{ Auth::user()->voterPollsAnswered($voterPoll->poll->id) }}</h2>
						</div>
					</a>
				</div>

				<div class="col-sm-4">
					<a href="javascript:void(0)" class="widget">
						<div class="widget-content themed-background-danger text-light-op">
							<i class="fa fa-fw fa-chevron-right"></i> <strong>Todas</strong>
						</div>
						<div class="widget-content themed-background-muted text-center">
							<i class="hi hi-stats fa-3x text-danger"></i>
						</div>
						<div class="widget-content text-center">
							<h2 class="widget-heading text-dark">+{{ $allPolls }}</h2>
						</div>
					</a>
				</div>
			</div>

        </div>
	</div>	
@endsection
