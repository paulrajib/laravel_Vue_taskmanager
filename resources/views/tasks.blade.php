@extends('layouts.crudapp')



@section('content')
	<div class="container">

		@if(session('successMsg'))

			<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<strong>{{ session('successMsg') }}</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

		@endif

		<table class="table table-striped text-center">
		  <thead>
		    <tr>
		      <!-- <th scope="col">Order</th> -->
		      <th scope="col">Title</th>
		      <th scope="col">Details</th>
		      <th scope="col">Completed</th>
		      <th scope="col">Action</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<div class="container">
				<div class="text-center">
		  			<h3>Testing From Blade file</h3>
		  		</div>
		  	</div>
		    @foreach($tasks as $task)
		    	<tr>
					<!-- <th scope="row">{{$task->order_of_tasks}}</th> -->
					<td>{{$task->name}}</td>
					<td style="color: #4286f4; font-weight: normal; font-size: 14px;">{{$task->details}}</td>
					<td>{{$task->completed}}</td>
					<td><a class="btn btn-primary" href="{{ route('edit', $task->id) }}">Edit</a>
						<form method="post" id="delete-form-{{ $task->id }}" action="{{ route('delete', $task->id ) }}" style="display: none;">
							@csrf
							{{ method_field('delete') }}
						</form>
						<!-- <a class="btn btn-danger" href="">Delete</a> -->
						<button onclick="if (confirm('Are you sure to delete this!?')){
							event.preventDefault();
							document.getElementById('delete-form-{{ $task->id }}').submit();
						} else{
							event.preventDefault();
						}" class="btn btn-danger">Delete</button>
					</td>

		    	</tr>
		    @endforeach

		  </tbody>
		</table>

	</div>


	<div class="container">
		<div class="text-center">
			<br>
			<h3>testing from Vue file - Draggable </h3>
			<div id="app">
				<task-crud-draggable :tasks="{{ $tasks }}"></task-crud-draggable>
			</div>
			<br>
			<br>
		</div>
	</div>

	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-md-auto">
			  
			</div>
		</div>
	</div>



@endsection

