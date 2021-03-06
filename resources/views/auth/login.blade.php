@extends ('auth.layout')
    @section('title_auth')
        <img src="/images/vinder500.png" style="width:74%; margin: 0 13%;"> 
    @endsection
    @section('buttons_header')
        <a href="/" class="btn btn-effect-ripple btn-primary" data-toggle="tooltip" data-placement="left" title="Olvidaste tu contraseña?"><i class="fa fa-exclamation-circle"></i></a>
    @endsection
    @section('title_header')
        <h2>Iniciar Sesión</h2>
    @endsection
    @section('form_auth')
        {!! Form::open(array('url' => 'auth/login', 'method' => 'post', 'class' => 'form-horizontal', 'id' => 'form-login')) !!}

            {!! Field::text('username', null, ['placeholder' => 'Usuario..']) !!}

            {!! Field::password('password', ['placeholder' => 'Contraseña..']) !!}

            <div class="form-group form-actions">
                <div class="col-xs-8">
                    <label class="csscheckbox csscheckbox-primary">
                        <input type="checkbox" id="login-remember-me" name="remember" value="true">
                        <span></span>
                    </label>
                    Recordarme
                </div>
                <div class="col-xs-4 text-right">
                    <button type="submit" class="btn btn-effect-ripple btn-sm btn-primary"><i class="fa fa-check"></i> Iniciar</button>
                </div>
            </div>
        {!! Form::close() !!}
    @endsection
