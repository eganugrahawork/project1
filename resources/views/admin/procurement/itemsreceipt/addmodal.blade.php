<form id="kt_modal_add_user_form" class="form" action="/admin/procurement/items-receipt/store" method="post">
    @csrf
    <div class="row">
        <div class="col-lg-6">
            <div class="fv-row mb-7">
                <label class="required form-label fw-bold">Po Number</label>
                    <select class="form-select  form-select-solid mb-3 mb-lg-0 select-2" name="purchase_order_id" id="purchase_order_id" required>
                        <option>Choose Po Number</option>
                        @foreach ($purchase_orders as $po)
                        <option value="{{ $po->id }}">{{ $po->code }}-{{ $po->partnernya->name }}</option>
                        @endforeach
                    </select>
            </div>
            <div class="fv-row mb-7">
                <label class="fw-bold fs-6 mb-2">Po Code</label>
                <input type="text" id="code" name="code" readonly class="form-control form-control-white mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="fw-bold fs-6 mb-2">Date</label>
                <input type="text" name="order_date" id="order_date" readonly class="form-control form-control-white mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class=" form-label fw-bold">Partners</label>
                <input type="text" name="partner" id="partner" readonly class="form-control form-control-white mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="fw-bold fs-6 mb-2">Address</label>
                <textarea type="text" name="address" id="address" readonly class="form-control form-control-white mb-3 mb-lg-0"  ></textarea>
            </div>
            <div class="fv-row mb-7">
                <label class="fw-bold fs-6 mb-2">Phone Number</label>
                <input type="text" name="phone" id="phone" readonly class="form-control form-control-white mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="fw-bold fs-6 mb-2">Fax</label>
                <input type="text" name="fax" id="fax" readonly class="form-control form-control-white mb-3 mb-lg-0"  required/>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Number Delivery Order</label>
                <input type="number" name="do_number" id="do_number" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Received Date</label>
                <input type="text" name="do_date" id="do_date"  class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Plate Number</label>
                <input type="text" name="plate_number" id="plate_number" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required form-label fw-bold">Status</label>
                    <select class="form-select  form-select-solid mb-3 mb-lg-0" name="status" required>
                        <option value="1">Yes</option>
                        <option value="0">Not</option>
                    </select>
            </div>
        </div>
        <hr>
        <h1>Items</h1>
        <hr>
        <div class="col-lg-12"id="itemsAddList">

        </div>
    </div>
    <hr>

        <div class="d-flex justify-content-end" id="loadingnya">
            <div class="px-2">
                <button class="btn btn-sm btn-primary" type="submit" id="btn-add">Confirm</button>
            </div>
            <div class="px-2">
                <button class="btn btn-sm btn-success" onclick="tutupModal()" id="btn-add">Cancel</button>
            </div>
        </div>
</form>

<script>
    $(document).ready(function() {
           $('.select-2').select2({
               dropdownParent: $('#mainmodal')
           });

   });

   $("#do_date").datepicker("option", "dateFormat", "yy-mm-dd ");
</script>

<script>
    $('#purchase_order_id').on('change', function(){
        var id = $(this).val();

        $.get("{{ url('/admin/procurement/items-receipt/getdatapo') }}/"+id, {}, function(data){
            $('#code').val(data.code);
            $('#order_date').val(data.order_date);
            $('#partner').val(data.partner);
            $('#address').val(data.address);
            $('#phone').val(data.phone);
            $('#fax').val(data.fax);
            $('#itemsAddList').html(data.html);
        })

    })

</script>
