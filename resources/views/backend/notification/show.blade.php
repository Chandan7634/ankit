<button type="button" class="topbar-button position-relative" id="page-header-notifications-dropdown1"
    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <iconify-icon icon="solar:bell-bing-bold-duotone" class="fs-24 align-middle"></iconify-icon>
    <span class="position-absolute topbar-badge fs-10 translate-middle badge bg-danger rounded-pill">
        @if (count(Auth::user()->unreadNotifications) > 5)
            <span data-count="5" class="count">5+</span>
        @else
            <span class="count"
                data-count="{{ count(Auth::user()->unreadNotifications) }}">{{ count(Auth::user()->unreadNotifications) }}</span>
        @endif
        {{-- <span class="visually-hidden">unread messages</span> --}}
    </span>
</button>
<div class="dropdown-menu py-0 dropdown-lg dropdown-menu-end" aria-labelledby="page-header-notifications-dropdown1">
    <div class="p-3 border-top-0 border-start-0 border-end-0 border-dashed border">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="m-0 fs-16 fw-semibold"> Notifications</h6>
            </div>
            @foreach (Auth::user()->unreadNotifications as $notification)
                <a class="dropdown-item d-flex align-items-center" target="_blank"
                    href="{{ route('admin.notification', $notification->id) }}">
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="fas {{ $notification->data['fas'] }} text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">{{ $notification->created_at->format('F d, Y h:i A') }}</div>
                        <span
                            class="@if ($notification->unread()) font-weight-bold @else small text-gray-500 @endif">{{ $notification->data['title'] }}</span>
                    </div>
                </a>
                @if ($loop->index + 1 == 5)
                    @php
                        break;
                    @endphp
                @endif
            @endforeach
            <div class="col-auto">
                <a href="javascript: void(0);" class="text-dark text-decoration-underline">
                    <small>Clear All</small>
                </a>
            </div>
        </div>
    </div>
    <div class="text-center py-3">
        <a href="{{ route('all.notification') }}" class="btn btn-primary btn-sm">View All Notification <i
                class="bx bx-right-arrow-alt ms-1"></i></a>
    </div>
</div>
