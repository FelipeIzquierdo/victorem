@extends('dashboard.pages.layout')
@section('title_page') Agenda de Eventos @endsection
@section('breadcrumbs') {!! Breadcrumbs::render('diary') !!} @endsection
@section('meta_extra') <meta name="_token" content="{{ csrf_token() }}"/> @endsection
@section('content_body_page')
    <div class="row" id="title_page">
        <div class="form-group col-md-12">
            {!! Form::open(['route' => 'diary.print', 'method' => 'GET', 'class' => 'form-inline', 'style' => 'display: inline-block;', 'target' => '_blank']) !!}
                <div class="form-group">
                    {!! Form::text('date', null, ['class' => 'form-control input-datepicker', 'placeholder' => 'Año-Mes-Día', 'data-date-format' => 'yyyy-mm-dd', 'required' => 'required']) !!}
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-info"  value="Imprimir Agenda">
                </div>
            {!! Form::close() !!}

            <a class="btn btn-primary" href="{{ route('diary.create') }}"><i class="fa fa-plus"></i> Agregar Evento</a>
        </div>
    </div>
    <div class="block full">
        <div class="row">                        
            <div class="col-md-12">                
                <div id="calendar"></div>
            </div>
        </div>
    </div>

    <div id="modal-diary" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 id="modal-title" class="modal-title"><strong></strong></h3>
                </div>

                <div class="modal-body row">

                    <div class="col-xs-12">
                        <h4 class="col-sm-4 col-xs-2"><i class="hi hi-map-marker"></i> <strong class="hidden-xs">Lugar: </strong></h4>
                        <h4 class="col-sm-8 col-xs-10"><span id="modal-location"></span> - <span id="modal-place"></span></h4>
                    </div>

                    <div class="col-xs-12">
                        <h4 class="col-sm-4 col-xs-2"><i class="gi gi-calendar"></i> <strong class="hidden-xs">Fecha: </strong></h4>
                        <h4 class="col-sm-8 col-xs-10"><spam id="modal-date"></spam> </h4>
                    </div>
                    
                    <div class="col-xs-12">
                        <h4 class="col-sm-4 col-xs-2"><i class="hi hi-time"></i> <strong class="hidden-xs">Hora: </strong></h4>
                        <h4 class="col-sm-8 col-xs-10">De <spam id="modal-time"></spam> a <spam id="modal-endtime"></spam></h4>
                    </div>

                    <div class="col-xs-12">
                        <h4 class="col-sm-4 col-xs-2"><i class="gi gi-old_man"></i> <strong class="hidden-xs">Delegado: </strong></h4>
                        <h4 class="col-sm-8 col-xs-10"><spam id="modal-delegate"></spam> </h4>
                    </div>

                    <div class="col-xs-12">
                        <h4 class="col-sm-4 col-xs-2"><i class="gi gi-old_man"></i> <strong class="hidden-xs">Organizador: </strong></h4>
                        <h4 class="col-sm-8 col-xs-10"><spam id="modal-organizer"></spam> </h4>
                    </div>

                    <div class="col-xs-12">
                        <h4 class="col-sm-4 col-xs-2"><i class="fa fa-users"></i> <strong class="hidden-xs">Personas: </strong></h4>
                        <h4 class="col-sm-8 col-xs-10"><spam id="modal-people"></spam> </h4>
                    </div>

                    <div class="col-xs-12">
                        <h4 class="col-sm-4 col-xs-2"><i class="fa fa-automobile"></i> <strong class="hidden-xs">Logistica: </strong></h4>
                        <h4 class="col-sm-8 col-xs-10"><spam id="modal-logistic"></spam> </h4>
                    </div>

                    <div class="col-xs-12">
                        <h4 class="col-sm-4 col-xs-2"><i class="fa fa-bullhorn"></i> <strong class="hidden-xs">Publicidad: </strong></h4>
                        <h4 class="col-sm-8 col-xs-10"><spam id="modal-advertising"></spam> </h4>
                    </div>

                    <div class="col-xs-12">
                        <h4 class="col-sm-4 col-xs-2"><i class="fa fa-calendar-o"></i> <strong class="hidden-xs">Notas: </strong></h4>
                        <h4 class="col-sm-8 col-xs-10"><spam id="modal-description"></spam> </h4>
                    </div>

                    <div class="col-xs-12">
                        <h4 class="col-sm-4 col-xs-2"><i class="hi hi-stats"></i> <strong class="hidden-xs">Asistentes: </strong></h4>
                        <h4 class="col-sm-8 col-xs-10"><spam id="modal-voters"></spam> </h4>
                    </div>

                </div>

                <div class="modal-footer">
                    <a href="#" id="modal-diary-people" data-toggle="tooltip" title="Agregar asistencia" class="btn btn-effect-ripple btn-success">
                        <i class="fa fa-file-text-o"></i>
                    </a>
                    <a href="#" id="modal-edit" data-toggle="tooltip" title="Editar Evento" class="btn btn-effect-ripple btn-primary">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a href="#" id="modal-delete" data-toggle="tooltip" title="Borrar Evento" data-dismiss="modal" class="btn btn-effect-ripple btn-danger">
                        <i class="gi gi-skull"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>

@endsection
@section('js_aditional')
    <script src="{{url('assets/js/pages/lang-all.js')}}"></script>
	<script>
        function updateDiary (calEvent) {
            $.ajax({
                data:  {
                    'date': calEvent.start.format('YYYY-MM-DD'),
                    'name': calEvent.name,
                    'location_id': calEvent.location_id,
                    'organizer_id': calEvent.organizer_id,
                    'place': calEvent.place,
                    'time': calEvent.start.format('h:mm A'),
                    'endtime': calEvent.end.format('h:mm A')
                },
                url:   '/diary/' + calEvent.id,
                type:  'PUT',
                beforeSend: function(request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
                },
                success:  function (data) {
                    if(data.success)
                    {
                        console.log('evento actualizado');
                    }
                    else
                    {
                        console.log(data.errors);
                    }
                }
            });
        }

    	var CompCalendar = function() {
            return {
                init: function() {     
                    $('#calendar').fullCalendar({
                        eventClick: function(calEvent) {   
                            console.log(calEvent);                 
                            $("#modal-title").html('Evento: ' + calEvent.title);
                            $("#modal-location").html(calEvent.location);
                            $("#modal-place").html(calEvent.place);
                            $("#modal-date").html(calEvent.date);
                            $("#modal-time").html(calEvent.time);
                            $("#modal-endtime").html(calEvent.endtime);
                            $("#modal-delegate").html(calEvent.delegate);
                            $("#modal-organizer").html(calEvent.organizer);
                            $("#modal-people").html(calEvent.people);
                            $("#modal-logistic").html(calEvent.logistic);
                            $("#modal-advertising").html(calEvent.advertising);
                            $("#modal-description").html(calEvent.description);
                            $("#modal-voters").html(calEvent.voters.length);

                            $("#modal-edit").attr("href", "/diary/"+calEvent.id+"/edit");
                            $("#modal-diary-people").attr("href", "/diary/"+calEvent.id+"/people");
                            
                            $('#modal-diary').modal('show');
                        },
                        eventDrop: function(calEvent, delta, revertFunc) {
                            updateDiary(calEvent);
                        }, 
                        eventResize: function(calEvent, delta, revertFunc) {
                            updateDiary(calEvent);
                        },
                        lang: 'es',
                        header: {
                            left: 'title',
                            center: '',
                            right: 'today month,agendaWeek,agendaDay prev,next'
                        },
                        defaultView: 'month',
                        firstDay: 1,
                        editable: true,
                        droppable: true,
                        events: '/diary-json',
                        timeFormat: 'h(:mm)a',
                        defaultTimedEventDuration: '01:00:00',
                        slotDuration: '01:00:00',
                    });
                }
            };
        }();
	</script>
	<script>$(function(){ CompCalendar.init(); });</script>
@endsection