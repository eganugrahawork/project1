<form id="kt_modal_add_user_form" class="form" action="/admin/masterdata/pricemanagement/update" method="post">
    @csrf
    <div class="row">
        <div class="col-lg-6">
            <div class="fv-row mb-7">
                <input type="hidden" name="id" value="{{ $item->pricehistory->id }}">

                <label class="required fw-bold fs-6 mb-2">Kode Item</label>
                <input type="text" name="code" disabled class="form-control form-control-white mb-3 mb-lg-0" value="{{ $item->code }}" required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Nama Item</label>
                <input type="text" name="name" disabled class="form-control form-control-white mb-3 mb-lg-0" value="{{ $item->name }}" required/>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Harga Atas</label>
                <input type="number" name="top_price" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $item->pricehistory->top_price }}" required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Harga Bawah</label>
                <input type="number" name="bottom_price" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $item->pricehistory->bottom_price }}" required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Harga Good Sold</label>
                <input type="text" name="harga_good_sold" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $item->pricehistory->harga_good_sold }}"/>
            </div>
        </div>
    </div>

        <div class="d-flex justify-content-end" id="loadingnya">
            <button class="btn btn-sm btn-primary" id="btn-update">Update Price</button>
        </div>
</form>
<script>
    $('form').submit(function(){
    $('#btn-update').hide()
    $('#loadingnya').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
    // $('#btn-custom').attr("disabled", 'disabled')
})
</script>
