@extends('template')

@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="panel panel-primary">

      <div class="panel-heading">
        <h3>DASHBOARD</h3>
      </div>

      <div class="panel-body px-2 mt-2">
          SEJARAH PT
      </div>
    </div>
  </div>
  @include('page.calendar_jam')
</div>
@endsection

@push("add_js")

@endpush