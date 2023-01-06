<div class="card">
    <div class="card-header">
        <h4>Tambah Invoice</h4>
    </div>
    <div class="card-body">
        <form id="createInvoice" class="form">
            <div class="row">
                <div class="col-lg-6">
                    @csrf
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Nomor Penjualan</label>
                        <select class="form-select  form-select-transparent mb-3 mb-lg-0 select-2" name="selling_id"
                            id="selling_id" onchange="getDataSelling()" required>
                            <option selected disabled>Pilih Nomor Penjualan</option>
                            @foreach ($list_penjualan as $list)
                                <option value="{{ $list->id_penjualan }}">{{ $list->no_selling }}-{{ $list->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Tanggal Penjualan</label>
                        <input type="text" id="sales_date" name="sales_date"
                            class="form-control form-control-transparent mb-3 mb-lg-0" readonly required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Alamat</label>
                        <textarea type="text" name="address" id="address" readonly class=" form-control form-control-transparent mb-3 mb-lg-0"></textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Nomor Telepon</label>
                        <input type="text" id="phone" name="phone"
                            class="form-control form-control-transparent mb-3 mb-lg-0" readonly required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Email</label>
                        <input type="text" id="email" name="email"
                            class="form-control form-control-transparent mb-3 mb-lg-0" readonly required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Credit Limit</label>
                        <input type="text" id="credit_limit" name="credit_limit"
                            class="form-control form-control-transparent mb-3 mb-lg-0" readonly  />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Credit Balance</label>
                        <input type="text" id="credit_balance" name="credit_balance"
                            class="form-control form-control-transparent mb-3 mb-lg-0" readonly  />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Dikirim Dari</label>
                        <textarea type="text" name="ship_from" id="ship_from" class=" form-control form-control-transparent mb-3 mb-lg-0" readonly>Cikutra, Bandung</textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Email</label>
                        <input type="email" id="email_parent" name="email_parent"
                            class="form-control form-control-transparent mb-3 mb-lg-0" value="swamedia@gmail.com" readonly required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Phone/Fax</label>
                        <input type="number" id="phone_fax" name="phone_fax"
                            class="form-control form-control-transparent mb-3 mb-lg-0" value="089321832" readonly required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required form-label fw-bold fs-6 mb-2">Jangka Waktu Pembayaran</label>
                        <select class="form-select  form-select-transparent mb-3 mb-lg-0 select-2" name="term_of_payment"
                            id="term_of_payment" readonly required>
<option>-</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">

                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Invoice Number</label>
                        <input type="text" id="invoice_number" name="invoice_number"
                            class="form-control form-control-transparent mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Sign</label>
                        <input type="text" id="sign" name="sign"
                            class="form-control form-control-transparent mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Tax Invoice</label>
                        <input type="text" id="tax_invoice" name="tax_invoice"
                            class="form-control form-control-transparent mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Att</label>
                        <input type="text" id="att" name="att"
                            class="form-control form-control-transparent mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Deskripsi</label>
                        <textarea type="text" name="description_invoice" id="description_invoice" class=" form-control form-control-transparent mb-3 mb-lg-0"></textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Tanggal Invoice</label>
                        <div class="">
                            <input type="text" id="invoice_date" name="invoice_date"
                                class="form-control form-control-transparent mb-3 mb-lg-0" required />
                        </div>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Jatuh Tempo</label>
                        <div class="">
                            <input type="text" id="due_date" name="due_date"
                                class="form-control form-control-transparent mb-3 mb-lg-0" required />
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-12">
                <hr>
                <h5 class="fw-bolder">Items</h5>
                <hr>
                <div class="col-lg-12" id="itemsAddList">

                </div>

                <hr>
                <div class="col-lg-12">
                    <div class="d-flex justify-content-end py-2">
                        <div class="row">
                            <div class="col-lg-6">Total</div>
                            <div class="col-lg-6"><input type="text" readonly name="total" id="total"
                                    class="form-control form-control-transparent text-end"></div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end py-2">
                        <div class="row">
                            <div class="col-lg-6">DPP</div>
                            <div class="col-lg-6"><input type="text" readonly name="dpp" id="dpp"
                                    class="form-control form-control-transparent text-end"></div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end py-2">
                        <div class="row">
                            <div class="col-lg-6">Vat/PPN</div>
                            <div class="col-lg-6"><input type="text" readonly name="vatppn" id="vatppn"
                                    class="form-control form-control-transparent text-end"></div>
                        </div>
                    </div>

                </div>
                <hr>
                <div class="d-flex justify-content-center" id="loadingnya">
                    <div class="px-2">
                        <button class="btn btn-sm btn-primary" type="submit" id="btn-add">Buat</button>
                    </div>
                    <div class="px-2">
                        <button class="btn btn-sm btn-secondary" type="button"
                            onclick="tutupContent()">Kembali</button>
                    </div>
                </div>

        </form>
    </div>
</div>
</div>

<script>
    $(document).ready(function() {
        $('.select-2').select2();


        flatpickr("#due_date", {
            static: true,
            dateFormat: "Y-m-d",
            allowInput:true
        });
        flatpickr("#invoice_date", {
            static: true,
            dateFormat: "Y-m-d",
            allowInput:true
        });
    });
</script>

<script>
    $('#createInvoice').submit(function(event) {
        event.preventDefault();

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Save This Data ?',
            text: "Data will be save to the database!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Save!',
            cancelButtonText: 'Not, Cancel!',
            reverseButtons: false
        }).then((result) => {
            if (result.isConfirmed) {
                $('#loadingnya').html(
                    '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span>'
                )
                $.ajax({
                    url: "{{ url('/admin/selling/invoice/store') }}",
                    type: 'post',
                    data: $('#createInvoice')
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
                        $('#searchTableInvoice').focus()
                        tableInvoice.ajax.reload()
                    },
                    error: function(response) {
                        // Handle error
                    }
                });

            } else if (

                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    '',
                    'success'
                )
            }
        })

    });


    function getDataSelling() {
        var id = $('#selling_id').val();
        $.get("{{ url('/admin/selling/invoice/getdataselling') }}/" + id, function(
            data) {
            $('#address').val(data.address)
            $('#sales_date').val(data.sales_date)
            $('#att').val(data.att)
            $('#phone').val(data.phone)
            $('#email').val(data.email)
            $('#term_of_payment').html(data.tof)
            $('#itemsAddList').html(data.html)
            countTotalQty()
        })
    }

    function getDetailItem(e) {
        var id = $(e).val()
        $.get("{{ url('/admin/selling/selling/getdetailitem') }}/" + id, function(
            data) {

            $(e).parent().parent().find('#qty_per_box').val(data.qty_per_box)
            $(e).parent().parent().find('#stock').val(data.stock)
            $(e).parent().parent().find('#vat_item').val(data.vat_item)
            $(e).parent().parent().find('#detail_box').html(data.desc)
            $('.select-2').select2();
        })
    }

    function countTotalQty(e) {
        var box = $(e).parent().parent().find('#qty_box').val();
        var qty_per_box = $(e).parent().parent().find('#qty_per_box').val();
        var qty = $(e).parent().parent().find('#qty').val();
        var price = $(e).parent().parent().find('#price').val();

        var stockInBox = $(e).parent().parent().find('#stock').val();
        var stockInQty = stockInBox * qty_per_box;

        var totalQty = (box * qty_per_box) + parseInt(qty)
        var totalPrice = parseInt(totalQty) * parseInt(price);


        $(e).parent().parent().find('#total_qty').val(totalQty);
        $(e).parent().parent().find('#total_price').val(totalPrice);

        if (stockInQty < totalQty) {
            Swal.fire(
                'Attention',
                'Not Enough Stock',
                'question'
            )
            $(e).parent().parent().find('#qty_box').val(0);
            $(e).parent().parent().find('#qty').val(0);
            $(e).parent().parent().find('#total_qty').val(0);
            $(e).parent().parent().find('#total_price').val(0);
        }
        sumAll()


    }

    function sumAll() {
        var total_price = 0;
        var vatnya = 0;
        var total = parseInt(0);
        var vatItem = parseInt(0);
        var dpp = 0;
        $('.total_price').each(function() {
            total += parseInt($(this).val());
            total_price = parseInt($(this).val());
            vatnya = parseInt($(this).parent().parent().find('#vat_item').val());
            vatItem += total_price * (vatnya / 100)
        });


        dpp = total - vatItem
        var totalVat = total - dpp;
        $('#total').val(total);
        $('#dpp').val(dpp);
        $('#vatppn').val(totalVat);
    }
</script>
