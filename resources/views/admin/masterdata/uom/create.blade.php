<div class="card">
    <div class="card-header">
        <h4>Buat UOM Baru</h4>
    </div>
    <div class="card-body">
        <form id="add-form">
            @csrf
            <div class="fv-row mb-3">
                <label class="required fw-bold fs-6 mb-2">UOM</label>
                <input type="text" name="name" id="name" class="form-control form-control-solid mb-3 mb-lg-0"
                    required />
            </div>
            <div class="fv-row mb-3">
                <label class="required fw-bold fs-6 mb-2">Simbol</label>
                <input type="text" name="symbol" id="symbol" class="form-control form-control-solid mb-3 mb-lg-0"
                    required />
            </div>
            <div class="fv-row mb-3">
                <label class="required fw-bold fs-6 mb-2">Keterangan</label>
                <input type="text" name="description" id="description"
                    class="form-control form-control-solid mb-3 mb-lg-0" required />
            </div>
            <div class="fv-row mb-3">
                <label class="required form-label fw-bold">Status</label>
                <select class="form-select  form-select-solid mb-3 mb-lg-0" id="status" name="status" required>
                    <option value="1">Ya</option>
                    <option value="0">Tidak</option>
                </select>
            </div>

            <div class="d-flex justify-content-end" id="loadingnya">
                <div class="py-2">
                    <button class="btn btn-sm btn-secondary" type="button" onclick="tutupContent()">Kembali</button>
                </div>
                <div class="py-2">
                    <button class="btn btn-sm btn-primary" id="btn-add">Buat UOM</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $('#add-form').on('submit', function(e) {
        e.preventDefault();

        $('#loadingnya').html(
            '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')

        $.ajax({
            type: "POST",
            url: "{{ url('/admin/masterdata/uom/store') }}",
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
                tableUom.ajax.reload(null, false);
            }
        })
    })
</script>
