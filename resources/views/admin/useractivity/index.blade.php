@extends('admin.layouts.main')


@section('content')

<div class="success-message" data-successmessage="{{ session('success') }}"></div>
<div class="toolbar py-5 py-lg-5" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Users Activity</h1>
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
                <div class="card-title">
                    <h2 class="mb-3">Users Activity</h2>
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
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
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
                            @foreach ($user as $usr)
                                <tr >
                                    <td class="d-flex align-items-center">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                            <a href="#">
                                                <div class="symbol-label">
                                                    <img src="{{ asset('storage/'. $usr->users->userdetail->image) }}"  class="w-100" />
                                                </div>
                                            </a>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <a href="#" class="text-gray-800 text-hover-primary mb-1">{{ $usr->users->UserDetail->nama }}</a>
                                            <span>{{ $usr->users->username }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $usr->menu }}</td>
                                    <td>{{ $usr->aktivitas }}</td>
                                    <td>{{ $usr->keterangan }}</td>
                                    <td>{{ $usr->created_at }}</td>
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

        $(document).ready(function () {
            $('#kt_table_users').DataTable({
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": false,
            });
        });


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
