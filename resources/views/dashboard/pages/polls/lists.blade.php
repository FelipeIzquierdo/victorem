@extends('dashboard.pages.layout')
@section('title_page')
    Sondeos de Opinión
@endsection
@section('breadcrumbs')
	{!! Breadcrumbs::render('polls') !!}
@endsection
@section('content_body_page')
	<div class="row">
        <div class="form-group col-md-12">
        	{!! Form::model($poll, $form_data + ['class' => 'form-inline']) !!}
			    {!! Field::tex('name', null, ['template' => 'inline', 'placeholder' => 'Nombre', 'required' => 'required']) !!}
			    {!! Field::tex('description', null, ['template' => 'inline', 'placeholder' => 'Descripción']) !!}
			    
			    <div class="form-group">
			        <button type="submit" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> Nuevo Sondeo </button>
			    </div>
			{!! Form::close() !!}
        </div>
    </div>

    <div class="row">
		@foreach($polls as $poll)    			
			<div class="col-sm-6 col-md-4">
				<div class="widget">
					<div class="widget-content widget-content-mini themed-background-muted">
						<strong style="font-size:17px;" class="text-dark">{{ $poll->name }}</strong>
					</div>
					<div class="widget-content text-right clearfix">
						<div class="widget-icon themed-background-flat pull-left">
							<i class="fa fa-check-square-o"></i>
						</div>
						<h2 class="widget-heading h3 themed-color-flat"><strong>+ {{ $poll->questions->count() }}</strong></h2>
						<span class="text-muted">PREGUNTAS</span>
					</div>

					<div class="widget-content themed-background-muted">
						<div class="row text-center">
							<div class="col-xs-3">
								<h3 class="widget-heading h4">
									<a href="{{ route('polls.show', $poll->id) }}" class="themed-color-flat" title="Editar Sondeo">
										<i class="hi hi-pencil fa-2x"></i>
									</a>
								</h3>
							</div>
							<div class="col-xs-3">
								<h3 class="widget-heading h4">
									<a href="{{ route('polls.stats', $poll->id) }}" class="themed-color-flat" title="Ver Resultados">
										<i class="hi hi-stats fa-2x"></i>
									</a>
								</h3>
							</div>
							<div class="col-xs-3">
								<h3 class="widget-heading h4">
									<a href="{{ route('reports.voter-polls', $poll->id) }}" class="themed-color-flat" title="Descargar reporte" target="_blank">
										<i class="hi hi-save fa-2x"></i>
									</a>
								</h3>
							</div>
							<div class="col-xs-3">
								<h3 class="widget-heading h4">
									<a href="{{ route('polls.voters.options', $poll->id) }}" class="themed-color-flat">
										<i class="gi gi-send fa-2x"></i>
									</a>
								</h3>
							</div>
						</div>
					</div>
				</div>
			</div>			
		@endforeach	
    </div>	
@endsection

