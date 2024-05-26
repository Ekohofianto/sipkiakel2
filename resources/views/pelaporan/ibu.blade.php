@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Pelaporan Data Ibu') }}</h1>
    <form id="filterForm" action="{{ route('pelaporan.ibu') }}" method="GET">
        <div class="my-3 p-3 bg-white rounded shadow-sm border-bottom-success">
            <!-- Form untuk memilih alamat, usia, dan created_at -->
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="alamat">Pilih Alamat:</label>
                    <select class="form-control" id="alamat" name="alamat">
                        @foreach ($desa_patrang as $desa)
                            <option value="{{ $desa }}" {{ isset($alamat) && $alamat == $desa ? 'selected' : '' }}>
                                {{ $desa }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-5">
                    <label for="created_month">Pilih Bulan:</label>
                    <input type="month" class="form-control" id="created_month" name="created_month"
                        value="{{ isset($created_month) ? $created_month : '' }}">
                </div>
                <div class="form-group col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-secondary w-100" id="resetBtn"><i
                            class="fa-solid fa-rotate"></i></button>
                </div>
                <div class="form-group col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-primary w-100" id="cetakPdfBtn"><i
                            class="fa-solid fa-file-pdf"></i></button>
                </div>
            </div>
            <div class="table-responsive">
                @if ($data_ibu->isEmpty())
                    <p>Data tidak ditemukan.</p>
                @else
                    <table id="ibu_table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">NIK Ibu</th>
                                <th class="text-center">Nama Ibu</th>
                                <th class="text-center">Usia</th>
                                <th class="text-center">Nama Suami</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Tanggal Dibuat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_ibu as $ibu)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $ibu->nik_ibu }}</td>
                                    <td>{{ $ibu->nama_ibu }}</td>
                                    <td class="text-center">{{ $ibu->usia }}</td>
                                    <td>{{ $ibu->nama_suami }}</td>
                                    <td>{{ $ibu->alamat }}</td>
                                    <td class="text-center">{{ $ibu->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#ibu_table').DataTable();

            // Tangani klik tombol "Cetak PDF"
            $('#cetakPdfBtn').click(function() {
                // Ambil nilai dari form filter
                var alamat = $('#alamat').val();
                var created_month = $('#created_month').val();

                // Buat URL untuk cetak PDF
                var url = "{{ route('laporan.ibu.pdf') }}?alamat=" + alamat + "&created_month=" +
                    created_month;

                // Buka laman PDF dalam tab baru
                window.open(url, '_blank');
            });

            // Tangani perubahan pada select alamat
            $('#alamat').change(function() {
                $('#filterForm').submit(); // Kirim form saat ada perubahan
            });

            // Tangani perubahan pada input tanggal
            $('#created_month').change(function() {
                $('#filterForm').submit(); // Kirim form saat ada perubahan
            });

            // Tangani klik tombol "Reset"
            $('#resetBtn').click(function() {
                // Reset nilai pada elemen form
                $('#alamat').val('');
                $('#created_month').val('');

                // Kirim form untuk mereset filter
                $('#filterForm').submit();
            });

            // Tambahkan atau hapus atribut disabled pada tombol cetak berdasarkan keberadaan data
            function updateCetakBtn() {
                if ($('#ibu_table tbody tr').length === 0) {
                    $('#cetakPdfBtn').addClass('btn-secondary').prop('disabled', true);
                } else {
                    $('#cetakPdfBtn').removeClass('btn-secondary').prop('disabled', false);
                }
            }

            // Panggil fungsi untuk memperbarui status tombol cetak saat dokumen dimuat
            updateCetakBtn();
        });
    </script>
@endsection
