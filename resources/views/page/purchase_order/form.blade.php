@extends('template')

@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="panel panel-primary">

      <div class="panel-heading">
        <h3>FORM PURCHASE ORDER</h3>
      </div>

      <div class="panel-body">
        <form action="{{route('cpanel.purchase_order.'.$post)}}" method="post">
          @csrf
        <input type="hidden" name="id_request_order" value="{{$id??''}}">
        <input type="hidden" name="id_purchase_order" value="{{$data_purchase_order->id_purchase_order??''}}">
          <div class="row">
            <div class="col-md-12 form-group">
              <label for="">
                No Purchase Order
              </label>
              <input type="text" name="no_purchase_order" placeholder=". . . ." value="{{old('no_purchase_order')??$data_purchase_order->no_purchase_order??''}}" id="" class="form-control">
            </div>
            @forelse ($data_request_product as $item => $value)
            <div class="col-md-4 form-group">
              <label for="">
                Description
              </label>
              <input disabled type="text" name="description[{{$value->id_request_product}}]" placeholder=". . . ." value="{{old('description')??$value->description??''}}" id="" class="form-control">
            </div>
            <div class="col-md-2 form-group">
              <label for="">
                Qty
              </label>
              <input disabled type="number" name="qty[{{$value->id_request_product}}]" placeholder=". . . ." value="{{old('qty')??$value->qty??''}}" id="" class="form-control qty_{{$value->id_request_product}}">
            </div>
            <div class="col-md-3 form-group">
              <label for="">
                Unit Price
              </label>
              <input type="number" name="unit_price[{{$value->id_request_product}}]" placeholder=". . . ." value="{{old('unit_price')??$value->unit_price??''}}" data-id="{{$value->id_request_product}}" class="form-control calculate">
            </div>
            <div class="col-md-3 form-group">
              <label for="">
                Amount
              </label>
              <input type="number" name="amount[{{$value->id_request_product}}]" placeholder=". . . ." value="{{old('amount')??$value->amount??''}}" id="" class="form-control amount_{{$value->id_request_product}}">
            </div>
            @empty
            @endforelse
              <div id="data_product"></div>
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
      $('.calculate').keyup(function(){
        var id = $(this).data('id')
        var qty = $('.qty_'+id).val()

        var res = parseInt($(this).val()) * parseInt(qty) 
        $('.amount_'+id).val(res)
      })
    });
</script>
@endpush