@extends('layouts.crudapp')

@section('content')

	<form action="{{ route('update', $task) }}" method="post">
		<div class="container">
			<!-- 
			@if(session('successMsg'))
				{{session('successMsg')}}
			@endif -->

			@csrf

			@if($errors->any())
				@foreach($errors->all() as $error)
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
					  <strong>{{ $error }}</strong>
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
				@endforeach
			@endif

			<div class="form-group">
				<label for="exampleInputEmail1">Name</label>
				<input type="text" class="form-control" id="name" name="name" value="{{ $task->name}}" aria-describedby="emailHelp" placeholder="Please Enter Your Name Here">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Details</label>
				<input type="text" class="form-control" id="details" name="details" value="{{ $task->details}}" aria-describedby="emailHelp" placeholder="Please Enter Task Details Here">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Order Of Tasks</label>
				<input type="text" class="form-control" id="order_of_tasks" name="order_of_tasks" value="{{ $task->order_of_tasks}}" aria-describedby="emailHelp" placeholder="Please Enter Task Details Here">
			</div>
			<div class="form-check">
				<input type="checkbox" class="form-check-input" id="exampleCheck1" name="completed">
				<label class="form-check-label" for="exampleCheck1">Completed</label>
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</form>

@endsection