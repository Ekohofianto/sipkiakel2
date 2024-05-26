@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Masukkan Data Pemeriksaan Balita') }}</h1>

    @include('pesan')

    @php
        $jenis_imunisasi = [
            '--Pilih Imunisasi--',
            'BCG',
            'Hepatitis B',
            'DTP',
            'Polio',
            'Hib',
            'PCV',
            'MMR',
            'Varisela',
            'HPV',
            'Influenza',
        ];
    @endphp

    <form action="{{ url('p_balita') }}" method="post">
        @csrf
        <div class="my-3 p-3 bg-white rounded shadow-lg p-3 mb-5 border-bottom-success">
            <div class="mb-3 row">
                <label for="nik_balita" class="col-sm-2 col-form-label">NIK Balita<span
                        class="small text-danger">*</span></label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" name="nik_balita" value="{{ Session::get('nik_balita') }}"
                        id="nik_balita" readonly>
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPilihNIKBalita"><i
                            class="fa-solid fa-bolt-lightning"></i>
                        Pilih NIK Balita
                    </button>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama_balita" class="col-sm-2 col-form-label">Nama Balita<span
                        class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_balita" value="{{ Session::get('nama_balita') }}"
                        id="nama_balita" readonly>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="berat_badan" class="col-sm-2 col-form-label">Berat Badan (kg)<span
                        class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="number" step="0.01" class="form-control" name="berat_badan"
                        value="{{ Session::get('berat_badan') }}" id="berat_badan">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="panjang_badan" class="col-sm-2 col-form-label">Panjang / Tinggi Badan (cm)<span
                        class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="number" step="0.01" class="form-control" name="panjang_badan"
                        value="{{ Session::get('panjang_badan') }}" id="panjang_badan">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="lingkar_kepala" class="col-sm-2 col-form-label">Lingkar Kepala (cm)<span
                        class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="number" step="0.01" class="form-control" name="lingkar_kepala"
                        value="{{ Session::get('lingkar_kepala') }}" id="lingkar_kepala">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="lingkar_lengan" class="col-sm-2 col-form-label">Lingkar Lengan (cm)<span
                        class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="number" step="0.01" class="form-control" name="lingkar_lengan"
                        value="{{ Session::get('lingkar_lengan') }}" id="lingkar_lengan">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="jenis_imunisasi" class="col-sm-2 col-form-label">Jenis Imunisasi<span
                        class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <select class="form-select form-control" name="jenis_imunisasi" id="jenis_imunisasi">
                        @foreach ($jenis_imunisasi as $imunisasi)
                            <option value="{{ $imunisasi }}"
                                {{ old('jenis_imunisasi') == $imunisasi ? 'selected' : '' }}>
                                {{ $imunisasi }}
                            </option>
                        @endforeach
                    </select>
                    @error('jenis_imunisasi')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
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
                    <a href='{{ url('p_balita') }}' class="btn btn-secondary mb-3"><i
                            class="fa-solid fa-circle-arrow-left"></i> Kembali</a>
                </div>
                <div class="col-sm-1 text-center">
                    <button type="submit" class="btn btn-primary" name="submit"><i
                            class="fa-solid fa-floppy-disk"></i>
                        Simpan</button>
                </div>
            </div>
        </div>
    </form>

    <!-- MODAL -->
    <div class="modal fade" id="modalPilihNIKBalita" tabindex="-1" role="dialog"
        aria-labelledby="modalPilihNIKBalitaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPilihNIKBalitaLabel">Pilih NIK Balita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="tableNikBalita" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>NIK Balita</th>
                                <th>Nama Balita</th>
                                <th>Aksi</th> <!-- Kolom aksi untuk memilih NIK balita -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_balita as $balita)
                                <tr>
                                    <td>{{ $balita->nik_balita }}</td>
                                    <td>{{ $balita->nama_balita }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-primary btn-select"
                                            onclick="pilihNIKBalita('{{ $balita->nik_balita }}', '{{ $balita->nama_balita }}', '{{ $balita->alamat }}')"><i
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

    <!-- JavaScript to handle NIK Balita selection -->
@section('scripts')
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables saat modal ditampilkan
            $('#modalPilihNIKBalita').on('shown.bs.modal', function() {
                $('#tableNikBalita').DataTable();
            });
        });

        function pilihNIKBalita(nik, nama, alamat) {
            document.getElementById('nik_balita').value = nik;
            document.getElementById('nama_balita').value = nama;
            document.getElementById('alamat').value = alamat;
            $('#modalPilihNIKBalita').modal('hide'); // Tutup modal setelah dipilih
        }

        document.addEventListener('DOMContentLoaded', function() {
            var imunisasiSelect = document.getElementById('jenis_imunisasi');
            var originalImunisasiValue = imunisasiSelect.value;

            document.querySelector('form').addEventListener('submit', function(event) {
                if (imunisasiSelect.value === '--Pilih Imunisasi--') {
                    event.preventDefault();
                    alert('Imunisasi belum dipilih.');
                }
            });
        });
    </script>
@endsection

@endsection
