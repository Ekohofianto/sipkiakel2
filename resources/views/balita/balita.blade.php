@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{ __('Data Balita') }}</h1>

    @include('pesan')
    <!-- START DATA -->
    <div class="my-3 p-3 bg-white rounded shadow-sm border-bottom-success">
        <!-- TOMBOL TAMBAH DATA -->
        <div class="pb-3 row justify-content-end">
            <div class="col-auto">
                <a href='{{ url('balita/create') }}' class="btn btn-primary"><i class="fa-solid fa-heart-circle-plus"></i>
                    Tambah Data</a>
            </div>
        </div>
        <div class="table-responsive">
            <table id="balita_table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">NIK</th>
                        <th class="text-center">NAMA</th>
                        <th class="text-center">TANGGAL LAHIR</th>
                        <th class="text-center">USIA</th>
                        <th class="text-center">NAMA IBU</th>
                        <th class="text-center">JENIS KELAMIN</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($data_balita as $item)
                        <tr>
                            <td class="text-center">{{ $i }}</td>
                            <td class="text-center">{{ $item->nik_balita }}</td>
                            <td>{{ $item->nama_balita }}</td>
                            <td class="text-center">{{ $item->tgl_balita }}</td>
                            <td class="text-center">{{ $item->usia }}</td>
                            <td>{{ $item->nama_ibu }}</td>
                            <td class="text-center">{{ $item->jenis_kelamin }}</td>
                            <td class="text-center">
                                <a href='{{ url('balita/' . $item->nik_balita . '/edit') }}'
                                    class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <button onclick="hapusData('{{ $item->nik_balita }}')" class="btn btn-danger btn-sm"><i
                                        class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#balita_table').DataTable({
                "columnDefs": [{
                        "width": "1%",
                        "targets": 0
                    }, // No
                    {
                        "width": "12%",
                        "targets": 1
                    }, // NIK
                    {
                        "width": "15%",
                        "targets": 2
                    }, // NAMA
                    {
                        "width": "5%",
                        "targets": 3
                    }, // TANGGAL LAHIR
                    {
                        "width": "3%",
                        "targets": 4
                    }, // USIA
                    {
                        "width": "15%",
                        "targets": 5
                    }, // NAMA IBU
                    {
                        "width": "8%",
                        "targets": 6
                    }, // JENIS KELAMIN
                    {
                        "width": "10%",
                        "targets": 7
                    } // Aksi
                ],
                "autoWidth": false
            });
        });

        function hapusData(nik) {
            // Tampilkan Sweet Alert untuk konfirmasi penghapusan
            Swal.fire({
                title: 'Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // AJAX request untuk menghapus data
                    $.ajax({
                        type: 'POST',
                        url: '{{ url('balita') }}/' + nik,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "_method": "DELETE"
                        },
                        success: function(response) {
                            Swal.fire(
                                'Berhasil!',
                                'Data balita telah dihapus.',
                                'success'
                            ).then((result) => {
                                if (result.isConfirmed || result.isDismissed) {
                                    location
                                        .reload(); // Refresh halaman setelah pesan SweetAlert ditutup
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menghapus data.',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>
@endsection
