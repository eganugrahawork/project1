<form id="kt_modal_add_user_form" class="form" action="/admin/masterdata/customer/update" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $cust->id }}">
    <div class="row">
        <div class="col-lg-6">
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Kode</label>
                <input type="text" name="code_cust" value="{{ $cust->code_cust }}" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Nama</label>
                <input type="text" name="cust_name" value="{{ $cust->cust_name }}" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Nama Kontak</label>
                <input type="text" name="contact_person" value="{{ $cust->contact_person }}" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required form-label fw-bold">Wilayah</label>
                <div class="col-lg-6">
                    <select class="form-select  form-select-solid mb-3 mb-lg-0" name="region" required>
                        @foreach ($wilayah as $w)
                        <option value="{{ $w->id }}" @if ($cust->region == $w->id)
                            selected
                        @endif>{{ $w->lokasi }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Alamat</label>
                <textarea  name="cust_address"  class="form-control form-control-solid mb-3 mb-lg-0"  required>{{ $cust->cust_address }}</textarea>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">No Telp</label>
                <input type="number" name="phone" value="{{ $cust->phone }}" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Email</label>
                <input type="email" name="email" value="{{ $cust->email }}" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">No NPWP</label>
                <input type="text" name="no_npwp" value="{{ $cust->no_npwp }}" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Pemilik NPWP</label>
                <input type="text" name="npwp_name" value="{{ $cust->npwp_name }}" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Alamat Pemilik NPWP</label>
                <input type="text" name="npwp_address" value="{{ $cust->npwp_address }}" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Distrik</label>
                <input type="text" name="district" value="{{ $cust->district }}" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Kota</label>
                <input type="text" name="city" value="{{ $cust->city }}" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Group</label>
                <input type="text" name="group" value="{{ $cust->group }}" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Limit Kredit</label>
                <input type="text" name="credit_limit" value="{{ $cust->credit_limit }}" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="form-label fw-bold required">Status Perlihat</label>
            <select class="form-select  form-select-solid mb-3 mb-lg-0" name="sts_show" required>
                    <option value="1"  @if ($cust->sts_show == 1)
                        selected
                    @endif>Show</option>
                    <option value="0"  @if ($cust->sts_show !== 1)
                        selected
                    @endif>Hide</option>
            </select>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-sm btn-primary">Update Customer</button>
            </div>

    </div>
</div>
</form>
