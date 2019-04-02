@extends('dashboard.pages.layout')
@section('title_page')
    Aplicar Sondeo: {{ $poll->name }}
@endsection
@section('breadcrumbs')
	{!! Breadcrumbs::render('polls.options', $poll) !!}
@endsection
@section('content_body_page')
	<div class="row">
    	<div class="col-md-8 col-md-offset-2">     	  		 			
			<div class="widget">
				<div class="widget-content text-right clearfix themed-background-muted">
					{!! Html::image('/images/placeholders/icons/user.png', 'icon', array('class' => 'img-circle img-thumbnail img-thumbnail-avatar pull-left')) !!}
					<p class="widget-heading h3"><strong>Sondeo a Votantes</strong></p>
				</div>
				<div class="widget-content">	
					{!! Form::open(['route' => ['polls.voters.options.store', $poll->id], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
						{!! Field::select('communities[]', $communities, null, ['template' => 'horizontal-large', 'data-placeholder' => 'Seleccione Comunidades', 'multiple']) !!}
						{!! Field::select('locations[]', $locations, null, ['template' => 'horizontal-large', 'data-placeholder' => 'Seleccione Ubicaciones', 'multiple']) !!}

						<div class="form-group form-actions">
                            <div class="col-md-10 col-md-offset-2">
                                <button type="submit" class="btn btn-effect-ripple btn-primary">Aplicar Sondeo</button>
                            </div>
                        </div>

					{!! Form::close() !!}
				</div>
			</div>				
    	</div>
    </div>	
@endsection

