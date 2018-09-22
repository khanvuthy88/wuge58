<div class="card">
	<div class="card-header">
		<a data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
			<i class="fas fa-plus"></i>
          {{ __('frontend.choose_category') }}
        </a>
	</div>
	<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
		@if(isset($categories))
			@foreach($categories as $category)
				<li class="list-group-item">
					<a href="{{ route('post.category',$category->cate_slug) }}"> 
						@if(Session::get('locale')==='zh')
							{{ $category->cate_zh_name }}
						@else
							{{ $category->cate_en_name }}
						@endif
					</a>
				</li>
			@endforeach
		@endif
	</div>
</div>