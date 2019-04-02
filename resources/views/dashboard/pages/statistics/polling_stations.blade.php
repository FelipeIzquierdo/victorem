@extends('dashboard.pages.layout')
@section('title_page') Estadística por Puestos de Votación @endsection
@section('breadcrumbs') @endsection
@section('content_body_page')
    <div class="row">
        <div class="col-sm-12">
            <div class="block full">
                <div class="block-title">
                    <h2>Total Votantes: {{ $number_voters }} </h2>
                </div>
                <div class="table-responsive">
                    <table id="example-datatable" class="table table-striped table-bordered table-center">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Ubicación</th>
                                <th>Dirección</th>
                                <th class="text-center">Mesas</th>
                                <th class="text-center">Potencial</th>
                                <th class="text-center">Total </th>
                                <th class="text-center">Equipo</th>
                                @foreach($statistic_rol_names as $name)
                                    <th class="text-center">{{ $name }}</th>
                                @endforeach
                                <th class="text-center">Votantes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pollingStations as $pollingStation)
                                <tr>
                                    <td> {{ $pollingStation->description }} </td>
                                    <td> {{ $pollingStation->location->name }} </td>
                                    <td> {{ $pollingStation->address }} </td>
                                    <td class="text-center"> {{ $pollingStation->tables }} </td>
                                    <td class="text-center"> {{ $pollingStation->electoral_potential }} </td>
                                    <td class="text-center"> 
                                        <a href="/reports/people-of-polling-stations?select%5B%5D={{$pollingStation->id}}" target="_blank">
                                            {{ $pollingStation->number_voters }} 
                                        </a>
                                        <div class="progress progress-striped progress-mini active remove-margin">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" 
                                                aria-valuenow="{{ ($pollingStation->number_voters / $number_voters) * 100 }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ ($pollingStation->number_voters / $number_voters) * 100 }}%"></div>
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <a href="/reports/people-of-polling-stations/1?select%5B%5D={{$pollingStation->id}}" target="_blank">
                                            {{ $pollingStation->number_team }} 
                                        </a> 
                                        <div class="progress progress-striped progress-mini active remove-margin">
                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{{ $pollingStation->percent_team }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $pollingStation->percent_team }}%"></div>
                                        </div>
                                    </td>

                                    @foreach($statistic_rol_ids as $rol_id)
                                        <td class="text-center"> 
                                            <a href="/reports/people-of-polling-stations?select%5B%5D={{$pollingStation->id}}&roles%5B%5D={{$rol_id}}" target="_blank">
                                                {{ $pollingStation->getNumberRol($rol_id) }} 
                                            </a> 
                                            
                                            <div class="progress progress-striped progress-mini active remove-margin">
                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ $pollingStation->getPercentRol($rol_id) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $pollingStation->getPercentRol($rol_id) }}%"></div>
                                            </div>
                                        </td>
                                    @endforeach

                                    <td class="text-center"> 
                                        <a href="/reports/people-of-polling-stations/0?select%5B%5D={{$pollingStation->id}}" target="_blank">
                                            {{ $pollingStation->number_only_voters }} 
                                        </a> 
                                        <div class="progress progress-striped progress-mini active remove-margin">
                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{{ $pollingStation->percent_only_voters }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $pollingStation->percent_only_voters }}%"></div>
                                        </div>
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js_aditional')

@endsection