<div class="card">
    <div class="card-header">
        <h4>Perbarui Item {{ $item->item_name }}</h4>
    </div>
    <div class="card-body">
        <form id="update-form" class="form">
            @csrf
            <input type="hidden" value="{{ $item->id }}" name="id">
            <div class="row">
                <div class="col-lg-6">
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Kode Item</label>
                        <input type="text" name="item_code" class="form-control form-control-transparent mb-3 mb-lg-0"
                            value="{{ $item->item_code }}" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Nama Item</label>
                        <input type="text" name="item_name" class="form-control form-control-transparent mb-3 mb-lg-0"
                            value="{{ $item->item_name }}" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Deskripsi Item</label>
                        <textarea name="item_description" class="form-control form-control-transparent mb-3 mb-lg-0" required>{{ $item->item_description }}</textarea>
                    </div>

                    <div class="fv-row mb-3">
                        <label class="required form-label fw-bold">Unit</label>
                        <div class="col-lg-6">
                            <select class="form-select  form-select-transparent mb-3 mb-lg-0 select-2" name="uom_id"
                                required>
                                @foreach ($uom as $uom)
                                    <option value="{{ $uom->id }}"
                                        @if ($item->uom_id == $uom->id) selected @endif>{{ $uom->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Unit Box</label>
                        <div class="col-lg-6">
                            <input type="number" name="unit_box" value="{{ $item->itemqty->unit_box }}"
                                class="form-control form-control-transparent mb-3 mb-lg-0" required />
                        </div>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required form-label fw-bold">Item Tipe</label>
                        <div class="col-lg-6">
                            <select class="form-select  form-select-transparent mb-3 mb-lg-0 select-2" name="type_id"
                                required>
                                @foreach ($type as $type)
                                    <option value="{{ $type->id }}"
                                        @if ($type->id == $item->type_id) selected @endif>{{ $type->name_type }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required form-label fw-bold">Pajak</label>
                        <div class="col-lg-6">
                            <select class="form-select  form-select-transparent mb-3 mb-lg-0" name="vat" required>
                                <option value="11" @if ($item->vat == 11) selected @endif>11%</option>
                                <option value="10" @if ($item->vat == 10) selected @endif>10%</option>
                                <option value="0" @if ($item->vat == 0) selected @endif>0%</option>
                            </select>
                        </div>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="form-label fw-bold required">Partner</label>
                        <select class="form-select  form-select-transparent mb-3 mb-lg-0 select-2" name="partner_id" required>
                            @foreach ($partner as $p)
                                <option value="{{ $p->id }}" @if ($item->partner_id == $p->id) selected @endif>
                                    {{ $p->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="form-label fw-bold required">Status</label>
                        <select class="form-select  form-select-transparent mb-3 mb-lg-0" name="status" required>
                            <option value="0" @if ($item->status == 0 || $item->status == null) selected @endif>Tidak Dijual
                            </option>
                            <option value="1" @if ($item->status == 1) selected @endif>Dijual</option>

                        </select>
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
            url: "{{ url('/admin/masterdata/items/update') }}",
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
                itemsTable.ajax.reload(null, false);
            }
        })
    });
</script>
