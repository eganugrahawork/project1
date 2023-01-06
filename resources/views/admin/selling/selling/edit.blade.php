<div class="card">
    <div class="card-header">
        <h4>Create Sales</h4>
    </div>
    <div class="card-body">
        <form id="update-form" class="form">
            <div class="row">
                <div class="col-lg-6">
                    @csrf
                    <div class="fv-row mb-3">
                        <input type="hidden" name="selling_id" value="{{ $data[0]->id_penjualan }}">
                        <label class="fw-bold fs-6 mb-2">Nomor Penjualan</label>
                        <input type="text" id="sales_number" name="sales_number"
                            class="form-control form-control-transparent mb-3 mb-lg-0" value="{{ $data[0]->no_selling }}"
                            readonly required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Tanggal Penjualan</label>
                        <div class="">
                            <input type="text" id="sales_date" name="sales_date"
                                class="form-control form-control-transparent mb-3 mb-lg-0"
                                value="{{ $data[0]->date_selling }}" required />
                        </div>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Pelanggan</label>
                        <select class="form-select  form-select-transparent mb-3 mb-lg-0 select-2" name="partner_id"
                            id="partner_id" onchange="getDataCustomer()" required>
                            @foreach ($customer as $cust)
                                <option value="{{ $cust->id }}"
                                    {{ $cust->id == $data[0]->cust_id ? 'selected' : '' }}>
                                    {{ $cust->code }}-{{ $cust->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Alamat</label>
                        <textarea type="text" name="address" id="address" readonly class=" form-control form-control-transparent mb-3 mb-lg-0">{{ $data[0]->address }}</textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Att</label>
                        <input type="text" id="att" name="att"
                            class="form-control form-control-transparent mb-3 mb-lg-0" value="-" readonly required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Nomor Telepon</label>
                        <input type="text" id="phone" name="phone"
                            class="form-control form-control-transparent mb-3 mb-lg-0" value="{{ $data[0]->phone }}" readonly
                            required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Email</label>
                        <input type="text" id="email" name="email"
                            class="form-control form-control-transparent mb-3 mb-lg-0" value="{{ $data[0]->email }}" readonly
                            required />
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
                        <textarea type="text" name="ship_from" id="ship_from" class=" form-control form-control-transparent mb-3 mb-lg-0">{{ $data[0]->ship_address }}</textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Email</label>
                        <input type="email" id="email" name="email"
                            class="form-control form-control-transparent mb-3 mb-lg-0" {{ $data[0]->email }} required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Phone/Fax</label>
                        <input type="number" id="phone_fax" name="phone_fax"
                            class="form-control form-control-transparent mb-3 mb-lg-0" {{ $data[0]->fax }} required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required form-label fw-bold fs-6 mb-2">Jangka Waktu Pembayaran</label>
                        <select class="form-select  form-select-transparent mb-3 mb-lg-0 select-2" name="term_of_payment"
                            id="term_of_payment" required>
                            <option value="Cash" {{ $data[0]->term_of_payment === 'Cash' ? 'selected' : '' }}>Cash
                            </option>
                            <option value="15" {{ $data[0]->term_of_payment === '15' ? 'selected' : '' }}>15 Hari
                            </option>
                            <option value="30" {{ $data[0]->term_of_payment === '30' ? 'selected' : '' }}>30 Hari
                            </option>
                            <option value="45" {{ $data[0]->term_of_payment === '45' ? 'selected' : '' }}>45 Hari
                            </option>
                            <option value="60" {{ $data[0]->term_of_payment === '60' ? 'selected' : '' }}>60 Hari
                            </option>
                            <option value="90" {{ $data[0]->term_of_payment === '90' ? 'selected' : '' }}>90 Hari
                            </option>
                            <option value="other" {{ $data[0]->term_of_payment === 'other' ? 'selected' : '' }}>
                                Lainnya</option>
                        </select>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Jangka Waktu Pembayaran Lain</label>
                        <input type="number" id="another_term_of_payment" name="another_term_of_payment"
                            class="form-control form-control-transparent mb-3 mb-lg-0" value="0" readonly required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Deskripsi</label>
                        <textarea type="text" name="description" id="description" class=" form-control form-control-transparent mb-3 mb-lg-0">{{ $data[0]->description }}</textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Tanggal Pengiriman</label>
                        <div class="">
                            <input type="text" id="delivery_date" name="delivery_date"
                                value="{{ $data[0]->delivery_date }}"
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
                    <div class='row'>
                        @foreach ($data as $d)
                            <div class='fv-row mb-3 col-lg-3'>
                                <input type="hidden" name="selling_detail_id[]" value="{{ $d->selling_detail_id }}">
                                <input type="hidden" name="mutation_id[]" value="{{ $d->mutation_id }}">
                                <label class=' form-label fs-6 fw-bold'>Item</label>
                                <select class='form-select  form-select-transparent mb-3 mb-lg-0 select-2'
                                    onchange='getDetailItem(this)' id='item_id' name='item_id[]' required>
                                    @foreach ($item as $itm)
                                        <option value="{{ $itm->id }}" {{ $d->item_id ===$itm->id ? 'selected' : ''; }}>
                                            {{ $itm->item_code }}-{{ $itm->item_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class='fv-row mb-3 col-lg-1'>
                                <label class=' fw-bold fs-6 mb-2'>Q Box</label>
                                <input type='number' name='qty_box[]' id='qty_box'
                                    class='form-control form-control-transparent mb-3 mb-lg-0' value='{{ $d->qty_box }}'
                                    onkeyup='countTotalQty(this)' required />
                                <p class='fs-9 fw-bolder' id='detail_box'>1 Box : {{ $d->qty_per_box }} Stock : {{ $d->stock }} Box</p>
                                {{-- BELUM DITAMBAH DISP KARENA BELUM MAU DIJALANKAN --}}
                                <input type='hidden' name='qty_per_box[]' id='qty_per_box' value="{{ $d->qty_per_box }}">
                                <input type='hidden' name='stock[]' id='stock' value="{{ $d->stock }}">
                                <input type='hidden' name='vat_item[]' id='vat_item' value="{{ $d->vat }}">
                            </div>
                            <div class='fv-row mb-3 col-lg-1'>
                                <label class=' fw-bold fs-6 mb-2'>Qty</label>
                                <input type='number' name='qty[]' id='qty' value="{{ $d->qty_satuan }}"
                                    class='form-control form-control-transparent mb-3 mb-lg-0'
                                    onkeyup='countTotalQty(this)' required />
                            </div>
                            <div class='fv-row mb-3 col-lg-2'>
                                <label class='required fw-bold fs-6 mb-2'>Total Qty</label>
                                <input type='number' name='total_qty[]' id='total_qty' readonly
                                    class='form-control form-control-transparent mb-3 mb-lg-0 ' value="{{ $d->qty }}" required />
                            </div>
                            <div class='fv-row mb-3 col-lg-2'>
                                <label class=' fw-bold fs-6 mb-2'>Harga</label>
                                <input type='number' name='price[]' id='price'
                                    class='form-control form-control-transparent mb-3 mb-lg-0' onkeyup='countTotalQty(this)'
                                    value='{{ $d->unit_price }}' required />
                            </div>
                            <div class='fv-row mb-3 col-lg-2'>
                                <label class=' fw-bold fs-6 mb-2'>Total</label>
                                <input type='number' name='total_price[]' id='total_price'
                                    class='form-control form-control-transparent mb-3 mb-lg-0 total_price' value="{{ $d->price }}" readonly
                                    required />
                            </div>

                        @endforeach
                    </div>
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

        flatpickr("#sales_date", {
            static: true,
            dateFormat: "Y-m-d",
            allowInput:true
        });
        flatpickr("#delivery_date", {
            static: true,
            dateFormat: "Y-m-d",
            allowInput:true
        });
    });
</script>

<script>
    sumAll()
    $('#update-form').submit(function(event) {
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
                    url: "{{ url('/admin/selling/selling/update') }}",
                    type: 'post',
                    data: $('#update-form')
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
                        // tableInvoice.ajax.reload()
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


    function getDataCustomer() {
        var id = $('#partner_id').val();
        $.get("{{ url('/admin/selling/selling/getdatacustomer') }}/" + id, function(
            data) {
            $('#address').val(data.address)
            $('#att').val(data.att)
            $('#phone').val(data.phone)
            $('#email').val(data.email)
            $('#credit_limit').val(data.credit_limit)
            $('#credit_balance').val(data.credit_balance)
            $('.select-2').select2();
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
