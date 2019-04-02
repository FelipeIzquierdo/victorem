@extends('dashboard.pages.database.voters.forms.layout')

@section('title_page')
    @if($voter->exists) Persona en Equipo: {{ $voter->name }} @else Nuevo Integrante de Equipo @endif
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('team.create', $voter) !!}
@endsection

@section('inputs-before')

    {!! Field::select('roles[]', $roles, $voter->roles_list, ['template' => 'horizontal-large','required' => 'required', 'data-placeholder' => 'Seleccione los Cargos', 'multiple']) !!}

    <div class="form-group">
        <label class="col-md-3 control-label" for="delegate">¿Es delegado? </label>
        <div class="col-md-8">
            <label class="switch switch-primary" title="¿Es Delegado?">
                @if($voter->delegate)
                    <input type="checkbox" value="1" name="delegate" checked><span></span> 
                @else
                    <input type="checkbox" value="1" name="delegate"><span></span>
                @endif
            </label>
        </div>
    </div>

    {!! Field::select('polling_station_day_d', $polling_stations , $voter->polling_station_day_d, ['template' => 'horizontal-large', 'data-placeholder' => 'Seleccione el Puesto del día D']) !!} 


@endsection
