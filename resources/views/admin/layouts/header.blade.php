<!--begin::Header-->
<div id="kt_header" class="header" data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
    <!--begin::Container-->
    <div class="container-xxl d-flex flex-grow-1 flex-stack">
        <div class="d-flex align-items-center me-5">
            <div class="d-lg-none btn btn-icon btn-active-color-primary w-30px h-30px ms-n2 me-3" id="kt_header_menu_toggle">
                <span class="svg-icon svg-icon-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
                        <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </div>
            <img alt="Logo" src="{{ asset('storage/logos/loccanalogo.png') }}" class="h-30px h-lg-40px" />
        </div>
        <div class="d-flex align-items-center">
            <!--begin::Topbar-->
            <div class="d-flex align-items-center flex-shrink-0">
                <!--begin::Search-->
                <div id="kt_header_search" class="d-flex align-items-center w-lg-225px" data-kt-search-keypress="true" data-kt-search-min-length="2" data-kt-search-enter="enter" data-kt-search-layout="menu" data-kt-search-responsive="lg" data-kt-menu-trigger="auto" data-kt-menu-permanent="true" data-kt-menu-placement="bottom-end">
                    <!--begin::Tablet and mobile search toggle-->
                    <div data-kt-search-element="toggle" class="d-flex d-lg-none align-items-center">
                        <div class="btn btn-icon btn-color-gray-700 btn-active-color-primary btn-outline btn-outline-secondary w-30px h-30px">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen004.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z" fill="black" />
                                    <path opacity="0.3" d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center ms-3 ms-lg-4" id="kt_header_user_menu_toggle">
                    <div class="btn btn-icon btn-color-gray-700 btn-active-color-primary btn-outline btn-outline-secondary w-30px h-30px w-lg-40px h-lg-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="black" />
                                <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::User icon-->
                    <!--begin::Menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-50px me-5">
                                    <img alt="Logo" src="{{ asset('storage/'. auth()->user()->userdetail->image) }}" />
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Username-->
                                <div class="d-flex flex-column">
                                    <div class="fw-bolder d-flex align-items-center fs-5">{{ auth()->user()->userdetail->nama }}
                                    <span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">{{ auth()->user()->userrole->role }}</span></div>
                                    <a href="#" class="fw-bold text-muted text-hover-primary fs-7">{{ auth()->user()->email }}</a>
                                </div>
                                <!--end::Username-->
                            </div>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu separator-->
                        <div class="separator my-2"></div>
                        <!--end::Menu separator-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <a href="/admin/myprofile" class="menu-link px-5">My Profile</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        {{-- <div class="menu-item px-5">
                            <a href="../../demo11/dist/pages/projects/list.html" class="menu-link px-5">
                                <span class="menu-text">My Projects</span>
                                <span class="menu-badge">
                                    <span class="badge badge-light-danger badge-circle fw-bolder fs-7">3</span>
                                </span>
                            </a>
                        </div> --}}
                        <!--end::Menu item-->

                        <!--begin::Menu item-->

                        <!--end::Menu item-->
                        <!--begin::Menu separator-->
                        <div class="separator my-2"></div>
                        <!--end::Menu separator-->

                        <!--begin::Menu item-->
                        @if (auth()->user()->userrole->role === 'Super Admin')

                        <div class="menu-item px-5 my-1">
                            <a href="/admin/useractivity" class="menu-link px-5">User Activity</a>
                        </div>
                        <div class="menu-item px-5 my-1">
                            <a href="/admin/configuration/menu" class="menu-link px-5">Configuration</a>
                        </div>
                        @endif
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <form  action="{{ route('logout') }}" method="POST" style="background: transparent;" >
                                @csrf
                                <button type="submit" class="menu-link px-5" style="background: transparent; border:none;">Sign Out</button>
                            </form>

                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu separator-->
                        <div class="separator my-2"></div>
                    </div>
                    <!--end::Menu-->
                    <!--end::Menu wrapper-->
                </div>
                <!--end::User -->

            </div>
            <!--end::Topbar-->
        </div>
        <!--end::Topbar-->
    </div>
    <div class="separator"></div>
    <!--end::Separator-->
    <!--begin::Container-->
    <div class="header-menu-container container-xxl d-flex flex-stack h-lg-75px" id="kt_header_nav">
        <!--begin::Menu wrapper-->
        <div class="header-menu flex-column flex-lg-row" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
            <!--begin::Menu-->
            <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch flex-grow-1" id="#kt_header_menu" data-kt-menu="true">

                    @php
                        $roleId = auth()->user()->id_role;
                        $menu = DB::select("select b.id, b.menu,  b.url, b.is_submenu from user_access_menus a join user_menus b on a.id_menu = b.id where a.id_role = $roleId");
                    @endphp

                @foreach ($menu as $m )
                    @php
                        $str = substr($m->url, 1);
                        $customaccess = DB::select('select * from custom_access_blocks where id_user = '. auth()->user()->id.' and  id_menu = '.$m->id);
                    @endphp

                    @if ($customaccess)

                    @else

                    @if ($m->is_submenu == true)
                        @php
                            $submenu = DB::select("select * from user_submenus where id_menu = $m->id");
                            $reqLink = Request::fullUrl();
                            $namaMenu = strtolower($m->menu);
                            $check = strpos($reqLink, $namaMenu);
                        @endphp
                            <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" class="menu-item {{ $check == true ? 'here show' : ''}} menu-lg-down-accordion me-lg-1">
                                <span class="menu-link  py-3">
                                    <span class="menu-title">{{ $m->menu }}</span>
                                    <span class="menu-arrow d-lg-none"></span>
                                </span>
                                <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px">


                            @foreach ($submenu as $sub )
                            @php
                                $subnya = DB::select('select * from user_access_submenus where id_submenu = '.$sub->id.' and id_role = '.auth()->user()->userrole->id);
                            @endphp
                            @if ($subnya)

                            <div class="menu-item">
                                <a class="menu-link py-3" href="{{ $sub->urlsubmenu }}"  data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon | path: /icons/duotune/general/gen002.svg-->
                                        <span class="svg-icon svg-icon-2">
                                            <i class="bi bi-{{ $sub->icon }}"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">{{ $sub->submenu }}</span>
                                </a>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                @else
                    @php
                        $str = substr($m->url, 1);
                    @endphp
                        <div  class="menu-item   me-lg-1">
                            <a class="menu-link {{ Request::is($str) ? 'active' : ''}} py-3" href="{{ $m->url }}">
                                <span class="menu-title">{{ $m->menu }}</span>
                                <span class="menu-arrow d-lg-none"></span>
                            </a>
                        </div>
                @endif
                @endif
                @endforeach

            </div>
            <!--end::Menu-->

        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::Container-->
</div>
<!--end::Header-->
