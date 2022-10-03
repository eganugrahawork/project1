<form id="kt_modal_add_user_form" class="form" action="/admin/masterdata/principal/store" method="post">
    @csrf
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Kode</label>
            <input type="text" name="kode_eksternal" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Nama</label>
            <input type="text" name="name_eksternal" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Email</label>
            <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Alamat</label>
            <textarea  name="eksternal_address" class="form-control form-control-solid mb-3 mb-lg-0"  required></textarea>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">No Hp</label>
            <input type="number" name="phone_1" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Fax</label>
            <input type="text" name="fax" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Bank 1</label>
            <div class="row">
                <div class="col-lg-4">
                    <input type="text" name="bank1" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
                </div>
                <div class="col-lg-8">
                    <input type="text" name="rek1" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
                </div>
            </div>
        </div>
        <div class="fv-row mb-7">
            <label class="fw-bold fs-6 mb-2">Bank 2</label>
            <div class="row">
                <div class="col-lg-4">
                    <input type="text" name="bank2" class="form-control form-control-solid mb-3 mb-lg-0" />
                </div>
                <div class="col-lg-8">
                    <input type="text" name="rek2" class="form-control form-control-solid mb-3 mb-lg-0" />
                </div>
            </div>
        </div>
        <div class="fv-row mb-7">
            <label class="fw-bold fs-6 mb-2">Bank 3</label>
            <div class="row">
                <div class="col-lg-4">
                    <input type="text" name="bank3" class="form-control form-control-solid mb-3 mb-lg-0" />
                </div>
                <div class="col-lg-8">
                    <input type="text" name="rek3" class="form-control form-control-solid mb-3 mb-lg-0" />
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <button class="btn btn-sm btn-primary">Add Principal</button>
        </div>
</form>
