<form id="kt_modal_add_user_form" class="form" action="/admin/masterdata/itemprice/store" method="post">
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
                        <option>Pilih Item</option>
                        @foreach ($partner as $besti)
                            <option value="{{ $besti->id }}">{{ $besti->name }}</option>
                        @endforeach
                    </select>
            </div>
            <div class="fv-row mb-7">
                <label class="fw-bold fs-6 mb-2">Address</label>
                <input type="text" name="address" readonly class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="fw-bold fs-6 mb-2">Phone Number</label>
                <input type="text" name="phone" readonly class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="fw-bold fs-6 mb-2">Fax</label>
                <input type="text" name="fax" readonly class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Vat/PPN</label>
                <input type="number" name="ppn" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required form-label fw-bold">Currency</label>
                    <select class="form-select  form-select-solid mb-3 mb-lg-0" name="currency_id" required>
                        @foreach ($currency as $currency)
                        <option value="{{ $currency->id }}">{{ $currency->name }}</option>

                        @endforeach
                    </select>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Rate</label>
                <input type="number" name="rate" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required form-label fw-bold">Term of Payment</label>
                    <select class="form-select  form-select-solid mb-3 mb-lg-0" name="term_of_payment" required>
                        <option>Pilih Term</option>
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
                        <option>Pilih Item</option>
                    </select>
            </div>
        </div>
        <div class="col-lg-12">
            <h1>Items</h1>
            <hr>
        <div class="row" id="itemsAddList">
            <div class="fv-row mb-7 col-lg-5">
                <label class="required form-label fw-bold">Item</label>
                <select class="form-select  form-select-solid mb-3 mb-lg-0" id="item_id" name="item_id" required>
                        <option>Pilih Item</option>
                </select>
            </div>
            <div class="fv-row mb-7 col-lg-1">
                <label class="fw-bold fs-6 mb-2">Base Qty</label>
                <input type="number" name="base_qty" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7 col-lg-1">
                <label class="required fw-bold fs-6 mb-2">Qty</label>
                <input type="number" name="qty" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7 col-lg-2">
                <label class="required fw-bold fs-6 mb-2">Price</label>
                <input type="number" name="price" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7 col-lg-2">
                <label class="required fw-bold fs-6 mb-2">Total</label>
                <input type="number" name="total" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="col-lg-1">

            </div>
        </div>
        <div class="d-flex justify-content-end py-2">
            <button class="btn btn-sm btn-primary" type="button" onclick="addNewItemRow()">+</button>
        </div>
        </div>
    </div>

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
            })
    })

    function addNewItemRow(){
            $.get("{{ url('/admin/procurement/purchase-order/addnewitemrow') }}/"+$('#partner_id').val(), {}, function(data){
                var itemHtml = "<p>apasih</p>";
                $('#itemsAddList').append(itemHtml)
            })


    }
</script>
