<form id="kt_modal_add_user_form" class="form" action="/admin/procurement/purchase-order/store" method="post">
    @csrf
    <div class="row">
        <div class="col-lg-6">
            <div class="fv-row mb-7">
                <label class="fw-bold fs-6 mb-2">Po Code</label>
                <input type="text" id="code" name="code" value="{{ $code }}" readonly class="form-control form-control-white mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="fw-bold fs-6 mb-2">Order Date</label>
                <input type="date" name="order_date" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required form-label fw-bold">Partners</label>
                    <select class="form-select  form-select-solid mb-3 mb-lg-0" id="partner_id" name="partner_id" required>
                        <option>Choose The Partner</option>
                        @foreach ($partner as $besti)
                            <option value="{{ $besti->id }}">{{ $besti->name }}</option>
                        @endforeach
                    </select>
            </div>
            <div class="fv-row mb-7">
                <label class="fw-bold fs-6 mb-2">Address</label>
                <textarea type="text" name="address" id="address" readonly class="form-control form-control-solid mb-3 mb-lg-0"  ></textarea>
            </div>
            <div class="fv-row mb-7">
                <label class="fw-bold fs-6 mb-2">Phone Number</label>
                <input type="text" name="phone" id="phone" readonly class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="fw-bold fs-6 mb-2">Fax</label>
                <input type="text" name="fax" id="fax" readonly class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Vat/PPN</label>
                <input type="number" name="ppn" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required form-label fw-bold">Currency</label>
                    <select class="form-select  form-select-solid mb-3 mb-lg-0" onchange="getRate(this.value)" name="currency_id" required>
                        <option>Choose The Currency</option>
                        @foreach ($currency as $currency)
                        <option value="{{ $currency->id }}">{{ $currency->name }}</option>

                        @endforeach
                    </select>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Rate</label>
                <input type="number" name="rate" id="rate" readonly class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required form-label fw-bold">Term of Payment</label>
                    <select class="form-select  form-select-solid mb-3 mb-lg-0" name="term_of_payment" required>
                        <option>Choose a Term</option>
                        <option value="Cash">Cash</option>
					    <option value="15">15 Hari</option>
						<option value="30">30 Hari</option>
						<option value="45">45 Hari</option>
						<option value="60">60 Hari</option>
						<option value="90">90 Hari</option>
						<option value="other">Lainnya</option>
                    </select>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Description</label>
                <textarea type="text" name="description" class="form-control form-control-solid mb-3 mb-lg-0"  required></textarea>
            </div>
            <div class="fv-row mb-7">
                <label class="required form-label fw-bold">Status</label>
                    <select class="form-select  form-select-solid mb-3 mb-lg-0" name="status" required>
                        <option>Choose Status</option>
                        <option value="1">Yes</option>
                        <option value="0">Not</option>
                    </select>
            </div>
        </div>
        <div class="col-lg-12"id="itemsAddList">
            <h1>Items</h1>
            <hr>
        <div class="row" >
            <div class="fv-row mb-7 col-lg-5">
                <label class="required form-label fw-bold">Item</label>
                <select class="form-select  form-select-solid mb-3 mb-lg-0" id="item_id" name="item_id[]" onchange="getBaseQty(this)" required>
                        <option>Choose Partner First</option>
                </select>
            </div>

            <div class="fv-row mb-7 col-lg-1">
                <label class="required fw-bold fs-6 mb-2">Qty</label>
                <input type="number" name="qty[]" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7 col-lg-1">
                <label class="required fw-bold fs-6 mb-2">Diskon</label>
                <input type="number" name="discount[]" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7 col-lg-1">
                <label class="required fw-bold fs-6 mb-2">Total</label>
                <input type="number" name="total[]" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7 col-lg-1">

            </div>
        </div>
        </div>
        <div class="d-flex justify-content-end py-2">
            <button class="btn btn-sm btn-primary" type="button" onclick="addNewItemRow()">+</button>
        </div>
    </div>
    <hr>
    <div class="d-flex justify-content-end py-2">
        <div class="row">
            <div class="col-lg-4">Subtotal</div>
            <div class="col-lg-4"></div>
        </div>
    </div>
    <div class="d-flex justify-content-end py-2">
        <div class="row">
            <div class="col-lg-4">Diskon</div>
            <div class="col-lg-4"></div>
        </div>
    </div>
    <div class="d-flex justify-content-end py-2">
        <div class="row">
            <div class="col-lg-4">Taxable</div>
            <div class="col-lg-4"></div>
        </div>
    </div>
    <div class="d-flex justify-content-end py-2">
        <div class="row">
            <div class="col-lg-4">Vat/PPn</div>
            <div class="col-lg-4"></div>
        </div>
    </div>
    <hr>
    <div class="d-flex justify-content-end py-2">
        <div class="row">
            <div class="col-lg-4">Grand Total</div>
            <div class="col-lg-4"></div>
        </div>
    </div>
    <hr>

        <div class="d-flex justify-content-end" id="loadingnya">
            <button class="btn btn-sm btn-primary" type="submit" id="btn-add">Add Purchase Order</button>
        </div>
</form>
<script>
    $('form').submit(function(){
    $('#btn-add').hide()
    $('#loadingnya').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
    })

    $('#partner_id').on('change', function(){
        $('#item_id').html("<option>Loading....</option>")
        $.get("{{ url('/admin/procurement/purchase-order/getitem') }}/"+$('#partner_id').val(), {}, function(data){
                $('#item_id').html(data.html)
                $('#address').val(data.address)
                $('#phone').val(data.phone)
                $('#fax').val(data.fax)
                $('#base_qty_parent').remove()
            })
    })

    function getBaseQty(e){
        $.get("{{ url('/admin/procurement/purchase-order/getbaseqty') }}/"+e.value, {}, function(data){
            $(e).parent().after("<div class='fv-row mb-7 col-lg-1' id='base_qty_parent'><label class='fw-bold fs-6 mb-2'>Base Qty</label><input type='number' name='base_qty' class='form-control form-control-white mb-3 mb-lg-0' value='"+data.base_qty+"' readonly/></div>"+data.pricing)
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
            })
    }

    function removeItemRow(e){
$(e).parent().parent().remove()
    }
</script>
