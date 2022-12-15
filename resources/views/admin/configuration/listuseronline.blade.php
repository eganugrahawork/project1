<div class="card-header pe-5 " id="kt_drawer_chat_messenger_header">
    <div class="card-title">
        <div class="d-flex justify-content-center flex-column me-3">
            <a href="#" class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1">Pengguna Aktif</a>
        </div>
    </div>

</div>
<div class="card-body" id="kt_drawer_chat_messenger_body">
    <div class="scroll-y me-n5 pe-5" data-kt-element="messages" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_drawer_chat_messenger_header, #kt_drawer_chat_messenger_footer" data-kt-scroll-wrappers="#kt_drawer_chat_messenger_body" data-kt-scroll-offset="0px">


                    @foreach ($uonline as $uo)
                             <div class="d-flex justify-content-start mb-10">
                                 <div class="d-flex flex-column align-items-start">
                                     <div class="d-flex align-items-center mb-2">
                                         <div class="symbol symbol-35px symbol-circle">
                                             <img alt="Pic" src="{{ asset('storage/' . $uo->image) }}" />
                                         </div>
                                         <div class="ms-3">
                                             <a onclick="openChat({{ $uo->id }})" href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1">{{ $uo->name }}</a>
                                             <span class="text-muted fs-7 mb-1">{{ $uo->username }}</span>
                                         </div>
                                     </div>

                                     <div class="py-2">
                                       <a href="https://api.whatsapp.com/send?phone=62{{ $uo->no_hp }}"><i class="bi bi-whatsapp"></i> Chat By Whatsapp</a>
                                    </div>
                                    <div class="py-2">
                                        <a href="mailto: {{ $uo->email }}"><i class="bi bi-envelope"></i> Send Email</a>
                                    </div>
                                 </div>
                             </div>
                             <hr>
                         @endforeach
    </div>
 </div>
