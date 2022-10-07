@extends('admin.layouts.main')


@section('content')
    <div class="toolbar py-5 py-lg-5" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
            <div class="page-title d-flex flex-column me-3">
                <h1 class="d-flex text-dark fw-bolder my-1 fs-3">View Role Details</h1>
                <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                    <li class="breadcrumb-item text-gray-600">
                        <a href="" class="text-gray-600 text-hover-primary">{{ auth()->user()->userrole->role }}</a>
                    </li>
                    <li class="breadcrumb-item text-gray-500">View Roles</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <div class="content flex-row-fluid" id="kt_content">
            <div class="d-flex flex-column flex-lg-row">
                <div class="flex-column flex-lg-row-auto w-100 w-lg-200px w-xl-300px mb-10">
                    <div class="card card-flush">
                        <div class="card-header">
                            <div class="card-title">
                                <h2 class="mb-0">{{ $role->role }}</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="d-flex flex-column text-gray-600">
                                @foreach ($menurole as $mr)

                                    <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>{{ $mr->usermenu->menu }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>


                <div class="flex-lg-row-fluid ms-lg-10">
                    <div class="card card-flush mb-6 mb-xl-9">
                        <div class="card-header pt-5">
                            <div class="card-title">
                                <h2 class="d-flex align-items-center">Users Assigned In Role</h2>
                            </div>

                        </div>
                        <div class="card-body pt-0">
                            <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_roles_view_table">
                                <thead>
                                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="min-w-50px">No</th>
                                        <th class="min-w-150px">User</th>
                                        <th class="min-w-150px">Email</th>
                                        <th class="min-w-150px">Region</th>
                                        <th class="text-end min-w-100px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-bold text-gray-600">
                                    @foreach ( $user as $usr )
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="d-flex align-items-center">
                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                    <a href="../../demo11/dist/apps/user-management/users/view.html">
                                                        <div class="symbol-label">
                                                            <img src="{{ asset('storage/'.$usr->userdetail->image) }}" class="w-100" />
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <a href="" class="text-gray-800 text-hover-primary mb-1">{{ $usr->userdetail->nama }}</a>
                                                    <span>{{ $usr->username }}</span>
                                                </div>
                                            </td>
                                            <td>{{ $usr->email }}</td>
                                            <td>{{ $usr->userdetail->lokasi }}</td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                <span class="svg-icon svg-icon-5 m-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                    </svg>
                                                </span></a>
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                                    <div class="menu-item px-3">

                                                        <a onclick="editCustomAccess({{ $usr->id }})" class="menu-link px-3" >Edit</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
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

{{-- End Main Modal --}}


@endsection

@section('js')


<script>
    function editCustomAccess(id){
            $.get("{{ url('/admin/configuration/useraccessmenu/editcustomaccess') }}/"+id, {}, function(data, status){
                $('#kontennya').html(data)
                $('#mainmodal').modal('show')
            })
    }

    function tutupModal(){
            $('#mainmodal').modal('hide')
    }

</script>


@endsection
