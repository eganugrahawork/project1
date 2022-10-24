
                         @foreach ($uonline as $uo)
                             <div class="d-flex justify-content-start mb-10">
                                 <div class="d-flex flex-column align-items-start">
                                     <div class="d-flex align-items-center mb-2">
                                         <div class="symbol symbol-35px symbol-circle">
                                             <img alt="Pic" src="{{ asset('storage/' . $uo->image) }}" />
                                         </div>
                                         <div class="ms-3">
                                             <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1">{{ $uo->name }}</a>
                                             <span class="text-muted fs-7 mb-1">{{ $uo->username }}</span>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         @endforeach
