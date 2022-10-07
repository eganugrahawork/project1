<div class="fv-row">

    <div class="table-responsive">
        <table class="table align-middle table-row-dashed fs-6 gy-5">
            <td><label class="fs-5 fw-bolder form-label mb-2">Menu </label></td>
            <td><label class="fs-5 fw-bolder form-label mb-2">Accessed</label></td>
            <td><label class="fs-5 fw-bolder form-label mb-2">Action</label></td>
            <tbody class="text-gray-600 fw-bold">
                @foreach ($useraccess as $ua)
                @php
                $checkblock = DB::select("select * from custom_access_blocks where id_user = $user->id and id_menu = $ua->id_menu");
                $data  = ['id_user' => $user->id, 'id_menu'=> $ua->id_menu];
                @endphp
                <tr>
                    <td class="text-gray-800">{{ $ua->usermenu->menu }}</td>
                    <td class="text-gray-800">@if($checkblock == null)
                        Diizinkan
                    @else
                        Tidak Diizinkan
                    @endif</td>
                <td>
                    @if($checkblock == null)
                    <a onclick="blockAccess({{ $ua->id_menu }}, {{ $user->id }})" class="btn btn-sm btn-danger">Hide</a>
                    @else
                    <button onclick="unBlockAccess({{ $ua->id_menu }}, {{ $user->id }})" data-iduser="{{ $user->id }}" data-idmenu="{{ $ua->id_menu }}" class="btn btn-sm btn-primary">Unhide</button>
                    @endif
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            <div class="">
                <button class="btn btn-sm btn-secondary" onclick="tutupModal()">Close</button>
            </div>
            <div class="">
                <button class="btn btn-sm btn-primary" onclick="closeWithReload()">Confirm</button>
            </div>
        </div>
    </div>
</div>


<script>
    function tutupModal(){
            $('#mainmodal').modal('hide')
    }

    function blockAccess(idMenu, idUser){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
        title: 'Hide Access to this menu ?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, Hide!',
        cancelButtonText: 'No, cancel !',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ url('/admin/configuration/useraccessmenu/blockaccess') }}",
                type: 'post',
                data: {
                    idUser: idUser,
                    idMenu: idMenu
                },
                success: function() {
                    swalWithBootstrapButtons.fire(
                      'Congratulation!',
                      'Hide Success',
                      'success'
                    )
                    setTimeout(function() {
                        location.reload()
                    }, 1000);
                }
            })

        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Cancelled',
            'Your data in safe :)',
            'success'
          )
        }
      })
    }

    function unBlockAccess(idMenu, idUser){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
        title: 'Unhide Access to this menu ?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, open it!',
        cancelButtonText: 'No, keep in hide !',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ url('/admin/configuration/useraccessmenu/unblockaccess') }}",
                type: 'post',
                data: {
                    idUser: idUser,
                    idMenu: idMenu
                },
                success: function() {
                    swalWithBootstrapButtons.fire(
                      'Congratulation!',
                      'Unhide',
                      'success'
                    )
                    setTimeout(function() {
                        location.reload()
                    }, 1000);
                }
            })

        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Cancelled',
            'Your data in safe :)',
            'success'
          )
        }
      })
    }

    function closeWithReload(){
        $('#mainmodal').modal('hide')
        setTimeout(function() {
            location.reload()
        }, 500);
    }
</script>
