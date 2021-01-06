@extends('template')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary">

      <div class="panel-heading">
        <h3>LAPORAN PURCHASE ORDER</h3>
      </div>

      <div class="panel-body px-2 mt-2">
          <div class="row">
            <div class="col-md-12">
              <form action="{{route('cpanel.laporan_po')}}" method="get">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Filter Berdasarkan Nama Supplier</label>
                      <select name="id_supplier" id="" class="form-control">
                        @foreach ($supplier as $item => $value)
                            <option value="{{$value->id_supplier}}">{{$value->nama}}</option>
                        @endforeach
                      </select>
                      <br>
                      <button class="btn btn-warning"><span class="fa fa-search"></span> Filter</button>
                    </div>
                  </div>
                  <div class="col-md-12"><hr></div>
                </div>
              </form>
            </div>
            <div class="col-md-12">
              <div class="tab-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="myTable2">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 15%">No. Request Order</th>
                                <th style="width: 15%">No. Purchase Order</th>
                                <th style="width: 20%">Description</th>
                                <th style="width: 10%">Qty</th>
                                <th style="width: 10%">Unit Price</th>
                                <th style="width: 15%">Amount</th>
                                <th style="width: 10%">Tanggal PO</th>
                            </tr>
                        </thead>
                        <tbody>
                              @forelse ($data_purchase as $item => $value)
                                  <tr>
                                      <td>{{$item+1}}</td>
                                      <td>{{$value->no_request_order}}</td>
                                      <td>{{$value->no_purchase_order}}</td>
                                      <td>{{$value->description}}</td>
                                      <td>{{$value->qty}}</td>
                                      <td>{{$value->unit_price}}</td>
                                      <td>{{$value->amount}}</td>
                                      <td>{{$value->tanggal_purchase_order}}</td>
                                  </tr>
                              @empty
                                  <tr>
                                    <td colspan="8">Data kosong</td>
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
@endsection

@push("add_js")
@endpush