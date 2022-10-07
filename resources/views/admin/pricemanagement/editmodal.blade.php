<form id="kt_modal_add_user_form" class="form" action="/admin/masterdata/pricemanagement/update" method="post">
    @csrf
    <div class="row">
        <div class="col-lg-6">
            <div class="fv-row mb-7">
                <input type="hidden" name="id_mat" value="{{ $item->id_mat }}">
                <label class="required fw-bold fs-6 mb-2">Kode Item</label>
                <input type="text" name="stock_code" disabled class="form-control form-control-white mb-3 mb-lg-0" value="{{ $item->stock_code }}" required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Nama Item</label>
                <input type="text" name="stock_name" disabled class="form-control form-control-white mb-3 mb-lg-0" value="{{ $item->stock_name }}" required/>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Harga Atas</label>
                <input type="number" name="top_price" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $item->top_price }}" required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Harga Bawah</label>
                <input type="number" name="bottom_price" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $item->bottom_price }}" required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Harga Pokok</label>
                <input type="number" name="base_price" disabled class="form-control form-control-white mb-3 mb-lg-0" value="{{ $item->base_price }}"/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Harga Beli</label>
                <input type="number" name="buy_price" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $item->buy_price }}" required/>
            </div>
        </div>
    </div>

        <div class="d-flex justify-content-end">
            <button class="btn btn-sm btn-primary">Update Price</button>
        </div>
</form>
