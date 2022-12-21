<table>
    <thead>
        <tr>
            <th colspan="5">Purchase Order</th>
        </tr>
        <tr>
            <th colspan="5">{{ \Carbon\Carbon::now()->format('d-M-Y H:i:s') }}</th>
        </tr>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Partner</th>
            <th>Tanggal Order</th>
            <th>Total PO</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $l)
            @php
                if ($l->po_status == 0) {
                    $status = 'Menunggu Konfirmasi';
                } elseif ($l->po_status == 1) {
                    $status = 'Disetujui';
                } elseif ($l->po_status == 2) {
                    $status = 'Ditolak';
                } elseif ($l->po_status == 3) {
                    $status = 'Pending';
                } elseif ($l->po_status == 4) {
                    $status = 'Release';
                }
            @endphp
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $l->po_code }}</td>
                <td>{{ $l->name }}</td>
                <td>{{ \Carbon\Carbon::parse($l->order_date)->format('d-M-Y') }}</td>
                <td>@Rupiah($l->total_po)</td>
                <td>{{ $status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
