   <header class="topbar">
       <div class="container-fluid">
           <div class="navbar-header">
               <div class="d-flex align-items-center">
                   <!-- Menu Toggle Button -->
                   <div class="topbar-item">
                       <button type="button" class="button-toggle-menu me-2">
                           <iconify-icon icon="solar:hamburger-menu-broken" class="fs-24 align-middle"></iconify-icon>
                       </button>
                   </div>

                   <!-- Menu Toggle Button -->
                   <div class="topbar-item">
                       <h4 class="fw-bold topbar-button pe-none text-uppercase mb-0">Welcome!</h4>
                   </div>

               </div>

               <div class="d-flex align-items-center gap-1">
                   <form class="app-search d-none d-md-block ms-2">
                       <div class="position-relative">
                           <input type="search" class="form-control" placeholder="Search..." autocomplete="off"
                               value="">
                           <iconify-icon icon="solar:magnifer-linear" class="search-widget-icon"></iconify-icon>
                       </div>
                   </form>

                   <!-- Theme Color (Light/Dark) -->
                   <div class="topbar-item">
                       <button type="button" class="topbar-button" id="light-dark-mode">
                           <iconify-icon icon="solar:moon-bold-duotone" class="fs-24 align-middle"></iconify-icon>
                       </button>
                   </div>
                   <div class="dropdown topbar-item">
                       @include('backend.notification.show')
                   </div>

                   <!-- Theme Setting -->
                   {{-- <div class="topbar-item d-none d-md-flex">
                       <button type="button" class="topbar-button" id="theme-settings-btn" data-bs-toggle="offcanvas"
                           data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
                           <iconify-icon icon="solar:settings-bold-duotone" class="fs-24 align-middle"></iconify-icon>
                       </button>
                   </div> --}}

                   <!-- Activity -->
                   <div class="topbar-item dropdown d-none d-md-flex">
                       @include('backend.message.message')
                   </div>
                   <div class="dropdown topbar-item">
                       <a type="button" class="topbar-button" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                           <span class="d-flex align-items-center">
                               @if (Auth()->user()->photo)
                                   <img class="img-profile rounded-circle" src="{{ Auth()->user()->photo }}">
                               @else
                                   <img class="img-profile rounded-circle" width="30px"
                                       src="{{ Storage::url('web/avatar.png') }}">
                               @endif
                           </span>
                       </a>
                       <div class="dropdown-menu dropdown-menu-end" style="">
                           <!-- item-->
                           <h6 class="dropdown-header">Welcome {{ Auth()->user()->name }}</h6>
                           <a class="dropdown-item" href="{{ route('admin-profile') }}">
                               <i class="bx bx-user-circle text-muted fs-18 align-middle me-1"></i><span
                                   class="align-middle">Profile</span>
                           </a>

                           <a class="dropdown-item" href="{{ route('settings') }}">
                               <i class="bx bx-help-circle text-muted fs-18 align-middle me-1"></i><span
                                   class="align-middle">Setting</span>
                           </a>
                           <a class="dropdown-item" href="{{ route('change.password.form') }}">
                               <i class="bx bx-lock text-muted fs-18 align-middle me-1"></i><span
                                   class="align-middle">Change Password</span>
                           </a>

                           <div class="dropdown-divider my-1"></div>

                           <a class="dropdown-item text-danger"
                               onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"
                               href="{{ route('logout') }}">
                               <i class="bx bx-log-out fs-18 align-middle me-1"></i><span class="align-middle">
                                   {{ __('Logout') }}</span>
                           </a>
                           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                               @csrf
                           </form>
                       </div>
                   </div>
                   <!-- App Search-->
               </div>
           </div>
       </div>
   </header>
