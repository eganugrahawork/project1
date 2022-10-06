<form id="kt_modal_add_user_form" class="form" action="/admin/masterdata/uom/update" method="post">
    @csrf
    <input type="hidden" value="{{ $uom->id }}" name="id">
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">UOM</label>
            <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $uom->name }}" required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Simbol</label>
            <input type="text" name="symbol" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $uom->symbol }}" required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Keterangan</label>
            <input type="text" name="description" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $uom->description }}" required/>
        </div>

        <div class="d-flex justify-content-end" id="loadingnya">
            <button class="btn btn-sm btn-primary" id="btn-update">Update UOM</button>
        </div>
</form>

<script>
    $('form').submit(function(){
    $('#btn-update').hide()
    $('#loadingnya').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
    // $('#btn-custom').attr("disabled", 'disabled')
})
</script>
