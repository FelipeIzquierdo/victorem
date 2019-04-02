@extends('dashboard.pages.layout')
@section('title_page')
    ¡Felicitaciones!.  Mensajes enviados éxitosamente
@endsection
@section('breadcrumbs')
	{!! Breadcrumbs::render('sms') !!}
@endsection
@section('content_body_page')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">	
			<div class="widget">
				<div class="widget-content text-right clearfix">
					<div class="form-group col-lg-12">
						<img src="/images/placeholders/icons/sms.png" class="img-circle img-thumbnail img-thumbnail-avatar pull-left"/>
						<p class="widget-heading h3"><strong>Se enviarón {{$quantity}} mensajes de texto</strong></p>
					</div>						
					<div class="form-group col-lg-12">
						<a href="/sms"><button class="btn btn-effect-ripple btn-primary" ><span class="btn-ripple animate"></span>Regresar</button></a>
					</div>										
				</div>
			</div>				
		</div>
	</div>
@endsection