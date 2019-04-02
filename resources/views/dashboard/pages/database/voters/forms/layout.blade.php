@extends('dashboard.pages.layout')
@section('content_body_page')
	<div class="row">
	    <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
            <img src="/images/placeholders/icons/loading.gif" id="loading-polling-station-gif" style="display:none;"> 
            
            <div class="widget-image widget-image-xs" id="polling_station" style="">
                <img src="/images/placeholders/photos/photo16.jpg" alt="image">
                <div class="widget-image-content">
                    <h2 class="widget-heading text-light"><strong id="polling_station_location_name"></strong></h2>
                    <h3 class="widget-heading text-light-op h4" id="polling_station_name_and_table"></h3>
                    <h3 class="widget-heading text-light-op h4" id="polling_station_address"></h3>
                    <h3 class="widget-heading text-light h3" style="margin:2px;" id="polling_station_message"></h3>
                </div>
                <i class="fa fa-newspaper-o"></i>
            </div>

	        <div class="block">
	            <div class="block-title">
	                <h2>Datos del Votante</h2>
                    @if($voter->exists)
                        <div class="pull-right">
                            @if ($voter->colaborator)
                                <a href="{{route('database.team.remove', $voter->doc)}}" data-toggle="tooltip" title="Sacar del Equipo" class="btn btn-effect-ripple btn-warning">
                                    <i class="fa fa-exclamation-triangle"></i>
                                </a>
                            @elseif (Auth::user()->hasModule('add-to-team-voters'))
                                <a href="{{route('database.voters.add-to-team', $voter->id)}}" data-toggle="tooltip" title="Agregar al Equipo" class="btn btn-effect-ripple btn-success">
                                    <i class="fa fa-user-plus"></i>
                                </a>
                            @endif
                        </div>
                    @endif
	            </div>

                @include('dashboard.includes.alerts')
                
                {!! Form::model($voter, $form_data + array('id' => 'form-voters', 'class' => 'form-horizontal form-bordered')) !!}
                    <!-- Validation Wizard Content -->
                    <!-- First Step -->
                    <div id="validation-first" class="step">
                        <!-- Step Info -->
                        <div class="form-group hidden-xs">
                            <div class="col-xs-12">
                                <ul class="nav nav-pills nav-justified clickable-steps">
                                    <li class="active"><a href="javascript:void(0)" class="text-muted"> <i class="fa fa-user"></i> <strong>Principales</strong></a></li>
                                    <li><a href="javascript:void(0)" data-gotostep="validation-second"><i class="fa fa-info-circle"></i> <strong>Adicionales</strong></a></li>
                                    <li><a href="javascript:void(0)" data-gotostep="validation-third"><i class="fa fa-info-circle"></i> <strong>Segmentación</strong></a></li>
                                    <li><a href="javascript:void(0)" data-gotostep="validation-fourt"><i class="fa fa-info-circle"></i> <strong>Notas</strong></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- END Step Info -->

                        @if(! $voter->result_scraping)
                            {!! Form::input('hidden', 'polling_station_id', null) !!}
                            {!! Form::input('hidden', 'table_number', null) !!}
                        @endif

                        {!! Field::text('doc', null, ['template' => 'horizontal-large', 'placeholder' => 'Número de cedula', 'readonly']) !!}

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="superior">Referido por <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    {!! Form::select('superior', $team, $voter->team_session, ['class' => 'form-control select-chosen','required' => 'required']) !!}
                                    <span class="input-group-addon"><i class="gi gi-user"></i></span>
                                </div>
                            </div>
                        </div>

                        {!!  Field::text('name' , null, ['required', 'template' => 'horizontal-large-loading', 'placeholder' => 'Nombres y apellidos']) !!}

                        @yield('inputs-before')

                        {!!  Field::select('sex', array('M' => 'Masculino', 'F' => 'Femenino') , null, ['template' => 'horizontal-large', 'data-placeholder' => 'Seleccione un Género', 'required']) !!} 
                        
                        {!!  Field::select('location_id', $locations , null, ['template' => 'horizontal-large', 'data-placeholder' => 'Seleccione una ubicación', 'required']) !!} 

                    </div>
                    <!-- END First Step -->
                        
                    @include('dashboard.pages.database.voters.forms.inputs-default')
                    
                    @yield('inputs-after')

                    <!-- Form Buttons -->
                    <div class="form-group form-actions text-right">
                        <div class="col-md-8 col-md-offset-4">
                            <input type="reset" class="btn btn-warning" id="back3" value="anterior">
                            <input type="submit" class="btn btn-primary" id="next3" value="siguiente">
                        </div>
                    </div>
                    <!-- END Form Buttons -->

	            {!! Form::close() !!}

                @include('dashboard.includes.alerts')

	        </div>
	    </div>

	</div>
@endsection

@section('js_aditional')
	{!! Html::script('assets/js/pages/formVoters.js') !!}
	<!-- Load and execute javascript code used only in this page -->
    <script> $(function(){ FormVoters.init(); });</script>
    <script> $(function(){ FormVoters.findNameAndPollingStation(); });</script>
    
@endsection
