@extends('dashboard.pages.layout')
@section('title_page')
    Publicidad
@endsection
@section('breadcrumbs')
	{!! Breadcrumbs::render('advertising') !!}
@endsection
@section('content_body_page')
    <div class="block">        
        <div class="block-title">
            <h2>Lista de Eventos</h2>
        </div>
        
        <div class="timeline block-content-full" style="margin: 10px;">
            <ul class="timeline-list">
                @foreach($events as $event)
                    <li>
                        <div class="timeline-time">{{ $event->date }}</div>
                        <div class="timeline-icon themed-background-danger text-light-op"><i class="fa fa-calendar"></i></div>
                        <div class="timeline-content">
                            <p class="push-bit"><strong>{{ $event->name }}</strong></p>
                            <p class="push-bit"><strong>Convoca:</strong> {{ $event->organizer->name }}</p>
                            <p class="push-bit"><strong>Desde las:</strong> {{ $event->time_for_humans }} <strong>hasta las:</strong> {{ $event->endtime_for_humans }}</p>
                            <p class="push-bit"><strong>Ubicación:</strong> {{ $event->location->name }}</p>
                            <p class="push-bit"><strong>Dirección:</strong> {{ $event->place }}</p>
                            <p class="push-bit"><strong>Se requiere:</strong>
                                @foreach($event->advertisings as $advertising)
                                    <span class="label label-danger">{{ $advertising }}</span>
                                @endforeach
                            </p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection