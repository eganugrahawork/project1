<form id="kt_modal_add_user_form" class="form" action="/admin/masterdata/typeitems/update" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $typeitems->id }}">
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Code of Type Item</label>
                <input type="text" name="type_code" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $typeitems->type_code }}"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Name of Type Item</label>
                <input type="text" name="name_type" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $typeitems->name_type }}" required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Description</label>
                <textarea  name="description" class="form-control form-control-solid mb-3 mb-lg-0" required>{{ $typeitems->description }}</textarea>
            </div>
            <div class="fv-row mb-7">
                <label class="required form-label fw-bold">Status</label>
                <div class="col-lg-6">
                    <select class="form-select  form-select-solid mb-3 mb-lg-0" name="status" required>
                        <option value="1" {{ $typeitems->status == 1 ?'selected' : '' }}>Ya</option>
                        <option value="0" {{ $typeitems->status == 0 ?'selected' : '' }}>Tidak</option>
                    </select>
                </div>
            </div>


        <div class="d-flex justify-content-end" id="loadingnya">
            <button class="btn btn-sm btn-primary" id="btn-update">Update Type Items</button>
        </div>
</form>

<script>
    $('form').submit(function(){
    $('#btn-update').hide()
    $('#loadingnya').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
    // $('#btn-custom').attr("disabled", 'disabled')
})
</script>
