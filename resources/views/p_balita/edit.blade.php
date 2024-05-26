@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Ubah Data Pemeriksaan Balita') }}</h1>

    @include('pesan')
    @php
        $jenis_imunisasiarray = [
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

    <form action="{{ url('p_balita/' . $data_p_balita->id_p_balita) }}" method="post">
        @csrf
        @method('PUT')
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <div class="mb-3 row">
                <label for="nik_balita" class="col-sm-2 col-form-label">NIK Balita<span
                        class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="nik_balita" value="{{ $data_p_balita->nik_balita }}"
                        readonly>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama_balita" class="col-sm-2 col-form-label">Nama Balita<span
                        class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_balita" value="{{ $data_p_balita->nama_balita }}"
                        readonly>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="berat_badan" class="col-sm-2 col-form-label">Berat Badan (kg)<span
                        class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="number" step="0.01" class="form-control" name="berat_badan"
                        value="{{ $data_p_balita->berat_badan }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="panjang_badan" class="col-sm-2 col-form-label">Panjang / Tinggi Badan (cm)<span
                        class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="number" step="0.01" class="form-control" name="panjang_badan"
                        value="{{ $data_p_balita->panjang_badan }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="lingkar_kepala" class="col-sm-2 col-form-label">Lingkar Kepala (cm)<span
                        class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="number" step="0.01" class="form-control" name="lingkar_kepala"
                        value="{{ $data_p_balita->lingkar_kepala }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="lingkar_lengan" class="col-sm-2 col-form-label">Lingkar Lengan (cm)<span
                        class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="number" step="0.01" class="form-control" name="lingkar_lengan"
                        value="{{ $data_p_balita->lingkar_lengan }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="jenis_imunisasi" class="col-sm-2 col-form-label">Jenis Imunisasi<span
                        class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <select class="form-select form-control" name="jenis_imunisasi"
                        value="{{ $data_p_balita->jenis_imunisasi }}" id="jenis_imunisasi">
                        <option value="" disabled selected>Pilih Imunisasi</option>
                        @foreach ($jenis_imunisasiarray as $imunisasi)
                            <option value="{{ $imunisasi }}"
                                {{ isset($data_p_balita) && $imunisasi == $data_p_balita->jenis_imunisasi ? 'selected' : '' }}>
                                {{ $imunisasi }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-sm-1 text-center">
                    <a href='{{ url('p_balita') }}' class="btn btn-secondary mb-3"><i
                            class="fa-solid fa-circle-arrow-left"></i> Kembali</a>
                </div>
                <div class="col-sm-1 text-center">
                    <button type="submit" class="btn btn-primary" name="submit"><i class="fa-solid fa-floppy-disk"></i>
                        Simpan</button>
                </div>
            </div>
        </div>
    </form>
@endsection
