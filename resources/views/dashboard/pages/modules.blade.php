@extends('dashboard.layout')
@section('content_page')
	<div class="row">
        @foreach($mainModules as $module)
            <div class="col-sm-4">
                <a href="/{{ $module->url }}" class="widget">
                    <div class="widget-content {{ $module->color_class }} text-light-op text-center">
                        <h2><strong>{{ $module->description }}</strong></h2>
                    </div>
                    <div class="widget-content themed-background-muted text-center">
                        {!! Html::image($module->image, 'icon vinder', array('class' => 'img-circle img-thumbnail')) !!}
                    </div>
                    <div class="widget-content text-center">
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <div class="row">
        @foreach($extraModules as $module)
            <div class="pull-right col-xs-12 col-sm-6 col-md-3">
                <a href="{{url($module->url)}}" class="widget">
                    <div class="widget-content {{$module->color_class}} clearfix">
                        {!! Html::image($module->image, 'icon vinder', ['class' => 'img-circle img-thumbnail img-thumbnail-avatar pull-right']) !!}
                        <h3 class="widget-heading h3 text-light" style="font-size:23px;"><strong>{{ $module->description }}</strong></h3>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
@section('js_aditional')

@endsection