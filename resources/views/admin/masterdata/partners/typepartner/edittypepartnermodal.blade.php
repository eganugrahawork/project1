<form id="updatetypepartner-form">
    {{-- @csrf --}}

    <input type="hidden" name="id" id="id" value="{{ $tp->id }}">
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Nama</label>
            <input type="text" name="name" id="name" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $tp->name }}" required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required form-label fw-bold">Status</label>
                <select class="form-select  form-select-solid mb-3 mb-lg-0" name="status" id="status" required>
                    <option value="1" {{ $tp->status == 1 ? 'selected' : '' }}>Ya</option>
                    <option value="0" {{ $tp->status == 0 ? 'selected' : '' }}>Tidak</option>
                </select>
        </div>
        <div class="d-flex justify-content-end" id="loadingnyaupdatetypepartner">
            <button class="btn btn-sm btn-primary" id="btn-updatetypepartner">Update Type</button>
        </div>
</form>
