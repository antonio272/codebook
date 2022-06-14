
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
			<!-- Add Comment -->
			<div class="card my-5">
					<h5 class="card-header">Actualize Comment</h5>
					<div class="card-body">
						<form method="post" action="/post/{{ $post->id }}/commentarios/{{ $commentario->id }}">
						@csrf
                        @method('PUT')
						<textarea name="commentario" class="form-control">{{ $commentario->commentario }}</textarea>
						<button type="submit" class="text-sm py-1 px-2 border border-gray-400 shadow-sm rounded-md hover:shadow-md">Save</button>
						</form>
					</div>
			</div>
  
        </div>
        <div class="col-md-3"></div>
    </div>
    </div>
</div>
@endsection
