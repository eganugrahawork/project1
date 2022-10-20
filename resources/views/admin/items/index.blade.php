@extends('admin.layouts.main')

@section('content')
<div class="success-message" data-successmessage="{{ session('success') }}"></div>
<div class="fail-message" data-failmessage="{{ session('fail') }}"></div>
<div class="toolbar py-5 py-lg-5" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
        <div class="page-title d-flex flex-column me-3">
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Items</h1>
            <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                <li class="breadcrumb-item text-gray-600">
                    <a href="/admin/dashboard" class="text-gray-600 text-hover-primary">Dashboard</a>
                </li>
            </ul>
        </div>
    </div>
</div>


<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl bg-warna py-4">
    <div class="content flex-row-fluid" id="kt_content">
        <div class="card bg-white">
            <div class="card-header border-0 pt-6">
                <div class="card-title align-items-start flex-column">
                    <div class="d-flex align-items-center position-relative my-1">
                       <h2>Items</h2>
                    </div>
                    <div class="d-flex align-items-center position-relative my-1">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <input type="text" id="searchIndukTable" class="form-control form-control-solid w-250px ps-15" placeholder="Items Search" />
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base" id="loading-add">
                        @can('create', ['/admin/masterdata/items'])
                            <button type="button" class="btn btn-primary me-3" id="add-btn" onclick="addItemsModal()">
                            Add Items</button>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="indukTable">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-20px">No
                            </th>
                            <th class="min-w-125px">Kode Items</th>
                            <th class="min-w-125px">Nama Items</th>
                            <th class="min-w-125px">Deskripsi</th>
                            <th class="min-w-125px">UOM</th>
                            <th class="min-w-70px">Principal</th>
                            <th class="text-end min-w-70px">Action</th>
                        </tr>
                    </thead>
                    <tbody class="fw-bold text-gray-600">
                        @foreach ($items as $item)
                        <tr>
                            <td class="text-gray-800 text-hover-primary mb-1">{{ $loop->iteration }}</td>
                            <td>
                                <a href="#" class="text-gray-800 text-hover-primary mb-1">{{ $item->item_code }}</a>
                            </td>
                            <td>
                                <a href="#" class="text-gray-800 text-hover-primary mb-1">{{ $item->item_name }}</a>
                            </td>
                            <td>
                                <a href="#" class="text-gray-600 text-hover-primary mb-1">{{ $item->item_description }}</a>
                            </td>
                            <td>{{ $item->uom_id }}</td>
                            <td>{{ $item->partner_id }}</td>
                            <td class="text-end">
                                @can('edit', ['/admin/masterdata/items'])
                                    <a onclick="editModal({{ $item->id }})" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                                @endcan
                                @can('delete', ['/admin/masterdata/items'])
                                    <a href="/admin/masterdata/items/delete/{{ $item->id }}" class="btn btn-sm btn-danger button-delete" ><i class="bi bi-trash"></i></a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--end::Post-->
</div>

{{-- Main Modal --}}
<div class="modal fade" id="mainmodal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-1000px">
        <div class="modal-content">
            <div class="modal-header" id="mainmodal_header">
                <h2 class="fw-bolder">Items</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" onclick="tutupModal()">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7" id="kontennya">
            </div>
        </div>
    </div>
</div>
{{-- End Main Modal --}}

@endsection

@section('js')

<script>
function addItemsModal(){
            $('#loading-add').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/masterdata/items/addmodal') }}", {}, function(data, status){
                $('#kontennya').html(data)
                $('#mainmodal').modal('toggle')
                $('#loading-add').html('<button type="button" class="btn btn-primary me-3" id="add-btn" onclick="addItemsModal()">Add Items</button>')
            });
}
            function editModal(id){
            $('#loading-add').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
                $.get("{{ url('/admin/masterdata/items/editmodal') }}/"+id, {}, function(data, status){
                    $('#loading-add').html('<button type="button" class="btn btn-primary me-3" id="add-btn" onclick="addItemsModal()">Add Items</button>')
                    $('#kontennya').html(data)
                    $('#mainmodal').modal('toggle')
                });
            }
            function tutupModal(){
                $('#mainmodal').modal('toggle')
            }
</script>

@endsection
