  <!-- Navbar -->
  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">

        <a class="font-weight-bolder text-white mb-0" href="/">Beranda</a>
      </nav>
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 justify-content-end" id="navbar">

        <div class="d-flex align-items-center">
            <div class="d-flex align-items-center ms-3 ms-lg-4">
                <a href="#"
                    class="btn btn-color-dark btn-outline btn-outline-none fs-8"><span
                        id="checkInternetSpeed"></span> <i class="bi bi-wifi"></i></a>
            </div>
            <div class="d-flex align-items-center flex-shrink-0">
                <div class="d-flex align-items-center ms-3 ms-lg-4" id="kt_header_user_menu_toggle">
                    <div class="btn btn-icon btn-color-dark btn-outline btn-outline-none w-30px h-30px w-lg-40px h-lg-40px"
                        data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                                    fill="black" />
                                <rect opacity="0.3" x="8" y="3" width="8" height="8"
                                    rx="4" fill="black" />
                            </svg>
                        </span>
                    </div>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                        data-kt-menu="true">

                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">

                                <div class="d-flex flex-column">
                                    <div class="fw-bolder d-flex align-items-center fs-5">{{ auth()->user()->name }}
                                        <span class="badge bg-gradient-primary fs-8 px-2 py-1 ms-2">{{ auth()->user()->userrole->role }}</span>

                                    </div>
                                    <a href="#"
                                        class="fw-bold text-muted text-hover-primary fs-7">{{ auth()->user()->email }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="separator my-2"></div>
                        <div class="menu-item px-3">
                            <a href="/admin/myprofile" class="menu-link px-3">Profil Saya</a>
                        </div>

                        <div class="separator my-2"></div>
                        @if (auth()->user()->userrole->role === 'Super Admin')
                            <div class="menu-item px-3 my-1">
                                <a href="/admin/useractivity" class="menu-link px-3">Aktifitas Pengguna</a>
                            </div>
                            <div class="menu-item px-3 my-1">
                                <a href="/admin/configuration/menu" class="menu-link px-3">Pengaturan</a>
                            </div>
                        @endif
                        <div class="menu-item px-3">
                            <form action="{{ route('logout') }}" method="POST" style="background: transparent;">
                                @csrf
                                <button type="submit" class="menu-link px-3"
                                    style="background: transparent; border:none;">Keluar</button>
                            </form>

                        </div>
                        <div class="separator my-2"></div>

                        {{-- <div class="menu-item px-3">
                            <div class="menu-content px-3">
                                <label
                                    class="form-check form-switch form-check-custom form-check-solid pulse pulse-success"
                                    for="kt_user_menu_dark_mode_toggle">
                                    <input class="form-check-input w-30px h-20px" type="checkbox"
                                        {{ session('darkmode') ? 'checked' : '' }} onchange="changeDarkMode()" />
                                    <span class="pulse-ring ms-n1"></span>
                                    <span class="form-check-label text-gray-600 fs-7">Dark Mode</span>
                                </label>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>

            @if (auth()->user()->userrole->role === 'Super Admin')
                <div class="d-flex align-items-center ms-3 ms-lg-4">
                    <div id="kt_drawer_chat_toggle"
                        class="btn btn-icon btn-color-dark btn-outline btn-outline-none
                        btn-outline btn-outline-none w-30px h-30px w-lg-40px h-lg-40px">
                        <div class="symbol symbol-25px">
                            <i class="bi bi-bell"></i>
                            <div id="notifycountnya">

                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>

        <ul class="navbar-nav">
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line bg-white"></i>
                        <i class="sidenav-toggler-line bg-white"></i>
                        <i class="sidenav-toggler-line bg-white"></i>
                    </div>
                </a>
            </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
