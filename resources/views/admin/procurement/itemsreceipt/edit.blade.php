<div class="card">
    <div class="card-header">
        <h4>Edit Receipt Item </h4>
    </div>
    <div class="card-body">
        <form id="updateItemReceipt">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <input type="hidden" name="id_po" value="{{ $po[0]->id_po }}">
                    <div class="fv-row mb-3">
                        <label class="required form-label fw-bold">Po Number</label>
                        <select class="form-select  form-select-solid mb-3 mb-lg-0 select-2" disabled name="purchase_order_id"
                            id="purchase_order_id" required>
                            <option>{{ $po[0]->number_po . '-' . $po[0]->partner_name }}</option>

                        </select>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Po Code</label>
                        <input type="text" id="code" name="code" readonly
                            class="form-control form-control-white mb-3 mb-lg-0" value="{{ $po[0]->number_po }}"
                            required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Date</label>
                        <input type="text" name="order_date" id="order_date" readonly
                            class="form-control form-control-white mb-3 mb-lg-0" value="{{ $po[0]->order_date }}"
                            required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class=" form-label fw-bold">Partners</label>
                        <input type="text" name="partner" id="partner" readonly
                            class="form-control form-control-white mb-3 mb-lg-0" value="{{ $po[0]->partner_name }}"
                            required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Address</label>
                        <textarea type="text" name="address" id="address" readonly class="form-control form-control-white mb-3 mb-lg-0">{{ $po[0]->address }}</textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Phone Number</label>
                        <input type="text" name="phone" id="phone" readonly
                            class="form-control form-control-white mb-3 mb-lg-0" value="{{ $po[0]->phone }}" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Fax</label>
                        <input type="text" name="fax" id="fax" readonly
                            class="form-control form-control-white mb-3 mb-lg-0" value="{{ $po[0]->fax }}" required />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Number Delivery Order</label>
                        <input type="text" name="do_number" id="do_number"
                            class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $po[0]->do_number }}" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Shipment</label>
                        <textarea name="shipment" id="shipment" class="form-control form-control-solid mb-3 mb-lg-0" required>{{ $po[0]->shipment }}</textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Received Date</label>
                        <div class="">
                            <input type="datetime-local" name="receipt_date" id="receipt_date"
                                class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $po[0]->receipt_date }}" required />
                        </div>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Plate Number</label>
                        <input type="text" name="plate_number" id="plate_number"
                            class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $po[0]->plate_number }}" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required form-label fw-bold">Status</label>
                        <select class="form-select  form-select-solid mb-3 mb-lg-0" name="status" required>
                            <option value="1">Yes</option>
                            <option value="0">Not</option>
                        </select>
                    </div>
                </div>
                <hr>
                <h5 class="fw-bolder">Items</h5>
                <hr>
                <div class="col-lg-12"id="itemsAddList">
                    @foreach ($po as $item)
                        <div class='row'>
                            <input type='hidden' name='po_item_id[]' value='{{ $item->po_item_id }}' />
                            <div class='fv-row mb-3 col-lg-2'>
                                <label class=' form-label fw-bold'>Item</label>
                                <select class='form-select  form-select-white mb-3 mb-lg-0' id='item_id'
                                    name='item_id[]' required>
                                    <option value='$item->item_id'>{{ $item->item_name }}</option>
                                </select>
                            </div>
                            <div class='fv-row mb-3 col-lg-2'>
                                <label class=' fw-bold fs-6 mb-2'>Order Qty</label>
                                <input type='number' name='qty_order[]' id='qty_order' value='{{ $item->qty }}'
                                    readonly class='form-control form-control-white mb-3 mb-lg-0 ' required />
                            </div>
                            <input type='hidden' id='nowBalance' value='{{ $item->qty_balance }}' readonly
                                class='form-control form-control-white mb-3 mb-lg-0 ' required />
                            <div class='fv-row mb-3 col-lg-2'>
                                <label class=' fw-bold fs-6 mb-2'>Balance</label>
                                <input type='number' name='balance[]' id='balance'
                                    value='{{ $item->qty_balances }}' readonly
                                    class='form-control form-control-white mb-3 mb-lg-0 ' required />
                            </div>
                            <div class='fv-row mb-3 col-lg-2'>
                                <label class='required fw-bold fs-6 mb-2'>Receipt</label>
                                <input type='number' name='qty[]' id='qty' onkeyup='balanceEdit(this)'
                                    value='{{ $item->qty_receipt }}' class='form-control form-control-solid mb-3 mb-lg-0 ' required />
                            </div>
                            <div class='fv-row mb-3 col-lg-1'>
                                <label class='required fw-bold fs-6 mb-2'>Bonus</label>
                                <input type='number' name='qty_bonus[]' id='qty_bonus' value='{{ $item->qty_bonus }}'
                                    class='form-control form-control-solid mb-3 mb-lg-0 ' required />
                            </div>

                            <div class='fv-row mb-3 col-lg-1'>
                                <label class='required fw-bold fs-6 mb-2'>Discount</label>
                                <input type='number' name='qty_discount[]' id='qty_discount' value='{{ $item->qty_discount }}'
                                    class='form-control form-control-solid mb-3 mb-lg-0 ' required />
                            </div>
                            <div class='fv-row mb-3 col-lg-2'>
                                <label class='required fw-bold fs-6 mb-2'>Note</label>
                                <input type='text' name='notes[]' id='notes'
                                    class='form-control form-control-solid mb-3 mb-lg-0 descriptionnya'
                                    value='{{ $item->deskripsi_items }}' />
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <hr>

            <div class="d-flex justify-content-center" id="loadingnya">
                <div class="px-2">
                    <button class="btn btn-sm btn-primary" type="submit" id="btn-add">Confirm</button>
                </div>
                <div class="px-2">
                    <button class="btn btn-sm btn-secondary" onclick="tutupContent()">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.select-2').select2();
        flatpickr("#receipt_date", {
            static: true,
            enableTime: true,
            dateFormat: "Y-m-d H:i:s",
            minuteIncrement: 1,
            time_24hr: true
        });
    });
</script>

<script>
    $('#updateItemReceipt').submit(function(event) {
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
                    url: "{{ url('/admin/procurement/items-receipt/update') }}",
                    type: 'post',
                    data: $('#updateItemReceipt')
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
                        $('#searchTableItemsReceipt').focus()
                        tableItemsReceipt.ajax.reload()
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

    function balanceEdit(e) {
        var order_qty = $(e).parent().parent().find('#nowBalance').val();
        var qty = $(e).val();

        $(e).parent().parent().find('#balance').val(order_qty - qty);

    }
</script>
