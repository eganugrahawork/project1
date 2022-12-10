@extends('admin.layouts.main')


@section('content')
    <div class="success-message" data-successmessage="{{ session('success') }}"></div>
    <div class="row">
        <div class="col-12">
            <div id="content"></div>
            <div class="card" id="indexContent">
                <div class="card-header border-0">
                    <div class="card-title">
                        <h5 class="fw-bolder">Users Activity</h5>
                    </div>
                    @if (auth()->user()->userrole->role === 'Super Admin')
                        <div class="card-toolbar">
                            <div class="d-flex align-items-center position-relative my-1">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                        <input class="form-control" placeholder="Search" id="searchActivityTable"
                                            type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="card-body pt-0">
                    <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100" id="activityTable">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">No</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">User</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Menu</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Activity</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Statues</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Created at</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-md fw-bold" style="border:none;">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var activityTable = $('#activityTable').DataTable({
            serverside: true,
            processing: true,
            ajax: {
                url: "{{ url('/admin/listuseractivity') }}"
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false
                },
                {
                    data: 'usernya',
                    name: 'usernya'
                },
                {
                    data: 'menu',
                    name: 'menu'
                },
                {
                    data: 'aktivitas',
                    name: 'aktivitas'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                }
            ],
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false
        });

        $('#searchActivityTable').keyup(function() {
            activityTable.search($(this).val()).draw()
        });
    </script>

    <script src="/metronic/assets/js/custom/apps/user-management/users/list/add.js"></script>
@endsection
