<div class="card">
    <div class="card-header">
        <h4>Perbarui Tipe {{ $typeitems->name_type }}</h4>
    </div>
    <div class="card-body">
        <form id="update-form" class="form">
            @csrf
            <div class="d-flex justify-content-center">

                <div class="col-lg-6">
                    <input type="hidden" name="id" value="{{ $typeitems->id }}">
                    <div class="fv-row mb-3">
                        <label class="required form-label fw-bold">Coa</label>
                        <div class="col-lg-6">
                            <select class="form-select  form-select-solid mb-3 mb-lg-0 select-2" name="coa_id"
                                required>
                                @foreach ($coa as $c)
                                    <option value="{{ $c->id }}"
                                        {{ $typeitems->coa_id == $c->id ? 'selected' : '' }}>{{ $c->coa }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Nama Tipe</label>
                        <input type="text" name="name_type" class="form-control form-control-solid mb-3 mb-lg-0"
                            value="{{ $typeitems->name_type }}" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Deskripsi</label>
                        <textarea name="description" class="form-control form-control-solid mb-3 mb-lg-0" required>{{ $typeitems->description }}</textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required form-label fw-bold">Status</label>
                        <div class="col-lg-6">
                            <select class="form-select  form-select-solid mb-3 mb-lg-0" name="status" required>
                                <option value="1" {{ $typeitems->status == 1 ? 'selected' : '' }}>Ya</option>
                                <option value="0" {{ $typeitems->status == 0 ? 'selected' : '' }}>Tidak</option>
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
                    <button class="btn btn-sm btn-primary" id="btn-update">Perbarui</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $('.select-2').select2()
    $('#update-form').on('submit', function(e) {
        e.preventDefault();

        $('#loadingnya').html(
            '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')

        $.ajax({
            type: "POST",
            url: "{{ url('/admin/masterdata/typeitems/update') }}",
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
                $('#searchItemsTable').focus();
                typeItemTable.ajax.reload(null, false);
            }
        })
    });
</script>
