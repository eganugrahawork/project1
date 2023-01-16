<div class="card">
    <div class="card-header">
        <h4>Tambah Retur Penjualan</h4>
    </div>
    <div class="card-body">
        <form id="createReturn" class="form">
            <div class="row">
                <div class="col-lg-6">
                    @csrf
                    <div class="fv-row mb-3">
                        <input type="hidden" id="sales_id" name="sales_id">
                        <label class="required fw-bold fs-6 mb-2">Nomor Invoice</label>
                        <select class="form-select  form-select-transparent mb-3 mb-lg-0 select-2" name="invoice_id"
                            id="invoice_id" onchange="getData()" required>
                            <option>Pilih Nomor Invoice</option>
                            @foreach ($invoice as $inv)
                                <option value="{{ $inv->id_invoice }}">{{ $inv->no_selling }}-{{ $inv->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Tanggal</label>
                        <div class="">
                            <input type="text" id="sales_date" name="sales_date"
                                class="form-control form-control-transparent mb-3 mb-lg-0" readonly required />
                        </div>
                    </div>

                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Alamat</label>
                        <textarea type="text" name="address" id="address" readonly
                            class=" form-control form-control-transparent mb-3 mb-lg-0"></textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Att</label>
                        <input type="text" id="att" name="att"
                            class="form-control form-control-transparent mb-3 mb-lg-0" readonly required />
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
                            class="form-control form-control-transparent mb-3 mb-lg-0" readonly required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Credit Balance</label>
                        <input type="text" id="credit_balance" name="credit_balance"
                            class="form-control form-control-transparent mb-3 mb-lg-0" readonly required />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Dikirim Dari</label>
                        <textarea type="text" name="ship_from" id="ship_from" class="form-control form-control-transparent mb-3 mb-lg-0"
                            readonly></textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Email</label>
                        <input type="email" id="email" name="email"
                            class="form-control form-control-transparent mb-3 mb-lg-0" readonly required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Phone/Fax</label>
                        <input type="number" id="phone_fax" name="phone_fax"
                            class="form-control form-control-transparent mb-3 mb-lg-0" readonly required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Jangka Waktu Pembayaran</label>
                        <input type="text" id="term_of_payment" name="term_of_payment"
                            class="form-control form-control-transparent mb-3 mb-lg-0" value="0" readonly
                            required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Keterangan Beli</label>
                        <textarea type="text" name="description" id="description" class=" form-control form-control-transparent mb-3 mb-lg-0"
                            readonly></textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Tanggal Retur</label>
                        <div class="">
                            <input type="text" id="return_date" name="return_date"
                                class="form-control form-control-transparent mb-3 mb-lg-0" required />
                        </div>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2 required">Keterangan Return</label>
                        <textarea type="text" name="return_description" id="return_description"
                            class=" form-control form-control-transparent mb-3 mb-lg-0"></textarea>
                    </div>
                </div>

            </div>
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table gy-5 gs-7 border rounded w-100">
                        <thead>
                            <tr class="fw-bold fs-6">
                                <td>Kode</td>
                                <td>Return Box</td>
                                <td>Return Satuan</td>
                                <td>Qty Retur</td>
                                <td>Qty Order</td>
                                <td>Harga</td>
                                <td>Total</td>
                            </tr>
                        </thead>
                        <tbody id="itemsAddList">

                        </tbody>
                        <tfoot>
                            <tr>
                                <input type="hidden" id="total_price_all_return" name="total_price_all_return">
                                <td colspan="6" class="text-end fw-bold">Total Retur</td>
                                <td id="total_price_all_return_tampil" class="fw-bold text-end"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="p-2" id="loadingnya">
                    <button type="submit" class="btn btn-sm btn-primary">Tambahkan</button>
                </div>
                <div class="p-2">
                    <button type="button" onclick="tutupContent()" class="btn btn-sm btn-secondary">Kembali</button>
                </div>
            </div>

        </form>
    </div>
</div>
</div>

<script>
    $(document).ready(function() {
        $('.select-2').select2();

        flatpickr("#return_date", {
            static: true,
            dateFormat: "Y-m-d",
            allowInput: true
        });

    });
</script>

<script>
    $('#createReturn').submit(function(event) {
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
                    url: "{{ url('/admin/selling/return/store') }}",
                    type: 'post',
                    data: $('#createReturn')
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


    function getData() {
        var id = $('#invoice_id').val();
        $.get("{{ url('/admin/selling/return/getdata') }}/" + id, function(
            data) {
            $('#sales_date').val(data.sales_date)
            $('#address').val(data.address)
            $('#att').val(data.att)
            $('#phone').val(data.phone)
            $('#email').val(data.email)
            $('#sales_id').val(data.sales_id)
            $('#term_of_payment').val(data.term_of_payment)
            $('#credit_limit').val(data.credit_limit)
            $('#credit_balance').val(data.credit_balance)
            $('#itemsAddList').html(data.item)
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
        
        var total_price_all_return = 0;
        $('.total_price_return').each(function(){
            total_price_all_return += parseFloat($(this).val())
        })

        $('#total_price_all_return').val(total_price_all_return);
        total_price_all_return = parseInt(total_price_all_return).toLocaleString();
        $('#total_price_all_return_tampil').html('Rp. '+total_price_all_return);


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

  
</script>
