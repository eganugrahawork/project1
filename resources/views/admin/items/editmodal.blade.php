<form id="kt_modal_add_user_form" class="form" action="/admin/masterdata/items/update" method="post">
    @csrf
    <input type="hidden" value="{{ $item->id_mat }}" name="id_mat">
    <div class="row">
        <div class="col-lg-6">
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Kode Item</label>
                <input type="text" name="stock_code" class="form-control form-control-solid mb-3 mb-lg-0"  value="{{ $item->stock_code }}" required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Nama Item</label>
                <input type="text" name="stock_name" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $item->stock_name }}" required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Deskripsi Item</label>
                <textarea  name="stock_desc" class="form-control form-control-solid mb-3 mb-lg-0"  required>{{ $item->stock_desc }}</textarea>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Ukuran</label>
                <div class="col-lg-6">
                    <input type="number" name="base_qty" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $item->base_qty }}" required/>
                </div>
            </div>
            <div class="fv-row mb-7">
                <label class="required form-label fw-bold">Satuan</label>
                <div class="col-lg-6">

                    <select class="form-select  form-select-solid mb-3 mb-lg-0" name="unit_terkecil" required>
                        @foreach ($uom as $uom)
                        <option value="{{ $uom->id_uom }}" @if ($item->unit_terkecil == $uom->id_uom)
                            selected
                        @endif>{{ $uom->uom_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Unit per Box</label>
                <div class="col-lg-6">
                    <input type="number" name="unit_box"value="{{ $item->unit_box }}" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
                </div>
            </div>
            <div class="fv-row mb-7">
                <label class="required form-label fw-bold">Tipe Barang</label>
                <div class="col-lg-6">

                    <select class="form-select  form-select-solid mb-3 mb-lg-0" name="type" required>
                        @foreach ($type as $type)
                        <option value="{{ $type->id_type_material }}" @if ($type->id_type_material == $item->type)
                            selected
                        @endif>{{ $type->type_material_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="fv-row mb-7">
                <label class="required form-label fw-bold">Pajak</label>
                <div class="col-lg-6">

                    <select class="form-select  form-select-solid mb-3 mb-lg-0" name="pajak" required>
                        <option value="10" @if ($item->pajak == 10)
                            selected
                        @endif>10%</option>
                        <option value="0"  @if ($item->pajak == 0)
                            selected
                        @endif>0%</option>
                    </select>
                </div>
            </div>
            <div class="fv-row mb-7">
                <label class="form-label fw-bold required">Principal</label>
            <select class="form-select  form-select-solid mb-3 mb-lg-0" name="dist_id" required>
                @foreach ($principal as $p)
                    <option value="{{ $p->id }}"  @if ($item->dist_id == $p->id)
                        selected
                    @endif>{{ $p->name_eksternal }}</option>
                @endforeach
            </select>
            </div>
            <div class="fv-row mb-7">
                <label class="form-label fw-bold required">Status Item</label>
                <select class="form-select  form-select-solid mb-3 mb-lg-0" name="sts_show" required>
                        <option value="0"  @if ($item->status ==0 || $item->status == null)
                            selected
                        @endif>Dijual</option>
                        <option value="1"  @if ($item->status == 1)
                            selected
                        @endif>Tidak Dijual</option>
                        <option value="1"  @if ($item->status == 2)
                            selected
                        @endif>Limit</option>
                </select>
            </div>
            <div class="fv-row mb-7">
                <label class="form-label fw-bold required">Status Perlihat</label>
                <select class="form-select  form-select-solid mb-3 mb-lg-0" name="sts_show" required>
                    <option value="1"  @if ($item->sts_show == 1)
                        selected
                    @endif>Show</option>
                    <option value="0"  @if ($item->sts_show !== 1)
                        selected
                    @endif>Hide</option>
            </select>
            </div>
        </div>
    </div>



        <div class="d-flex justify-content-end">
            <button class="btn btn-sm btn-primary">Update Item</button>
        </div>
</form>
