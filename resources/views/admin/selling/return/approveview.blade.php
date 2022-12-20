<div class="card">
    <div class="card-header">
        <h4>Konfirmasi Penjualan</h4>
    </div>
    <div class="card-body">
        <form id="updateReturn" class="form">
            <div class="row">
                <div class="col-lg-6">
                    @csrf
                    <div class="fv-row mb-3">
                        <input type="hidden" name="return_id" id="return_id" value="{{ $data[0]->id_return }}">
                        <input type="hidden" name="invoice_id" id="invoice_id">
                        <label class="required fw-bold fs-6 mb-2">Nomor Penjualan</label>
                        <select class="form-select  form-select-solid mb-3 mb-lg-0 select-2"
                            id="sales_id" required>
                            <option>{{ $data[0]->no_selling }}-{{ $data[0]->name }}</option>
                        </select>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Tanggal</label>
                        <div class="">
                            <input type="text" id="sales_date" name="sales_date"
                                class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $data[0]->sales_date }}" readonly required />
                        </div>
                    </div>

                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Alamat</label>
                        <textarea type="text" name="address" id="address" readonly class=" form-control form-control-solid mb-3 mb-lg-0">{{ $data[0]->address }}</textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Att</label>
                        <input type="text" id="att" name="att"
                            class="form-control form-control-solid mb-3 mb-lg-0" value="-" readonly required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Nomor Telepon</label>
                        <input type="text" id="phone" name="phone"
                            class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $data[0]->phone }}" readonly required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Email</label>
                        <input type="text" id="email" name="email"
                            class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $data[0]->email }}" readonly required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Credit Limit</label>
                        <input type="text" id="credit_limit" name="credit_limit"
                            class="form-control form-control-solid mb-3 mb-lg-0" readonly required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Credit Balance</label>
                        <input type="text" id="credit_balance" name="credit_balance"
                            class="form-control form-control-solid mb-3 mb-lg-0" readonly required />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Dikirim Dari</label>
                        <textarea type="text" name="ship_from" id="ship_from" class="form-control form-control-solid mb-3 mb-lg-0" readonly></textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Email</label>
                        <input type="email" id="email" name="email"
                            class="form-control form-control-solid mb-3 mb-lg-0" readonly required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Phone/Fax</label>
                        <input type="number" id="phone_fax" name="phone_fax"
                            class="form-control form-control-solid mb-3 mb-lg-0" readonly required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Jangka Waktu Pembayaran</label>
                        <input type="text" id="term_of_payment" name="term_of_payment"
                            class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $data[0]->term_of_payment }}" readonly required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Keterangan Beli</label>
                        <textarea type="text" name="description" id="description" class=" form-control form-control-solid mb-3 mb-lg-0"
                            readonly>{{ $data[0]->keterangan_beli }}</textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Tanggal Retur</label>
                        <div class="">
                            <input type="text" id="return_date" name="return_date"
                                class="form-control form-control-solid mb-3 mb-lg-0" readonly value="{{ $data[0]->retur_date }}" required />
                        </div>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2 required">Keterangan Return</label>
                        <textarea type="text" name="return_description" id="return_description" readonly
                            class=" form-control form-control-solid mb-3 mb-lg-0">{{ $data[0]->notes }}</textarea>
                    </div>
                </div>

            </div>
            <div class="col-lg-12">
                <hr>
                <h5 class="fw-bolder">Items</h5>
                <hr>
                <div class="col-lg-12" id="itemsAddList">
                    @foreach ($data as $d)
                    <div class='row'>
                        <div class='fv-row mb-3 col-lg-3'>
                            <label class='form-label fs-8 fw-bold'>Item</label>
                            <input type='hidden' name='selling_return_detail_id[]' value='{{ $d->selling_return_detail_id }}' />
                            <input type='hidden' name='item_id[]' value='{{ $d->item_id }}' />
                            <input type='text'  class='form-control form-control-solid mb-3 mb-lg-0 countaja' value='{{ $d->item_name }}' readonly/>
                        </div>
                        <div class='fv-row mb-3 col-lg-1'>
                            <label class='required fw-bold fs-8 mb-2'>R Box</label>
                            <input type='number' name='return_box[]' id='return_box'
                                class='form-control form-control-solid mb-3 mb-lg-0' value='0' readonly onkeyup='countTotalQty(this)' required />
                            <p class='fs-9 fw-bolder' id='detail_box'>@ {{ $d->unit_box }}/box</p>
                            <input type='hidden' id='qty_per_box' value='{{ $d->unit_box }}' />
                        </div>
                        <div class='fv-row mb-3 col-lg-1'>
                            <label class='required fw-bold fs-8 mb-2'>R Satuan</label>
                            <input type='number' name='return_qty[]' id='return_qty'
                                class='form-control form-control-solid mb-3 mb-lg-0' value='{{ $d->qty_return }}' readonly onkeyup='countTotalQty(this)'
                                required />
                        </div>
                        <div class='fv-row mb-3 col-lg-1'>
                            <label class=' fw-bold fs-8 mb-2'>Qty Return</label>
                            <input type='number' name='total_return_qty[]' id='total_return_qty' readonly
                                class='form-control form-control-solid mb-3 mb-lg-0' value='{{ $d->qty_return }}' required />
                        </div>
                        <div class='fv-row mb-3 col-lg-1'>
                            <label class=' fw-bold fs-8 mb-2'>Qty Order</label>
                            <input type='number' name='qty_order[]' value='{{ $d->qty_order }}' id='qty_order'
                                class='form-control form-control-solid mb-3 mb-lg-0'
                                readonly required />
                        </div>
                        <div class='fv-row mb-3 col-lg-2'>
                            <label class=' fw-bold fs-8 mb-2'>Harga</label>
                            <input type='number' name='price[]' value='{{ $d->unit_price }}' id='price'
                                class='form-control form-control-solid mb-3 mb-lg-0' readonly required />
                        </div>
                        <div class='fv-row mb-3 col-lg-2'>
                            <label class=' fw-bold fs-8 mb-2'>Total</label>
                            <input type='number' name='total_price_return[]' id='total_price_return'
                                class='form-control form-control-solid mb-3 mb-lg-0' value='0' readonly required />

                        </div>
                    </div>
                    @endforeach
                </div>

                <hr>

                <div class="d-flex justify-content-center" id="loadingnya">
                    <div class="px-2">
                        <a class="btn btn-sm btn-primary" id="approve-btn" href="/admin/selling/return/approve/{{ $data[0]->id_return }}">Setujui</a>
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
    $('.countaja').each(function(){
        countTotalQty(this);
    })

    $(document).on('click', '#approve-btn', function(e) {
            e.preventDefault();
            const href = $(this).attr('href');

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Setujui data ini ?',
                text: "Pastikan sudah melihat data dengan teliti!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Setujui!',
                cancelButtonText: 'Tidak, Batalkan!',
                reverseButtons: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#loadingnya').html(
                        '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>'
                    )
                    $.ajax({
                        type: "GET",
                        url: href,
                        success: function(response) {
                            Swal.fire(
                                'Success',
                                response.success,
                                'success'
                            )
                            tableRetur.ajax.reload(null, false);

                        }
                    })

                } else if (

                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Batal',
                        'Data anda masih aman :)',
                        'success'
                    )
                }
            })
        });

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
</script>
