<form id="add-form" class="form" action="/admin/procurement/purchase-order/update" method="post">
    @csrf
    <input type="hidden" name="id_po" value="{{ $ponya[0]->id_ponya }}">

    <div class="row">
        <div class="col-lg-6">
            <div class="fv-row mb-7">
                <label class="fw-bold fs-6 mb-2">Po Code</label>
                <input type="text" id="code" name="code" value="{{ $ponya[0]->code }}" readonly class="form-control form-control-white mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="fw-bold fs-6 mb-2">Order Date</label>
                <input type="datetime-local" name="order_date" id="order_date" value="{{ $ponya[0]->order_date }}" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required form-label fw-bold">Partners</label>
                    <select class="form-select  form-select-solid mb-3 mb-lg-0 select-2" id="partner_id" name="partner_id" required>
                        @foreach ($partner as $besti)
                            <option value="{{ $besti->id }}" {{ $besti->id == $ponya[0]->partner_id ? 'selected' : '' }}>{{ $besti->name }}</option>
                        @endforeach
                    </select>
            </div>
            <div class="fv-row mb-7">
                <label class="fw-bold fs-6 mb-2">Address</label>
                <textarea type="text" name="address" id="address" readonly class="form-control form-control-solid mb-3 mb-lg-0"></textarea>
            </div>
            <div class="fv-row mb-7">
                <label class="fw-bold fs-6 mb-2">Phone Number</label>
                <input type="text" name="phone" id="phone" readonly class="form-control form-control-solid mb-3 mb-lg-0" required/>
            </div>
            <div class="fv-row mb-7">
                <label class="fw-bold fs-6 mb-2">Fax</label>
                <input type="text" name="fax" id="fax" readonly class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Vat/PPN</label>
                <input type="number" name="ppn" id="ppn" onkeyup='sumAll()' value="{{ $ponya[0]->ppn }}" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required form-label fw-bold">Currency</label>
                    <select class="form-select  form-select-solid mb-3 mb-lg-0 select-2" onchange="getRate(this.value)" name="currency_id" id="currency_id" required>
                        @foreach ($currency as $currency)
                        <option value="{{ $currency->id }}" {{ $currency->id == $ponya[0]->currency_id ? 'selected' : '' }}>{{ $currency->name }}</option>

                        @endforeach
                    </select>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Rate</label>
                <input type="number" name="rate" id="rate" value="{{ $ponya[0]->rate }}" readonly class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required form-label fw-bold">Term of Payment</label>
                    <select class="form-select  form-select-solid mb-3 mb-lg-0 select-2" name="term_of_payment" id="term_of_payment" required>
                        <option value="Cash" {{ $ponya[0]->term_of_payment === 'Cash' ? 'selected' : '' }}>Cash</option>
					    <option value="15" {{ $ponya[0]->term_of_payment === '15' ? 'selected' : '' }}>15 Hari</option>
						<option value="30" {{ $ponya[0]->term_of_payment === '30' ? 'selected' : '' }}>30 Hari</option>
						<option value="45" {{ $ponya[0]->term_of_payment === '45' ? 'selected' : '' }}>45 Hari</option>
						<option value="60" {{ $ponya[0]->term_of_payment === '60' ? 'selected' : '' }}>60 Hari</option>
						<option value="90" {{ $ponya[0]->term_of_payment === '90' ? 'selected' : '' }}>90 Hari</option>
						<option value="other" {{ $ponya[0]->term_of_payment === 'other' ? 'selected' : '' }}>Lainnya</option>
                    </select>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Description</label>
                <textarea type="text" name="description" id="description"  class="form-control form-control-solid mb-3 mb-lg-0"  required>{{ $ponya[0]->description }}</textarea>
            </div>
        </div>
        <div class="col-lg-12"id="itemsAddList">
            <h1>Items</h1>
            <hr>

            @foreach ($s_item as $s_item)
            <div class="row" >
                <input type="hidden" name="idonpoitems[]" value="{{ $s_item->id }}">
                <div class="fv-row mb-7 col-lg-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <label class="required form-label fw-bold">Item </label>
                        </div>
                        <div class="col-lg-6 text-end">
                            <a onclick="getallitem(this)" class="text-success">List All</a>
                        </div>
                    </div>
                <select class="form-select  form-select-solid mb-3 mb-lg-0 item_id select-2" id="item_id" name="item_id[]" readonly onchange="getBaseQty(this)" required>
                    @foreach ($items as $listitem)
                    <option value="{{ $listitem->id }}" {{ $s_item->item_id == $listitem->id ? 'selected' : '' }}>{{ $listitem->item_code }}-{{ $listitem->item_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class='fv-row mb-7 col-lg-1' id='base_qty_parent'>
                <label class='fw-bold fs-6 mb-2'>Base Qty</label>
                <input type='number' name='base_qty' id='base_qty' class='form-control form-control-white mb-3 mb-lg-0' value='' readonly/>
            </div>
            <div class='fv-row mb-7 col-lg-2' id='price_parent'>
                <label class='required fw-bold fs-6 mb-2'>Price</label>
                <input type='number' name='price[]' id='price' onkeyup='hitungByPrice(this)' value="{{ $s_item->unit_price }}" class='form-control form-control-solid mb-3 mb-lg-0' placeholder='$itemprice->base_price' required/>
                <p id='notifprice'>Tulis Kembali harga untuk konfirmasi</p>
            </div>
            <div class="fv-row mb-7 col-lg-1">
                <label class="required fw-bold fs-6 mb-2">Qty</label>
                <input type="number" name="qty[]" id="qty" value="{{ $s_item->qty }}" onkeyup="hitungByQty(this)" class="form-control form-control-solid mb-3 mb-lg-0 qty"  required/>
            </div>
            <div class="fv-row mb-7 col-lg-1">
                <label class="required fw-bold fs-6 mb-2">Diskon</label>
                <input type="number" name="discount[]" id="discount" value="{{ $s_item->discount }}" onkeyup="hitungByDiscount(this)" class="form-control form-control-solid mb-3 mb-lg-0 discount"  required/>
            </div>
            <div class="fv-row mb-7 col-lg-2">
                <label class="required fw-bold fs-6 mb-2">Total</label>
                <input type="number" name="total[]" id="total" value="{{ $s_item->total_price }}" readonly class="form-control form-control-solid mb-3 mb-lg-0 totalnya"  required/>
                <input type="hidden" name="getdiscountperitem[]" value="{{ $s_item->total_discount }}" id="getdiscountperitem" readonly class="form-control form-control-solid mb-3 mb-lg-0 getdiscountperitem"  required/>
            </div>
            <div class="fv-row mb-7 col-lg-1">
                <label class='fw-bold fs-6 mb-2'>Remove</label>
                <button class='btn btn-sm btn-warning' type='button' onclick='removeItemRow(this)'>-</button>
            </div>
        </div>
        @endforeach
        </div>
        <div class="d-flex justify-content-end py-2">
            <button class="btn btn-sm btn-primary" type="button" onclick="addNewItemRow()">+</button>
        </div>
    </div>
    <hr>
    <div class="d-flex justify-content-end py-2">
        <div class="row">
            <div class="col-lg-6">Subtotal</div>
            <div class="col-lg-6"><input type="text" name="subtotal" readonly id="subtotal" class="form-control form-control-white"></div>
        </div>
    </div>
    <div class="d-flex justify-content-end py-2">
        <div class="row">
            <div class="col-lg-6">Discount</div>
            <div class="col-lg-6"><input type="text" name="totaldiscount" readonly id="totaldiscount" class="form-control form-control-white"></div>
        </div>
    </div>
    <div class="d-flex justify-content-end py-2">
        <div class="row">
            <div class="col-lg-6">Taxable</div>
            <div class="col-lg-6"><input type="text" name="taxable" readonly id="taxable" class="form-control form-control-white"></div>
        </div>
    </div>
    <div class="d-flex justify-content-end py-2">
        <div class="row">
            <div class="col-lg-6">Vat/PPn</div>
            <div class="col-lg-6"><input type="text" name="totalppn" readonly id="totalppn" class="form-control form-control-white"></div>
        </div>
    </div>
    <hr>
    <div class="d-flex justify-content-end py-2">
        <div class="row">
            <div class="col-lg-6">Grand Total</div>
            <div class="col-lg-6"><input type="text" name="grandtotal" readonly id="grandtotal" class="form-control form-control-white"></div>
        </div>
    </div>
    <hr>

        <div class="d-flex justify-content-end" id="loadingnya">
            <button class="btn btn-sm btn-primary" type="submit" id="btn-update">Update Purchase Order</button>
        </div>
</form>

<script>
     $(document).ready(function() {
            $('.select-2').select2({
                dropdownParent: $('#mainmodal')
            });

    });
</script>


<script>
    // $('form').submit(function(){
    // $('#btn-add').hide()
    // $('#loadingnya').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
    // })

    sumAll()

    $('#partner_id').on('change', function(){
        $('#item_id').html("<option>Loading....</option>")
        $.get("{{ url('/admin/procurement/purchase-order/getitem') }}/"+$('#partner_id').val(), {}, function(data){
                $('#item_id').html(data.html)
                $('#address').val(data.address)
                $('#phone').val(data.phone)
                $('#fax').val(data.fax)
                $('#base_qty_parent').remove()
                $('#price_parent').remove()
            })
    })

    function getallitem(e){
        $.get("{{ url('/admin/procurement/purchase-order/getallitem') }}", {}, function(data){
            $(e).parent().parent().parent().find('#item_id').html(data.html);
        })
    }

    function getBaseQty(e){
        $.get("{{ url('/admin/procurement/purchase-order/getbaseqty') }}/"+e.value, {}, function(data){
            $(e).parent().parent().find('#price_parent').remove();
            $(e).parent().parent().find('#base_qty_parent').remove();
            $(e).parent().after("<div class='fv-row mb-7 col-lg-1' id='base_qty_parent'><label class='fw-bold fs-6 mb-2'>Base Qty</label><input type='number' name='base_qty' id='base_qyu' class='form-control form-control-white mb-3 mb-lg-0' value='"+data.base_qty+"' readonly/></div>"+data.pricing)
            })
    }

    function getRate(e){
        $.get("{{ url('/admin/procurement/purchase-order/getcurrency') }}/"+e, {}, function(data){
                $('#rate').val(data.rate)
            })
    }

    function addNewItemRow(){
            $.get("{{ url('/admin/procurement/purchase-order/addnewitemrow') }}/"+$('#partner_id').val(), {}, function(data){
                $('#itemsAddList').append(data.html)
                $('.select-2').select2({
                    dropdownParent: $('#mainmodal')
                });
            })
    }

    function removeItemRow(e){
        $(e).parent().parent().remove()
        sumAll()
    }

    function hitungByDiscount(e){
        let qty = $(e).parent().parent().find('#qty').val();
        let discount = e.value;
        let price =  $(e).parent().parent().find('#price').val();
        if(typeof price == "undefined"){
            price =0;
        }
        let total = (parseFloat(qty) * parseFloat(price)) - ((parseFloat(qty) * parseFloat(price)) * (parseFloat(discount) / 100));
        $(e).parent().parent().find('#total').val(total);
        let getdiscountperitem =((parseFloat(qty) * parseFloat(price)) * (parseFloat(discount) / 100));
        $(e).parent().parent().find('#total').val(total);
        $(e).parent().parent().find('#getdiscountperitem').val(getdiscountperitem);
        sumAll()
    }
    function hitungByQty(e){
        let qty =  e.value;
        let discount = $(e).parent().parent().find('#discount').val();
        let price =  $(e).parent().parent().find('#price').val();
        if(typeof price == "undefined"){
            price =0;
        }
        let getdiscountperitem =((parseFloat(qty) * parseFloat(price)) * (parseFloat(discount) / 100));
        let total = (parseFloat(qty) * parseFloat(price)) - ((parseFloat(qty) * parseFloat(price)) * (parseFloat(discount) / 100));
        $(e).parent().parent().find('#total').val(total);
        $(e).parent().parent().find('#getdiscountperitem').val(getdiscountperitem);
        sumAll()
    }
    function hitungByPrice(e){
        // if(e.value.length >0){
        //     $(e).closest('#notifprice').hide()
        // }
        let qty = $(e).parent().parent().find('#qty').val();
        let discount = $(e).parent().parent().find('#discount').val();
        let price = e.value;
        if(typeof price == "undefined"){
            price =0;
        }
        let getdiscountperitem =((parseFloat(qty) * parseFloat(price)) * (parseFloat(discount) / 100));
        let total = (parseFloat(qty) * parseFloat(price)) - ((parseFloat(qty) * parseFloat(price)) * (parseFloat(discount) / 100));
        $(e).parent().parent().find('#total').val(total);
        $(e).parent().parent().find('#getdiscountperitem').val(getdiscountperitem);

        sumAll()

    }

    function sumAll(){
        let taxable = 0;
        let totalppn = 0;
        let totaldiscount = 0;
        let subtotal = 0;
        let grandtotal = 0;
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
    }

</script>
