<form id="update-form" class="form">
    @csrf
    <input type="hidden" value="{{ $uom->id }}" name="id"  id="id">
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">UOM</label>
            <input type="text" name="name" id="name" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $uom->name }}" required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Simbol</label>
            <input type="text" name="symbol" id="symbol" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $uom->symbol }}" required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Keterangan</label>
            <input type="text" name="description" id="description" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $uom->description }}" required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required form-label fw-bold">Status</label>
                <select class="form-select  form-select-solid mb-3 mb-lg-0" id="status" name="status" required>
                    <option value="1" {{ $uom->status == 1? 'selected' : ''; }}>Ya</option>
                    <option value="0"  {{ $uom->status == 0? 'selected' : ''; }}>Tidak</option>
                </select>
        </div>

        <div class="d-flex justify-content-end" id="loadingnya">
            <button class="btn btn-sm btn-primary" id="btn-update">Update UOM</button>
        </div>
</form>

{{-- <script>
    $('form').submit(function(){
    $('#btn-update').hide()
    $('#loadingnya').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
    // $('#btn-custom').attr("disabled", 'disabled')
})
</script> --}}
