@extends('template')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary">

      <div class="panel-heading">
        <h3>LIST DATA HUTANG SUPPLIER</h3>
      </div>

      <div class="panel-body px-2 mt-2">
          <div class="row">
            <div class="col-md-12" style="margin-bottom: 10px">
              <a href="{{route('cpanel.hutang_supplier.form')}}" class="pull-right btn btn-sm btn-primary "><span class="fa fa-plus"></span>&nbsp; Tambah</a>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 20%">Nama Supplier</th>
                                <th style="width: 20%">No Invoice</th>
                                <th style="width: 10%">Tgl Invoice</th>
                                <th style="width: 10%">Total Tagihan</th>
                                <th style="width: 10%">Jatuh Tempo</th>
                                <th style="width: 10%">Status Pembayaran</th>
                                <th style="width: 15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                              @foreach ($hutang_supplier as $item => $value)
                                  <tr>
                                      <td>{{$item+1}}</td>
                                      <td>{{$value->nama}}</td>
                                      <td>{{$value->no_invoice}}</td>
                                      <td>{{$value->tgl_invoice}}</td>
                                      <td>{{$value->total_tagihan}}</td>
                                      <td>{{$value->jatuh_tempo}}</td>
                                      <td>{{$value->status_pembayaran==0?"Cicil":"Lunas"}}</td>
                                      <td>
                                          <a href="{{route('cpanel.hutang_supplier.form',[$value->id_hutang_supplier])}}" title="edit" class="btn btn-info btn-xs round"><span class="fa fa-edit"></span></a>
                                          <a target="_blank" href="{{route('cpanel.hutang
                                          _supplier.pdf',[$value->id_hutang_supplier])}}" title="Print PDF" class="btn btn-warning btn-xs round"><span class="fa fa-print"></span></a>
                                          <a href="{{route('cpanel.hutang_supplier.delete',[$value->id_hutang_supplier])}}" onclick="return confirm(`kamu yakin ingin menghapus?`)" title="hapus" class="btn btn-danger btn-xs round"><span class="fa fa-trash"></span></a>
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
</div>
@endsection

@push("add_js")
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    });
</script>
@endpush