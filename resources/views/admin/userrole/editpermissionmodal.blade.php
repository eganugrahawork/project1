<div class="table-responsive">

    <table class="table align-middle table-row-dashed">
    <tbody>
        <tr class="text-muted fw-bolder fs-7 text-uppercase gs-0">
            <th colspan="5" class="text-center">Menu</th>
        </tr>
        @foreach ($menu as $m)
        <input type="hidden" name="id_menu" value="{{ $m->id }}">
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $m->menu }}</td>
            <td>
                <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                    <input class="form-check-input" type="checkbox" name="create" />
                    <span class="form-check-label">Create</span>
                </label>
            </td>
            <td>
                <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                    <input class="form-check-input" type="checkbox" name="update" />
                    <span class="form-check-label">Update</span>
                </label>
            </td>
            <td>
                <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                    <input class="form-check-input" type="checkbox" name="delete" />
                    <span class="form-check-label">Delete</span>
                </label>
            </td>
        </tr>
        @endforeach
        <tr class="text-muted fw-bolder fs-7 text-uppercase gs-0">
            <th colspan="5" class="text-center">Submenu</th>
        </tr>
        @foreach ($submenu as $sm )
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $sm->usersubmenu->submenu }}</td>
                <td>
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                        <input class="form-check-input" type="checkbox" name="create" />
                        <span class="form-check-label">Create</span>
                    </label>
                </td>
                <td>
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                        <input class="form-check-input" type="checkbox" name="update" />
                        <span class="form-check-label">Update</span>
                    </label>
                </td>
                <td>
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                        <input class="form-check-input" type="checkbox" name="delete" />
                        <span class="form-check-label">Delete</span>
                    </label>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</div>
