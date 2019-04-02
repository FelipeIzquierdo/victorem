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
                                <th>Tipo</th>
                                <th>Nombre</th>
                                <th class="text-center">Potencial</th>
                                <th class="text-center">Total <i class="gi gi-ok_2"></i> </th>
                                <th class="text-center">Votante</th>
                                <th class="text-center">Equipo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($locations as $location)
                                <tr>
                                    <td> {{ $location->type_name }}</td>
                                    <td> {{ $location->name }} </td>
                                    <td class="text-center"> {{ $location->electoral_potential }} </td>
                                    <td class="text-center"> 
                                        {{ $location->all_number_voters }} 
                                        <div class="progress progress-striped progress-mini active remove-margin">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" 
                                                aria-valuenow="{{ ($location->all_number_voters / $number_voters) * 100 }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ ($location->all_number_voters / $number_voters) * 100 }}%"></div>
                                        </div>
                                    </td>
                                    <td class="text-center"> 
                                        {{ $location->all_number_only_voters }} 
                                        <div class="progress progress-striped progress-mini active remove-margin">
                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{{ $location->all_percent_only_voters }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $location->all_percent_only_voters }}%"></div>
                                        </div>
                                    </td>
                                    <td class="text-center"> 
                                        {{ $location->all_number_team }} 
                                        <div class="progress progress-striped progress-mini active remove-margin">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ $location->all_percent_team }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $location->all_percent_team }}%"></div>
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