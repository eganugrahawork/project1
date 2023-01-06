<div class="card">
    <div class="card-header">
        <h4>Tambah Pemasukan</h4>
    </div>
    <div class="card-body">
        <form id="createSales" class="form">
            <div class="d-flex justify-content-center">
                <div class="col-lg-6">
                    @csrf
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Cash Account Debit</label>
                        <select class="form-select  form-select-transparent mb-3 mb-lg-0 select-2" name="coa_id"
                            id="coa_id" required>
                            <option selected disabled>Pilih COA</option>
                            @foreach ($coa as $c)
                                <option value="{{ $c->id }}">{{ $c->coa }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Tanggal</label>
                        <div class="">
                            <input type="text" id="payment_date" name="payment_date"
                                class="form-control form-control-transparent mb-3 mb-lg-0" required />
                        </div>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Jumlah</label>
                        <div class="">
                            <input type="number" id="amount" name="amount"
                                class="form-control form-control-transparent mb-3 mb-lg-0" required />
                        </div>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Keterangan</label>
                        <div class="">
                            <textarea name="description" id="description" cols="10" rows="5" class="form-control form-control-transparent"></textarea>
                        </div>
                    </div>
                </div>
            </div>

    </div>
    <div class="col-lg-12 px-2">
        <hr>
        <div class="col-lg-12">
            <table class="table gy-5 gs-7 border rounded w-100">
                <thead>
                    <tr class="fw-bolder fs-6 text-gray-800">
                        <td>Cash Credit</td>
                        <td>Jumlah</td>
                        <td>Keterangan</td>
                        <td>Partner</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody id="cashcreditList">
                    <tr>
                        <td><select name="cash_credit" id="cash_credit" class="form-select form-select-transparent select-2">
                                <option selected disabled>Pilih</option>
                            </select></td>
                        <td>
                            <input type="number" name="amount" class="form-control form-control-transparent">
                        </td>
                        <td>
                            <input name="description" class="form-control form-control-transparent" type="text"/>
                        </td>
                        <td>
                            <select name="partner_id" id="partner_id" class="form-select form-select-transparent select-2">
                                <option selected disable>Pilih Partner Disini</option>
                                @foreach ($partner as $p)
                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endforeach

                            </select>
                        </td>
                        <td><button class="btn btn-icon btn-sm btn-danger" onclick="removeRow(this)">-</button></td>
                    </tr>
                </tbody>
            </table>
            <div class="d-flex justify-content-end px-4">
                <button class="btn btn-icon btn-sm btn-primary" onclick="addNewItemRow()">+</button>
            </div>
        </div>

        <hr>

        <div class="d-flex justify-content-center" id="loadingnya">
            <div class="px-2">
                <button class="btn btn-sm btn-primary" type="submit" id="btn-add">Buat</button>
            </div>
            <div class="px-2">
                <button class="btn btn-sm btn-secondary" type="button" onclick="tutupContent()">Kembali</button>
            </div>
        </div>

        </form>
    </div>
</div>
</div>

<script>
    $(document).ready(function() {
        $('.select-2').select2();

        flatpickr("#payment_date", {
            static: true,
            dateFormat: "Y-m-d",
            allowInput:true
        });

    });
</script>

<script>
    $('#createSales').submit(function(event) {
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
                    url: "{{ url('/admin/selling/selling/store') }}",
                    type: 'post',
                    data: $('#createSales')
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
                        tableSelling.ajax.reload()
                    },
                    error: function(response) {
                        // Handle error
                    }
                });

            } else if (

                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Dibatalkan',
                    '',
                    'success'
                )
            }
        })

    });



    function removeRow(e){
        $(e).parent().parent().remove()
    }

    function addNewItemRow(){
        $.get("{{ url('/admin/finance/income/addnewitemrow') }}", function(data){
            $('#cashcreditList').append(data.html)
            $('.select-2').select2()
        })
    }
</script>
