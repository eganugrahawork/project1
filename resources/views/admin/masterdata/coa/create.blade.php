<div class="card">
    <div class="card-header">
        <h4>Create New Coa</h4>
    </div>
    <div class="card-body">
        <form id="add-form">
            @csrf
            <div class="fv-row mb-3">
                <label class="required form-label fw-bold">Parent</label>
                <select class="form-select  form-select-solid mb-3 mb-lg-0 select-2" id="id_parent" name="id_parent"
                    required>
                    <option value="0">Main Parent</option>
                    @foreach ($coa as $coa)
                        <option value="{{ $coa->id }}">{{ $coa->coa }}</option>
                    @endforeach
                </select>
            </div>
            <div class="fv-row mb-3">
                <label class="required fw-bold fs-6 mb-2">Cash Of Account</label>
                <input type="text" name="coa" id="coa" class="form-control form-control-solid mb-3 mb-lg-0"
                    required />
            </div>
            <div class="fv-row mb-3">
                <label class="required fw-bold fs-6 mb-2">Deskripsi</label>
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
                    <button class="btn btn-sm btn-primary" id="btn-add">Buat Coa</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.select-2').select2();

    });

    $('#add-form').on('submit', function(e) {
            e.preventDefault();
            $('#loadingnya').html('<div class="spinner-grow text-primary" role="status"><span class="sr-only"></span></div>')
                $.ajax({
                    type: "POST",
                    url: "{{ url('/admin/masterdata/coa/store') }}",
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
                        coaTable.ajax.reload(null, false);
                    }
                })
        });
</script>
