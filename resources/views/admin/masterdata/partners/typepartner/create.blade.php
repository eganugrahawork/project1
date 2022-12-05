<div class="card">
    <div class="card-header">
        <h4>Create New Type Partner</h4>
    </div>
    <div class="card-body">
        <form id="add-form">
            @csrf
            <div class="fv-row mb-3">
                <label class="required fw-bold fs-6 mb-2">Name</label>
                <input type="text" name="name" id="name" class="form-control form-control-solid mb-3 mb-lg-0"
                    required />
            </div>
            <div class="fv-row mb-3">
                <label class="required form-label fw-bold">Status</label>
                <select class="form-select  form-select-solid mb-3 mb-lg-0" name="status" id="status" required>
                    <option value="1">Ya</option>
                    <option value="0">Tidak</option>
                </select>
            </div>
            <div class="d-flex justify-content-end" id="loadingnya">
                <div class="py-2">
                    <button class="btn btn-sm btn-secondary" type="button" onclick="tutupContent()">Discard</button>
                </div>
                <div class="py-2">
                    <button class="btn btn-sm btn-primary" id="btn-add">Create Type</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $('#add-form').on('submit', function(e) {
        e.preventDefault();

        $('#btn-add').hide()
        $('#loadingnya').html(
            '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')


        $.ajax({
            type: "POST",
            url: "{{ url('/admin/masterdata/typepartners/store') }}",
            data: $('#add-form').serialize(),
            dataType: 'json',
            success: function(response) {
                Swal.fire(
                    'Success',
                    response.success,
                    'success'
                )
                $('#content').hide();
                $('#indexContent').show();
                typeofpartner.ajax.reload(null, false);

            }
        })
    });
</script>
