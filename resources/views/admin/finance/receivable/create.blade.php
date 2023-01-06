<div class="card">
    <div class="card-header">
        <h4>Pembayaran Piutang</h4>
    </div>
    <div class="card-body">
        <form id="createPayment" class="form">
            <div class="row">
                <div class="col-lg-6">
                    @csrf
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Kode</label>
                        <div class="">
                            <input type="text" id="code" name="code"
                                class="form-control form-control-transparent mb-3 mb-lg-0" value="{{ $code }}"
                                readonly required />
                        </div>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Tanggal</label>
                        <div class="">
                            <input type="text" id="payment_date" name="payment_date"
                                class="form-control form-control-transparent mb-3 mb-lg-0" required />
                        </div>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Partner</label>
                        <select class="form-select  form-select-transparent mb-3 mb-lg-0 select-2" name="partner_id"
                            id="partner_id" onchange="getData()" required>
                            <option selected disabled>Pilih Partner</option>
                            @foreach ($customer as $cust)
                                <option value="{{ $cust->id }}">{{ $cust->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Tipe Pembayran</label>
                        <select class="form-select  form-select-transparent mb-3 mb-lg-0 select-2" name="payment_type"
                            id="payment_type" required>
                            <option selected="selected" disabled>-- Pilih Pembayaran --</option>
                            <option value="0">Cash/Transfer</option>
                            <option value="1">Giro</option>
                            <option value="2">Bonus</option>
                            <option value="3">Komisi</option>
                            <option value="4">Piutang</option>
                        </select>
                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Cash Account</label>
                        <select class="form-select  form-select-transparent mb-3 mb-lg-0 select-2" name="cash_account"
                            id="cash_account" required>
                            <option selected disabled>Pilih Cash Account</option>
                            @foreach ($coa as $c)
                                <option value="{{ $c->id }}">{{ $c->coa }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Tanggal Terbit</label>
                        <div>
                            <input type="text" id="publish_date" name="publish_date"
                                class="form-control form-control-transparent mb-3 mb-lg-0" required />
                        </div>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Jatuh Tempo</label>
                        <div>
                            <input type="text" id="due_date" name="due_date"
                                class="form-control form-control-transparent mb-3 mb-lg-0" required />
                        </div>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Keterangan</label>
                        <textarea type="text" name="description" id="description"
                            class=" form-control form-control-transparent mb-3 mb-lg-0"></textarea>
                    </div>
                </div>

            </div>
            <div class="col-lg-12">
                <hr>
                <h5 class="fw-bolder">Invoice</h5>
                <hr>
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table gs-7 gy-7 gx-7">
                            <thead>
                                <tr class="fw-bolder fs-6 text-gray-800">
                                    <td>Invoice</td>
                                    <td>Nilai</td>
                                    <td>Sisa</td>
                                    <td>Terbayar</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody id="invoiceList">
                                <tr>
                                    <td><select name="invoice_id" id="invoice_id"
                                            class="form-select form-select-transparent select-2">
                                            <option value="">Pilih Nomor Invoice</option>
                                        </select></td>
                                    <td>
                                        <input type="number" name="nilai"
                                            class="form-control form-control-transparent">
                                    </td>
                                    <td>
                                        <input type="number" name="sisa"
                                            class="form-control form-control-transparent">
                                    </td>
                                    <td>
                                        <input type="number" name="terbayar"
                                            class="form-control form-control-transparent">
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" onclick="deleteRow(this)"
                                            type="button">-</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-end fw-bolder fs-6 text-gray-800">Tambah Baris</td>
                                    <td class="d-flex align-items-end "><button class="btn btn-sm btn-primary"
                                            type="button" onclick="addnewrow()">+</button></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-center" id="loadingnya">
                    <div class="px-2">
                        <button class="btn btn-sm btn-primary" type="submit" id="btn-add">Buat</button>
                    </div>
                    <div class="px-2">
                        <button class="btn btn-sm btn-secondary" type="button"
                            onclick="backHistory()">Kembali</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>

<script>
    $(document).ready(function() {
        $('.select-2').select2();

        flatpickr("#payment_date", {
            static: true,
            dateFormat: "Y-m-d",
            allowInput: true
        });
        flatpickr("#publish_date", {
            static: true,
            dateFormat: "Y-m-d",
            allowInput: true
        });
        flatpickr("#due_date", {
            static: true,
            dateFormat: "Y-m-d",
            allowInput: true
        });

    });
</script>

<script>
    $('#createPayment').submit(function(event) {
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
                    url: "{{ url('/admin/selling/selling/store') }}",
                    type: 'post',
                    data: $('#createPayment')
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
                        $('#searchtableSelling').focus()
                        tableSelling.ajax.reload()
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


    function getData() {
        var id = $('#partner_id').val();
        $.get("{{ url('/admin/finance/receivable/getdata') }}/" + id, function(
            data) {

            $('#invoiceList').html(data.item)
            $('.select-2').select2();
        })
    }

    function countTotalQty(e) {
        var box = $(e).parent().parent().find('#return_box').val();
        var qty_per_box = $(e).parent().parent().find('#qty_per_box').val();
        var qtyReturn = $(e).parent().parent().find('#return_qty').val();
        var price = $(e).parent().parent().find('#price').val();
        var jumlahOrder = $(e).parent().parent().find('#qty_order').val();

        var totalQtyReturn = (box * qty_per_box) + parseInt(qtyReturn)
        var totalPriceReturn = parseInt(totalQtyReturn) * parseInt(price);


        $(e).parent().parent().find('#total_return_qty').val(totalQtyReturn);
        $(e).parent().parent().find('#total_price_return').val(totalPriceReturn);

        if (jumlahOrder < totalQtyReturn) {
            Swal.fire(
                'Peringatan',
                'Melebihi Jumlah Order',
                'question'
            )
            $(e).parent().parent().find('#return_box').val(0);
            $(e).parent().parent().find('#return_qty').val(0);
            $(e).parent().parent().find('#total_return_qty').val(0);
            $(e).parent().parent().find('#total_price_return').val(0);
        }
    }

    function addnewrow() {
        $.ajax({
            url: "{{ url('/admin/finance/receivable/addnewrow') }}",
            type: 'post',
            data: $('#createPayment')
                .serialize(), // Remember that you need to have your csrf token included
            dataType: 'json',
            success: function(response) {
                $('#invoiceList').append(response.data)
                $('.select-2').select2()
            },
            error: function(response) {
                // Handle error
            }
        });
    }

    function deleteRow(e) {
        $(e).parent().parent().remove()
    }

</script>
