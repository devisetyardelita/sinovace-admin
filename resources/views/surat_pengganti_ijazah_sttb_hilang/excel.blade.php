<table>
    <thead>
    <tr>
        <th>No.</th>
        <th>Nama</th>
        <th>NIK</th>
        <th>Alamat</th>
        <th>No. Handphone/WhatsApp</th>
    </tr>
    </thead>
    <tbody>
    @foreach($surat_pengganti_ijazah_sttb_hilang as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td><strong>{{ $item->nama }}</strong></td>
            <td>{{ $item->nik }}</td>
            <td>{{ $item->alamat }}</td>
            <td>{{ $item->no_hp }}</td>
        </tr>
    @endforeach
    </tbody>
</table>