<form id="kt_modal_add_user_form" class="form" action="/admin/masterdata/coa/update" method="post">
    @csrf
<input type="hidden" name="id" value="{{ $coa->id }}">
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Parent</label>
            <input type="number" name="id_parent" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $coa->id_parent }}" required readonly/>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">COA</label>
            <input type="text" name="coa" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $coa->coa }}" required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Keterangan</label>
            <input type="text" name="description" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $coa->description }}" required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required form-label fw-bold">Status</label>
                <select class="form-select  form-select-solid mb-3 mb-lg-0" name="status" required>
                    <option value="1" {{ $coa->status == 1 ? 'selected' : ''; }}>Ya</option>
                    <option value="0" {{ $coa->status == 0 ? 'selected' : ''; }}>Tidak</option>
                </select>
        </div>
        <div class="d-flex justify-content-end" id="loadingnya">
            <button class="btn btn-sm btn-primary" id="btn-update">Update Coa</button>
        </div>
</form>
<script>
    $('form').submit(function(){
    $('#btn-update').hide()
    $('#loadingnya').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
    // $('#btn-custom').attr("disabled", 'disabled')
})
</script>
