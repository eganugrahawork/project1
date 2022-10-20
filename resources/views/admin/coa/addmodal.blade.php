<form id="add-form" >
    {{-- @csrf --}}
        <div class="fv-row mb-7">
            <label class="required form-label fw-bold">Parent</label>
                <select class="form-select  form-select-solid mb-3 mb-lg-0" id="id_parent" name="id_parent" required>
                    <option value="0">Main Parent</option>
                    @foreach ($coa as $coa)
                        <option value="{{ $coa->id }}">{{ $coa->coa }}</option>
                    @endforeach
                </select>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Cash Of Account</label>
            <input type="text" name="coa" id="coa" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Description</label>
            <input type="text" name="description" id="description" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required form-label fw-bold">Status</label>
                <select class="form-select  form-select-solid mb-3 mb-lg-0" id="status" name="status" required>
                    <option value="1">Ya</option>
                    <option value="0">Tidak</option>
                </select>
        </div>

        <div class="d-flex justify-content-end" id="loadingnya">
            <button class="btn btn-sm btn-primary" id="btn-add">Add Coa</button>
        </div>
</form>
