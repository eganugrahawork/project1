<div class="card">
    <div class="card-header">
        <h4>Buat Retur</h4>
    </div>
    <div class="card-body">
        <form id="add-form" class="form">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="fv-row mb-3">
                        <label class="required form-label fw-bold">Nomor Invoice</label>
                        <select class="form-select  form-select-solid mb-3 mb-lg-0 select-2" name="id_invoice"
                            id="id_invoice" required>
                            <option>Pilih Disini</option>
                            @foreach ($list as $l)
                                <option value="{{ $l->id }}">{{ $l->invoice_number }}-{{ $l->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Tanggal Purchase Order</label>
                        <input type="text" name="order_date" id="order_date" readonly
                            class="form-control form-control-white mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <input type="hidden" name="po_id" id="po_id">
                        <label class=" form-label fw-bold">Partner</label>
                        <input type="text" name="partner" id="partner" readonly
                            class="form-control form-control-white mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Alamat</label>
                        <textarea type="text" name="address" id="address" readonly class="form-control form-control-white mb-3 mb-lg-0"></textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Nomor Telepon</label>
                        <input type="text" name="phone" id="phone" readonly
                            class="form-control form-control-white mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Att</label>
                        <input type="text" name="att" id="att" value="-" readonly
                            class="form-control form-control-white mb-3 mb-lg-0" />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Fax</label>
                        <input type="text"  id="fax" readonly
                            class="form-control form-control-white mb-3 mb-lg-0" required />
                    </div>
                </div>
                <div class="col-lg-6">

                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Kirim Dari</label>
                        <textarea id="shipment" class="form-control form-control-solid mb-3 mb-lg-0" readonly required></textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Vat/PPN</label>
                        <input type="text"  id="vat"
                            class="form-control form-control-solid mb-3 mb-lg-0" readonly required />
                    </div>

                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Email</label>
                        <input type="text"  id="email"
                            class="form-control form-control-solid mb-3 mb-lg-0" value="-" readonly required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Telp/Fax</label>
                        <input type="text"  id="telp/fax"
                            class="form-control form-control-solid mb-3 mb-lg-0" value="0837263723" readonly required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Jangka Waktu Pembayaran</label>
                        <input type="text" id="term_of_payment" name="term_of_payment"
                            class="form-control form-control-solid mb-3 mb-lg-0" readonly required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Deskripsi</label>
                        <textarea  id="description" name="description" class="form-control form-control-solid mb-3 mb-lg-0" readonly required></textarea>

                    </div>

                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Tanggal Retur</label>
                        <div class="">
                            <input type="text" name="retur_date" id="retur_date"
                            class="form-control form-control-solid mb-3 mb-lg-0" required />
                        </div>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Deskripsi Retur</label>
                        <textarea  name="description_retur" id="description_retur"
                            class="form-control form-control-solid mb-3 mb-lg-0" required > </textarea>
                    </div>


                </div>
                <hr>
                <h5 class="fw-bolder">Items</h5>
                <hr>
                <div class="col-lg-12"id="itemsList">

                </div>
            </div>
            <hr>

            <div class="d-flex justify-content-center" id="loadingnya">
                <div class="px-2">
                    <button class="btn btn-sm btn-primary" type="submit" id="btn-add">Buat</button>
                </div>
                <div class="px-2">
                    <button class="btn btn-sm btn-secondary" type="button" onclick="tutupContent()">Kembali</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.select-2').select2();
        flatpickr("#retur_date", {
            static: true,
            dateFormat: "Y-m-d",
        });

    });
</script>

<script>
    $('#id_invoice').on('change', function() {
        var id = $(this).val();
        $('#itemsList').html(
            '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')

        $.get("{{ url('/admin/procurement/retur/getdata') }}/" + id, {}, function(data) {

            $('#order_date').val(data.order_date);
            $('#partner').val(data.partner);
            $('#address').val(data.address);
            $('#phone').val(data.phone);
            $('#vat').val(data.vat);
            $('#fax').val(data.fax);
            $('#po_id').val(data.po_id);
            $('#shipment').val(data.shipment);
            $('#term_of_payment').val(data.term_of_payment);
            $('#description').val(data.description);
            $('#itemsList').html(data.html);
        })

    })




    $('#add-form').submit(function(event) {
        event.preventDefault();

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Buat Retur ini ?',
            text: "Pastikan Data Diisi Dengan Benar !",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak!',
            reverseButtons: false
        }).then((result) => {
            if (result.isConfirmed) {
                $('#loadingnya').html(
                    '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span>'
                    )
                $.ajax({
                    url: "{{ url('/admin/procurement/retur/store') }}",
                    type: 'post',
                    data: $('#add-form')
                        .serialize(), // Remember that you need to have your csrf token included
                    dataType: 'json',
                    success: function(response) {
                        Swal.fire(
                            'Success',
                            response.success,
                            'success'
                        )
                        $('#content').hide();
                        $('#indexContent').show();
                        $('#searchtableRetur').focus()
                        tableRetur.ajax.reload()
                    },
                    error: function(response) {
                        // Handle error
                    }
                });

            } else if (

                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Dibatalkan',
                    '',
                    'success'
                )
            }
        })

    });


</script>
