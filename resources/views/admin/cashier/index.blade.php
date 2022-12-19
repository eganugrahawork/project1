@extends('admin.layouts.main')

@section('content')
    <div class="success-message" data-successmessage="{{ session('success') }}"></div>
    <div class="fail-message" data-failmessage="{{ session('fail') }}"></div>
    <div class="row">
      <div class="col-12">
          <div id="content"></div>
          <div class="card" id="indexContent">
              <div class="card-header border-0">
                    <div class="card-title align-items-start flex-column">
                        <div class="d-flex align-items-center position-relative my-1">
                            <h5 class="text-gray-600 fw-bolder ">Transaction</h5>
                        </div>

                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base" id="loading-add">
                            @can('create', ['/admin/cashier'])
                                <button type="button" class="btn btn-sm btn-primary me-3" onclick="create()">
                                    Cashier</button>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5"
                                href="#">All Transaction</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5"
                                href="#">Spending</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5"
                                href="#">Sales</a>
                        </li>

                    </ul>

                    <div class="card py-4" id="menuContentCashier">
                        <div class="card-header card-header-stretch">
                            <div class="card-title">
                                <h3 class="m-0 text-gray-800">All Transaction</h3>
                            </div>
                            <div class="card-toolbar m-0">
                                <div class="d-flex align-items-center position-relative my-1">
                                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546"
                                                height="2" rx="1" transform="rotate(45 17.0365 15.1223)"
                                                fill="black" />
                                            <path
                                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                fill="black" />
                                        </svg>
                                    </span>
                                    <input type="text" id="searchCoaTable"
                                        class="form-control form-control-solid w-250px ps-15" placeholder="Search..." />
                                </div>
                            </div>
                        </div>
                        <div id="kt_referred_users_tab_content" class="tab-content">
                            <div id="kt_referrals_1" class="card-body p-0 tab-pane fade show active" role="tabpanel">
                                <div class="table-responsive">
                                    <table
                                        class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9">
                                        <thead class="border-gray-200 fs-5 fw-bold bg-lighten">
                                            <tr>
                                                <th class="min-w-175px ">Date</th>
                                                <th class="min-w-150px px-0">Order ID</th>
                                                <th class="min-w-350px">Details</th>
                                                <th class="min-w-125px">Amount</th>
                                                <th class="min-w-125px text-center">Invoice</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fs-6 fw-bold text-gray-600">
                                            <tr>
                                                <td class="">Nov 01, 2020</td>
                                                <td class="ps-0">102445788</td>
                                                <td>Darknight transparency 36 Icons Pack</td>
                                                <td class="text-success">$38.00</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="">Oct 24, 2020</td>
                                                <td class="ps-0">423445721</td>
                                                <td>Seller Fee</td>
                                                <td class="text-danger">$-2.60</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="">Oct 08, 2020</td>
                                                <td class="ps-0">312445984</td>
                                                <td>Cartoon Mobile Emoji Phone Pack</td>
                                                <td class="text-success">$76.00</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="">Sep 15, 2020</td>
                                                <td class="ps-0">312445984</td>
                                                <td>Iphone 12 Pro Mockup Mega Bundle</td>
                                                <td class="text-success">$5.00</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="">May 30, 2020</td>
                                                <td class="ps-0">523445943</td>
                                                <td>Seller Fee</td>
                                                <td class="text-danger">$-1.30</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="">Apr 22, 2020</td>
                                                <td class="ps-0">231445943</td>
                                                <td>Parcel Shipping / Delivery Service App</td>
                                                <td class="text-success">$204.00</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="">Feb 09, 2020</td>
                                                <td class="ps-0">426445943</td>
                                                <td>Visual Design Illustration</td>
                                                <td class="text-success">$31.00</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="">Nov 01, 2020</td>
                                                <td class="ps-0">984445943</td>
                                                <td>Abstract Vusial Pack</td>
                                                <td class="text-success">$52.00</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="">Jan 04, 2020</td>
                                                <td class="ps-0">324442313</td>
                                                <td>Seller Fee</td>
                                                <td class="text-danger">$-0.80</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="kt_referrals_2" class="card-body p-0 tab-pane fade" role="tabpanel">
                                <div class="table-responsive">
                                    <table
                                        class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9">
                                        <thead class="border-gray-200 fs-5 fw-bold bg-lighten">
                                            <tr>
                                                <th class="min-w-175px ">Date</th>
                                                <th class="min-w-150px px-0">Order ID</th>
                                                <th class="min-w-350px">Details</th>
                                                <th class="min-w-125px">Amount</th>
                                                <th class="min-w-125px text-center">Invoice</th>
                                            </tr>
                                        </thead>
                                        <!--end::Thead-->
                                        <!--begin::Tbody-->
                                        <tbody class="fs-6 fw-bold text-gray-600">
                                            <tr>
                                                <td class="">May 30, 2020</td>
                                                <td class="ps-0">523445943</td>
                                                <td>Seller Fee</td>
                                                <td class="text-danger">$-1.30</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="">Apr 22, 2020</td>
                                                <td class="ps-0">231445943</td>
                                                <td>Parcel Shipping / Delivery Service App</td>
                                                <td class="text-success">$204.00</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="">Feb 09, 2020</td>
                                                <td class="ps-0">426445943</td>
                                                <td>Visual Design Illustration</td>
                                                <td class="text-success">$31.00</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="">Nov 01, 2020</td>
                                                <td class="ps-0">984445943</td>
                                                <td>Abstract Vusial Pack</td>
                                                <td class="text-success">$52.00</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="">Jan 04, 2020</td>
                                                <td class="ps-0">324442313</td>
                                                <td>Seller Fee</td>
                                                <td class="text-danger">$-0.80</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="">Nov 01, 2020</td>
                                                <td class="ps-0">102445788</td>
                                                <td>Darknight transparency 36 Icons Pack</td>
                                                <td class="text-success">$38.00</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="">Oct 24, 2020</td>
                                                <td class="ps-0">423445721</td>
                                                <td>Seller Fee</td>
                                                <td class="text-danger">$-2.60</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="">Oct 08, 2020</td>
                                                <td class="ps-0">312445984</td>
                                                <td>Cartoon Mobile Emoji Phone Pack</td>
                                                <td class="text-success">$76.00</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="">Sep 15, 2020</td>
                                                <td class="ps-0">312445984</td>
                                                <td>Iphone 12 Pro Mockup Mega Bundle</td>
                                                <td class="text-success">$5.00</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <!--end::Tbody-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                            </div>
                            <!--end::Tab panel-->
                            <!--begin::Tab panel-->
                            <div id="kt_referrals_3" class="card-body p-0 tab-pane fade" role="tabpanel">
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table
                                        class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9">
                                        <!--begin::Thead-->
                                        <thead class="border-gray-200 fs-5 fw-bold bg-lighten">
                                            <tr>
                                                <th class="min-w-175px ">Date</th>
                                                <th class="min-w-150px px-0">Order ID</th>
                                                <th class="min-w-350px">Details</th>
                                                <th class="min-w-125px">Amount</th>
                                                <th class="min-w-125px text-center">Invoice</th>
                                            </tr>
                                        </thead>
                                        <!--end::Thead-->
                                        <!--begin::Tbody-->
                                        <tbody class="fs-6 fw-bold text-gray-600">
                                            <tr>
                                                <td class="">Feb 09, 2020</td>
                                                <td class="ps-0">426445943</td>
                                                <td>Visual Design Illustration</td>
                                                <td class="text-success">$31.00</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="">Nov 01, 2020</td>
                                                <td class="ps-0">984445943</td>
                                                <td>Abstract Vusial Pack</td>
                                                <td class="text-success">$52.00</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="">Jan 04, 2020</td>
                                                <td class="ps-0">324442313</td>
                                                <td>Seller Fee</td>
                                                <td class="text-danger">$-0.80</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="">Sep 15, 2020</td>
                                                <td class="ps-0">312445984</td>
                                                <td>Iphone 12 Pro Mockup Mega Bundle</td>
                                                <td class="text-success">$5.00</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="">Nov 01, 2020</td>
                                                <td class="ps-0">102445788</td>
                                                <td>Darknight transparency 36 Icons Pack</td>
                                                <td class="text-success">$38.00</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="">Oct 24, 2020</td>
                                                <td class="ps-0">423445721</td>
                                                <td>Seller Fee</td>
                                                <td class="text-danger">$-2.60</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="">Oct 08, 2020</td>
                                                <td class="ps-0">312445984</td>
                                                <td>Cartoon Mobile Emoji Phone Pack</td>
                                                <td class="text-success">$76.00</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="">May 30, 2020</td>
                                                <td class="ps-0">523445943</td>
                                                <td>Seller Fee</td>
                                                <td class="text-danger">$-1.30</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="">Apr 22, 2020</td>
                                                <td class="ps-0">231445943</td>
                                                <td>Parcel Shipping / Delivery Service App</td>
                                                <td class="text-success">$204.00</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <!--end::Tbody-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                            </div>
                            <!--end::Tab panel-->
                            <!--begin::Tab panel-->
                            <div id="kt_referrals_4" class="card-body p-0 tab-pane fade" role="tabpanel">
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table
                                        class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9">
                                        <!--begin::Thead-->
                                        <thead class="border-gray-200 fs-5 fw-bold bg-lighten">
                                            <tr>
                                                <th class="min-w-175px ">Date</th>
                                                <th class="min-w-150px px-0">Order ID</th>
                                                <th class="min-w-350px">Details</th>
                                                <th class="min-w-125px">Amount</th>
                                                <th class="min-w-125px text-center">Invoice</th>
                                            </tr>
                                        </thead>
                                        <!--end::Thead-->
                                        <!--begin::Tbody-->
                                        <tbody class="fs-6 fw-bold text-gray-600">
                                            <tr>
                                                <td class="">Nov 01, 2020</td>
                                                <td class="ps-0">102445788</td>
                                                <td>Darknight transparency 36 Icons Pack</td>
                                                <td class="text-success">$38.00</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="">Oct 24, 2020</td>
                                                <td class="ps-0">423445721</td>
                                                <td>Seller Fee</td>
                                                <td class="text-danger">$-2.60</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="">Nov 01, 2020</td>
                                                <td class="ps-0">102445788</td>
                                                <td>Darknight transparency 36 Icons Pack</td>
                                                <td class="text-success">$38.00</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="">Oct 24, 2020</td>
                                                <td class="ps-0">423445721</td>
                                                <td>Seller Fee</td>
                                                <td class="text-danger">$-2.60</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="">Feb 09, 2020</td>
                                                <td class="ps-0">426445943</td>
                                                <td>Visual Design Illustration</td>
                                                <td class="text-success">$31.00</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="">Nov 01, 2020</td>
                                                <td class="ps-0">984445943</td>
                                                <td>Abstract Vusial Pack</td>
                                                <td class="text-success">$52.00</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="">Jan 04, 2020</td>
                                                <td class="ps-0">324442313</td>
                                                <td>Seller Fee</td>
                                                <td class="text-danger">$-0.80</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="">Oct 08, 2020</td>
                                                <td class="ps-0">312445984</td>
                                                <td>Cartoon Mobile Emoji Phone Pack</td>
                                                <td class="text-success">$76.00</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="">Oct 08, 2020</td>
                                                <td class="ps-0">312445984</td>
                                                <td>Cartoon Mobile Emoji Phone Pack</td>
                                                <td class="text-success">$76.00</td>
                                                <td class="text-center">
                                                    <button
                                                        class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <!--end::Tbody-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                            </div>
                            <!--end::Tab panel-->
                        </div>
                        <!--end::Tab Content-->
                    </div>
                </div>
            </div>
        </div>
        <!--end::Post-->
    </div>

@endsection

@section('js')
    <script>
        function create() {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/cashier/create') }}", {}, function(data, status) {
                $('#indexContent').hide();
                $('#content').html(data)
                $('#content').show()
                $('#loading-add').html(
                    '<button type="button" class="btn btn-sm btn-primary me-3" onclick="create()">Tambah Jurnal</button>'
                )
            })
        }

        function edit(id) {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/cashier/edit') }}/" + id, {}, function(data, status) {
                $('#kontennya').html(data)
                $('#mainmodal').modal('toggle')
                $('#loading-add').html(
                    '<button type="button" class="btn btn-primary me-3" id="add-btn" onclick="create()">Cashier</button>'
                    )
            })
        }

        function tutupContent() {
            $('#content').hide()
            $('#indexContent').show()
            $('#searchtableJurnalPenyesuaian').focus();

        }

        var coaTable = $('#coaTable').DataTable({
            serverside: true,
            processing: true,
            ajax: {
                url: "{{ url('/admin/cashier/list') }}"
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false
                },
                {
                    data: 'parent',
                    name: 'parent'
                },
                {
                    data: 'coa',
                    name: 'coa'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ],
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false
        });

        $('#searchCoaTable').keyup(function() {
            coaTable.search($(this).val()).draw()
        });

        $(document).on('click', '#deletecoa', function(e) {
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
                title: 'Hapus data ini ?',
                text: "Data tidak bisa dikembalikan!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, hapus!',
                cancelButtonText: 'Tidak, Batalkan!',
                reverseButtons: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#loading-add').html(
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
                            coaTable.ajax.reload(null, false);
                            $('#loading-add').html(
                                '<button type="button" class="btn btn-primary me-3" id="add-btn" onclick="create()">Cashier</button>'
                                )
                        }
                    })

                } else if (

                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Data anda masih aman :)',
                        'success'
                    )
                }
            })
        });

        $(document).on('submit', '#add-form', function(e) {
            e.preventDefault();

            if ($('#id_parent').val().length < 1 || $('#coa').val().length < 1 || $('#description').val().length <
                1) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Data tidak boleh ada yang kosong'
                })
            } else {
                $('#btn-add').hide()
                $('#loadingnya').html(
                    '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
                var data = {
                    'id_parent': $('#id_parent').val(),
                    'coa': $('#coa').val(),
                    'description': $('#description').val(),
                    'status': $('#status').val()
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ url('/admin/cashier/store') }}",
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        Swal.fire(
                            'Success',
                            response.success,
                            'success'
                        )
                        $('#mainmodal').modal('toggle');
                        coaTable.ajax.reload(null, false);
                    }
                })
            }
        });


        $(document).on('submit', '#update-form', function(e) {
            e.preventDefault();


            $('#btn-update').hide()
            $('#loadingnya').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            var data = {
                'id': $('#id').val(),
                'id_parent': $('#id_parent').val(),
                'coa': $('#coa').val(),
                'description': $('#description').val(),
                'status': $('#status').val()
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ url('/admin/cashier/update') }}",
                data: data,
                dataType: 'json',
                success: function(response) {
                    Swal.fire(
                        'Success',
                        response.success,
                        'success'
                    )
                    $('#mainmodal').modal('toggle');
                    coaTable.ajax.reload(null, false);
                }
            })
        })
    </script>
@endsection
