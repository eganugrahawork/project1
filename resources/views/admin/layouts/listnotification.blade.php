<div class="text-center py-3 px-2">
    <h4>Notification</h4>
</div>
<div class="d-flex justify-content-center py-2 px-2 bg-warna rounded">
    <a onclick="readAll()" class="text-white" href="#">Read All</a>
</div>
<hr>
<div class="ms-4">
    @foreach ($activity as $act)
        <div class="d-flex justify-content-start bg-light-info px-2">
            <div class="d-flex flex-column align-items-start">
                <div class="d-flex align-items-center mb-2">
                    <div class="symbol symbol-35px symbol-circle">
                        <img alt="Pic" src="{{ asset('storage/' . $act->image) }}" />
                    </div>
                    <div class="ms-3">
                        <a href="#"
                            class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1">{{ $act->username }}</a>
                        <span
                            class="text-muted fs-7 mb-1">{{ Carbon\Carbon::parse($act->created_at)->diffForHumans() }}</span>
                    </div>
                </div>
                <div class="p-5  text-dark fw-bold mw-lg-400px text-start" data-kt-element="message-text">
                    {{ $act->keterangan }}
                </div>

            </div>
        </div>
        @php
        $inUser = auth()->user()->id;
            $checkRead = DB::connection('masterdata')->select("select id from seen_activities a where a.user_id = $inUser  and a.user_activities_id=$act->id");
        @endphp
        @if ($checkRead)
            <div class="py-2"></div>
        @else
            <div class="d-flex justify-content-end mb-10 ">
                <a href="#" onclick="read({{ $act->id }})" class="btn btn-sm btn-primary">Read</a>
            </div>
        @endif
    @endforeach
    <div class="d-flex justify-content-end py-4 mb-6">
        <a href="/admin/useractivity" class="btn btn-sm btn-warning">Readmore Activity</a>
    </div>
</div>

<script>
    function readAll() {

        $('#kt_drawer_chat_toggle').click();
        $('#notifycountnya').html(
            '<span class="position-absolute top-0 start-100 translate-middle  badge badge-circle badge-primary">...</span>'
            );
        $.get("{{ url('/admin/readallnotif') }}", {}, function(data, status) {
            notif();
        })
    }

    function read(id) {
            $('#kt_drawer_chat_toggle').click();
            $('#notifycountnya').html(
                '<span class="position-absolute top-0 start-100 translate-middle  badge badge-circle badge-primary">...</span>'
                );
        $.get("{{ url('/admin/read') }}/" + id, {}, function(data, status) {
            notif();
        })
    }
</script>
