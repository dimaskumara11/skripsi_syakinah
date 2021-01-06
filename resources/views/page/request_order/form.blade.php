@extends('template')

@section('content')
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Request Product</h4>
      </div>
      <div class="modal-body">
        <form action="#" method="post" class="row myform">
          <input type="hidden" name="id_edit">
          <div class="col-md-9 form-group">
            <label for="">
              Description
            </label>
            <input type="text" name="description_edit" placeholder=". . . ." id="" class="form-control">
          </div>
          <div class="col-md-3 form-group">
            <label for="">
              Qty
            </label>
            <input type="number" name="qty_edit" placeholder=". . . ." id="" class="form-control">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary simpan-product" data-dismiss="modal">Simpan</button>
      </div>
    </div>

  </div>
</div>
<div class="row">
  <div class="col-md-8">
    <div class="panel panel-primary">

      <div class="panel-heading">
        <h3>FORM REQUEST ORDER</h3>
      </div>

      <div class="panel-body">
        <form action="{{route('cpanel.request_order.'.$post)}}" method="post">
          @csrf
        <input type="hidden" name="id_request_order" value="{{$data_request_order->id_request_order??''}}">
          <div class="row">
            <div class="col-md-12 form-group">
              <label for="">
                No Request Order
              </label>
              <input type="text" name="no_request_order" placeholder=". . . ." value="{{old('no_request_order')??$data_request_order->no_request_order??''}}" id="" class="form-control">
            </div>
            <div class="col-md-12 form-group">
              <label for="">
                Nama Supplier
              </label>
              <select name="supplier" id="" class="form-control">
                @foreach ($data_supplier as $item => $value)
                  <option value="{{$value->id_supplier}}" {{(old('supplier')??$data_request_order->id_supplier??'')==$value->id_supplier?"selected":""}}>{{$value->nama}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-12 form-group text-right">
              <button class="btn btn-info btn-sm tambah-product" type="button"><span class="fa fa-plus"></span> Tambah</button>
            </div>
            @forelse ($data_request_product as $item => $value)
              <div class="col-md-7 form-group">
                <label for="">
                  Description
                </label>
                <input disabled type="text" placeholder=". . . ." value="{{old('description')??$value->description??''}}" id="desc_{{$value->id_request_product}}" class="form-control">
              </div>
              <div class="col-md-3 form-group">
                <label for="">
                  Qty
                </label>
                <input disabled type="number" placeholder=". . . ." value="{{old('qty')??$value->qty??''}}" id="qty_{{$value->id_request_product}}" class="form-control">
              </div>
              <div class="col-md-2">
                <label for="">
                  Aksi
                </label><br>
                <button type="button" class="btn btn-sm btn-warning edit" data-id="{{$value->id_request_product}}"><span class="fa fa-edit"></span></button>
                <button type="button" class="btn btn-sm btn-danger delete" data-id="{{$value->id_request_product}}"><span class="fa fa-trash"></span></button>
              </div>
            @empty
              <div class="col-md-9 form-group">
                <label for="">
                  Description
                </label>
                <input type="text" name="description[]" placeholder=". . . ." value="{{old('description')??$value->description??''}}" id="" class="form-control">
              </div>
              <div class="col-md-3 form-group">
                <label for="">
                  Qty
                </label>
                <input type="number" name="qty[]" placeholder=". . . ." value="{{old('qty')??$value->qty??''}}" id="" class="form-control">
              </div>
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
      $('.tambah-product').click(function () {
        var html = `<div class="col-md-9 form-group">
                      <label for="">
                        Description
                      </label>
                      <input type="text" name="description[]" placeholder=". . . ." id="" class="form-control">
                    </div>
                    <div class="col-md-3 form-group">
                      <label for="">
                        Qty
                      </label>
                      <input type="number" name="qty[]" placeholder=". . . ." id="" class="form-control">
                    </div>`
        $('#data_product').append(html)
      })

      $('.edit').click(function () {
        $('#myModal').modal()
        var id = $(this).data('id')
        $.ajax({
          url : "{{route('cpanel.request_product.get_by_id')}}/"+id,
          success : function (data) {
            $('[name="description_edit"]').val(data.description)
            $('[name="qty_edit"]').val(data.qty)
            $('[name="id_edit"]').val(id)
          }
        })
      })

      $('.delete').click(function () {
        if(confirm('kamu yakin ingin menghapus ?')){
          var id = $(this).data('id')
          $.ajax({
            url : "{{route('cpanel.request_product.delete')}}/"+id,
            success : function (data) {
              if(data){
                $('[data-id="'+id+'"]').remove()
                $('#desc_'+id).remove()
                $('#qty_'+id).remove()
              }
            }
          })
        }
      })

      $('.simpan-product').click(function () {
        var id = $('[name="id_edit"]').val()
        $.ajax({
          url : "{{route('cpanel.request_product.update')}}/",
          data: $('.myform').serialize(),
          success : function (data) {
            if(data){
              $("#desc_"+id).val($('[name="description_edit"]').val())
              $("#qty_"+id).val($('[name="qty_edit"]').val())
              alert("sukses update product")
            }
            else
              alert("gagal update product")

            $('#myModal').hide()
          }
        })
      })
    });
</script>
@endpush