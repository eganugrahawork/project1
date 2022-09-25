@extends('admin.layouts.main')


@section('content')
<div class="container mt-4">

    <div class="card">
        <div class="card-header">
            {{ $title }}
        </div>
        <div class="success-message" data-successmessage="{{ session('success') }}"></div>

        <div class="card-body">
            <h5 class="card-title">Set for User Access to Menues</h5>
                <div class="table-responsive">
                    <table id="example" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Menues</th>
                                <th class="text-center">Accessed</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menu as $m )
                            @php
                                $data = [
                                    'id_role' =>$id_role,
                                    'id_menu' => $m->id
                                ]
                            @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $m->menu }}</td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input user_access" id="" name="checkbox" type="checkbox" @php
                                                checkAccess($data)
                                            @endphp data-idrole="{{ $id_role }}" data-idmenu="{{ $m->id }}">
                                          </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>


@endsection

@section('js')
<script>
    // $(document).ready(function() {
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
     $('.user_access').on('click',function() {
        const menuId = $(this).data('idmenu');
        const roleId = $(this).data('idrole');

        $.ajax({
            url: "{{ route('changeaccess') }}",
            type: 'post',
            data: {
                roleId: roleId,
                menuId: menuId
            },
            success: function() {
                Swal.fire(
                    'Success',
                    'Access Changed',
                    'success'
                )
                setTimeout(function(){
                            location.reload();
                        }, 1500);

            }
        })
    });
// });

</script>


@endsection
