@extends ('layout.ui-demo')
@section ('content')
  <ul>
  @foreach ($images as $image)
    <li style="font-weight: bold;"><a href="images/{{ $image->id }}">{{ basename( $image->url ) }}</a></li>
  @endforeach
  </ul>
	<a class="btn btn-primary" href="images/create" role="button">Create New</a>
@endsection
