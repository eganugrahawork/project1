<form id="kt_modal_add_user_form" class="form" action="/admin/configuration/location/update" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $region->id }}">
        <div class="fv-row mb-3">
            <label class="required fw-bold fs-6 mb-2">Wilayah</label>
            <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $region->name }}" required/>
        </div>

        <div class="d-flex justify-content-end">
            <button class="btn btn-sm btn-primary">Perbarui</button>
        </div>
</form>
