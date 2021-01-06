@extends('template')

@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="panel panel-primary">

      <div class="panel-heading">
        <h3>FORM DATA USER</h3>
      </div>

      <div class="panel-body">
        <form action="{{route('cpanel.user.'.$post)}}" method="post">
          @csrf
        <input type="hidden" name="id_user" value="{{$data_user->id_user??''}}">
        <input type="hidden" name="username_old" placeholder=". . . ." value="{{$data_user->username??''}}" id="" class="form-control">
          <div class="row">
            <div class="col-md-12 form-group">
              <label for="">
                Username
              </label>
              <input type="text" name="username" placeholder=". . . ." value="{{old('username')??$data_user->username??''}}" id="" class="form-control">
            </div>
            <div class="col-md-12 form-group">
              <label for="">
                Password {{$post=="update"?"(kosongkan jika tidak ingin mengupdate password)":""}}
              </label>
              <input type="text" name="password" placeholder=". . . ." id="" class="form-control">
            </div>
            <div class="col-md-4 form-group">
              <label for="">
                Hak Akses
              </label>
              <select name="id_hak_akses" id="" class="form-control">
                @foreach ($hak_akses as $item  => $value)
                    <option value="{{$value->id_hak_akses}}" {{($data_user->id_hak_akses??0)==$value->id_hak_akses}}>{{$value->nama_hak_akses}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-5 form-group">
              <label for="">
                Status
              </label><br>
              <input type="radio" name="active" value="1" placeholder=". . . ." {{(old('active')??$data_user->active??'')==1?"checked":""}}> Aktif &emsp;
              <input type="radio" name="active" value="0" placeholder=". . . ." {{(old('active')??$data_user->active??'')==0?"checked":""}}> Non Aktif
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