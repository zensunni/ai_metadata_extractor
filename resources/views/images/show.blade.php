@extends ('layout.ui-demo')
@section ('content')
  <div class="content">
    <div style="font-weight: bold;">{{ basename( $image->url ) }}</div>
    <textarea class="form-control" style="height: 400px;">{{ $image->extracted_metadata }}</textarea>
  </div>
@endsection
