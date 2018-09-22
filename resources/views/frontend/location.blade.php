<div class="card">
	<div class="card-header">{{ __('frontend.browse_by_location') }}</div>
	<div class="card-body">
		@if(isset($locations))
			<div class="row">
				@foreach($locations as $location)
					<li class="col-md-3">
						@if(Session::get('locale')==='zh')
							<a href="{{ route('post.location',$location->l_slug) }}" title="{{ $location->l_zh_name }}"> 
								{{ $location->l_zh_name }}
							</a>
						@else
							<a href="{{ route('post.location',$location->l_slug) }}" title="{{ $location->l_en_name }}"> 
								{{ $location->l_en_name }}
							</a>
						@endif
					</li>
				@endforeach
			</div>
		@endif
	</div>
</div>