@extends('dashboard.pages.layout')
@section('title_page') Estadística: {{$stat->description}} @endsection
@section('breadcrumbs') @endsection
@section('content_body_page')
	 <div class="col-sm-12">
        <!-- Bars Chart Block -->
        <div class="block full">
            <div id="chart-bars" style="height: 380px;" data-url-json='{{$url_json}}'></div>
        </div>
        <!-- END Bars Chart Block -->
    </div>
@endsection
@section('js_aditional')
    <!-- Load and execute javascript code used only in this page -->
    {!! Html::script('assets/js/pages/compCharts.js') !!}
    <script>$(function(){ CompCharts.init(); });</script>
@endsection