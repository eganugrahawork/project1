<div class="min-height-300 bg-primary position-absolute w-100"></div>
<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="/admin/dashboard"
            target="_blank">
            <img src="/herobiz/assets/img/brand-logo/thumb.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">Loccana</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main"
        style="margin: 0; height: 50%; overflow: hidden">
        <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
            id="kt_aside_menu" data-kt-menu="true">
            @if (session('menu'))
                @php
                    $x = session('menu')[0];
                    echo $x;
                @endphp
            @endif

        </div>
    </div>
    <div class="sidenav-footer mx-3 ">
        <div class="card card-plain shadow-none" id="sidenavCard">
            <img class="w-50 mx-auto" src="{{ asset('storage/'. auth()->user()->image) }}"
                alt="sidebar_illustration">
            <div class="card-body text-center p-3 w-100 pt-0">
                <div class="docs-info">
                    <h6 class="mb-0">{{ auth()->user()->name }}</h6>
                    <p class="text-xs font-weight-bold mb-0">{{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>
        <a href="/" target="_blank"
            class="btn btn-dark btn-sm w-100 mb-3">Beranda</a>
            <form action="{{ route('logout') }}" method="POST" style="background: transparent;">
                @csrf
                <button class="btn btn-primary btn-sm mb-0 w-100"
                href="" type="submit">Keluar</button>

            </form>
    </div>
</aside>


