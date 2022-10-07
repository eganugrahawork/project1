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
                    <a href="/admin/dashboard" class="text-gray-600 text-hover-primary">{{ auth()->user()->name }} : {{ auth()->user()->userrole->role }}</a>
                </li>

            </ul>
        </div>
    </div>
</div>

<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
    <!--begin::Post-->
    <div class="content flex-row-fluid" id="kt_content">
        <!--begin::Row-->
        <div class="row gy-0 gx-10">
            <!--begin::Col-->
            <div class="col-xl-12">
                <!--begin::General Widget 1-->
                <div class="mb-10">
                    <!--begin::Tabs-->
                    <ul class="nav row mb-10">
                        <li class="nav-item col-12 col-lg mb-5 mb-lg-0">
                            <a class="nav-link active btn btn-flex btn-color-gray-400 btn-outline btn-outline-default btn-active-primary d-flex flex-grow-1 flex-column flex-center py-5 h-1250px h-lg-175px" data-bs-toggle="tab" href="#kt_general_widget_1_1">
                                <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                                <span class="svg-icon svg-icon-3x mb-5 mx-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
                                            <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                            <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                            <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                        </g>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <span class="fs-6 fw-bold">Menu
                                <br />Data</span>
                            </a>
                        </li>
                        <li class="nav-item col-12 col-lg mb-5 mb-lg-0">
                            <a class="nav-link btn btn-flex btn-color-gray-400 btn-outline btn-outline-default btn-active-primary d-flex flex-grow-1 flex-column flex-center py-5 h-1250px h-lg-175px" data-bs-toggle="tab" href="#kt_general_widget_1_5">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                                <span class="svg-icon svg-icon-3x mb-5 mx-0">
                                    <i class="bi bi-diagram-3-fill"></i>
                                </span>
                                <!--end::Svg Icon-->
                                <span class="fs-6 fw-bold">Submenu
                                <br />Data</span>
                            </a>
                        </li>
                        <li class="nav-item col-12 col-lg mb-5 mb-lg-0">
                            <a class="nav-link btn btn-flex btn-color-gray-400 btn-outline btn-outline-default btn-active-primary d-flex flex-grow-1 flex-column flex-center py-5 h-1250px h-lg-175px" data-bs-toggle="tab" href="#kt_general_widget_1_7">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                                <span class="svg-icon svg-icon-3x mb-5 mx-0">
                                    <i class="bi bi-person-badge-fill"></i>
                                </span>
                                <!--end::Svg Icon-->
                                <span class="fs-6 fw-bold">Role
                                <br />Data</span>
                            </a>
                        </li>
                        <li class="nav-item col-12 col-lg mb-5 mb-lg-0">
                            <a class="nav-link btn btn-flex btn-color-gray-400 btn-outline btn-outline-default btn-active-primary d-flex flex-grow-1 flex-column flex-center py-5 h-1250px h-lg-175px" data-bs-toggle="tab" href="#kt_general_widget_1_8">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                                <span class="svg-icon svg-icon-3x mb-5 mx-0">
                                    <i class="bi bi-geo"></i>
                                </span>
                                <!--end::Svg Icon-->
                                <span class="fs-6 fw-bold">Region
                                <br />Data</span>
                            </a>
                        </li>
                        <li class="nav-item col-12 col-lg mb-5 mb-lg-0">
                            <a class="nav-link btn btn-flex btn-color-gray-400 btn-outline btn-outline-default btn-active-primary d-flex flex-grow-1 flex-column flex-center py-5 h-1250px h-lg-175px" data-bs-toggle="tab" href="#kt_general_widget_1_6">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                                <span class="svg-icon svg-icon-3x mb-5 mx-0">
                                    <i class="bi bi-signpost-split"></i>
                                </span>
                                <!--end::Svg Icon-->
                                <span class="fs-6 fw-bold">Access
                                <br />Control</span>
                            </a>
                        </li>
                        <li class="nav-item col-12 col-lg mb-5 mb-lg-0">
                            <a class="nav-link btn btn-flex btn-color-gray-400 btn-outline btn-outline-default btn-active-primary d-flex flex-grow-1 flex-column flex-center py-5 h-1250px h-lg-175px" data-bs-toggle="tab" href="#kt_general_widget_1_9">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                                <span class="svg-icon svg-icon-3x mb-5 mx-0">
                                    <i class="bi bi-signpost-split"></i>
                                </span>
                                <!--end::Svg Icon-->
                                <span class="fs-6 fw-bold">Permission Role
                                <br />Control</span>
                            </a>
                        </li>
                    </ul>
                    <!--begin::Tab content-->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="kt_general_widget_1_1">
                            <!--begin::Tables Widget 2-->
                            <div class="card">
                                <!--begin::Header-->
                                <div class="card-header border-0 pt-5">
                                    <div class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bolder fs-3 mb-1">Menu </span>
                                        <span class="text-muted mt-1 fw-bold fs-7"></span>
                                        <div class="d-flex align-items-center position-relative my-1">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            <input type="text" id="searchMenuTable" class="form-control form-control-solid w-250px ps-15" placeholder="Menu Search" />
                                        </div>
                                    </div>
                                    <div class="card-toolbar">
                                        <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <span class="svg-icon svg-icon-2">
                                                <i class="bi bi-plus-square"></i>
                                            </span>
                                        </button>
                                        <!--begin::Menu 1-->
                                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_617b94b52ee36">
                                            <div class="px-7 py-5">
                                                <div class="fs-5 text-dark fw-bolder">Add Menues</div>
                                            </div>
                                            <div class="separator border-gray-200"></div>
                                            <div class="px-7 py-5">
                                                <form action="/admin/configuration/menu/store" method="post">
                                                    @csrf
                                                    <label class="form-label fw-bold">Menu</label>
                                                    <input type="text" name="menu" class="form-control" required>
                                                    <div id="isurlparent">
                                                        <label class="form-label fw-bold">Url</label>
                                                        <input type="text" id="isurl" class="form-control" name="url">
                                                    </div>
                                                    <label class="form-label fw-bold">Is Submenu:</label>
                                                    <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" name="is_submenu" id="formissubmenu" onclick="submenuactive(this)" />
                                                        <label class="form-check-label">Enable</label>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <button class="btn btn-sm btn-primary">Add</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body py-3">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-dashed" id="menuTable">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                    <th class="min-w-50px">No</th>
                                                    <th class="min-w-150px">Menu</th>
                                                    <th class="min-w-125px">Url</th>
                                                    <th class="min-w-50px">Submenu</th>
                                                    <th class="text-end min-w-100px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-gray-600 fw-bold">
                                                @foreach ($menu as $m )
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $m->menu }}</td>
                                                    <td>{{ $m->url }}</td>
                                                    <td>@if ($m->is_submenu == 1)
                                                        <i class="bi bi-check"></i>
                                                    @else
                                                    x
                                                    @endif
                                                </td>
                                                    <td class="text-end">
                                                        <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions <i class="bi bi-caret-down"></i></a>
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                                            <div class="menu-item px-3">
                                                                <a class="menu-link px-3" onclick="editModalMenu({{ $m->id }})" >Edit</a>
                                                            </div>
                                                            <div class="menu-item px-3">
                                                                <a href="/admin/configuration/menu/delete/{{ $m->id }}" class="menu-link px-3 button-delete" data-kt-users-table-filter="delete_row">Delete</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Tables Widget 2-->
                        </div>
                        <div class="tab-pane fade" id="kt_general_widget_1_5">
                            <!--begin::Tables Widget 1-->
                            <div class="card">
                                <!--begin::Header-->
                                <div class="card-header border-0 pt-5">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bolder fs-3 mb-1">Submenu</span>
                                        <div class="d-flex align-items-center position-relative my-1">
											<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
											<span class="svg-icon svg-icon-1 position-absolute ms-6">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
													<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
												</svg>
											</span>
											<!--end::Svg Icon-->
											<input type="text" id="searchSubmenu" class="form-control form-control-solid w-250px ps-15" placeholder="Submenu Search" />
										</div>
                                    </h3>
                                    <div class="card-toolbar">
                                        <!--begin::Menu-->
                                        <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <i class="bi bi-plus-square"></i>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </button>
                                        <!--begin::Menu 1-->
                                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_617b94b537c9a">
                                            <!--begin::Header-->
                                            <div class="px-7 py-5">
                                                <div class="fs-5 text-dark fw-bolder">Add Submenu</div>
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Menu separator-->
                                            <div class="separator border-gray-200"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Form-->
                                            <div class="px-7 py-5">
                                                <form action="/admin/configuration/submenu/store" method="post">
                                                    @csrf
                                                    <label class="form-label fw-bold">Submenu</label>
                                                    <input type="text" name="submenu" class="form-control" required>
                                                    <div>
                                                        <label class="form-label fw-bold">Menu</label>
                                                    <select class="form-select" name="id_menu">
                                                        @foreach ($menu as $m)
                                                        @if ($m->is_submenu)
                                                            <option value="{{ $m->id }}">{{ $m->menu }}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                    </div>
                                                    <div>
                                                        <label class="form-label fw-bold">Icon</label>
                                                        <input type="text" class="form-control" name="icon" required>
                                                    </div>
                                                    <div>
                                                        <label class="form-label fw-bold">Url</label>
                                                        <input type="text" class="form-control" name="urlsubmenu" required>
                                                    </div>

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
                                        <table class="table align-middle table-row-dashed" id="submenuTable">
                                            <thead>
                                                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                    <th class="min-w-50px">No</th>
                                                    <th class="min-w-100px">Submenu</th>
                                                    <th class="min-w-100px">Menu</th>
                                                    <th class="min-w-100px">Url</th>
                                                    <th class="min-w-100px">Icon</th>
                                                    <th class="text-end min-w-100px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-gray-600 fw-bold">
                                                @foreach ($submenu as $sm )
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $sm->submenu }}</td>
                                                    <td>{{ $sm->usermenu->menu }}</td>
                                                    <td class="text-wrap">{{ $sm->urlsubmenu }}</td>
                                                    <td>{{ $sm->icon }}</td>
                                                    <td class="text-end">
                                                        <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions <i class="bi bi-caret-down"></i></a>
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                                            <div class="menu-item px-3">
                                                                <a class="menu-link px-3" onclick="editModalSubmenu({{ $sm->id }})" >Edit</a>
                                                            </div>
                                                            <div class="menu-item px-3">
                                                                <a href="/admin/configuration/submenu/delete/{{ $sm->id }}" class="menu-link px-3 button-delete" data-kt-users-table-filter="delete_row">Delete</a>
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
                        <div class="tab-pane fade" id="kt_general_widget_1_6">
                            <!--begin::Tables Widget 1-->
                            <div class="card">
                                <!--begin::Header-->
                                <div class="card-header border-0 pt-5">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bolder fs-3 mb-1">Access</span>
                                    </h3>
                                    <div class="card-toolbar">
                                        <!--begin::Menu-->
                                        <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <i class="bi bi-info-circle"></i>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </button>
                                        <!--begin::Menu 1-->
                                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_617b94b537c9a">
                                            <!--begin::Header-->
                                            <div class="px-7 py-5">
                                                <div class="fs-5 text-dark fw-bolder">Information <i class="bi bi-info-circle"></i> </div>
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Menu separator-->
                                            <div class="separator border-gray-200"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Form-->
                                            <div class="px-7 py-5">
                                               <p>This page for set the access any role to menu</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body py-3">
                                    <div class="row">
                                    @foreach ($role as $r )
                                        <div class="col-md-4">
                                            <div class="card card-flush h-md-100">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <h2>{{ $r->role }}</h2>
                                                    </div>
                                                </div>
                                                @php
                                                    $getmenu = DB::select("select b.menu from user_access_menus a join user_menus b on a.id_menu = b.id where id_role=$r->id ");
                                                    $getUser = DB::select("select username from users where id_role = $r->id");
                                                    $jmlUser = count($getUser)
                                                @endphp

                                                <div class="card-body pt-1">
                                                    <div class="fw-bolder text-gray-600 mb-5">Total users with this role: {{ $jmlUser }}</div>
                                                    <div class="d-flex flex-column text-gray-600">
                                                <h5>Menu</h5>
                                                <div class="row">
                                                    @foreach ($getmenu as $gm )
                                                    <div class="d-flex align-items-center py-2 col-lg-6">
                                                        <span class="bullet bg-primary me-3"></span>{{ $gm->menu }}
                                                    </div>
                                                    @endforeach
                                                </div>

                                                    </div>
                                                </div>
                                                <div class="card-footer flex-wrap pt-0">
                                                    <a href="/admin/configuration/userrole/viewrole/{{ $r->id }}" class="btn btn-light btn-active-primary my-1 me-2">View Role</a>
                                                    <button type="button" class="btn btn-light btn-active-light-primary my-1" onclick="editModalAccess({{ $r->id }})">Edit Role</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="kt_general_widget_1_7">
                            <!--begin::Tables Widget 1-->
                            <div class="d-flex justify-content-center">
                            <div class="card col-lg-6">
                                <!--begin::Header-->
                                <div class="card-header border-0 pt-5">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bolder fs-3 mb-1">Role</span>
                                        <div class="d-flex align-items-center position-relative my-1">
											<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
											<span class="svg-icon svg-icon-1 position-absolute ms-6">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
													<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
												</svg>
											</span>
											<!--end::Svg Icon-->
											<input type="text" id="searchRole" class="form-control form-control-solid w-250px ps-15" placeholder="Role Search" />
										</div>
                                    </h3>
                                    <div class="card-toolbar">
                                        <!--begin::Menu-->
                                        <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <i class="bi bi-plus-square"></i>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </button>
                                        <!--begin::Menu 1-->
                                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_617b94b537c9a">
                                            <!--begin::Header-->
                                            <div class="px-7 py-5">
                                                <div class="fs-5 text-dark fw-bolder">Add Role</div>
                                            </div>
                                            <div class="separator border-gray-200"></div>
                                            <div class="px-7 py-5">
                                                <form action="/admin/configuration/userrole/store" method="post">
                                                    @csrf
                                                    <label class="form-label fw-bold">Role</label>
                                                    <input type="text" name="role" class="form-control" required>

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
                                                    <th class="min-w-50px">No</th>
                                                    <th class="min-w-100px">Role</th>
                                                    <th class="text-end min-w-100px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-gray-600 fw-bold">
                                                @foreach ($role as $r )
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $r->role }}</td>
                                                    <td class="text-end">
                                                        <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions <i class="bi bi-caret-down"></i></a>
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                                            <div class="menu-item px-3">
                                                                <a class="menu-link px-3" onclick="editModalRole({{ $r->id }})" >Edit</a>
                                                            </div>
                                                            <div class="menu-item px-3">
                                                                <a href="/admin/configuration/userrole/delete/{{ $r->id }}" class="menu-link px-3 button-delete" data-kt-users-table-filter="delete_row">Delete</a>
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
                        <div class="tab-pane fade" id="kt_general_widget_1_8">
                            <!--begin::Tables Widget 1-->
                            <div class="d-flex justify-content-center">
                            <div class="card col-lg-6">
                                <!--begin::Header-->
                                <div class="card-header border-0 pt-5">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bolder fs-3 mb-1">Region</span>
                                        <div class="d-flex align-items-center position-relative my-1">
											<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
											<span class="svg-icon svg-icon-1 position-absolute ms-6">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
													<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
												</svg>
											</span>
											<!--end::Svg Icon-->
											<input type="text" id="searchRegion" class="form-control form-control-solid w-250px ps-15" placeholder="Region Search" />
										</div>
                                    </h3>
                                    <div class="card-toolbar">
                                        <!--begin::Menu-->
                                        <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <i class="bi bi-plus-square"></i>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </button>
                                        <!--begin::Menu 1-->
                                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_617b94b537c9a">
                                            <!--begin::Header-->
                                            <div class="px-7 py-5">
                                                <div class="fs-5 text-dark fw-bolder">Add Region</div>
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Menu separator-->
                                            <div class="separator border-gray-200"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Form-->
                                            <div class="px-7 py-5">
                                                <form action="/admin/configuration/location/store" method="post">
                                                    @csrf
                                                    <label class="form-label fw-bold">Name</label>
                                                    <input type="text" name="name" class="form-control" required>
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
                                                    <th class="min-w-50px">No</th>
                                                    <th class="min-w-100px">Region</th>
                                                    <th class="text-end min-w-100px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-gray-600 fw-bold">
                                                @foreach ($region as $r )
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $r->name }}</td>
                                                    <td class="text-end">
                                                        <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions <i class="bi bi-caret-down"></i></a>
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                                            <div class="menu-item px-3">
                                                                <a class="menu-link px-3" onclick="editModalLocation({{ $r->id }})" >Edit</a>
                                                            </div>
                                                            <div class="menu-item px-3">
                                                                <a href="/admin/configuration/location/delete/{{ $r->id }}" class="menu-link px-3 button-delete" data-kt-users-table-filter="delete_row">Delete</a>
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
                        <div class="tab-pane fade" id="kt_general_widget_1_9">
                            <!--begin::Tables Widget 1-->
                            <div class="card">
                                <!--begin::Header-->
                                <div class="card-header border-0 pt-5">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bolder fs-3 mb-1">Permission Role</span>
                                    </h3>
                                    <div class="card-toolbar">
                                        <!--begin::Menu-->
                                        <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <i class="bi bi-info-circle"></i>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </button>
                                        <!--begin::Menu 1-->
                                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_617b94b537c9a">
                                            <!--begin::Header-->
                                            <div class="px-7 py-5">
                                                <div class="fs-5 text-dark fw-bolder">Information <i class="bi bi-info-circle"></i> </div>
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Menu separator-->
                                            <div class="separator border-gray-200"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Form-->
                                            <div class="px-7 py-5">
                                               <p>This page for set the access any role to menu</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body py-3">
                                    <div class="row">
                                    @foreach ($role as $r )
                                        <div class="col-md-4">
                                            <div class="card card-flush h-md-100">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <h2>{{ $r->role }}</h2>
                                                    </div>
                                                </div>
                                                @php
                                                    $getmenu = DB::select("select b.menu from user_access_menus a join user_menus b on a.id_menu = b.id where id_role=$r->id ");
                                                @endphp

                                                <div class="card-body pt-1">
                                                    <div class="d-flex flex-column text-gray-600">
                                                <h5>Menu</h5>
                                                <div class="row">
                                                    @foreach ($getmenu as $gm )
                                                    <div class="d-flex align-items-center py-2 ">
                                                        <span class="bullet bg-primary me-3"></span>{{ $gm->menu }}
                                                    </div>
                                                    @endforeach
                                                </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer flex-wrap pt-0">

                                                    <button type="button" class="btn btn-light btn-active-light-primary my-1" onclick="editModalPermission({{ $r->id }})">Edit Permission</button>
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
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
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
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
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
        $(document).ready(function () {
         var menuTable =  $('#menuTable').DataTable({
                "bLengthChange": false,
                // "bFilter": true,
                "bInfo": false,
                'pageLength' : 5,
            });
            $('#searchMenu').keyup(function () {
                menuTable.search($(this).val()).draw()
            });
        });
        $(document).ready(function () {
         var submenuTable =  $('#submenuTable').DataTable({
                "bLengthChange": false,
                // "bFilter": true,
                "bInfo": false,
                'pageLength' : 5,
            });
            $('#searchSubmenu').keyup(function () {
                submenuTable.search($(this).val()).draw()
            });
        });
        $(document).ready(function () {
           var roleTable = $('#roleTable').DataTable({
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": false,
                'pageLength' : 5
            });
            $('#searchRole').keyup(function () {
                roleTable.search($(this).val()).draw()
            });
        });
        $(document).ready(function () {
           var regionTable =  $('#regionTable').DataTable({
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": false,
                'pageLength' : 5
            });
            $('#searchRegion').keyup(function () {
                regionTable.search($(this).val()).draw()
            });
        });
</script>
{{-- Datatable End --}}

{{-- Hide url Start --}}
<script>

    function submenuactive(e){
        if(e.checked == true){
            $('#isurlparent').hide()
            $('#isurl').value(null)
        }else{
            $('#isurlparent').show()
            $('#isurl').value(null)

        }
    }

    function editModalMenu(id){
            $.get("{{ url('/admin/configuration/menu/editmodal') }}/"+id, {}, function(data, status){
                $('#kontennya').html(data)
                $('#mainmodal').modal('show')
            })
        }
    function editModalSubmenu(id){
            $.get("{{ url('/admin/configuration/submenu/editmodal') }}/"+id, {}, function(data, status){
                $('#kontennya').html(data)
                $('#mainmodal').modal('show')
            })
        }

        function editModalAccess(id){
            $.get("{{ url('/admin/configuration/useraccessmenu/editmodalaccess') }}/"+id, {}, function(data, status){
                $('#contentAccess').html(data)
                $('#accessModal').modal('show')
            })
        }

        function editModalRole(id){
            $.get("{{ url('/admin/configuration/userrole/editmodalrole') }}/"+id, {}, function(data, status){
                $('#kontennya').html(data)
                $('#mainmodal').modal('show')
            })
        }
        function editModalLocation(id){
            $.get("{{ url('/admin/configuration/location/editmodal') }}/"+id, {}, function(data, status){
                $('#kontennya').html(data)
                $('#mainmodal').modal('show')
            })
        }
        function editModalPermission(id){
            $.get("{{ url('/admin/configuration/useraccessmenu/editpermissionmodal') }}/"+id, {}, function(data, status){
                $('#contentAccess').html(data)
                $('#accessModal').modal('show')
            })
        }

    function tutupModal(){
            $('#mainmodal').modal('hide')
        }
    function tutupModalAccess(){
            $('#accessModal').modal('hide')
        }

</script>
{{-- Hide URL End --}}
@endsection
