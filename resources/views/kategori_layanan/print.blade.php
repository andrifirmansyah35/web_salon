<style>
    .table-border {
        width: 100%;

    }
</style>

<h3>
    <center>Laporan Data Santri</center>
</h3>
<table border="1" class="table border" cellspacing="0" cellpadding="5" class="table-border">
    <tr>
        <th>#no</th>
        <th>Slug</th>
        <th>Nama Kategori</th>
        <th>Create Time</th>
        <th>Updated Time</th>
    </tr>
    @foreach ($kategori_layanan_all as $s)
        <tr>
            <td>{{ $s->id }}</td>
            <td>{{ $s->slug }}</td>
            <td>{{ $s->nama }}</td>
            <td>{{ $s->created_at }}</td>
            <td>{{ $s->updated_at }}</td>
        </tr>
    @endforeach
</table>
