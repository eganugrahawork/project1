@extends('admin.layouts.main')


@section('content')
    <div class="success-message" data-successmessage="{{ session('success') }}"></div>


    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <div class="content flex-row-fluid" id="kt_content">
            <div class="card  px-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-1">
                            <h5>Loccana</h5>
                        </div>
                        <div class="col-lg-11">
                            <ul class="nav row">
                                <li class="nav-item col-12 col-lg  mb-lg-0">
                                    <a class="nav-link active text-gray-600 fs-7 fw-bolder" data-bs-toggle="tab"
                                        href="#kt_general_widget_1_1">
                                        <i class="bi bi-list"></i>
                                        <span class="fs-6 fw-bold">Menu Data</span>
                                    </a>
                                </li>
                                <li class="nav-item col-12 col-lg  mb-lg-0">
                                    <a class="nav-link text-gray-600 fs-7 fw-bolder" data-bs-toggle="tab"
                                        href="#kt_general_widget_1_7">
                                        <i class="bi bi-person-badge-fill"></i>
                                        <span class="fs-6 fw-bold">Role Data</span>
                                    </a>
                                </li>
                                <li class="nav-item col-12 col-lg  mb-lg-0">
                                    <a class="nav-link text-gray-600 fs-7 fw-bolder" data-bs-toggle="tab"
                                        href="#kt_general_widget_1_8">
                                        <i class="bi bi-geo"></i>
                                        <span class="fs-6 fw-bold">Region Data</span>
                                    </a>
                                </li>
                                <li class="nav-item col-12 col-lg  mb-lg-0">
                                    <a class="nav-link text-gray-600 fs-7 fw-bolder" data-bs-toggle="tab"
                                        href="#kt_general_widget_1_6">
                                        <i class="bi bi-signpost-split"></i>
                                        <span class="fs-6 fw-bold">Access Control</span>
                                    </a>
                                </li>
                                <li class="nav-item col-12 col-lg mb-lg-0">
                                    <a class="nav-link text-gray-600 fs-7 fw-bolder" data-bs-toggle="tab"
                                        href="#kt_general_widget_1_9">
                                        <i class="bi bi-signpost-split"></i>
                                        <span class="fs-6 fw-bold">Permission Control</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row gy-0 gx-10 py-3">
                <div class="col-xl-12">
                    <div class="mb-5">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="kt_general_widget_1_1">
                                <div class="card">
                                    <div class="card-header border-0 ">
                                        <div class="card-title align-items-start flex-column">
                                            <span class="card-label fw-bolder fs-3 mb-1">Menu</span>
                                            <span class="text-muted mt-1 fw-bold fs-7"></span>
                                            <div class="d-flex align-items-center position-relative my-1">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i
                                                                class="ni ni-zoom-split-in"></i></span>
                                                        <input class="form-control" placeholder="Search"
                                                            id="searchMenuTable" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-toolbar">
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                <span class="svg-icon svg-icon-2">
                                                    <i class="bi bi-plus-square"></i>
                                                </span>
                                            </button>
                                            <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px"
                                                data-kt-menu="true" id="kt_menu_617b94b52ee36">
                                                <div class="px-3 ">
                                                    <div class="fs-5 text-dark fw-bolder">Add Menues</div>
                                                </div>
                                                <div class="separator border-gray-200"></div>
                                                <div class="px-3" id="addmenuparent">
                                                    <form action="/admin/configuration/menu/store" method="post">
                                                        @csrf
                                                        <label class="form-label fw-bold ">Parent</label>
                                                        <select class="form-select select-2" name="parent">
                                                            <option value="0">Main Parent</option>
                                                            @foreach ($menu as $m)
                                                                <option value="{{ $m->id }}">{{ $m->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <label class="form-label fw-bold">Name</label>
                                                        <input type="text" name="name" class="form-control" required>
                                                        <label class="form-label fw-bold">Url</label>
                                                        <input type="text" class="form-control" name="url">
                                                        <label class="form-label fw-bold">Icon</label>
                                                        <input type="text" class="form-control" name="icon">
                                                        <label class="form-label fw-bold">Sequence</label>
                                                        <input type="number" class="form-control" name="sequence">
                                                        <label class="form-label fw-bold">Status</label>
                                                        <select class="form-select" name="status">
                                                            <option value="1">1</option>
                                                            <option value="0">0</option>
                                                        </select>

                                                        <div class="d-flex justify-content-end mt-2">
                                                            <button class="btn btn-sm btn-primary">Add</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pb-5 px-5">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-row-dashed" id="menuTable">
                                                <thead>
                                                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                        <th
                                                            class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">
                                                            No</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">
                                                            Menu</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">
                                                            Parent</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">
                                                            Url</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">
                                                            Icon</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">
                                                            Status</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">
                                                            Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-gray-600 text-md fw-bold" style="border:none;">
                                                    @foreach ($menu as $m)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $m->name }}</td>
                                                            <td>
                                                                @if ($m->parent == 0)
                                                                    <i class="bi bi-check"></i>
                                                                @else
                                                                    x
                                                                @endif
                                                            </td>
                                                            <td>{{ $m->url }}</td>
                                                            <td>{{ $m->icon }}</td>
                                                            <td>{{ $m->status }}</td>
                                                            <td>
                                                                <a class="btn btn-sm btn-warning"
                                                                    onclick="editModalMenu({{ $m->id }})"><i
                                                                        class="bi bi-pencil-square"></i></a>
                                                                <a href="/admin/configuration/menu/delete/{{ $m->id }}"
                                                                    class="btn btn-sm btn-danger button-delete"><i
                                                                        class="bi bi-trash"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="kt_general_widget_1_6">
                                <div class="card px-5 pb-5">
                                    <div class="card-header border-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="card-label fw-bolder fs-3 mb-1">Access</span>
                                        </h3>
                                        <div class="card-toolbar">
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                <span class="svg-icon svg-icon-2">
                                                    <i class="bi bi-info-circle"></i>
                                                </span>
                                            </button>
                                            <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px"
                                                data-kt-menu="true" id="kt_menu_617b94b537c9a">
                                                <div class="px-7 py-5">
                                                    <div class="fs-5 text-dark fw-bolder">Information <i
                                                            class="bi bi-info-circle"></i> </div>
                                                </div>
                                                <div class="separator border-gray-200"></div>
                                                <div class="px-7 py-5">
                                                    <p>This page for set the access any role to menu</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body py-3 mb-3">
                                        <div class="row">
                                            @foreach ($role as $r)
                                                <div class="col-md-4">
                                                    <div class="card card-flush h-md-100 shadow">
                                                        <div class="card-header">
                                                            <div class="card-title">
                                                                <h2>{{ $r->role }}</h2>
                                                            </div>
                                                        </div>
                                                        @php
                                                            $getUser = DB::connection('masterdata')->select("select username from users where role_id = $r->id");
                                                            $jmlUser = count($getUser);
                                                        @endphp

                                                        <div class="card-body pt-1">
                                                            <div class="fw-bolder text-gray-600 mb-5">Total users with this
                                                                role: {{ $jmlUser }}</div>

                                                        </div>
                                                        <div class="card-footer flex-wrap pt-0">
                                                            <a href="/admin/configuration/userrole/viewrole/{{ $r->id }}"
                                                                class="btn btn-light btn-active-primary my-1 me-2">View
                                                                Role</a>
                                                            <button type="button"
                                                                class="btn btn-light btn-active-light-primary my-1"
                                                                onclick="editModalAccess({{ $r->id }})">Edit
                                                                Role</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="kt_general_widget_1_7">
                                <div class="card">
                                    <div class="card-header border-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="card-label fw-bolder fs-3 mb-1">Role</span>
                                            <div class="d-flex align-items-center position-relative my-1">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i
                                                                class="ni ni-zoom-split-in"></i></span>
                                                        <input class="form-control" placeholder="Search"
                                                            id="searchRoleTable" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                        </h3>
                                        <div class="card-toolbar">
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                <span class="svg-icon svg-icon-2">
                                                    <i class="bi bi-plus-square"></i>
                                                </span>
                                            </button>
                                            <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px"
                                                data-kt-menu="true" id="kt_menu_617b94b537c9a">
                                                <div class="">
                                                    <div class="fs-5 text-dark fw-bolder">Add Role</div>
                                                </div>
                                                <div class="separator border-gray-200"></div>
                                                <div class="">
                                                    <form action="/admin/configuration/userrole/store" method="post">
                                                        @csrf
                                                        <label class="form-label fw-bold">Role</label>
                                                        <input type="text" name="role" class="form-control"
                                                            required>

                                                        <div class="d-flex justify-content-end mt-2">
                                                            <button class="btn btn-sm btn-primary">Add</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body py-3 ">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-row-dashed" id="roleTable">
                                                <thead>
                                                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                        <th
                                                            class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">
                                                            No</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">
                                                            Role</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">
                                                            Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-gray-600 text-md fw-bold" style="border:none;">
                                                    @foreach ($role as $r)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $r->role }}</td>
                                                            <td>
                                                                <a class="btn btn-sm btn-warning"
                                                                    onclick="editModalRole({{ $r->id }})"><i
                                                                        class="bi bi-pencil-square"></i></a>
                                                                <a href="/admin/configuration/userrole/delete/{{ $r->id }}"
                                                                    class="btn btn-sm btn-danger button-delete"><i
                                                                        class="bi bi-trash"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="kt_general_widget_1_8">
                                <div class="card">
                                    <div class="card-header border-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="card-label fw-bolder fs-3 mb-1">Region</span>
                                            <div class="d-flex align-items-center position-relative my-1">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i
                                                                class="ni ni-zoom-split-in"></i></span>
                                                        <input class="form-control" placeholder="Search"
                                                            id="searchRegion" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                        </h3>
                                        <div class="card-toolbar">
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                <span class="svg-icon svg-icon-2">
                                                    <i class="bi bi-plus-square"></i>
                                                </span>
                                            </button>
                                            <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px"
                                                data-kt-menu="true" id="kt_menu_617b94b537c9a">
                                                <div class="">
                                                    <div class="fs-5 text-dark fw-bolder">Add Region</div>
                                                </div>
                                                <div class="separator border-gray-200"></div>
                                                <div class="">
                                                    <form action="/admin/configuration/location/store" method="post">
                                                        @csrf
                                                        <label class="form-label fw-bold">Name</label>
                                                        <input type="text" name="name" class="form-control"
                                                            required>
                                                        <div class="d-flex justify-content-end mt-2">
                                                            <button class="btn btn-sm btn-primary">Add</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body py-3">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-row-dashed" id="regionTable">
                                                <thead>
                                                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                        <th
                                                            class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">
                                                            No</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">
                                                            Region</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">
                                                            Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-gray-600 text-md fw-bold" style="border:none;">
                                                    @foreach ($region as $r)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $r->name }}</td>
                                                            <td>
                                                                <a class="btn btn-sm btn-warning"
                                                                    onclick="editModalLocation({{ $r->id }})"><i
                                                                        class="bi bi-pencil-square"></i></a>
                                                                <a href="/admin/configuration/location/delete/{{ $r->id }}"
                                                                    class="btn btn-sm btn-danger button-delete"><i
                                                                        class="bi bi-trash"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="kt_general_widget_1_9">
                                <div class="card">
                                    <div class="card-header border-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="card-label fw-bolder fs-3 mb-1">Permission Control</span>
                                        </h3>
                                        <div class="card-toolbar">
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                <span class="svg-icon svg-icon-2">
                                                    <i class="bi bi-info-circle"></i>
                                                </span>
                                            </button>
                                            <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px"
                                                data-kt-menu="true" id="kt_menu_617b94b537c9a">
                                                <div class="px-7 py-5">
                                                    <div class="fs-5 text-dark fw-bolder">Information <i
                                                            class="bi bi-info-circle"></i> </div>
                                                </div>
                                                <div class="separator border-gray-200"></div>
                                                <div class="px-7 py-5">
                                                    <p>This page for set the access any role to menu</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body  py-3">
                                        <div class="row">
                                            @foreach ($role as $r)
                                                <div class="col-md-4">
                                                    <div class="card shadow card-flush h-md-100">
                                                        <div class="card-header">
                                                            <div class="card-title">
                                                                <h2 class="text-gray-600 fw-bolder">{{ $r->role }}
                                                                </h2>
                                                            </div>
                                                        </div>
                                                        <div class="card-body pt-1">
                                                            <div class="d-flex flex-column text-gray-600">

                                                            </div>
                                                        </div>
                                                        <div class="card-footer flex-wrap pt-0">
                                                            <button type="button"
                                                                class="btn btn-light text-gray-600  my-1"
                                                                onclick="editModalPermission({{ $r->id }})">Edit
                                                                Permission</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Main Modal --}}

    <div class="modal fade" id="mainmodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header" id="mainmodal_header">
                    <h2 class="fw-bolder">Config</h2>
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
                    <!--Content-->
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="accessModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-1000px">
            <div class="modal-content">
                <div class="modal-header" id="accessModal_header">
                    <h2 class="fw-bolder">Config</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" onclick="tutupModalAccess()">
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
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7" id="contentAccess">
                    <!--Content-->
                </div>
            </div>
        </div>
    </div>

    {{-- End Main Modal --}}
@endsection


@section('js')
    {{-- DataTable Start --}}
    <script>
        $(document).ready(function() {
            var menuTable = $('#menuTable').DataTable({
                "bLengthChange": false,
                // "bFilter": true,
                "bInfo": false,
                'pageLength': 10,
            });
            $('#searchMenuTable').keyup(function() {
                menuTable.search($(this).val()).draw()
            });
        });
        $(document).ready(function() {
            var roleTable = $('#roleTable').DataTable({
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": false,
                'pageLength': 5
            });
            $('#searchRoleTable').keyup(function() {
                roleTable.search($(this).val()).draw()
            });
        });
        $(document).ready(function() {
            var regionTable = $('#regionTable').DataTable({
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": false,
                'pageLength': 5
            });
            $('#searchRegion').keyup(function() {
                regionTable.search($(this).val()).draw()
            });
        });
    </script>
    {{-- Datatable End --}}

    {{-- Hide url Start --}}

    <script>
        $(document).ready(function() {
            $('.select-2').select2({
                dropdownParent: $('#addmenuparent')
            });

        });
    </script>

    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toastr-bottom-left",
            "preventDuplicates": false,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    </script>

    <script>
        function editModalMenu(id) {
            toastr.info("Loading..");
            $.get("{{ url('/admin/configuration/menu/editmodal') }}/" + id, {}, function(data, status) {
                $('#kontennya').html(data)
                $('#mainmodal').modal('show')
            })
        }

        function editModalAccess(id) {
            toastr.info("Loading..");
            $.get("{{ url('/admin/configuration/useraccessmenu/editmodalaccess') }}/" + id, {}, function(data, status) {
                $('#contentAccess').html(data)
                $('#accessModal').modal('show')
            })
        }

        function editModalRole(id) {
            toastr.info("Loading..");
            $.get("{{ url('/admin/configuration/userrole/editmodalrole') }}/" + id, {}, function(data, status) {
                $('#kontennya').html(data)
                $('#mainmodal').modal('show')
            })
        }

        function editModalLocation(id) {
            toastr.info("Loading..");
            $.get("{{ url('/admin/configuration/location/editmodal') }}/" + id, {}, function(data, status) {
                $('#kontennya').html(data)
                $('#mainmodal').modal('show')
            })
        }

        function editModalPermission(id) {
            toastr.info("Loading..");
            $.get("{{ url('/admin/configuration/useraccessmenu/editpermissionmodal') }}/" + id, {}, function(data,
                status) {

                $('#contentAccess').html(data)
                $('#accessModal').modal('show')
            })
        }

        function tutupModal() {
            $('#mainmodal').modal('hide')
        }

        function tutupModalAccess() {
            $('#accessModal').modal('hide')
        }
    </script>
    {{-- Hide URL End --}}
@endsection
