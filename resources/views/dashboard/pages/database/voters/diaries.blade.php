@extends('dashboard.pages.layout')
@section('title_page') Asistencia a eventos: {{ $voter->name }} @endsection
@section('breadcrumbs')  @endsection
@section('content_body_page')
	
	<div class="row">	
		@if($voter->diaries)
			<div class="col-md-10 col-md-offset-1">
				<div class="block">
		            <div class="block-title">
		                <h2>Asistencias</h2>
		            </div>	  
		            <div class="table-responsive">
					    <table id="example-datatable" class="table table-striped table-bordered table-center">
					        <thead>
					            <tr>
					                <th>Nombre</th>
					                <th>Lugar</th>
					                <th>Fecha</th>
					                <th class="text-center">Organizador</th>
					                <th class="text-center">Delegado</th>
					                <th class="text-center" title="Votantes esperados"><i class="gi gi-user_add"></i></th>
					                <th class="text-center" title="Asistencia real"><i class="fa fa-users"></i></th>
					            </tr>
					        </thead>
					        <tbody>
					            @foreach($voter->all_diaries->sortBy('date') as $diary)
					                <tr>
					                    <td>{{ $diary->name }}</td>
					                    <td>{{ $diary->location_place }}</td>
					                    <td><b>{{ $diary->date }}</b> {{ $diary->time_to_endtime }}</td>
					                    <td class="text-center"> 
					                    	@if($diary->organizer_id == $voter->id) <i class="gi gi-ok_2"></i> @else {{ $diary->organizer->name }} @endif
					                    </td>
					                    <td class="text-center">
					                    	@if($diary->delegate_id == $voter->id) <i class="gi gi-ok_2"></i> @else {{ $diary->delegate->name }} @endif
					                    </td>
					                    <td class="text-center">
					                    	{{ $diary->people }}
					                    </td>
					                    <td class="text-center">
					                    	{{ $diary->voters->count() }}
					                    </td>
					                </tr>
					            @endforeach
					        </tbody>
					    </table>
					</div>          
		        </div>		
	        </div>
	    @endif
	</div>

@endsection
@section('js_aditional')
    

@endsection