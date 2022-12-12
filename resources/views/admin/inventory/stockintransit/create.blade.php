<div class="card">
    <div class="card-header">
        <h4>Create Transit</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-8">
                <form id="addTransit" class="form">
                    @csrf
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Transit Date</label>
                        <div class="">
                            <input type="text" id="transitdate" name="transitdate"
                                class="form-control form-control-solid mb-3 mb-lg-0" required />
                        </div>
                    </div>
                    <div class="fv-row mb-3">
                        <input type="hidden" name="id_receipt" id="id_receipt">
                        <label class="required form-label fw-bold">Sales</label>
                        <select class="form-select  form-select-solid mb-3 mb-lg-0 select-2" name="sales"
                            id="sales" required>
                            <option>Choose DO Number</option>
                        </select>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Description</label>
                        <textarea type="text" name="description" id="description" class=" form-control form-control-solid mb-3 mb-lg-0"></textarea>
                    </div>
                    <hr>
                    <h5 class="fw-bolder">Items</h5>
                    <hr>
                    <div class="col-lg-12" id="itemsList">
                        <div class='row'>
                            <div class='fv-row mb-3 col-lg-4'>
                                <label class=' form-label fs-6 fw-bold'>Item</label>
                                <select class='form-select  form-select-solid mb-3 mb-lg-0' id='item_id'
                                    name='item_id[]' required>
                                    {{-- <option value='{{ $item->item_id }}'>{{ $item->item_name }}</option> --}}
                                </select>
                            </div>
                            <div class='fv-row mb-3 col-lg-2'>
                                <label class=' fw-bold fs-6 mb-2'>Qty Box</label>
                                <input type='number' name='qty_box[]' id='qty_box'
                                    class='form-control form-control-solid mb-3 mb-lg-0 ' required />
                            </div>
                            <div class='fv-row mb-3 col-lg-2'>
                                <label class='required fw-bold fs-6 mb-2'>Total Qty Box</label>
                                <input type='number' name='total_qty_box[]' id='total_qty_box' readonly
                                    class='form-control form-control-solid mb-3 mb-lg-0 ' required />
                            </div>
                            <div class='fv-row mb-3 col-lg-1  '>
                                <button class="btn btn-danger btn-sm btn-icon mt-4" type="button" onclick="deleteRow()">-</button>
                            </div>


                        </div>
                    </div>
                    <hr>

                    <div class="d-flex justify-content-center" id="loadingnya">
                        <div class="px-2">
                            <button class="btn btn-sm btn-primary" type="submit" id="btn-add">Create</button>
                        </div>
                        <div class="px-2">
                            <button class="btn btn-sm btn-secondary" type="button"
                                onclick="tutupContent()">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                <div class="card card-flush shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title fw-bolder text-gray-600">Information </h3>
                        <div class="card-toolbar">
                            <i class="bi bi-bookmarks-fill text-primary fs-2x"></i>
                        </div>
                        <div class="separator"></div>
                    </div>
                    <div class="card-body  text-gray-400">
                        Lorem Ipsum is simply dummy text...
                    </div>
                    <div class="card-footer">
                       <p class="text-sm">Loccana Team</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.select-2').select2();

        flatpickr("#transitdate", {
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
        })

    })


    $('#addTransit').submit(function(event) {
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
                    url: "{{ url('/admin/inventory/stock-in-transit/store') }}",
                    type: 'post',
                    data: $('#addTransit')
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
                        $('#searchTableInvoice').focus()
                        tableInvoice.ajax.reload()
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
</script>
