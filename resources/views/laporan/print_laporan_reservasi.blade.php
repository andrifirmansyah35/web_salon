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
        @php
            function tgl_indo($tanggal)
            {
                $bulan = [
                    1 => 'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember',
                ];
                $pecahkan = explode('-', $tanggal);
            
                return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
            }
        @endphp
        <p>{{ tgl_indo(date('Y-m-d')) }}</p>
    </div>
    <table>
        <tr>
            <td>Hal</td>
            <td>:</td>
            <td>Laporan Reservasi
                {{ session()->get('laporan_status') != 'semua' ? '- ' . session()->get('laporan_status') : '' }}</td>
        </tr>
        @if (session()->has('laporan_reservasi_tanggal_awal'))
            <tr>
                <td>Jangka Waktu</td>
                <td>:</td>
                <td>{{ tgl_indo(session()->get('laporan_reservasi_tanggal_awal')) . ' - ' . tgl_indo(session()->get('laporan_reservasi_tanggal_akhir')) }}
                </td>
            </tr>
        @endif

    </table>
</div>

<div style="margin-top:10px">
    <table border="1" class="table-border" cellspacing="0" cellpadding="5">
        <tr>
            <td><strong>No</strong></td>
            <td><strong>Tanggal dan Operasional</strong></td>
            <td><strong>Member</strong></td>
            <td><strong>Status</strong></td>
            <td><strong>Harga</strong></td>
            <td><strong>Status</strong></td>
        </tr>

        <tbody>

            @foreach ($laporan_reservasi as $reservasi)
                <tr>
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $reservasi['jadwal_operasi_tanggal'] }}</td>
                    <td>{{ $reservasi['user_member_nama'] }}</td>
                    <td>{{ $reservasi['layanan_nama'] }}</td>
                    <td>{{ 'Rp ' . number_format($reservasi['harga'], 2, ',', '.') }}</td>
                    <td>{{ $reservasi['status'] }}</td>
                </tr>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
