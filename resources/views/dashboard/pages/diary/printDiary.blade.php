 @extends('dashboard.pages.reports.pdf.layout')
	@section('content-pdf')					
		@foreach($events as $item => $event)
			<div class="diary-event">				
				<p class="event-title"><span>{{$event->name}}, por {{$event->organizer->name}}</span></p>
				<p class="event-data"><span>Hora: </span> De {{$event->time}} a {{$event->endtime}}</p>
				<p class="event-data"><span>Lugar: </span>{{$event->location->name}}, {{$event->place}}</p>								
				<p class="event-data"><span>Delegado: </span>{{$event->delegate->name}}</p>
				<p class="event-data"><span>Cantidad de personas: </span>{{$event->people}}</p>
				@if($event->description!=null)
					<p class="event-data"><span>Descripción: </span>{{$event->description}}</p>
				@endif
			</div>
		@endforeach
	@endsection