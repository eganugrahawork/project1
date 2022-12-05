<div class="card">
    <div class="card-header">
        <h4>Update Coa {{ $coa->coa }}</h4>
    </div>
    <div class="card-body">
        <form id="update-form">
            @csrf
            <input type="hidden" name="id" id="id" value="{{ $coa->id }}">
            <div class="fv-row mb-3">
                <label class="required form-label fw-bold">Parent</label>
                <select class="form-select  form-select-solid mb-3 mb-lg-0 select-2" id="id_parent" name="id_parent"
                    disabled required>
                    <option value="0" {{ $coa->id_parent == 0 ? 'selected' : '' }}>Main Parent</option>
                    @foreach ($parentcoa as $pc)
                        <option value="{{ $pc->id }}" {{ $coa->id_parent == $pc->id ? 'selected' : '' }}>
                            {{ $pc->coa }}</option>
                    @endforeach
                </select>
            </div>
            <div class="fv-row mb-3">
                <label class="required fw-bold fs-6 mb-2">COA</label>
                <input type="text" name="coa" id="coa" class="form-control form-control-solid mb-3 mb-lg-0"
                    value="{{ $coa->coa }}" required />
            </div>
            <div class="fv-row mb-3">
                <label class="required fw-bold fs-6 mb-2">Keterangan</label>
                <input type="text" name="description" id="description"
                    class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $coa->description }}" required />
            </div>
            <div class="fv-row mb-3">
                <label class="required form-label fw-bold">Status</label>
                <select class="form-select  form-select-solid mb-3 mb-lg-0" name="status" id="status" required>
                    <option value="1" {{ $coa->status == 1 ? 'selected' : '' }}>Ya</option>
                    <option value="0" {{ $coa->status == 0 ? 'selected' : '' }}>Tidak</option>
                </select>
            </div>
            <div class="d-flex justify-content-end" id="loadingnya">
                <div class="py-2">
                    <button class="btn btn-sm btn-secondary" type="button" onclick="tutupContent()">Discard</button>
                </div>
                <div class="py-2">
                    <button class="btn btn-sm btn-primary" id="btn-update">Update Coa</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.select-2').select2({});

    });

    $('#update-form').on('submit', function(e) {
            e.preventDefault();


            $('#loadingnya').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')


            $.ajax({
                type: "POST",
                url: "{{ url('/admin/masterdata/coa/update') }}",
                data: $('#update-form').serialize(),
                dataType: 'json',
                success: function(response) {
                    Swal.fire(
                        'Success',
                        response.success,
                        'success'
                    )
                    $('#content').hide();
                    $('#indexContent').show();
                    coaTable.ajax.reload(null, false);
                }
            })
        })
</script>
