@extends('dashboard.pages.layout')
@section('title_page')
    @if($polling_station->exists) Puesto de votación: {{ $polling_station->description }} @else Nuevo puesto de votación @endif
@endsection
@section('breadcrumbs') {!! Breadcrumbs::render('polling-stations.create', $polling_station) !!} @endsection
@section('content_body_page')
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
            {!! Form::model($polling_station, $form_data + ['id' => 'form-polling-stations']) !!}
                <div class="block">
                    <div class="block-title">
                        <h2>Datos del puesto de votación</h2>
                    </div>

                    @include('dashboard.includes.alerts')
                    
                    <div class="form-horizontal form-bordered">

                        {!! Field::text('description', null, ['template' => 'horizontal', 'placeholder' => 'Descripción']) !!}

                        {!! Field::text('address', null, ['template' => 'horizontal', 'placeholder' => 'Dirección']) !!}

                        {!! Field::select('location_id', $locations, null, ['template' => 'horizontal', 'data-placeholder' => 'Seleccione la ubicación']) !!}

                        {!! Field::number('electoral_potential', null, ['template' => 'horizontal', 'placeholder' => 'Potencial electoral']) !!}

                        {!! Field::number('tables', null, ['template' => 'horizontal', 'placeholder' => 'Mesas']) !!}

                        <div class="form-group form-actions">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar</button>
                            </div>
                        </div>

                    </div>

                    @include('dashboard.includes.alerts')

                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('js_aditional')
    {!! Html::script('assets/js/pages/formlocations.js') !!}
    <!-- Load and execute javascript code used only in this page -->
    <script> $(function (){ Formlocations.init(); });</script>
@endsection