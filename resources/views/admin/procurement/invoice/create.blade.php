<div class="card">
    <div class="card-header">
        <h4>Create Invoice</h4>
    </div>
    <div class="card-body">
        <form id="addInvoice" class="form">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="fv-row mb-3">
                        <input type="hidden" name="id_receipt" id="id_receipt">
                        <label class="required form-label fw-bold">Delivery Order Number</label>
                        <select class="form-select  form-select-solid mb-3 mb-lg-0 select-2" name="purchase_order_id"
                            id="purchase_order_id" required>
                            <option>Choose DO Number</option>
                            @foreach ($list as $l)
                                <option value="{{ $l->id_po }}">{{ $l->do_number }}-{{ $l->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">No Purchase Order</label>
                        <input type="text" id="code" name="code" readonly
                            class="form-control form-control-white mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Date Purchase Order</label>
                        <input type="text" name="order_date" id="order_date" readonly
                            class="form-control form-control-white mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class=" form-label fw-bold">Partners</label>
                        <input type="text" name="partner" id="partner" readonly
                            class="form-control form-control-white mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Address</label>
                        <textarea type="text" name="address" id="address" readonly class="form-control form-control-white mb-3 mb-lg-0"></textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Phone Number</label>
                        <input type="text" name="phone" id="phone" readonly
                            class="form-control form-control-white mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Att</label>
                        <input type="text" name="att" id="att" value="-" readonly
                            class="form-control form-control-white mb-3 mb-lg-0" />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Fax</label>
                        <input type="text"  id="fax" readonly
                            class="form-control form-control-white mb-3 mb-lg-0" required />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Ship To</label>
                        <textarea id="shipment" class="form-control form-control-solid mb-3 mb-lg-0" readonly required></textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Vat/PPN</label>
                        <input type="text"  id="vat"
                            class="form-control form-control-solid mb-3 mb-lg-0" readonly required />
                    </div>

                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Email</label>
                        <input type="text"  id="email"
                            class="form-control form-control-solid mb-3 mb-lg-0" value="-" readonly required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Telp/Fax</label>
                        <input type="text"  id="telp/fax"
                            class="form-control form-control-solid mb-3 mb-lg-0" value="0837263723" readonly required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Term Of Payment</label>
                        <input type="text" id="term_of_payment"
                            class="form-control form-control-solid mb-3 mb-lg-0" readonly required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Decription</label>
                        <textarea  id="description" class="form-control form-control-solid mb-3 mb-lg-0" readonly required></textarea>

                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">No Invoice</label>
                        <input type="text" name="no_invoice" id="no_invoice"
                            class="form-control form-control-solid mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Date Invoice</label>
                        <div class="">
                            <input type="text" name="date_invoice" id="date_invoice"
                            class="form-control form-control-solid mb-3 mb-lg-0" required />
                        </div>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Due Date</label>
                        <div class="">
                            <input type="text" name="due_date" id="due_date"
                            class="form-control form-control-solid mb-3 mb-lg-0" required />
                        </div>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Description Invoice</label>
                        <textarea  name="description_invoice" id="description_invoice"
                            class="form-control form-control-solid mb-3 mb-lg-0" required > </textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Tax Invoice</label>
                        <input type="text" name="tax_invoice" id="tax_invoice"
                            class="form-control form-control-solid mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Sign</label>
                        <input type="text" name="sign" id="sign"
                            class="form-control form-control-solid mb-3 mb-lg-0" required />
                    </div>

                </div>
                <hr>
                <h5 class="fw-bolder">Items</h5>
                <hr>
                <div class="col-lg-12"id="itemsList">

                </div>
            </div>
            <hr>

            <div class="d-flex justify-content-center" id="loadingnya">
                <div class="px-2">
                    <button class="btn btn-sm btn-primary" type="submit" id="btn-add">Confirm</button>
                </div>
                <div class="px-2">
                    <button class="btn btn-sm btn-secondary" onclick="tutupContent()" id="btn-add">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.select-2').select2();
        flatpickr("#date_invoice", {
            static: true,
            dateFormat: "Y-m-d",
        });
        flatpickr("#due_date", {
            static: true,
            dateFormat: "Y-m-d",
        });
    });
</script>

<script>
    $('#purchase_order_id').on('change', function() {
        var id = $(this).val();
        $('#itemsList').html(
            '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')

        $.get("{{ url('/admin/procurement/invoice/getdata') }}/" + id, {}, function(data) {
            $('#code').val(data.code);
            $('#order_date').val(data.order_date);
            $('#partner').val(data.partner);
            $('#address').val(data.address);
            $('#phone').val(data.phone);
            $('#vat').val(data.vat);
            $('#fax').val(data.fax);
            $('#shipment').val(data.shipment);
            $('#term_of_payment').val(data.term_of_payment);
            $('#description').val(data.description);
            $('#id_receipt').val(data.id_receipt);
            $('#itemsList').html(data.html);
        })

    })




    $('#addInvoice').submit(function(event) {
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
                    url: "{{ url('/admin/procurement/invoice/store') }}",
                    type: 'post',
                    data: $('#addInvoice')
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
