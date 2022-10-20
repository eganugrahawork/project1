<form id="kt_modal_add_user_form" class="form" action="/admin/masterdata/itemprice/update" method="post">
    @csrf
    <div class="row">
        <div class="col-lg-6">
            <div class="fv-row mb-7">
                <input type="hidden" name="id" value="{{ $itemprice->id }}">
                <input type="hidden" name="item_id" value="{{ $itemprice->item_id }}">
                <input type="hidden" name="qty_item_id" value="{{ $itemprice->qty_item_id }}">

                <label class="required fw-bold fs-6 mb-2">Code Item</label>
                <input type="text" name="item_code" disabled class="form-control form-control-white mb-3 mb-lg-0" value="{{ $itemprice->item->item_code }}" required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Unit Of Measure</label>
                <input type="text" name="uom" disabled class="form-control form-control-white mb-3 mb-lg-0" value="{{ $itemprice->item->uom->name }}" required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Item Name</label>
                <input type="text" name="item_name" disabled class="form-control form-control-white mb-3 mb-lg-0" value="{{ $itemprice->item->item_name }}" required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Buy Price</label>
                <input type="text" name="buy_price" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $itemprice->base_price }}"/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Base Price</label>
                <input type="text" name="base_price" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $itemprice->base_price }}"/>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Bottom Price</label>
                <input type="number" name="bottom_price" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $itemprice->bottom_price }}" required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Top Price</label>
                <input type="number" name="top_price" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $itemprice->top_price }}" required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Price Pcs</label>
                <input type="number" name="price_pcs" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $itemprice->price_pcs }}" required/>
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
