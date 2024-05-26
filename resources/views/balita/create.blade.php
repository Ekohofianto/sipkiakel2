@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Masukkan Data Balita') }}</h1>

    @include('pesan')

    <!-- START FORM -->
    <form action="{{ url('balita') }}" method="post">
        @csrf
        <div class="my-3 p-3 bg-white rounded shadow-lg p-3 mb-5 border-bottom-success">
            <div class="mb-3 row">
                <label for="nik_balita" class="col-sm-2 col-form-label">NIK<span class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="nik_balita" value="{{ Session::get('nik_balita') }}"
                        id="nik_balita">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama_balita" class="col-sm-2 col-form-label">Nama<span
                        class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_balita" value="{{ Session::get('nama_balita') }}"
                        id="nama_balita">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="tgl_balita" class="col-sm-2 col-form-label">Tanggal Lahir<span
                        class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="tgl_balita" value="{{ Session::get('tgl_balita') }}"
                        id="tgl_balita">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="usia" class="col-sm-2 col-form-label">Usia<span class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="usia" value="{{ Session::get('usia') }}"
                        id="usia" readonly>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin<span
                        class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                        <option value="">--Pilih Jenis Kelamin--</option>
                        <option value="Laki-laki" {{ Session::get('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                            Laki-laki</option>
                        <option value="Perempuan" {{ Session::get('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                            Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="nik_ibu" class="col-sm-2 col-form-label">NIK Ibu<span
                        class="small text-danger">*</span></label>
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
                <label for="alamat" class="col-sm-2 col-form-label">Alamat<span class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="alamat" value="{{ Session::get('alamat') }}"
                        id="alamat" readonly>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-sm-1 text-center">
                    <a href='{{ url('balita') }}' class="btn btn-secondary mb-3"><i
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
            // Initialize DataTables when the modal is shown
            $('#modalPilihNIKIbu').on('shown.bs.modal', function() {
                $('#tableNikIbu').DataTable();
            });

            document.getElementById('tgl_balita').addEventListener('change', function() {
                var dob = new Date(this.value);
                var today = new Date();
                var ageInMilliseconds = today - dob;
                var ageInWeeks = Math.floor(ageInMilliseconds / (7 * 24 * 60 * 60 *
                    1000)); // 7 hari dalam seminggu
                document.getElementById('usia').value = ageInWeeks;
            });
        });

        function pilihNIKIbu(nik, nama, alamat) {
            document.getElementById('nik_ibu').value = nik;
            document.getElementById('nama_ibu').value = nama;
            document.getElementById('alamat').value = alamat;
            $('#modalPilihNIKIbu').modal('hide'); // Close modal after selection
        }
    </script>
@endsection

@endsection
