{!! Form::open(['route' => $route, 'method' => 'POST', 'class' => 'form-inline', 'style' => 'display: inline-block;']) !!}
    <div class="form-group" style="min-width:230px;">
        {!! Form::select('colaborator', $team, $teamSession, ['class' => 'select-chosen form-control','required' => 'required', 'data-placeholder' => 'Persona Jefe', 'style' => 'width:250px;']) !!}
    </div>
    <div class="form-group">
        {!! Form::number('doc', null, ['class' => 'form-control', 'placeholder' => 'Número de Cédula', 'required' => 'required']) !!}
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary"  value="{{ $value_submit }}">
    </div>
{!! Form::close() !!}
@yield('extra_form')


