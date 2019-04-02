@extends('dashboard.pages.layout')
@section('title_page')
    Envio masivo de mensajes de texto (<span style="color: red">{{$credits}} créditos</span>)
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
						<p class="widget-heading h3"><strong>Enviar mensajes de texto</strong></p>
					</div>	

					<div class="form-horizontal form-bordered">
						{!! Form::open(['route' => 'sms.send', 'method' => 'POST']) !!}

							{!! Field::select('locations[]', $locations , [1], ['template' => 'horizontal-large', 'data-placeholder' => 'Seleccione Ubicaciones', 'multiple']) !!} 

							{!! Field::select('polling_stations[]', $polling_stations , null, ['template' => 'horizontal-large', 'data-placeholder' => 'Seleccione Puestos de Votación', 'multiple']) !!} 

							{!! Field::select('sex[]', $sex, [], ['template' => 'horizontal-large', 'data-placeholder' => 'Seleccione Géneros', 'multiple']) !!} 

							{!! Field::select('communities[]', $communities, null, ['template' => 'horizontal-large', 'data-placeholder' => 'Seleccione Comunidades', 'multiple']) !!} 

							{!! Field::select('roles[]', $roles, null, ['template' => 'horizontal-large', 'data-placeholder' => 'Seleccione Cargos', 'multiple']) !!} 

							{!! Field::select('occupations[]', $occupations, null, ['template' => 'horizontal-large', 'data-placeholder' => 'Seleccione Ocupaciones', 'multiple']) !!} 
							
							{!! Field::textarea('message', null, ['template' => 'horizontal-large', 'placeholder' => 'Mensaje de máximo 160 caracteres', 'multiple', 'required', 'maxlength' => '160', 'rows' => '3']) !!} 

							<div class="row">
								<div class="col-md-offset-1 col-md-10">
									<div class="well well-sm">
										<ul class="fa-ul">
											<li><i class="fa fa-check fa-li"></i>Use <strong>[NOMBRE]</strong> para mostrar el nombre del votante</li>
											<li><i class="fa fa-check fa-li"></i>Use <strong>[PUESTO]</strong> para mostrar el puesto de votación</li>
											<li><i class="fa fa-check fa-li"></i>Use <strong>[MESA]</strong> para mostrar la mesa de votación</li>
										</ul>
									</div>
								</div>
							</div>

							<div class="form-group form-actions">
			                    <div class="col-md-8 col-md-offset-4">
		                            <button type="submit" class="btn btn-effect-ripple btn-primary">Enviar mensaje</button>
			                    </div>
			                </div>

						{!! Form::close() !!}	
					</div>	

				</div>
			</div>				
		</div>
	</div>	
@endsection