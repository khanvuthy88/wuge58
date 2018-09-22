@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				@include('includes._user_sitebar')
			</div>
			<div class="col-md-9">
				<div class="card">
					<div class="card-header">{{ __('frontend.all_categories') }}<a class="float-right" href="{{ route('user.category.create') }}">{{ __('login.create_new_category') }}</a></div>
					<div class="card-body">
						<div class="row">
							@if(isset($categories))
								@foreach($categories as $category)
									<li class="col-md-6">
										@if(Session::get('locale')==='en')
											{{ $category->cate_en_name }}
										@elseif(Session::get('locale')==='zh')
											{{ $category->cate_zh_name }}
										@endif
									</li>								
								@endforeach
							@else
								<p>没有类别</p>
							@endif	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

