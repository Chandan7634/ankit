<button type="button" class="topbar-button position-relative" id="page-header-notifications-dropdown2"
    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="bx bx-message-dots text-muted align-middle me-1" style="font-size: 1.4rem"></i>
    {{-- <iconify-icon icon="solar:clock-circle-bold-duotone" class="fs-24 align-middle"></iconify-icon> --}}
</button>

<div class="dropdown-menu py-0 dropdown-lg dropdown-menu-end" aria-labelledby="page-header-notifications-dropdown2">
    <div class="p-3 border-top-0 border-start-0 border-end-0 border-dashed border">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="m-0 fs-16 fw-semibold"> Message Center</h6>
            </div>
            <div id="message-items">
                @foreach (App\Helpers\Helper::messageList() as $message)
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('message.show', $message->id) }}">
                        <div class="dropdown-list-image mr-3">
                            @if ($message->photo)
                                <img class="rounded-circle" src="{{ $message->photo }}" alt="profile">
                            @else
                                <img class="rounded-circle" src="{{ asset('backend/img/avatar.png') }}"
                                    alt="default img">
                            @endif
                            {{-- <div class="status-indicator bg-success"></div> --}}
                        </div>
                        <div class="font-weight-bold">
                            <div class="text-truncate">{{ $message->subject }}</div>
                            <div class="small text-gray-500">{{ $message->name }} ·
                                {{ $message->created_at->diffForHumans() }}</div>
                        </div>
                    </a>
                    @if ($loop->index + 1 == 5)
                        @php
                            break;
                        @endphp
                    @endif
                @endforeach
                {{-- <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                </div>
                <div>
                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                </div>
                </a> --}}
            </div>
        </div>
    </div>
    <div class="text-center py-3">
        <a href="{{ route('message.index') }}" class="btn btn-primary btn-sm">View All Message <i
                class="bx bx-right-arrow-alt ms-1"></i></a>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            Echo.channel('message')
                .listen('MessageSent', (e) => {

                    const message_container = $('#message-items');
                    const message_counter_area = $('#messages .count');
                    const message_counter = parseInt($(message_counter_area).attr('data-count')) + 1;
                    const message_length = parseInt($('#message-items>.dropdown-item').length);
                    $(message_counter_area).attr('data-count', message_counter);

                    const data = `
      <a class="dropdown-item d-flex align-items-center message-item" href="${e.message.url}">
        <div class="dropdown-list-image mr-3">
          <img class="rounded-circle" src="${e.message.photo}" alt="${e.message.name}">
        </div>
        <div class="font-weight-bold">
          <div class="text-truncate">${e.message.subject}</div>
          <div class="small text-gray-500">${e.message.name} · ${e.message.date}</div>
        </div>
      </a>
      `;

                    $(message_container).prepend(data);

                    if (message_counter <= 5) {
                        $(message_counter_area).text(message_counter);
                    } else {
                        $(message_counter_area).text('5+');
                    };

                    if (message_length >= 5) $(message_container).find('.message-item').last().remove();

                });

        });
    </script>
@endpush
