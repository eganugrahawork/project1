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
            <input type="text" name="description" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
        </div>

        <div class="d-flex justify-content-end" id="loadingnya">
            <button class="btn btn-sm btn-primary" id="btn-add">Add Coa</button>
        </div>
</form>

<script>
    $('form').submit(function(){
    $('#btn-add').hide()
    $('#loadingnya').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
    // $('#btn-custom').attr("disabled", 'disabled')
})
</script>
