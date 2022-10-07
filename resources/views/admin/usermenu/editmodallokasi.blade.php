<form id="kt_modal_add_user_form" class="form" action="/admin/configuration/location/update" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $region->id }}">
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Region</label>
            <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $region->name }}" required/>
        </div>

        <div class="d-flex justify-content-end">
            <button class="btn btn-sm btn-primary">Update</button>
        </div>
</form>
