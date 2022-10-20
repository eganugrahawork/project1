<form id="kt_modal_add_user_form" class="form" action="/admin/masterdata/items/store" method="post">
    @csrf
    <div class="row">
        <div class="col-lg-6">
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Code of Item</label>
                <input type="text" name="item_code" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Name of Item</label>
                <input type="text" name="item_name" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Item Description</label>
                <textarea  name="item_description" class="form-control form-control-solid mb-3 mb-lg-0"  required></textarea>
            </div>
            <div class="fv-row mb-7">
                <label class="required form-label fw-bold">Units</label>
                <div class="col-lg-6">
                    <select class="form-select  form-select-solid mb-3 mb-lg-0" name="uom_id" required>
                        @foreach ($uom as $uom)
                        <option value="{{ $uom->id }}">{{ $uom->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Ukuran</label>
                <div class="col-lg-6">
                    <input type="number" name="base_qty" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
                </div>
            </div> --}}
        </div>
        <div class="col-lg-6">
            {{-- <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Unit per Box</label>
                <div class="col-lg-6">
                    <input type="number" name="unit_box" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
                </div>
            </div> --}}
            <div class="fv-row mb-7">
                <label class="required form-label fw-bold">Item Type</label>
                <div class="col-lg-6">

                    <select class="form-select  form-select-solid mb-3 mb-lg-0" name="type_id" required>
                        @foreach ($type as $type)
                        <option value="{{ $type->id }}">{{ $type->name_type }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="fv-row mb-7">
                <label class="required form-label fw-bold">Vat</label>
                <div class="col-lg-6">
                    <select class="form-select  form-select-solid mb-3 mb-lg-0" name="vat" required>
                        <option value="11">11%</option>
                        <option value="10">10%</option>
                        <option value="0">0%</option>
                    </select>
                </div>
            </div>
            <div class="fv-row mb-7">
                <label class="form-label fw-bold required">Partners</label>
            <select class="form-select  form-select-solid mb-3 mb-lg-0" name="partner_id" required>
                @foreach ($partner as $p)
                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                @endforeach
            </select>
            </div>
            <div class="fv-row mb-7">
                <label class="required form-label fw-bold">Status</label>
                <div class="col-lg-6">
                    <select class="form-select  form-select-solid mb-3 mb-lg-0" name="status" required>
                        <option value="0">Dijual</option>
                        <option value="1">Tidak Dijual</option>
                        <option value="2">Limit</option>
                    </select>
                </div>
            </div>
        </div>
    </div>




        <div class="d-flex justify-content-end" id="loadingnya">
            <button class="btn btn-sm btn-primary" id="btn-add">Add Items</button>
        </div>
</form>

<script>
    $('form').submit(function(){
    $('#btn-add').hide()
    $('#loadingnya').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
    // $('#btn-custom').attr("disabled", 'disabled')
})
</script>
