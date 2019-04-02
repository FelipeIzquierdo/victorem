
<div id="show-voters">
	@foreach($voters as $voter)
	    <div class="col-sm-6 col-md-4 col-lg-3">
	        <a href="#modal-voter" data-voter="{{ $voter }}" data-toggle="modal" data-id="{{ $voter->id }}" id="voter-{{ $voter->id }}" class="widget">
	            <div class="widget-content text-right clearfix" style="height: 108px;">
	                <img src="/images/placeholders/avatars/avatar9.jpg" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar pull-left">
	                <h3 class="widget-heading h4"><strong>{{ $voter->name }}</strong></h3>
	                <span class="text-muted">{{ $voter->doc }}</span>
	            </div>
	        </a>
	    </div>
	@endforeach

	{!! $voters->render() !!}

</div>

