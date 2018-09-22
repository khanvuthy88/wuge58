
	<div class="col-md-12 author">
		<div class="card">
			@foreach($post_auth as $user)
			<div class="card-header">Auth: {{ $user->name }}</div>		
			<div class="card-body row">
				<div class="col-md-3 ">
					<img src="{{ asset('images/default-user.png') }}" class="img-fluid rounded-circle">
				</div>
				<div class="col-md-9">
					<h2><a href="{{ route('post.user',$user->slug) }}">More posts by : {{ $user->name }}</a></h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. </p>
					<p class="phone"><i class="fas fa-phone-volume img-thumbnail"></i>070 80 90 34</p>
					<p class="email"><i class="fas fa-envelope img-thumbnail"></i>{{ $user->email }}</p>
				</div>
			</div>
			@endforeach
		</div>
	</div>
