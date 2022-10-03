<form id="kt_modal_add_user_form" class="form" action="/admin/masterdata/uom/update" method="post">
    @csrf
    <input type="hidden" value="{{ $uom->id_uom }}" name="id_uom">
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">UOM</label>
            <input type="text" name="uom_name" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $uom->uom_name }}" required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Simbol</label>
            <input type="text" name="uom_symbol" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $uom->uom_symbol }}" required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Keterangan</label>
            <input type="text" name="description" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $uom->description }}" required/>
        </div>

        <div class="d-flex justify-content-end">
            <button class="btn btn-sm btn-primary">Add UOM</button>
        </div>
</form>
