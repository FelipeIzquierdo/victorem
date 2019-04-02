@extends('dashboard.pages.layout')
@section('title_page')
    Reportes
@endsection
@section('breadcrumbs')
	{!! Breadcrumbs::render('reports') !!}
@endsection
@section('content_body_page')
    <div class="row">
    	<div class="col-md-8 col-md-offset-2">     	  		
    		@foreach($reports as $report)    			
				<div class="widget">
					<div class="widget-content text-right clearfix">
						{!! Html::image($report->image, 'icon', array('class' => 'img-circle img-thumbnail img-thumbnail-avatar pull-left')) !!}
						<p class="widget-heading h3"><strong>{{$report->description}}</strong></p>
						{!! Form::open(['route' => $report->url, 'method' => 'GET', 'class' => 'float:right;', 'target' => '_blank']) !!}
							@if($report->select)
								<div class="form-group col-lg-8">
									{!! Form::select('select[]', $selects[$report->select], null, ['class' => 'select-chosen', 'data-placeholder' => $report->message, 'required', 'multiple']) !!}
								</div>
							@endif
							<div class="form-group">
								<button class="btn btn-effect-ripple btn-primary" type="submit"><span class="btn-ripple animate"></span>Generar Reporte</button>
							</div>
						{!! Form::close() !!}
					</div>
				</div>				
			@endforeach	
    	</div>
    </div>	
@endsection