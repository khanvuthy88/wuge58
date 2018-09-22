@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				@include('includes._user_sitebar')
			</div>
			<div class="col-md-9">
				<div class="card">
					<div class="card-header">{{ $category->exists ? __('login.edit_category') : __('login.create_new_category') }}</div>
					<div class="card-body">
						{!! Form::model($category, [
							'method'=>$category->exists ? 'PUT' : 'POST',
							'route'=>$category->exists ? ['user.category.update',$category] : 'user.category.store'
							]) !!}

							<div class="form-row">
								<div class="form-group col-md-12">
									{!! Form::label('类别', NULL, []) !!}
									
									{!! Form::select('parent_id', $category_array, $category->exists ? $cateogry->cate_name : NULL, ['class'=>'form-control']) !!}
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-12">
									{!! Form::label('新类别', NULL, []) !!}
									{!! Form::text('category', $category->exists ? $category->cate_name : NULL, ['class'=>'form-control']) !!}
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-12">
									{!! Form::submit('发送', ['class'=>'btn btn-primary']) !!}
								</div>
							</div>

						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection