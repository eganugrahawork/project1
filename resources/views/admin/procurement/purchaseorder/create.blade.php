<div class="card">
    <div class="card-header">
        <h4>Buat Purchase Order</h4>
    </div>
    <div class="card-body">
        <form id="add-form" class="form">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Nomor Purchase Order</label>
                        <input type="text" id="code" name="code" value="{{ $code }}" readonly
                            class="form-control form-control-transparent mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required form-label fw-bold fs-6 mb-2">Partner</label>
                        <select class="form-select  form-select-transparent mb-3 mb-lg-0 select-2" id="partner_id"
                            name="partner_id" required>
                            <option>Pilih Partner</option>
                            @foreach ($partner as $besti)
                                <option value="{{ $besti->id }}">{{ $besti->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Alamat</label>
                        <textarea type="text" name="address" id="address" readonly class="form-control form-control-transparent mb-3 mb-lg-0"></textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Nomor Telepon</label>
                        <input type="text" name="phone" id="phone" readonly
                            class="form-control form-control-transparent mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Fax</label>
                        <input type="text" name="fax" id="fax" readonly
                            class="form-control form-control-transparent mb-3 mb-lg-0" required />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Vat/PPN</label>
                        <input type="number" name="ppn" id="ppn" onkeyup='sumAll()' value="11"
                            class="form-control form-control-transparent mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required form-label fw-bold fs-6 mb-2">Mata Uang</label>
                        <select class="form-select  form-select-transparent mb-3 mb-lg-0 select-2" onchange="getRate(this.value)"
                            name="currency_id" id="currency_id" required>
                            <option>Pilih Mata Uang</option>
                            @foreach ($currency as $currency)
                                <option value="{{ $currency->id }}" {{ $currency->id == 3 ? 'selected' : '' }}>
                                    {{ $currency->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Rate</label>
                        <input type="number" name="rate" id="rate" value="1" readonly
                            class="form-control form-control-transparent mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required form-label fw-bold fs-6 mb-2">Jangka Waktu Pembayaran</label>
                        <select class="form-select  form-select-transparent mb-3 mb-lg-0 select-2" name="term_of_payment"
                            id="term_of_payment" required>
                            <option value="Cash">Cash</option>
                            <option value="15">15 Hari</option>
                            <option value="30">30 Hari</option>
                            <option value="45">45 Hari</option>
                            <option value="60">60 Hari</option>
                            <option value="90">90 Hari</option>
                            <option value="other">Lainnya</option>
                        </select>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Deskripsi</label>
                        <textarea type="text" name="description" id="description" class="form-control form-control-transparent mb-3 mb-lg-0"
                            required></textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <div class="">
                            <label class="fw-bold fs-6 mb-2">Tanggal Order</label>
                        </div>
                        <input type="text" name="order_date" id="order_date"
                            class="form-control form-control-transparent mb-3 mb-lg-0" required />
                    </div>
                </div>
                <div class="col-lg-12"id="itemsAddList">
                    <h5 class="fw-bolder">Items</h5>
                    <hr class="border border-dark border-2 opacity-50">
                    <div class="row">
                        <div class="fv-row mb-3 col-lg-4">
                            <label class="required form-label fw-bold fs-6 mb-2">Item </label>
                            <div class="row">
                                <div class="col-lg-10">
                                    <select class="form-select  form-select-transparent mb-3 mb-lg-0 item_id select-2"
                                        id="item_id" name="item_id[]" onchange="getBaseQty(this)" required>
                                        <option>Pilih Partner Dahulu</option>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <button onclick="getallitem(this)" type="button"
                                        class="btn btn-sm btn-primary">All</button>
                                </div>
                            </div>
                        </div>

                        <div class="fv-row mb-3 col-lg-1">
                            <label class="required fw-bold fs-6 mb-2">Qty Pcs</label>
                            <input type="number" name="qty[]" id="qty" value="0"
                                onkeyup="hitungByQty(this)" class="form-control form-control-transparent mb-3 mb-lg-0 qty"
                                required />
                        </div>
                        <div class="fv-row mb-3 col-lg-1" id="discount_parent">
                            <label class="required fw-bold fs-6 mb-2">Diskon</label>
                            <input type="number" name="discount[]" id="discount" value="0"
                                onkeyup="hitungByDiscount(this)"
                                class="form-control form-control-transparent mb-3 mb-lg-0 discount" required />
                        </div>
                        <div class="fv-row mb-3 col-lg-2">
                            <label class="required fw-bold fs-6 mb-2">Total</label>
                            <input type="number" name="total[]" id="total" readonly
                                class="form-control form-control-transparent mb-3 mb-lg-0 totalnya" required />
                            <input type="hidden" name="getdiscountperitem[]" value="0" id="getdiscountperitem"
                                readonly class="form-control form-control-transparent mb-3 mb-lg-0 getdiscountperitem"
                                required />
                        </div>
                        <div class="fv-row mb-3 col-lg-1">

                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end py-2">
                    <button class="btn btn-sm btn-primary" type="button" onclick="addNewItemRow()">+</button>
                </div>
            </div>
            <hr class="border border-dark border-2 opacity-50">
            <div class="d-flex justify-content-end py-2">
                <div class="row">
                    <div class="col-lg-6">Subtotal</div>
                    <div class="col-lg-6"><input type="text" readonly name="subtotal" id="subtotal"
                            class="form-control form-control-transparent text-end"></div>
                </div>
            </div>
            <div class="d-flex justify-content-end py-2">
                <div class="row">
                    <div class="col-lg-6">Diskon</div>
                    <div class="col-lg-6"><input type="text" readonly name="totaldiscount" id="totaldiscount"
                            class="form-control form-control-transparent text-end"></div>
                </div>
            </div>
            <div class="d-flex justify-content-end py-2">
                <div class="row">
                    <div class="col-lg-6">Taxable</div>
                    <div class="col-lg-6"><input type="text" readonly name="taxable" id="taxable"
                            class="form-control form-control-transparent text-end"></div>
                </div>
            </div>
            <div class="d-flex justify-content-end py-2">
                <div class="row">
                    <div class="col-lg-6">Vat/PPn</div>
                    <div class="col-lg-6"><input type="text" readonly name="totalppn" id="totalppn"
                            class="form-control form-control-transparent text-end"></div>
                </div>
            </div>
            <hr class="border border-dark border-2 opacity-50">
            <div class="d-flex justify-content-end py-2">
                <div class="row">
                    <div class="col-lg-6">Grand Total</div>
                    <div class="col-lg-6"><input type="text" readonly name="grandtotal" id="grandtotal"
                            class="form-control form-control-transparent text-end"></div>
                </div>
            </div>
            <hr class="border border-dark border-2 opacity-50">

            <div class="d-flex justify-content-center" id="loadingnya">
                <div class="px-2">
                    <button class="btn btn-sm btn-primary" type="submit" id="btn-add">Buat</button>
                </div>
                <div class="px-2">
                    <button class="btn btn-sm btn-secondary" type="button" onclick="tutupContent()">Batal</button>
                </div>

            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.select-2').select2();

        flatpickr("#order_date", {
            static: true,
            enableTime: true,
            dateFormat: "Y-m-d H:i:s",
            minuteIncrement: 1,
            time_24hr: true,
            allowInput:true
        });

    });
</script>


<script>
    $('#partner_id').on('change', function() {
        $('#item_id').html("<option>Loading....</option>")

        $.get("{{ url('/admin/procurement/purchase-order/getitem') }}/" + $('#partner_id').val(), {}, function(
            data) {
            $('#item_id').html(data.html)
            $('#address').val(data.address)
            $('#phone').val(data.phone)
            $('#fax').val(data.fax)
            $('#base_qty_parent').remove()
            $('#price_parent').remove()
        })
    })

    function getallitem(e) {
        $.get("{{ url('/admin/procurement/purchase-order/getallitem') }}", {}, function(data) {
            $(e).parent().parent().find('#item_id').html(data.html);
            $(e).parent().html(
                "<button onclick='backitem(this)' type='button' id='getbackitem' class='btn btn-sm btn-success'>Back</button>"
            );
        })
    }

    function backitem(e) {
        var partnerId = $('#partner_id').val();
        var check = $.isNumeric(partnerId);
        if (check) {
            $.get("{{ url('/admin/procurement/purchase-order/getitem') }}/" + partnerId, {}, function(data) {
                $(e).parent().parent().find('#item_id').html(data.html);
                $(e).parent().html(
                    "<button onclick='getallitem(this)' type='button' class='btn btn-sm btn-primary'>All</button>"
                );
            })
        } else {
            $(e).parent().parent().find('#item_id').html("<option>Choose Partner First</option>");
            $(e).parent().html(
                "<button onclick='getallitem(this)' type='button' class='btn btn-sm btn-primary'>All</button>");
        }
    }

    function getBaseQty(e) {
        $.get("{{ url('/admin/procurement/purchase-order/getbaseqty') }}/" + e.value, {}, function(data) {
            $(e).parent().parent().parent().parent().find('#price_parent').remove();
            $(e).parent().parent().parent().parent().find('#base_qty_parent').remove();
            $(e).parent().parent().parent().after(
                "<div class='fv-row mb-3 col-lg-1' id='base_qty_parent'><label class='fw-bold fs-6 mb-2'>Base Qty</label><input type='number' name='base_qty' id='base_qyu' class='form-control form-control-transparent mb-3 mb-lg-0' value='" +
                data.base_qty + "' readonly/></div>")
            $(e).parent().parent().parent().parent().find('#discount_parent').after(data.pricing)
        })
    }

    function getRate(e) {
        $.get("{{ url('/admin/procurement/purchase-order/getcurrency') }}/" + e, {}, function(data) {
            $('#rate').val(data.rate)
        })
    }

    function addNewItemRow() {
        $.get("{{ url('/admin/procurement/purchase-order/addnewitemrow') }}/" + $('#partner_id').val(), {}, function(
            data) {
            $('#itemsAddList').append(data.html)
            $('.select-2').select2();
        })
    }

    function removeItemRow(e) {
        $(e).parent().parent().remove()
        sumAll()
    }

    function hitungByDiscount(e) {
        let qty = $(e).parent().parent().find('#qty').val();
        let discount = e.value;
        let price = $(e).parent().parent().find('#price').val();
        if (typeof price == "undefined") {
            price = 0;
        }
        let total = (parseFloat(qty) * parseFloat(price)) - ((parseFloat(qty) * parseFloat(price)) * (parseFloat(
            discount) / 100));
        $(e).parent().parent().find('#total').val(total);
        let getdiscountperitem = ((parseFloat(qty) * parseFloat(price)) * (parseFloat(discount) / 100));
        $(e).parent().parent().find('#total').val(total);
        $(e).parent().parent().find('#getdiscountperitem').val(getdiscountperitem);
        sumAll()
    }

    function hitungByQty(e) {
        let qty = e.value;
        let discount = $(e).parent().parent().find('#discount').val();
        let price = $(e).parent().parent().find('#price').val();
        if (typeof price == "undefined") {
            price = 0;
        }
        let getdiscountperitem = ((parseFloat(qty) * parseFloat(price)) * (parseFloat(discount) / 100));
        let total = (parseFloat(qty) * parseFloat(price)) - ((parseFloat(qty) * parseFloat(price)) * (parseFloat(
            discount) / 100));
        $(e).parent().parent().find('#total').val(total);
        $(e).parent().parent().find('#getdiscountperitem').val(getdiscountperitem);
        sumAll()
    }

    function hitungByPrice(e) {
        // if(e.value.length >0){
        //     $(e).closest('#notifprice').hide()
        // }
        let qty = $(e).parent().parent().find('#qty').val();
        let discount = $(e).parent().parent().find('#discount').val();
        let price = e.value;
        if (typeof price == "undefined") {
            price = 0;
        }
        let getdiscountperitem = ((parseFloat(qty) * parseFloat(price)) * (parseFloat(discount) / 100));
        let total = (parseFloat(qty) * parseFloat(price)) - ((parseFloat(qty) * parseFloat(price)) * (parseFloat(
            discount) / 100));
        $(e).parent().parent().find('#total').val(total);
        $(e).parent().parent().find('#getdiscountperitem').val(getdiscountperitem);

        sumAll()

    }

    function sumAll() {
        let taxable = 0;
        let totalppn = 0;
        let totaldiscount = 0;
        let subtotal = 0;
        let grandtotal = 0;
        if ($('.totalnya').length > 1) {
            $('.totalnya').each(function() {
                taxable += parseFloat($(this).val());
            });
        } else {
            taxable = $('.totalnya').val()
        }

        if ($('.getdiscountperitem').length > 1) {
            $('.getdiscountperitem').each(function() {
                totaldiscount += parseFloat($(this).val());
            });
        } else {
            totaldiscount = $('.getdiscountperitem').val()
        }

        subtotal = parseFloat(taxable) + parseFloat(totaldiscount);

        $('#subtotal').val(subtotal);

        totalppn = parseFloat($('#ppn').val() * taxable / 100);

        grandtotal = parseFloat(taxable) + parseFloat(totalppn);

        $('#grandtotal').val(grandtotal);

        $('#totalppn').val(totalppn);
        $('#totaldiscount').val(totaldiscount);
        $('#taxable').val(taxable);
    }

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
            title: 'Buat Data PO?',
            text: "Pastikan data terisi dengan benar !",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya!',
            cancelButtonText: 'Batal!',
            reverseButtons: false
        }).then((result) => {
            if (result.isConfirmed) {
                $('#loadingnya').html(
            '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span>')
                $.ajax({
                    url: "{{ url('/admin/procurement/purchase-order/store') }}",
                    type: 'POST',
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
                        $('#searchTablePo').focus()
                        tablePo.ajax.reload()
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
