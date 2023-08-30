@extends('layouts.main')

@section('content')
    <div class="d-flex align-items-center">
        <div class="h2 mb-2 text-gray-800 d-block">{{ $title }}</div>
    </div>

    <div class="row">
        <div class="col">
            <p class="font-italic">*Cek data daftar reservasi mendatang <a href="/reservasi_mendatang">Click Disini</a>
            </p>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success text-center" role="alert">
            {{ session('success') }}
        </div>
    @endif


    @if (session()->has('fail'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ session('fail') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- DataTales Example -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            {{-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> --}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>

                        <tr>
                            <th>No</th>
                            <th>Operasional</th>
                            <th>Pelangan</th>
                            <th>Layanan</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Operasional</th>
                            <th>Pelangan</th>
                            <th>Layanan</th>
                            <th>harga</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($reservasi_all as $r)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $r['operasi_mulai'] }}-{{ $r['operasi_selesai'] }}</td>
                                <td>{{ $r['user_nama'] }}</td>
                                <td>{{ $r['layanan_nama'] }}</td>
                                <td>{{ 'Rp ' . number_format($r['layanan_harga'], 2, ',', '.') }}</td>
                                <td><strong>{{ $r['status'] }}</strong></td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                        data-target="#modal-reservasi-{{ $r['id'] }}">
                                        ubah status
                                    </button>

                                    @if ($r['status'] == 'diproses')
                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                            data-target="#modal-reservasi-selesai-{{ $r['id'] }}">
                                            konfirmasi pembayaran
                                        </button>
                                    @endif

                                    @if ($r['status'] == 'antri')
                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#modal-reservasi-ubah-jadwal-{{ $r['id'] }}">
                                            ubah jadwal
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-2. Modal Jadwal Operasi ubah--->
        @if ($reservasi_all != '')
            @foreach ($reservasi_all as $r)
                <div class="modal fade" id="modal-reservasi-{{ $r['id'] }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    Ubah Status Reservasi
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            <div class="modal-body">
                                {{-- {{ $r->status ? 'Klick untuk mempublik jadwal operasi ' : 'Klick untuk menutup jadwal operasi' }}
                      {{ $r->tanggal }} --}}
                                <form method="post" action="/reservasi_status">
                                    @method('put')
                                    @csrf
                                    <input type="hidden" name="id_reservasi" value="{{ $r['id'] }}">
                                    <div class="form-group">
                                        <label>Operasional</label>
                                        <input class="form-control" type="text"
                                            value="{{ $r['operasi_mulai'] }}-{{ $r['operasi_selesai'] }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Pelanggan</label>
                                        <input class="form-control" type="text" value="{{ $r['user_nama'] }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Layanan</label>
                                        <input class="form-control" type="text" value="{{ $r['layanan_nama'] }}"
                                            readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputState">Status</label>
                                        <select id="inputState" class="form-control" name="status">
                                            @if ($r['status'] == 'antri')
                                                <option value="antri" selected>antri</option>
                                                <option value="diproses">diproses</option>
                                            @else
                                                <option value="antri">antri</option>
                                                <option value="diproses" selected>diproses</option>
                                            @endif
                                        </select>
                                    </div>

                            </div>
                            <button type="submit" class="btn btn-primary w-80">Submit</button>
                            </form>
                        </div>

                    </div>
                </div>

                <div class="modal fade" id="modal-reservasi-selesai-{{ $r['id'] }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    Konfirmasi Pembayaran</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Pastikan bahwa pembayaran sudah dilakukan, sebelum menyatakan bahwa reservasi sudah selesai
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a href="/reservasi_konfirmasi_pembayaran/{{ $r['id'] }}"
                                    class="btn btn-success">Konfirmasi</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modal-reservasi-ubah-jadwal-{{ $r['id'] }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    Yakin pelangan ingin mengubah jadwal?</h5>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a href="/reservasi_ubah_jadwal/{{ $r['id'] }}"
                                    class="btn btn-success">Konfirmasi</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    @endsection
