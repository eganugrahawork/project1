@extends('admin.layouts.main')


@section('content')
    <div class="success-message" data-successmessage="{{ session('success') }}"></div>
    <div class="toolbar py-5 py-lg-5" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
            <div class="page-title d-flex flex-column me-3">
                <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Users Activity</h1>
                <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                    <li class="breadcrumb-item text-gray-600">
                        <a href="/admin/dashboard" class="text-gray-600 text-hover-primary">Admin</a>
                    </li>
                    <li class="breadcrumb-item text-gray-600">Users</li>

                </ul>
            </div>
        </div>
    </div>

    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <div class="content flex-row-fluid" id="kt_content">
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <h2 class="mb-3">Users Activity</h2>
                    </div>
                    @if (auth()->user()->userrole->role === 'Super Admin')
                        <div class="card-toolbar">
                            <div class="d-flex align-items-center position-relative my-1">
                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                            rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                        <path
                                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                            fill="black" />
                                    </svg>
                                </span>
                                <input type="text" id="searchActivityTable"
                                    class="form-control form-control-solid w-250px ps-15" placeholder="Search" />
                            </div>
                        </div>
                    @endif
                </div>
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="activityTable">
                        <thead>
                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">

                                <th class="min-w-50px">No</th>
                                <th class="min-w-125px">User</th>
                                <th class="min-w-125px">Menu</th>
                                <th class="min-w-125px">Activity</th>
                                <th class="min-w-125px">Statues</th>
                                <th class="min-w-125px">Created at</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-bold">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    {{-- Modal Activity --}}
    <div class="modal fade" id="mainmodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header" id="mainmodal_header">
                    <h2 class="fw-bolder">Users</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" onclick="tutupModal()">
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                    rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="black" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7" id="kontennya">
                </div>
            </div>
        </div>
    </div>
      {{-- End Modal Activity --}}
@endsection

@section('js')
    <script>
        var activityTable = $('#activityTable').DataTable({
            serverside: true,
            processing: true,
            ajax: {
                url: "{{ url('/admin/listuseractivity') }}"
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false
                },
                {
                    data: 'usernya',
                    name: 'usernya'
                },
                {
                    data: 'menu',
                    name: 'menu'
                },
                {
                    data: 'aktivitas',
                    name: 'aktivitas'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                }
            ],
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false
        });

        $('#searchActivityTable').keyup(function() {
            activityTable.search($(this).val()).draw()
        });
    </script>

    <script src="/metronic/assets/js/custom/apps/user-management/users/list/add.js"></script>
@endsection
