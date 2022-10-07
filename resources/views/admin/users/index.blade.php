@extends('admin.layouts.main')


@section('content')

<div class="success-message" data-successmessage="{{ session('success') }}"></div>
<div class="toolbar py-5 py-lg-5" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">{{ $title }}</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                <li class="breadcrumb-item text-gray-600">
                    <a href="/admin/dashboard" class="text-gray-600 text-hover-primary">Admin</a>
                </li>
                <li class="breadcrumb-item text-gray-600">Users</li>

            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Container-->
</div>

<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
    <!--begin::Post-->
    <div class="content flex-row-fluid" id="kt_content">
        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <!--begin::Card title-->
                <div class="card-title align-items-start flex-column">
                    <h2 class="mb-3">User List</h2>
                    <div class="d-flex align-items-center position-relative my-1">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <input type="text" id="searchIndukTable" class="form-control form-control-solid w-250px ps-15" placeholder="User Search" />
                    </div>
                </div>
                @if  (auth()->user()->userrole->role ==='Super Admin')
                    <div class="card-toolbar">

                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <a class="btn btn-light-primary me-3" href="/admin/configuration/menu">
                            <span class="svg-icon svg-icon-2">
                                <i class="bi bi-menu-button-wide"></i>
                            </span>
                           Configuration</a>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
                                <span class="svg-icon svg-icon-2">
                                    <i class="bi bi-plus-square"></i>
                                </span>
                                Add User</button>
                            </div>
                    </div>
                @endif
            </div>
            <div class="card-body pt-0">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="indukTable">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">

                            <th class="min-w-50px">No</th>
                            <th class="min-w-125px">User</th>
                            <th class="min-w-125px">Email</th>
                            <th class="min-w-125px">Role</th>
                            <th class="min-w-125px">Region</th>
                            <th class="min-w-125px">Created at</th>
                            <th class="text-end min-w-100px">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-bold">
                        @foreach ($users as $usr)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="d-flex align-items-center">
                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                    <a href="#">
                                        <div class="symbol-label">
                                            <img src="{{ asset('storage/'. $usr->userdetail->image) }}" alt="" class="w-100" />
                                        </div>
                                    </a>
                                </div>
                                <div class="d-flex flex-column">
                                    <a href="#" class="text-gray-800 text-hover-primary mb-1">{{ $usr->UserDetail->nama }}</a>
                                    <span>{{ $usr->username }}</span>
                                </div>
                            </td>
                            <td>{{ $usr->email }}</td>
                            <td>
                                {{ $usr->userrole->role }}
                            </td>
                            <td>{{ $usr->userdetail->lokasi }}</td>
                            <td>{{ $usr->created_at }}</td>
                            <td class="text-end">
                                @if (auth()->user()->userrole->role ==='Super Admin')
                                    <button class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions <i class="bi bi-caret-down"></i></button>
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                        <div class="menu-item px-3">
                                            <a href="/admin/users/show/{{ $usr->id }}" class="menu-link px-3">View</a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a class="menu-link px-3" onclick="editModal({{ $usr->id }})" >Edit</a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="/admin/users/delete/{{ $usr->id }}" class="menu-link px-3 button-delete" data-kt-users-table-filter="delete_row">Delete</a>
                                        </div>
                                    </div>
                                @else
                                <a href="/admin/users/show/{{ $usr->id }}" class="btn btn-light btn-active-light-primary btn-sm">View</a>

                                @endif

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Post-->
</div>


{{-- Modal Add User --}}

<div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h2 class="fw-bolder">Add User</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <form id="kt_modal_add_user_form" class="form" action="/admin/users/store" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                        <div class="fv-row mb-7">
                            <label class="d-block fw-bold fs-6 mb-5">Image</label>
                            <div class="image-input image-input-outline" data-kt-image-input="true">
                                <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ url('storage/img-users/default.png') }});"></div>
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change Image">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                </label>
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                            </div>
                            <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                        </div>
                        <div class="fv-row mb-7">
                            <label class="required fw-bold fs-6 mb-2">Nama</label>
                            <input type="text" name="nama" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Nama Lengkap" required/>
                        </div>
                        <div class="fv-row mb-7">
                            <label class="required fw-bold fs-6 mb-2">Email</label>
                            <input type="email" name="email" oninput="checkEmail(this)" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="example@domain.com" required/>
                            <div class="form-text" style="color: red" id="demailmin"><i class="bi bi-x-circle-fill"></i> Harus Email</div>
                            <div class="form-text" style="color: rgb(207, 207, 29)" id="demailcheck"><i class="bi bi-arrow-clockwise"></i> Sedang Memeriksa</div>
                            <div class="form-text" style="color: red" id="demailcheckfalse"><i class="bi bi-x-circle-fill"></i> Email sudah ada</div>
                            <div class="form-text" style="color: rgb(61, 32, 187)" id="demailchecktrue"><i class="bi bi-check2-circle"></i> Email Bisa Digunakan</div>
                        </div>
                        <div class="fv-row mb-7">
                            <label class="required fw-bold fs-6 mb-2">No. Telp</label>
                            <input type="number" name="nokontak" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="081111111111" required/>
                        </div>
                        <div class="fv-row mb-7">
                            <label class="required fw-bold fs-6 mb-2">Alamat</label>
                            <input type="text" name="alamat" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
                        </div>
                        <div class="fv-row mb-7">
                            <label class="required fw-bold fs-6 mb-2">Wilayah</label>
                            <select class="form-select form-select-solid" name="lokasi" required>
                                @foreach ( $lokasi as $l )
                                <option value="{{ $l->lokasi }}">{{ $l->lokasi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="fv-row mb-7">
                            <label class="required fw-bold fs-6 mb-2">Username</label>
                            <input type="text" name="username" oninput="checkUsername(this)"  class="form-control form-control-solid mb-3 mb-lg-0"  required/>
                            <div class="form-text" style="color: red" id="dusrmin"><i class="bi bi-x-circle-fill"></i> Minimal 4 Karakter</div>
                            <div class="form-text" style="color: rgb(207, 207, 29)" id="dusrcheck"><i class="bi bi-arrow-clockwise"></i> Sedang Memeriksa</div>
                            <div class="form-text" style="color: red" id="dusrcheckfalse"><i class="bi bi-x-circle-fill"></i> Username sudah ada</div>
                            <div class="form-text" style="color: rgb(61, 32, 187)" id="dusrchecktrue"><i class="bi bi-check2-circle"></i> Bisa Digunakan</div>

                        </div>
                        <div class="fv-row mb-7">
                            <label class="required fw-bold fs-6 mb-2">Password</label>
                            <input type="password" name="password" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
                        </div>
                        <div class="mb-7">
                            <label class="required fw-bold fs-6 mb-5">Role</label>
                            @foreach ($role as $r )
                            <div class="d-flex fv-row">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input me-3" name="id_role" type="radio" value="{{ $r->id }}" id="kt_modal_update_role_option_0" checked='checked' />
                                    <label class="form-check-label" for="kt_modal_update_role_option_0">
                                        <div class="fw-bolder text-gray-800">{{ $r->role }}</div>
                                    </label>
                                </div>
                            </div>
                            <div class='separator separator-dashed my-5'></div>
                            @endforeach
                        </div>
                    </div>
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
                        <button type="submit" class="btn btn-primary" id="submitbuttonnya" data-kt-users-modal-action="submit">Submit</button>
                        <button type="button" class="btn btn-primary" data-kt-users-modal-action="submit" hidden>
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>

{{-- End Modal Add User --}}

<div class="modal fade" id="mainmodal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header" id="mainmodal_header">
                <h2 class="fw-bolder">Users</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" onclick="tutupModal()">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7" id="kontennya">
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>


@endsection

@section('js')

<script>
// Notif Validation set
 $("#dusrmin").hide()
 $("#dusrcheck").hide()
 $("#dusrcheckfalse").hide()
 $("#dusrchecktrue").hide()
 $("#demailmin").hide()
 $("#demailcheck").hide()
 $("#demailcheckfalse").hide()
 $("#demailchecktrue").hide()
// End Notif Validation set


        function checkUsername(e){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
            let valuenya = e.value;
            let sendData = {
                'value' : valuenya
            };

            if(valuenya.length < 4){
                $("#dusrmin").show()
                $("#submitbuttonnya").attr('disabled', false);
            }

            if(valuenya.length > 3){
                $("#dusrmin").hide()
                $("#dusrcheck").show()

                var APP_URL = {!! json_encode(url('/admin/users/checkusername')) !!}

                jQuery.ajax({
                    type: "POST",
                    url: APP_URL,
                    data: sendData,
                    cache: false,
                    success: function(response) {
                    if (response.success == true) {
                        $("#dusrcheck").hide()
                        $("#dusrcheckfalse").hide()
                        $("#dusrchecktrue").show()
                        $("#submitbuttonnya").attr('disabled', false);
                    } else {
                        $("#dusrchecktrue").hide()
                        $("#dusrcheck").hide()
                        $("#dusrcheckfalse").show()
                        $("#submitbuttonnya").attr('disabled', true);
                    }
                }
            });

            }

        }

        function checkEmail(e){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
            let valuenya = e.value;
            let sendData = {
                'value' : valuenya
            };

            if(valuenya.indexOf('@') <1){
                $("#demailchecktrue").hide()
                $("#demailcheck").hide()
                $("#demailmin").show()
                $("#submitbuttonnya").attr('disabled', false);
            }

            if(valuenya.indexOf('@') >= 1){
                $("#demailmin").hide()
                $("#demailcheck").show()

                var APP_URL = {!! json_encode(url('/admin/users/checkemail')) !!}

                jQuery.ajax({
                    type: "POST",
                    url: APP_URL,
                    data: sendData,
                    cache: false,
                    success: function(response) {
                    if (response.success == true) {
                        $("#demailcheck").hide()
                        $("#demailcheckfalse").hide()
                        $("#demailchecktrue").show()
                        $("#submitbuttonnya").attr('disabled', false);
                    } else {
                        $("#demailchecktrue").hide()
                        $("#demailcheck").hide()
                        $("#demailcheckfalse").show()
                        $("#submitbuttonnya").attr('disabled', true);
                    }
                }
            });

            }

        }

        function editModal(id){
            $.get("{{ url('/admin/users/editmodal') }}/"+id, {}, function(data, status){
                $('#kontennya').html(data)
                $('#mainmodal').modal('toggle')
            })
        }

        function tutupModal(){
            $('#mainmodal').modal('toggle')
        }
</script>

<script src="/metronic/assets/js/custom/apps/user-management/users/list/add.js"></script>
@endsection
