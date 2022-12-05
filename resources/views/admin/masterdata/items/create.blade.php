<div class="card">
    <div class="card-header">
        <h4>Create New Item</h4>
    </div>
    <div class="card-body">
        <form id="add-form" class="form">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Code of Item</label>
                        <input type="text" name="item_code" class="form-control form-control-solid mb-3 mb-lg-0"
                            required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Name of Item</label>
                        <input type="text" name="item_name" class="form-control form-control-solid mb-3 mb-lg-0"
                            required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Item Description</label>
                        <textarea name="item_description" class="form-control form-control-solid mb-3 mb-lg-0" required></textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required form-label fw-bold">Units</label>
                        <div class="col-lg-6">
                            <select class="form-select  form-select-solid mb-3 mb-lg-0 select-2" name="uom_id"
                                required>
                                @foreach ($uom as $uom)
                                    <option value="{{ $uom->id }}">{{ $uom->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Unit Box</label>
                        <div class="col-lg-6">
                            <input type="number" name="unit_box" class="form-control form-control-solid mb-3 mb-lg-0"
                                required />
                        </div>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required form-label fw-bold">Item Type</label>
                        <div class="col-lg-6">
                            <select class="form-select form-select-solid " name="type_id" required>
                                @foreach ($type as $type)
                                    <option value="{{ $type->id }}">{{ $type->name_type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required form-label fw-bold">Vat</label>
                        <div class="col-lg-6">
                            <select class="form-select  form-select-solid mb-3 mb-lg-0" name="vat" required>
                                <option value="11">11%</option>
                                <option value="10">10%</option>
                                <option value="0">0%</option>
                            </select>
                        </div>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="form-label fw-bold required">Partners</label>
                        <select class="form-select form-select-solid mb-3 mb-lg-0 select-2" name="partner_id" required>
                            @foreach ($partner as $p)
                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required form-label fw-bold">Status</label>
                        <div class="col-lg-6">
                            <select class="form-select  form-select-solid mb-3 mb-lg-0" name="status" required>
                                <option value="1">Sale</option>
                                <option value="0">Not Sale</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end" id="loadingnya">
                <div class="py-2">
                    <button class="btn btn-sm btn-secondary" type="button" onclick="tutupContent()">Discard</button>
                </div>
                <div class="py-2">
                    <button class="btn btn-sm btn-primary" id="btn-add">Add Items</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.select-2').select2();

    });
</script>
<script>
    $('#add-form').on('submit', function(e) {
        e.preventDefault();

        $('#loadingnya').html(
            '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')

        $.ajax({
            type: "POST",
            url: "{{ url('/admin/masterdata/items/store') }}",
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
                itemsTable.ajax.reload(null, false);
            }
        })
    });
</script>
