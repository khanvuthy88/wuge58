@extends('layouts.app')
@section('custom-style')
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				@include('includes._user_sitebar')
			</div>
			<div class="col-md-9">
				<div class="card">
					<div class="card-header">{{ __('login.all_posts') }}<a href="{{ route('user.post.create') }}" class="float-right">{{ __('login.create_new_post') }}</a></div>
					<div class="card-body">
						<table class="table table-bordered table-responsive-md" id="post-table">
					        <thead>
					            <tr>
					                <th>Id</th>
					                <th>{{ __('login.post_name') }}</th>
					                <th>{{ __('login.post_price') }}</th>
					                <th>{{ __('login.actions') }}</th>
					            </tr>
					        </thead>
					    </table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('custom-script')
	<script type="text/javascript" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.0/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.0/js/buttons.print.min.js"></script>

	<script>
		$(function() {
		    $('#post-table').DataTable({
		        processing: true,
		        serverSide: true,
		        ajax: '{!! route('user.post.datatable') !!}',
		        columns: [
		            { data: 'id', name: 'id' },
		            { data: 'post_name', name: 'post_name' },
		            { data: 'price', name: 'price' },
		            {data: 'action', name: 'action', orderable: false, searchable: false}
		        ],
		        buttons: [
			        'copy', 'excel', 'pdf'
			    ],
			    language: {
		        	search: "{{ __('login.search') }}",
			        searchPlaceholder: "{{ __('login.search') }} ...",
			    }
		    });
		});
	</script>
@endsection