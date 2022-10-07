<form id="kt_modal_add_user_form" class="form" action="/admin/masterdata/principal/store" method="post">
    @csrf
    <div class="row">
    <div class="col-lg-6">
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Kode</label>
            <input type="text" name="code" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Nama</label>
            <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Email</label>
            <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
        </div>

        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">No Hp</label>
            <input type="number" name="phone" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Fax</label>
            <input type="text" name="fax" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Alamat</label>
            <textarea  name="address" class="form-control form-control-solid mb-3 mb-lg-0"  required></textarea>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Alamat Pengiriman</label>
            <textarea  name="ship_address" class="form-control form-control-solid mb-3 mb-lg-0"  required></textarea>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Bank</label>
            <div class="row">
                <div class="col-lg-4">
                    <input type="text" name="bank_name" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
                </div>
                <div class="col-lg-8">
                    <input type="text" name="account_number" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
                </div>
            </div>
        </div>

    </div>
</div>

        <div class="d-flex justify-content-end" id="loadingnya">
            <button class="btn btn-sm btn-primary" id="btn-add">Add Principal</button>
        </div>
    </form>

    <script>
        $('form').submit(function(){
        $('#btn-add').hide()
        $('#loadingnya').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
        // $('#btn-custom').attr("disabled", 'disabled')
    })
