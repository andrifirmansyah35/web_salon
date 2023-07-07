<style>
    .table-border {
        width: 100%;
    }

    hr.solid {
        border-top: 3px solid #bbb;
    }


    /* contoh */
    .img2 {
        float: right;
        height: auto
    }

    .clearfix {
        overflow: auto;
    }



    /*  */
</style>
{{-- kita akan menggunakan float --}}

<div class="header-laporan">
    <center>
        <h2>RCSM BANTUL</h2>
    </center>
</div>

<hr class="solid">

<div class="clearfix">
    <div class="img2">
        <p>{{ $hari_ini = date('d M Y') }}</p>
    </div>
    <div>
        <h3>Laporan Layanan</h3>
    </div>
</div>

<div style="margin-top:10px">
    <table border="1" class="table-border" cellspacing="0" cellpadding="5">
        <tr>
            <td><strong>No</strong></td>
            <td><strong>Kategori</strong></td>
            <td><strong>Nama</strong></td>
            <td><strong>Status</strong></td>
            <td><strong>Harga</strong></td>
        </tr>

        <tbody>

            @foreach ($layanan_all as $l)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $l->kategori_layanan->nama }}</td>
                    <td>{{ $l->nama }}</td>
                    <td>{{ $l->status ? 'tersedia' : 'kosong' }}</td>
                    <td>{{ 'Rp ' . number_format($l->harga, 2, ',', '.') }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
