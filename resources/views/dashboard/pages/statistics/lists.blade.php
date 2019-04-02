@extends('dashboard.pages.layout')
@section('title_page')
    Estadísticas
@endsection
@section('breadcrumbs')
	{!! Breadcrumbs::render('statistics') !!}
@endsection
@section('content_body_page')
    <div class="row">
    	<div class="col-md-8 col-md-offset-2">
			<a class="widget" href="#">
				<div class="widget-content text-right clearfix">
					<h2 class="widget-heading h3"><strong>Alcanzando nuestra meta:</strong> {{$number_voters}} de {{$target_number}} </h2>
					<div class="progress progress-striped active">
		                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{{$goal_percentage}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$goal_percentage}}%">{{$number_voters}} / {{$target_number}}</div>
		            </div>
				</div>
			</a>
			@foreach($statistics as $stat)    			
				<div class="widget">
					<div class="widget-content text-right clearfix">
						{!! Html::image($stat->image, 'icon', array('class' => 'img-circle img-thumbnail img-thumbnail-avatar pull-left')) !!}
						
						<p class="widget-heading h3"><strong>{{ $stat->description }}</strong></p>
						
						{!! Form::open(['route' => $stat->url, 'method' => 'GET', 'class' => 'float:right;', 'target' => '_blank']) !!}
							
							@if($stat->select)
								<div class="form-group col-lg-8">
									{!! Form::select($stat->select . '[]', $selects[$stat->select], null, ['class' => 'select-chosen', 'data-placeholder' => $stat->message, 'multiple']) !!}
								</div>
							@endif
							
							<div class="form-group">
								<button class="btn btn-effect-ripple btn-primary" type="submit"><span class="btn-ripple animate"></span>Ver Estadistica</button>
							</div>
							
						{!! Form::close() !!}

					</div>
				</div>				
			@endforeach
    	</div>
    </div>	
@endsection