@extends ('layout.ui-demo')
@section ('content')


	<table class="table table-hover" style="margin-top: 40px;">
		<thead>
			<tr>
				<th>#</th>
				<th>Image URL</th>
				<th></th>
			</tr>
		</thead>
		<tbody style="font-weight: bold;">
			@foreach ($images as $image)
				<tr>
					<td>{{ $image->id }}</td>
					<td><a href="images/{{ $image->id }}">{{ basename( $image->url ) }}</a></td>
					<td>
						<form action="images/{{ $image->id }}" method="POST">
							<input type="hidden" name="_method" value="DELETE">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<button type="submit" class="btn btn-sm btn-danger">Delete</button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<a class="btn btn-primary" href="images/create" role="button">Create New</a>
@endsection
