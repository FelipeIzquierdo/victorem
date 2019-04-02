@extends('dashboard.pages.layout')

@section('title_page')
    Base de Datos
@endsection

@section('breadcrumbs')
	{!! Breadcrumbs::render('database') !!}
@endsection

@section('content_body_page')
    <div class="row">
        @foreach($modules as $module)
            <div class="col-sm-4">
                <a href=" /{{ $module->url }}" class="widget">
                    <div class="widget-content {{ $module->color_class }} text-light-op text-center">
                        <h4><strong>{{ $module->description }}</strong></h4>
                    </div>
                    <div class="widget-content themed-background-muted text-center">
                        {!! Html::image($module->image, 'icon vinder', array('class' => 'img-circle img-thumbnail', 'style' => 'width:128px;')) !!}
                    </div>
                    <div class="widget-content text-center">
                    </div>
                </a>
            </div>
        @endforeach
        
        <div class="col-md-12 hidden-xs" style="position: absolute; bottom: 0; left:0;">
            {!! Html::image('images/placeholders/banners/info_databases.jpg', 'Base de Datos - Victorem', array('style' => 'position:relative; width:70%; margin: 0 15%;')) !!}
        </div>
    </div>
@endsection