@extends('dashboard.pages.layout')

@section('extra-header-section')
    
    <div class="row text-center border-top push-inner-top-bottom">
        @yield('form_voters')
    </div>

    <div id="filter-voters" class="text-center border-top push-inner-top-bottom">
        <a href="javascript:void(0)" class="btn btn-sm btn-default">A</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-default">B</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-default">C</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-default">D</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-default">E</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-default">F</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-default">G</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-default">H</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-default">I</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-default">J</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-default">K</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-default">L</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-default">M</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-default">N</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-default">O</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-default">P</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-default">Q</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-default">R</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-default">S</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-default">T</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-default">V</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-default">U</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-default">W</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-default">X</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-default">Y</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-default">Z</a>
    </div>

@endsection

@section('content_body_page')
    
    <div class="row">
        @include('dashboard.pages.database.voters.lists.include.table')

        @include('dashboard.pages.database.voters.lists.include.modal')

        {!! Form::open(array('route' => array('database.voters.destroy', 'ID') , 'method' => 'POST', 'role' => 'form', 'id' => 'form-delete')) !!}

        {!! Form::close() !!}
         
        @yield('after-table')

    </div>

@endsection

@section('js_aditional')
    {!! Html::script('assets/js/pages/voter/lists.js'); !!}
    <script>$(function(){ VoterLists.init(); });</script>
@endsection
