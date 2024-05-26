@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Masukkan Data Pemeriksaan Ibu') }}</h1>

    @include('pesan')

    <form action="{{ url('p_ibu') }}" method="post">
        @csrf
        <div class="my-3 p-3 bg-white rounded shadow-lg p-3 mb-5 border-bottom-success">
            <div class="mb-3 row">
                <label for="nik_ibu" class="col-sm-2 col-form-label">NIK Ibu<span class="small text-danger">*</span></label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" name="nik_ibu" value="{{ Session::get('nik_ibu') }}"
                        id="nik_ibu" readonly>
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPilihNIKIbu"><i
                            class="fa-solid fa-bolt-lightning"></i>
                        Pilih NIK Ibu
                    </button>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama_ibu" class="col-sm-2 col-form-label">Nama Ibu<span
                        class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_ibu" value="{{ Session::get('nama_ibu') }}"
                        id="nama_ibu" readonly>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="berat_b" class="col-sm-2 col-form-label">Berat Badan (kg)<span
                        class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="number" step="0.01" class="form-control" name="berat_b"
                        value="{{ Session::get('berat_b') }}" id="berat_b">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="tinggi_b" class="col-sm-2 col-form-label">Tinggi Badan (cm)<span
                        class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="number" step="0.01" class="form-control" name="tinggi_b"
                        value="{{ Session::get('tinggi_b') }}" id="tinggi_b">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="tekanan_d" class="col-sm-2 col-form-label">Tekanan Darah (mmHg)<span
                        class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="tekanan_d" value="{{ Session::get('tekanan_d') }}"
                        id="tekanan_d">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="riwayat_p" class="col-sm-2 col-form-label">Riwayat Penyakit</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="riwayat_p" id="riwayat_p" rows="3">{{ Session::get('riwayat_p') }}</textarea>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="usia_kehamilan" class="col-sm-2 col-form-label">Usia Kehamilan (bulan)<span
                        class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="number" step="0.01" class="form-control" name="usia_kehamilan"
                        value="{{ Session::get('usia_kehamilan') }}" id="usia_kehamilan">
                </div>
            </div>

            <style>
                #alamat-wrapper {
                    display: none;
                }
            </style>

            <div id="alamat-wrapper" class="mb-3 row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="alamat" value="{{ Session::get('alamat') }}"
                        id="alamat" readonly>
                </div>
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-sm-1 text-center">
                    <a href='{{ url('p_ibu') }}' class="btn btn-secondary mb-3"><i
                            class="fa-solid fa-circle-arrow-left"></i> Kembali</a>
                </div>
                <div class="col-sm-1 text-center">
                    <button type="submit" class="btn btn-primary" name="submit"><i class="fa-solid fa-floppy-disk"></i>
                        Simpan</button>
                </div>
            </div>
        </div>
    </form>

    <!-- MODAL -->
    <div class="modal fade" id="modalPilihNIKIbu" tabindex="-1" role="dialog" aria-labelledby="modalPilihNIKIbuLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPilihNIKIbuLabel">Pilih NIK Ibu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="tableNikIbu" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>NIK Ibu</th>
                                <th>Nama Ibu</th>
                                <th>Aksi</th> <!-- Kolom aksi untuk memilih NIK ibu -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_ibu as $ibu)
                                <tr>
                                    <td>{{ $ibu->nik_ibu }}</td>
                                    <td>{{ $ibu->nama_ibu }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-primary btn-select"
                                            onclick="pilihNIKIbu('{{ $ibu->nik_ibu }}', '{{ $ibu->nama_ibu }}', '{{ $ibu->alamat }}')"><i
                                                class="fa-solid fa-square-check"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- AKHIR MODAL -->

    <!-- JavaScript to handle NIK Ibu selection -->
@section('scripts')
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables saat modal ditampilkan
            $('#modalPilihNIKIbu').on('shown.bs.modal', function() {
                $('#tableNikIbu').DataTable();
            });
        });

        function pilihNIKIbu(nik, nama, alamat) {
            document.getElementById('nik_ibu').value = nik;
            document.getElementById('nama_ibu').value = nama;
            document.getElementById('alamat').value = alamat;
            $('#modalPilihNIKIbu').modal('hide'); // Tutup modal setelah dipilih
        }
    </script>
@endsection

@endsection
