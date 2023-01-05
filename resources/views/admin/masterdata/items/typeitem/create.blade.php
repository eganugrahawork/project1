<div class="card">
    <div class="card-header">
        <h4>Buat Tipe Item Baru</h4>
    </div>
    <div class="card-body">
        <form id="add-form" class="form">
            @csrf
            <div class="d-flex justify-content-center">
                <div class="col-lg-6">
            <div class="fv-row mb-3">
                <label class="required form-label fw-bold">Coa</label>
                <div class="col-lg-6">
                    <select class="form-select  form-select-solid mb-3 mb-lg-0 select-2" name="coa_id" required>
                        @foreach ($coa as $c)
                            <option value="{{ $c->id }}">{{ $c->coa }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="fv-row mb-3">
                <label class="required fw-bold fs-6 mb-2">Nama Tipe</label>
                <input type="text" name="name_type" class="form-control form-control-solid mb-3 mb-lg-0" required />
            </div>
            <div class="fv-row mb-3">
                <label class="required fw-bold fs-6 mb-2">Deskripsi</label>
                <textarea name="description" class="form-control form-control-solid mb-3 mb-lg-0" required></textarea>
            </div>
            <div class="fv-row mb-3">
                <label class="required form-label fw-bold">Status</label>
                <div class="col-lg-6">
                    <select class="form-select  form-select-solid mb-3 mb-lg-0" name="status" required>
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

            <div class="d-flex justify-content-center" id="loadingnya">
                <div class="p-2">
                    <button class="btn btn-sm btn-secondary" type="button" onclick="tutupContent()">Kembali</button>
                </div>
                <div class="p-2">
                    <button class="btn btn-sm btn-primary" id="btn-add">Buat Tipe Item</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $('.select-2').select2()
    $('#add-form').on('submit', function(e) {
        e.preventDefault();

        $('#loadingnya').html(
            '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')

        $.ajax({
            type: "POST",
            url: "{{ url('/admin/masterdata/typeitems/store') }}",
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
                typeItemTable.ajax.reload(null, false);
            }
        })
    });
</script>
