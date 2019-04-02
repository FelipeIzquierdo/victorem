@extends('dashboard.pages.layout')
@section('css_aditional')
    <link rel="stylesheet" href="/assets/css/jquery.jOrgChart.css">
    <link rel="stylesheet" href="/assets/css/roles-tree.css">
@endsection
@section('title_page') Estructura de Campaña @endsection
@section('breadcrumbs') {!! Breadcrumbs::render('roles') !!} @endsection

@section('content_body_page')
    <div class="row" id="title_page">
        <div class="form-group col-md-12">
            {!! Form::model($rol, $form_data + ['class' => 'form-inline', 'style' => 'display: inline-block;']) !!}
                <div class="form-group" style="min-width:230px;">
                    {!! Form::select('superior', $roles, $rolSession, ['class' => 'select-chosen form-control','required' => 'required', 'data-placeholder' => 'Seleccione el Puesto Superior..', 'style' => 'width:250px;']) !!}
                </div>
                <div class="form-group">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre', 'required' => 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Descripción']) !!}
                </div>
                <div class="form-group">
                    @if($rol->exists)
                        <input type="submit" class="btn btn-success"  value="Actualizar Puesto">
                    @else
                        <input type="submit" class="btn btn-primary"  value="Agregar Puesto">
                    @endif
                </div>
            {!! Form::close() !!}
           @if($rol->exists)
                {!! Form::open(array('route' => ['database.roles.destroy', $rol->id] , 'method' => 'DELETE', 'style' => 'float: right;')) !!}
                    <div class="form-group">
                        <input type="submit" class="btn btn-danger"  value="Eliminar">
                    </div>
                {!! Form::close() !!}
                
                @if($result = Session::get('result'))
                    <div class="alert alert-danger alert-dismissable col-md-10 col-md-offset-1" style="margin-top:15px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ $result['msg'] }}
                    </div>
                @endif
           @endif
        </div>
    </div>
    <div class="block full" style="overflow-x: scroll">
        {!! $rolesTree !!}
        <div id="chart" class="orgChart"></div>
    </div>
    <!-- END Datatables Block -->
    
@endsection
@section('js_aditional')
    {!! Html::script('assets/js/jquery.jOrgChart.js') !!}

    <script>
        jQuery(document).ready(function() 
        {
            $("#roles-tree").jOrgChart(
            {
                chartElement : '#chart'
            });
        });
    </script>
@endsection