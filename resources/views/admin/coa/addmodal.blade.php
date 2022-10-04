<form id="kt_modal_add_user_form" class="form" action="/admin/masterdata/coa/store" method="post">
    @csrf
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Parent</label>
            <input type="number" name="id_parent" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">COA</label>
            <input type="text" name="coa" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Keterangan</label>
            <input type="text" name="keterangan" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
        </div>

        <div class="d-flex justify-content-end">
            <button class="btn btn-sm btn-primary">Add Coa</button>
        </div>
</form>
