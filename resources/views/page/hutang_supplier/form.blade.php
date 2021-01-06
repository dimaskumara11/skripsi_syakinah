@extends('template')

@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="panel panel-primary">

      <div class="panel-heading">
        <h3>FORM DATA HUTANG SUPPLIER</h3>
      </div>

      <div class="panel-body">
        <form action="{{route('cpanel.hutang_supplier.'.$post)}}" method="post">
          @csrf
        <input type="hidden" name="id_hutang_supplier" value="{{$data_hutang_supplier->id_hutang_supplier??''}}">
          <div class="row">
            <div class="col-md-6 form-group">
              <label for="">
                No Invoice
              </label>
              <input type="text" name="no_invoice" placeholder=". . . ." value="{{old('no_invoice')??$data_hutang_supplier->no_invoice??''}}" id="" class="form-control">
            </div>
            <div class="col-md-3 form-group">
              <label for="">
                Tgl Invoice
              </label>
              <input type="date" name="tgl_invoice" placeholder=". . . ." value="{{old('tgl_invoice')??$data_hutang_supplier->tgl_invoice??''}}" id="" class="form-control">
            </div>
            <div class="col-md-3 form-group">
              <label for="">
                Tgl Terima Invoice 
              </label>
              <input type="date" name="tgl_terima_invoice" placeholder=". . . ." value="{{old('tgl_terima_invoice')??$data_hutang_supplier->tgl_terima_invoice??''}}" id="" class="form-control">
            </div>
            <div class="col-md-6 form-group">
              <label for="">
                Total Tagihan
              </label>
              <input type="number" name="total_tagihan" placeholder=". . . ." value="{{old('total_tagihan')??$data_hutang_supplier->total_tagihan??''}}" id="" class="form-control">
            </div>
            <div class="col-md-3 form-group">
              <label for="">
                Jatuh Tempo 
              </label>
              <input type="date" name="jatuh_tempo" placeholder=". . . ." value="{{old('jatuh_tempo')??$data_hutang_supplier->jatuh_tempo??''}}" id="" class="form-control">
            </div>
            <div class="col-md-4 form-group">
              <label for="">
                Supplier
              </label>
              <select name="supplier" id="" class="form-control">
                @foreach ($supplier as $item  => $value)
                    <option value="{{$value->id_supplier}}" {{($data_hutang_supplier->id_hak_akses??0)==$value->id_hak_akses}}>{{$value->nama}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-5 form-group">
              <label for="">
                Status Pembayaran
              </label><br>
              <input type="radio" name="status_pembayaran" value="0" placeholder=". . . ." {{(old('status_pembayaran')??$data_hutang_supplier->status_pembayaran??'')==0?"checked":""}}> Cicil &emsp;
              <input type="radio" name="status_pembayaran" value="1" placeholder=". . . ." {{(old('status_pembayaran')??$data_hutang_supplier->status_pembayaran??'')==1?"checked":""}}> Lunas
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