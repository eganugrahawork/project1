<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
      <ul class="nav flex-column">
        @php
            $roleId = auth()->user()->id_role;
            $menu = DB::select("select b.id, b.menu, b.icon, b.url, b.is_submenu from user_access_menus a join user_menus b on a.id_menu = b.id where a.id_role = $roleId");
        @endphp

    @foreach ($menu as $m )
        @php
            $str = substr($m->url, 1);
        @endphp
        @if ($m->is_submenu == true)
         @php
             $submenu = DB::select("select * from user_submenus where id_menu = $m->id");
             $reqLink = Request::fullUrl();
             $namaMenu = strtolower($m->menu);
             $check = strpos($reqLink, $namaMenu);
         @endphp
            <div class="btn-group dropend">
                <a class="nav-link dropdown-toggle {{ $check == true ? 'active' : ''}}" data-bs-toggle="dropdown" aria-expanded="false" href="#">
                  <span data-feather="{{ $m->icon }}" class="align-text-bottom"></span>
                {{ $m->menu }}
                </a>
                <ul class="dropdown-menu">
                  @foreach ($submenu as $sub )
                  <li><a class="dropdown-item" href="{{ $sub->urlsubmenu }}">{{ $sub->submenu }}</a></li>
                  @endforeach
                </ul>
            </div>
        @else
        @php
            $str = substr($m->url, 1);
        @endphp
            <li class="nav-item">
                <a class="nav-link {{ Request::is($str) ? 'active' : ''}}" href="{{ $m->url }}">
                <span data-feather="{{ $m->icon }}" class="align-text-bottom"></span>
                {{ $m->menu }}
            </a>
            </li>
    @endif
    @endforeach


      </ul>


    </div>
  </nav>
