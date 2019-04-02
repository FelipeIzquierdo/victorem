@extends('dashboard.pages.layout')
@section('title_page')
    Configuración del Sistema
@endsection
@section('breadcrumbs')
	{!! Breadcrumbs::render('system') !!}
@endsection
@section('content_body_page')
    <div class="row">
        <div class="col-sm-3">
            <a href="/system/users" class="widget">
                <div class="widget-content themed-background text-light-op text-center">
                    <h4><strong>Usuarios</strong></h4>
                </div>
                <div class="widget-content themed-background-muted text-center">
                    {!! Html::image('images/placeholders/icons/users.png', 'icon vinder', array('class' => 'img-circle img-thumbnail', 'style' => 'width:128px;')) !!}
                </div>
                <div class="widget-content text-center">
                </div>
            </a>
        </div>

        <div class="col-sm-3">
            <a href="/system/user-types" class="widget">
                <div class="widget-content themed-background text-light-op text-center">
                    <h4><strong>Tipos de Usuario</strong></h4>
                </div>
                <div class="widget-content themed-background-muted text-center">
                    {!! Html::image('images/placeholders/icons/user_type.png', 'icon vinder', array('class' => 'img-circle img-thumbnail', 'style' => 'width:128px;')) !!}
                </div>
                <div class="widget-content text-center">
                </div>
            </a>
        </div>

        <div class="col-sm-3">
            <a href="/system/locations" class="widget">
                <div class="widget-content themed-background text-light-op text-center">
                    <h4><strong>Ubicaciones</strong></h4>
                </div>
                <div class="widget-content themed-background-muted text-center">
                    {!! Html::image('images/placeholders/icons/map2.png', 'icon vinder', array('class' => 'img-circle img-thumbnail', 'style' => 'width:128px;')) !!}
                </div>
                <div class="widget-content text-center">
                </div>
            </a>
        </div>

        <div class="col-sm-3">
            <a href="/system/polling-stations" class="widget">
                <div class="widget-content themed-background text-light-op text-center">
                    <h4><strong>Puestos de Votación</strong></h4>
                </div>
                <div class="widget-content themed-background-muted text-center">
                    {!! Html::image('images/placeholders/icons/map.png', 'icon vinder', array('class' => 'img-circle img-thumbnail', 'style' => 'width:128px;')) !!}
                </div>
                <div class="widget-content text-center">
                </div>
            </a>
        </div>        
    </div>
@endsection