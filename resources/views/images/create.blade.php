@extends ('layout.ui-demo')
@section ('content')
  <form action="/images" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="url">URL</label>
      <input type="text" class="form-control" id="url" name="url" placeholder="Enter url of image">
    </div>
	  <button type="submit" class="btn btn-primary" role="button">Add</button>
  </form>
@endsection
