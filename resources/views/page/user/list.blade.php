@extends('template')

@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="panel panel-primary">

      <div class="panel-heading">
        <h3>LIST DATA USER</h3>
      </div>

      <div class="panel-body px-2 mt-2">
          <div class="row">
            <div class="col-md-12" style="margin-bottom: 10px">
              <a href="{{route('cpanel.user.form')}}" class="pull-right btn btn-sm btn-primary "><span class="fa fa-plus"></span>&nbsp; Tambah</a>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 30%">Username</th>
                                <th style="width: 30%">Hak Akses</th>
                                <th style="width: 20%">Status</th>
                                <th style="width: 15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                              @foreach ($user as $item => $value)
                                  <tr>
                                      <td>{{$item+1}}</td>
                                      <td>{{$value->username}}</td>
                                      <td>{{$value->nama_hak_akses}}</td>
                                      <td>{{$value->active==1?"Aktif":"Non Aktif"}}</td>
                                      <td>
                                          <a href="{{route('cpanel.user.form',[$value->id_user])}}" title="edit" class="btn btn-info btn-xs round"><span class="fa fa-edit"></span></a>
                                          <a href="#" onclick="return alert(`sedang dalam perbaikan`)" title="hapus" class="btn btn-warning btn-xs round"><span class="fa fa-print"></span></a>
                                          <a href="{{route('cpanel.user.delete',[$value->id_user])}}" onclick="return confirm(`kamu yakin ingin menghapus?`)" title="hapus" class="btn btn-danger btn-xs round"><span class="fa fa-trash"></span></a>
                                      </td>
                                  </tr>
                              @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
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