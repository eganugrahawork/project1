<div class="d-flex justify-content-center py-2">
    <a href="">Read All</a>
</div>
<hr>
@foreach ($activity as $act)
<div class="d-flex justify-content-start bg-light-info">
    <div class="d-flex flex-column align-items-start">
        <div class="d-flex align-items-center mb-2">
            <div class="symbol symbol-35px symbol-circle">
                <img alt="Pic" src="{{ asset('storage/' . $act->image) }}" />
            </div>
            <div class="ms-3">
                <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1">{{ $act->username }}</a>
                <span class="text-muted fs-7 mb-1">{{ Carbon\Carbon::parse($act->created_at)->diffForHumans() }}</span>
            </div>
        </div>
        <div class="p-5  text-dark fw-bold mw-lg-400px text-start" data-kt-element="message-text">{{ $act->keterangan }}</div>
    </div>
</div>
<div class="d-flex justify-content-end mb-10 ">
    <a href="">Read</a>
</div>

@endforeach
