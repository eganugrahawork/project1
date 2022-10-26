
<div class="row">
    <div class="col-lg-6">
        <div class="fv-row mb-7">
            <label class="fw-bold fs-6 mb-2">Number Po</label>
            <input type="text" id="code" name="code" value="{{ $info[0]->number_po }}" readonly class="form-control form-control-white mb-3 mb-lg-0"  required/>
        </div>
        <div class="fv-row mb-7">
            <label class="fw-bold fs-6 mb-2">Order Date</label>
            <input type="datetime-local" name="order_date" id="order_date" readonly value="{{ $info[0]->order_date }}" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required form-label fw-bold">Partners</label>
                <select class="form-select  form-select-solid mb-3 mb-lg-0 select-2" disabled id="partner_id" name="partner_id" required>
                    <option >{{ $info[0]->partner_name }}</option>

                </select>
        </div>
        <div class="fv-row mb-7">
            <label class="fw-bold fs-6 mb-2">Address</label>
            <textarea type="text" name="address" id="address" readonly class="form-control form-control-solid mb-3 mb-lg-0"  >{{ $info[0]->address }}</textarea>
        </div>
        <div class="fv-row mb-7">
            <label class="fw-bold fs-6 mb-2">Phone Number</label>
            <input type="text" name="phone" id="phone" value="{{ $info[0]->phone }}" readonly class="form-control form-control-solid mb-3 mb-lg-0"  required/>
        </div>
        <div class="fv-row mb-7">
            <label class="fw-bold fs-6 mb-2">Fax</label>
            <input type="text" name="fax" id="fax" value="{{ $info[0]->fax }}"  readonly class="form-control form-control-solid mb-3 mb-lg-0"  required/>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Vat/PPN</label>
            <input type="number" name="ppn" id="ppn"  value="{{ $info[0]->ppn }}" class="form-control form-control-solid mb-3 mb-lg-0" disabled required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required form-label fw-bold">Currency</label>
                <select class="form-select  form-select-solid mb-3 mb-lg-0" disabled name="currency_id" id="currency_id" required>
                    <option>{{ $info[0]->currency_name }}</option>
                </select>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Rate</label>
            <input type="number" name="rate" id="rate"  value="{{ $info[0]->rate }}" disabled readonly class="form-control form-control-solid mb-3 mb-lg-0"  required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required form-label fw-bold">Term of Payment</label>
                <select class="form-select  form-select-solid mb-3 mb-lg-0 select-2" readonly name="term_of_payment" id="term_of_payment" required>
                    <option value="{{ $info[0]->term_of_payment }}">{{ $info[0]->term_of_payment }}</option>
                </select>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Description</label>
            <textarea type="text" name="description" id="description" class="form-control form-control-solid mb-3 mb-lg-0" readonly required>{{ $info[0]->description }}</textarea>
        </div>
    </div>
    <div class="col-lg-12"id="itemsAddList">
        <h1>Items</h1>
        <hr>
        @foreach ($info as $item)
        <div class="row" >
            <div class="fv-row mb-7 col-lg-3">
                <label class="required form-label fw-bold">Item</label>
                <select class="form-select  form-select-solid mb-3 mb-lg-0 item_id select-2" id="item_id" disabled name="item_id[]"  required>
                        <option>{{ $item->item_name }}</option>
                </select>
            </div>
            <div class="fv-row mb-7 col-lg-2">
                <label class="required fw-bold fs-6 mb-2">Price</label>
                <input type="text" name="price[]" id="price" value="{{ $item->unit_price }}" disabled class="form-control form-control-solid mb-3 mb-lg-0 qty"  required/>
            </div>
            <div class="fv-row mb-7 col-lg-2">
                <label class="required fw-bold fs-6 mb-2">Qty</label>
                <input type="text" name="qty[]" id="qty" value="{{ $item->qty }}" disabled class="form-control form-control-solid mb-3 mb-lg-0 qty"  required/>
            </div>
            <div class="fv-row mb-7 col-lg-2">
                <label class="required fw-bold fs-6 mb-2">Diskon</label>
                <input type="text" name="discount[]" id="discount" value="{{ $item->discount }}" disabled class="form-control form-control-solid mb-3 mb-lg-0 discount"  required/>
            </div>
            <div class="fv-row mb-7 col-lg-3">
                <label class="required fw-bold fs-6 mb-2">Total</label>
                <input type="text" name="total[]" id="total" value="{{ $item->total_price }}" readonly class="form-control form-control-solid mb-3 mb-lg-0 totalnya"  required/>
                <input type="hidden" name="getdiscountperitem[]" id="getdiscountperitem" value="{{ $item->total_discount }}" class="form-control form-control-solid mb-3 mb-lg-0 getdiscountperitem"  required/>
            </div>
        </div>
        @endforeach
    </div>

</div>
<hr>
<div class="d-flex justify-content-end py-2">
    <div class="row">
        <div class="col-lg-6">Subtotal</div>
        <div class="col-lg-6"><input type="text" readonly name="subtotal" id="subtotal" class="form-control form-control-white"></div>
    </div>
</div>
<div class="d-flex justify-content-end py-2">
    <div class="row">
        <div class="col-lg-6">Discount</div>
        <div class="col-lg-6"><input type="text" readonly name="totaldiscount" id="totaldiscount" class="form-control form-control-white"></div>
    </div>
</div>
<div class="d-flex justify-content-end py-2">
    <div class="row">
        <div class="col-lg-6">Taxable</div>
        <div class="col-lg-6"><input type="text" readonly name="taxable" id="taxable" class="form-control form-control-white"></div>
    </div>
</div>
<div class="d-flex justify-content-end py-2">
    <div class="row">
        <div class="col-lg-6">Vat/PPn</div>
        <div class="col-lg-6"><input type="text" readonly name="totalppn" id="totalppn" class="form-control form-control-white"></div>
    </div>
</div>
<hr>
<div class="d-flex justify-content-end py-2">
    <div class="row">
        <div class="col-lg-6">Grand Total</div>
        <div class="col-lg-6"><input type="text" readonly name="grandtotal" id="grandtotal" class="form-control form-control-white"></div>
    </div>
</div>
<hr>


    <div class="d-flex justify-content-center" id="loadingnya">
        <div class="px-2">
            <a class="btn btn-md btn-primary" href="/admin/procurement/purchase-order/approve/{{ $id_po }}"  id="btn-confirm">Approve Here</a>
        </div>
        <div class="px-2">
            <button class="btn btn-md btn-success" type="button" id="btn-close">Cancel</button>
        </div>
    </div>



<script>

    var taxable = 0;
    var totalppn = 0;
    var totaldiscount = 0;
    var subtotal = 0;
    var grandtotal = 0;
    if($('.totalnya').length > 1){
        $('.totalnya').each(function(){
            taxable += parseFloat($(this).val());
        });
    }else{
        taxable = $('.totalnya').val()
    }

    if($('.getdiscountperitem').length > 1){
        $('.getdiscountperitem').each(function(){
            totaldiscount += parseFloat($(this).val());
        });
    }else{
        totaldiscount = $('.getdiscountperitem').val()
    }

    subtotal = parseFloat(taxable) + parseFloat(totaldiscount);

    $('#subtotal').val(subtotal);

    totalppn = parseFloat($('#ppn').val() * taxable /100);

    grandtotal = parseFloat(taxable) +parseFloat(totalppn);

    $('#grandtotal').val(grandtotal);

        $('#totalppn').val(totalppn);
        $('#totaldiscount').val(totaldiscount);
        $('#taxable').val(taxable);

    $('#btn-close').on('click', function(){
        $('#mainmodal').modal('toggle');
    });

// Approve Button
$(document).on('click', '#btn-confirm', function(e){
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
                title: 'Seriously Approve this data ?',
                text: "The data will be approved if you click yes!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'Not',
                reverseButtons: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#loading-add').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
                    $.ajax({
                        type:"GET",
                        url: href,
                        success:function(response){
                            Swal.fire(
                                'Success',
                                response.success,
                                'success'
                            )
                            tablePo.ajax.reload(null, false);
                            $('#loading-add').html('<button type="button" class="btn btn-primary me-3" onclick="addPoModal()">Add Purchase Order</button>')
                            $('#mainmodal').modal('toggle')
                        }
                    })

                } else if (

                result.dismiss === Swal.DismissReason.cancel
                ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'The data not approved !',
                    'success'
                )
                }
            })
        });


</script>
