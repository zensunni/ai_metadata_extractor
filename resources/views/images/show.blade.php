@extends ('layout.ui-demo')
@section ('content')
  <div class="content">
    <span style="font-weight: bold;">{{ basename( $image->url ) }}</span>
  </div>
@endsection
