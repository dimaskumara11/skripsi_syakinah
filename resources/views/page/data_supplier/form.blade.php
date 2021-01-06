@extends('template')

@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="panel panel-primary">

      <div class="panel-heading">
        <h3>FORM DATA SUPPLIER</h3>
      </div>

      <div class="panel-body">
        <form action="{{route('cpanel.data_supplier.'.$post)}}" method="post">
          @csrf
        <input type="hidden" name="id_supplier" value="{{$data_supplier->id_supplier??''}}">
          <div class="row">
            <div class="col-md-12 form-group">
              <label for="">
                Nama Supplier
              </label>
              <input type="text" name="nama" placeholder=". . . ." value="{{old('nama')??$data_supplier->nama??''}}" id="" class="form-control">
            </div>
            <div class="col-md-3 form-group">
              <label for="">
                No Telp
              </label>
              <input type="text" name="no_telp" placeholder=". . . ." value="{{old('no_telp')??$data_supplier->no_telp??''}}" id="" class="form-control">
            </div>
            <div class="col-md-4 form-group">
              <label for="">
                Fax
              </label>
              <input type="text" name="fax" placeholder=". . . ." value="{{old('fax')??$data_supplier->fax??''}}" id="" class="form-control">
            </div>
            <div class="col-md-5 form-group">
              <label for="">
                Email
              </label>
              <input type="email" name="email" placeholder=". . . ." value="{{old('email')??$data_supplier->email??''}}" id="" class="form-control">
            </div>
            <div class="col-md-12 form-group">
              <label for="">
                UP
              </label>
              <input type="text" name="up" placeholder=". . . ." value="{{old('up')??$data_supplier->up??''}}" id="" class="form-control">
            </div>
            <div class="col-md-12 form-group">
              <label for="">
                Alamat
              </label>
              <textarea name="alamat" placeholder=". . . ." id="" cols="30" rows="10" class="form-control">{{old('alamat')??$data_supplier->alamat??''}}</textarea>
            </div>
            <div class="col-md-12 form-group text-right">
              <hr>
              <button type="reset" class="btn btn-sm btn-danger"><span class="fa fa-minus-circle"></span> Reset</button>
              <button class="btn btn-sm btn-info"><span class="fa fa-save"></span> Simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  @include('page.calendar_jam')
</div>
@endsection

@push("add_js")
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    });
</script>
@endpush