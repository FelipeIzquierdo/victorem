@extends('dashboard.pages.layout')
@section('title_page')
    Resultados de Sondeo: {{ $poll->name }}
@endsection
@section('breadcrumbs') {!! Breadcrumbs::render('polls.show', $poll) !!}
@endsection
@section('content_body_page')
	<div class="row">
		<div class="col-xs-12" id="poll" data-poll-id="{{ $poll->id }}">
			<div class="row">
				@foreach($poll->questions as $question)
				<div class="col-sm-6">
			        <div class="block full">
			        	<div class="block-title">
							<h2 style="text-transform: none;">{{ $question->text }}</h2>
						</div>
			            <div id="chart-{{ $question->id }}" style="height: 380px;"></div>
			        </div>
			    </div>
			    @endforeach
			</div>
		</div>

		<div class="col-sm-4">
			<div class="block full">
				<div class="block-title">
					<h1>Llamadas</h1>
				</div>
				<div class="row">
					<div id="chart-calls" style="height: 380px;"></div>
				</div>
			</div>
		</div>
	</div>

@endsection
@section('js_aditional')

    <script type="text/javascript">
    	var CompCharts = function() {
		    return {
		        init: function() {
		        	var poll_id = $("#poll").data('poll-id');
		        	//Options PIE
		        	var options = {
		    			colors: ['#B715A7', '#5cafde', '#B74A13', '#14A05A', '#ACA745', '#D74761', '#DFDCDC', '#73EBEE'],
		                legend: {show: false},
		                series: {
		                    pie: {
		                        show: true,
		                        radius: 1,
		                        label: {
		                            show: true,
		                            radius: 2/3,
		                            formatter: function(label, pieSeries) {
		                                return '<div class="chart-pie-label">' + label + '<br>' + Math.round(pieSeries.percent) + '%</div>';
		                            },
		                            background: {opacity: .75, color: '#000000'}
		                        }
		                    }
		                }
			        };

	                $.ajax({
		                type: "GET",
		                url: '/polls/' + poll_id + '/stats/json'
		            }).done(function(json) {
		            	questions = json.questions;
		                console.log(questions);
		                for(var question in questions) {
						    // Pie Chart
				            $.plot("#chart-" + questions[question].id,
				                questions[question].series,
				                options
				            );
						}
		            });
		        }
		    };
		}();
    </script>
    <script>$(function(){ CompCharts.init(); });</script>

@endsection