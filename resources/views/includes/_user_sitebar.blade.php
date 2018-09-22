<div class="card">
	<div class="card-header">{{ __('login.setting') }}</div>
	<div class="list-group">
		<li class="list-group-item"><a href="{{ route('user.post.index') }}">{{ __('login.posts') }}</a></li>
		<li class="list-group-item"><a href="{{ route('user.category.index') }}">{{ __('login.categories') }}</a></li>
		<li class="list-group-item"><a href="#">Profile</a></li>
		<li class="list-group-item"><a href="#">Store</a></li>
	</div>
</div>