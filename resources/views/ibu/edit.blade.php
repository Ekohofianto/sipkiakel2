@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Ubah Data Ibu') }}</h1>

    @include('pesan')
    @php
        $desa_patrang = [
            'Blimbing',
            'Jenggawah',
            'Jepun',
            'Kalirejo',
            'Karangnongko',
            'Kemuning',
            'Kepel',
            'Kranji',
            'Kunir',
            'Mangli',
            'Mlandingan',
            'Patrang',
            'Plumbon',
            'Pucangsewu',
            'Rowobangun',
            'Sumberbendo',
            'Talun',
            'Tlogoagung',
            'Tlogomas',
            'Wuluhan',
        ];
    @endphp

    <!-- START FORM -->
    <form action="{{ url('ibu/' . $data_ibu->nik_ibu) }}" method="post">
        @csrf
        @method('PUT')
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <div class="mb-3 row">
                <label for="nik_ibu" class="col-sm-2 col-form-label">NIK<span class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="nik_ibu" value="{{ $data_ibu->nik_ibu }}"
                        id="nik_ibu">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama_ibu" class="col-sm-2 col-form-label">Nama<span class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_ibu" value="{{ $data_ibu->nama_ibu }}"
                        id="nama_ibu">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="tgl_ibu" class="col-sm-2 col-form-label">Tanggal Lahir<span
                        class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="tgl_ibu" value="{{ $data_ibu->tgl_ibu }}"
                        id="tgl_ibu">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="usia" class="col-sm-2 col-form-label">Usia<span class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="usia"
                        value="{{ isset($data_ibu) ? $data_ibu->usia : Session::get('usia') }}" id="usia" readonly>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="nama_suami" class="col-sm-2 col-form-label">Nama Suami</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_suami" value="{{ $data_ibu->nama_suami }}"
                        id="nama_suami">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat<span class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <select class="form-select form-control" name="alamat" value="{{ $data_ibu->alamat }}" id="alamat">
                        <option value="" disabled selected>Pilih Alamat</option>
                        @foreach ($desa_patrang as $desa)
                            <option value="{{ $desa }}"
                                {{ isset($data_ibu) && $desa == $data_ibu->alamat ? 'selected' : '' }}>
                                {{ $desa }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-sm-1 text-center">
                    <a href='{{ url('ibu') }}' class="btn btn-secondary mb-3"><i
                            class="fa-solid fa-circle-arrow-left"></i> Kembali</a>
                </div>
                <div class="col-sm-1 text-center">
                    <button type="submit" class="btn btn-primary" name="submit"><i class="fa-solid fa-floppy-disk"></i>
                        Simpan</button>
                </div>
            </div>
        </div>
    </form>
    <!-- AKHIR FORM -->
    <script>
        document.getElementById('tgl_ibu').addEventListener('change', function() {
            var dob = new Date(this.value);
            var today = new Date();
            var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
            document.getElementById('usia').value = age;
        });
    </script>
@endsection
