<form id="kt_modal_add_user_form" class="form" action="/admin/masterdata/customer/store" method="post">
    @csrf
    <div class="row">
        <div class="col-lg-6">
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Kode</label>
                <input type="text" name="cust_code" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Nama</label>
                <input type="text" name="cust_name" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required form-label fw-bold">Wilayah</label>
                <div class="col-lg-6">
                    <select class="form-select  form-select-solid mb-3 mb-lg-0" name="region" required>
                        @foreach ($region as $r)
                        <option value="{{ $r->id }}">{{ $r->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Alamat</label>
                <textarea  name="cust_address" class="form-control form-control-solid mb-3 mb-lg-0"  required></textarea>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Nama Kontak</label>
                <input type="text" name="contact_person" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">No Telp</label>
                <input type="number" name="phone" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Email</label>
                <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">No NPWP</label>
                <input type="text" name="no_npwp" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Alamat Pemilik NPWP</label>
                <input type="text" name="npwp_address" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Distrik</label>
                <input type="text" name="district" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Kota</label>
                <input type="text" name="city" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Group</label>
                <input type="text" name="group" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Limit Kredit</label>
                <input type="text" name="credit_limit" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>

        </div>
    </div>
    <div class="d-flex justify-content-end" id="loadingnya">
        <button class="btn btn-sm btn-primary" id="btn-add">Add Customer</button>
    </div>
</form>


<script>
    $('form').submit(function(){
    $('#btn-add').hide()
    $('#loadingnya').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
    // $('#btn-custom').attr("disabled", 'disabled')
})
</script>
