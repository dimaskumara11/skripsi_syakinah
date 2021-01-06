@extends('template')

@section('content')
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Request Order Detail</h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-striped">
          <thead class="bg-info">
            <tr>
              <td>No</td>
              <td>Description</td>
              <td>Qty</td>
              <td>Unit Price</td>
              <td>Amount</td>
            </tr>
          </thead>
          <tbody id="show_request_detail">
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div class="row">
  <div class="col-md-8">
    <div class="panel panel-primary">

      <div class="panel-heading">
        <h3>LIST REQUEST ORDER</h3>
      </div>

      <div class="panel-body px-2 mt-2">
          <div class="row">
            <div class="col-md-12" style="margin-bottom: 10px">
              <a href="{{route('cpanel.request_order.form')}}" class="pull-right btn btn-sm btn-primary "><span class="fa fa-plus"></span>&nbsp; Request Order</a>
            </div>
            <div class="col-md-12" style="margin-bottom: 10px">
              <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#menu1">Sedang Request</a></li>
                <li><a data-toggle="tab" href="#menu2">Sudah Di Proses</a></li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="tab-content">
                <div id="menu1" class="tab-pane fade in active">
                  <div class="table-responsive">
                      <table class="table table-bordered table-striped" id="myTable1">
                          <thead>
                              <tr>
                                  <th style="width: 5%">No</th>
                                  <th style="width: 30%">No. Request Order</th>
                                  <th style="width: 25%">Supplier</th>
                                  <th style="width: 20%">Tanggal Request</th>
                                  <th style="width: 20%">Aksi</th>
                              </tr>
                          </thead>
                          <tbody>
                            @forelse ($request_order_0 as $item => $value)
                              <tr>
                                  <td>{{$item+1}}</td>
                                  <td>{{$value->no_request_order}}</td>
                                  <td>{{$value->nama}}</td>
                                  <td>{{$value->tanggal_request}}</td>
                                  <td>
                                      <a href="{{route('cpanel.request_order.form',[$value->id_request_order])}}" title="edit" class="btn btn-info btn-xs round"><span class="fa fa-edit"></span></a>
                                      <a href="#" title="detail" class="btn btn-success btn-xs round detail" id="{{$value->id_request_order}}"><span class="fa fa-eye"></span></a>
                                      <a href="#" onclick="return alert(`sedang dalam perbaikan`)" title="print" class="btn btn-warning btn-xs round"><span class="fa fa-print"></span></a>
                                      <a href="{{route('cpanel.request_order.delete',[$value->id_request_order])}}" onclick="return confirm(`kamu yakin ingin menghapus?`)" title="hapus" class="btn btn-danger btn-xs round"><span class="fa fa-trash"></span></a>
                                  </td>
                              </tr>
                            @empty
                                <tr>
                                  <td colspan="6">Data kosong</td>
                                </tr>
                            @endforelse
                          </tbody>
                      </table>
                  </div>
                </div>
                <div id="menu2" class="tab-pane fade">
                  <div class="table-responsive">
                      <table class="table table-bordered table-striped" id="myTable2">
                          <thead>
                              <tr>
                                  <th style="width: 5%">No</th>
                                  <th style="width: 30%">No. Request Order</th>
                                  <th style="width: 25%">Supplier</th>
                                  <th style="width: 20%">Tanggal Request</th>
                                  <th style="width: 20%">Aksi</th>
                              </tr>
                          </thead>
                          <tbody>
                                @forelse ($request_order_1 as $item => $value)
                                    <tr>
                                        <td>{{$item+1}}</td>
                                        <td>{{$value->no_request_order}}</td>
                                        <td>{{$value->nama}}</td>
                                        <td>{{$value->tanggal_request}}</td>
                                        <td>
                                            <a href="#" title="detail" class="btn btn-success btn-xs round detail" id="{{$value->id_request_order}}"><span class="fa fa-eye"></span></a>
                                            <a href="#" onclick="return alert(`sedang dalam perbaikan`)" title="print" class="btn btn-warning btn-xs round"><span class="fa fa-print"></span></a>
                                            <a href="{{route('cpanel.request_order.delete',[$value->id_request_order])}}" onclick="return confirm(`kamu yakin ingin menghapus?`)" title="hapus" class="btn btn-danger btn-xs round"><span class="fa fa-trash"></span></a>
                                        </td>
                                    </tr>
                                  @empty
                                      <tr>
                                        <td colspan="6">Data kosong</td>
                                      </tr>
                                  @endforelse
                          </tbody>
                      </table>
                  </div>
                </div>
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
      $(".detail").click(function(){
        $.ajax({
          url : "{{route('cpanel.request_product.get_request_order')}}/"+$(this).attr("id"),
          dataType:"JSON",
          success:function (data) {
            console.log(data)
            var num = 1
            var html = ""
            for (let index = 0; index < data.length; index++) {
              html += `
                  <tr>
                    <td>`+num+`</td>
                    <td>`+data[index].description+`</td>
                    <td>`+data[index].qty+`</td>
                    <td>`+(data[index].unit_price == undefined ?'-' : data[index].unit_price)+`</td>
                    <td>`+(data[index].amount == undefined ?'-' : data[index].amount)+`</td>
                  </tr>
              `
              num++
            }
            $("#show_request_detail").html(html)
            $("#myModal").modal()
          }
        })

      })
    });
</script>
@endpush