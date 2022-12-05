<div class="card">
    <div class="card-header">
        <h4>Edit Type {{ $tp->name }}</h4>
    </div>
    <div class="card-body">
        <form id="update-form">
            @csrf

            <input type="hidden" name="id" id="id" value="{{ $tp->id }}">
            <div class="fv-row mb-3">
                <label class="required fw-bold fs-6 mb-2">Nama</label>
                <input type="text" name="name" id="name" class="form-control form-control-solid mb-3 mb-lg-0"
                    value="{{ $tp->name }}" required />
            </div>
            <div class="fv-row mb-3">
                <label class="required form-label fw-bold">Status</label>
                <select class="form-select  form-select-solid mb-3 mb-lg-0" name="status" id="status" required>
                    <option value="1" {{ $tp->status == 1 ? 'selected' : '' }}>Ya</option>
                    <option value="0" {{ $tp->status == 0 ? 'selected' : '' }}>Tidak</option>
                </select>
            </div>
            <div class="d-flex justify-content-end" id="loadingnya">
                <div class="py-2">
                    <button class="btn btn-sm btn-secondary" type="button" onclick="tutupContent()">Discard</button>
                </div>
                <div class="py-2">
                    <button class="btn btn-sm btn-primary" id="btn-update">Update Type</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $('#update-form').on('submit', function(e) {
            e.preventDefault();


            $('#btn-update').hide()
            $('#loadingnya').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')


            $.ajax({
                type: "POST",
                url: "{{ url('/admin/masterdata/typepartners/update') }}",
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
                    typeofpartner.ajax.reload(null, false);

                }
            })
        })
</script>
