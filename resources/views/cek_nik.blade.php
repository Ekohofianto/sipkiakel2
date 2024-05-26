@extends('topbar')

@section('content')
    <div>
        <form action="{{ url('cek.nik') }}" method="post" class="mb-5">
            <h1 class="h3 mb-3 text-gray-800 row justify-content-center text-center"></h1>
            @csrf
            <div class="container">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <ul class="nav nav-tabs mb-0">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#data-ibu" style="text-white">Data Ibu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#pemeriksaan-ibu">Pemeriksaan Ibu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#data-balita">Data Balita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#pemeriksaan-balita">Pemeriksaan Balita</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="data-ibu" class="tab-pane fade show active">
                        @if (isset($dataIbu))
                            <div class="card mb-4">
                                <div class="card-header bg-success text-white text-center">
                                    <h3><strong>Data Ibu</strong></h3>
                                </div>
                                <div class="card-body shadow-lg">
                                    @if (isset($dataIbu))
                                        <div class="list-group-item">
                                            <p><strong>NIK :</strong> {{ $dataIbu->nik_ibu }}</p>
                                            <p><strong>Nama :</strong> {{ $dataIbu->nama_ibu }}</p>
                                            <p><strong>Tanggal Lahir :</strong>
                                                {{ \Carbon\Carbon::parse($dataIbu->tgl_ibu)->translatedFormat('d F Y') }}
                                            </p>
                                            <p><strong>Usia :</strong> {{ $dataIbu->usia }}</p>
                                            <p><strong>Nama Suami :</strong> {{ $dataIbu->nama_suami }}</p>
                                            <p><strong>Alamat :</strong> {{ $dataIbu->alamat }}</p>
                                            <p><strong>Tanggal Mendaftar di Posyandu :</strong>
                                                {{ \Carbon\Carbon::parse($dataIbu->created_at)->translatedFormat('d F Y') }}
                                                Jam
                                                {{ \Carbon\Carbon::parse($dataIbu->created_at)->format('H:i') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="card mb-4">
                                <div class="card-header bg-success text-white text-center">
                                    <h3><strong>Data Ibu Tidak ditemukan!</strong></h3>
                                </div>
                                <div class="card-body shadow-lg">
                                    <p><strong>Pastikan anda sudah mendaftar di posyandu terdekat!</strong></p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div id="pemeriksaan-ibu" class="tab-pane fade shadow-lg">
                        @if (isset($data_p_ibu) && !$data_p_ibu->isEmpty())
                            <div class="card mb-4">
                                <div class="card-header bg-biru text-white text-center">
                                    <h3><strong>Data Pemeriksaan Ibu</strong></h3>
                                </div>
                                <div class="card-body shadow-lg">
                                    <div class="mb-3">
                                        <label for="created_month_ibu">Filter Bulan:</label>
                                        <input type="month" class="form-control" id="created_month_ibu"
                                            name="created_month_ibu"
                                            value="{{ isset($created_month_ibu) ? $created_month_ibu : '' }}">
                                    </div>
                                    <table id="pemeriksaan_ibu_table" class="table table-striped table-bordered"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Berat Badan</th>
                                                <th>Tinggi Badan</th>
                                                <th>Tekanan Darah</th>
                                                <th>Riwayat Penyakit</th>
                                                <th>Usia Kehamilan</th>
                                                <th>Tanggal Periksa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data_p_ibu as $pemeriksaanibu)
                                                <tr>
                                                    <td>{{ $pemeriksaanibu->berat_b }} kg</td>
                                                    <td>{{ $pemeriksaanibu->tinggi_b }} cm</td>
                                                    <td>{{ $pemeriksaanibu->tekanan_d }} mmHg</td>
                                                    <td>{{ $pemeriksaanibu->riwayat_p }}</td>
                                                    <td>{{ $pemeriksaanibu->usia_kehamilan }} minggu</td>
                                                    <td>{{ \Carbon\Carbon::parse($pemeriksaanibu->created_at)->translatedFormat('d F Y') }}
                                                        Jam
                                                        {{ \Carbon\Carbon::parse($pemeriksaanibu->created_at)->format('H:i') }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-header bg-biru text-white text-center">
                                    <h3><strong>Grafik Data Pemeriksaan Ibu</strong></h3>
                                </div>
                                <div class="card-body shadow-lg">
                                    <div id="chartContainer">
                                        <canvas id="chartibu" width="100" height="30"></canvas>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="card mb-4">
                                <div class="card-header bg-biru text-white text-center">
                                    <h3><strong>Data Pemriksaan Ibu Tidak Ditemukan!</strong></h3>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div id="data-balita" class="tab-pane fade">
                        @if (isset($dataBalita) && !$dataBalita->isEmpty())
                            <div class="card mb-4">
                                <div class="card-header bg-warning text-white text-center">
                                    <h3><strong>Data Balita</strong></h3>
                                </div>
                                <div class="card-body shadow-lg">
                                    <div class="list-group">
                                        @foreach ($dataBalita as $dtBalita)
                                            <div class="list-group-item">
                                                <p><strong>Nama Balita :</strong> {{ $dtBalita->nama_balita }}</p>
                                                <p><strong>NIK Balita :</strong> {{ $dtBalita->nik_balita }}</p>
                                                <p><strong>Tanggal Lahir :</strong>
                                                    {{ \Carbon\Carbon::parse($dtBalita->tgl_balita)->translatedFormat('d F Y') }}
                                                </p>
                                                <p><strong>Usia :</strong> {{ $dtBalita->usia }}</p>
                                                <p><strong>Jenis Kelamin :</strong> {{ $dtBalita->jenis_kelamin }}</p>
                                                <p><strong>Tanggal Mendaftar di Posyandu :</strong>
                                                    {{ \Carbon\Carbon::parse($dtBalita->created_at)->translatedFormat('d F Y') }}
                                                    Jam
                                                    {{ \Carbon\Carbon::parse($dtBalita->created_at)->format('H:i') }}
                                                </p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="card mb-4">
                                <div class="card-header bg-info text-white text-center">
                                    <h3><strong>Data Balita Tidak Ditemukan!</strong></h3>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div id="pemeriksaan-balita" class="tab-pane fade">
                        @if (isset($data_p_balita) && !$data_p_balita->isEmpty())
                            <div class="card mb-4">
                                <div class="card-header bg-info text-white text-center">
                                    <h3><strong>Data Pemeriksaan Balita</strong></h3>
                                </div>
                                <div class="card-body shadow-lg">
                                    <div class="mb-3">
                                        <label for="created_month_balita">Filter Bulan:</label>
                                        <input type="month" class="form-control" id="created_month_balita"
                                            name="created_month_balita"
                                            value="{{ isset($created_month_balita) ? $created_month_balita : '' }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="filter_nama_balita">Filter Nama Balita:</label>
                                        <select class="form-control" id="filter_nama_balita" name="filter_nama_balita">
                                            <option value="">Pilih Nama Balita</option>
                                            @foreach ($dataBalita as $dtBalita)
                                                <option value="{{ $dtBalita->nama_balita }}">{{ $dtBalita->nama_balita }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <table id="pemeriksaan_balita_table" class="table table-striped table-bordered"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Nama Balita</th>
                                                <th>Berat Badan</th>
                                                <th>Panjang Badan</th>
                                                <th>Lingkar Kepala</th>
                                                <th>Lingkar Lengan</th>
                                                <th>Jenis Imunisasi</th>
                                                <th>Tanggal Periksa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data_p_balita as $pemeriksaanbalita)
                                                <tr>
                                                    <td>{{ $pemeriksaanbalita->nama_balita }} kg</td>
                                                    <td>{{ $pemeriksaanbalita->berat_badan }} kg</td>
                                                    <td>{{ $pemeriksaanbalita->panjang_badan }} cm</td>
                                                    <td>{{ $pemeriksaanbalita->lingkar_kepala }} cm</td>
                                                    <td>{{ $pemeriksaanbalita->lingkar_lengan }} cm</td>
                                                    <td>{{ $pemeriksaanbalita->jenis_imunisasi }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($pemeriksaanbalita->created_at)->translatedFormat('d F Y') }}
                                                        Jam
                                                        {{ \Carbon\Carbon::parse($pemeriksaanbalita->created_at)->format('H:i') }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-header bg-info text-white text-center">
                                    <h3><strong>Grafik Data Pemeriksaan Balita</strong></h3>
                                </div>
                                <div class="card-body shadow-lg">
                                    <div id="chartContainer">
                                        <canvas id="chartbalita" width="100" height="30"></canvas>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="card mb-4">
                                <div class="card-header bg-info text-white text-center">
                                    <h3><strong>Data Pemeriksaan Balita Tidak Ditemukan</strong></h3>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Fungsi untuk memfilter tabel dan grafik berdasarkan bulan yang dipilih
            $('#created_month_ibu').change(function() {
                var selectedMonth = $(this).val();
                var filteredDataIbu = filterDataByMonth(selectedMonth, 'ibu');
                updateTableAndChart(filteredDataIbu, '#pemeriksaan_ibu_table');
            });

            $('#created_month_balita').change(function() {
                var selectedMonth = $(this).val();
                var filteredDataBalita = filterDataByMonth(selectedMonth, 'balita');
                updateTableAndChart(filteredDataBalita, '#pemeriksaan_balita_table');
            });

            // Fungsi untuk memfilter tabel dan grafik berdasarkan nama balita
            $('#filter_nama_balita').change(function() {
                var filterValue = $(this).val().toLowerCase();
                filterTableAndChart(filterValue);
            });

            function filterTableAndChart(filterValue) {
                if (filterValue === '') {
                    // Kosongkan tabel dan grafik jika filter kosong
                    updateTableAndChart([], '#pemeriksaan_balita_table');
                } else {
                    var filteredData = [];
                    // Filter data pemeriksaan balita sesuai dengan nama balita yang dipilih
                    @foreach ($data_p_balita as $pemeriksaanbalita)
                        var namaBalita = '{{ strtolower($pemeriksaanbalita->nama_balita) }}';
                        if (namaBalita.includes(filterValue)) {
                            filteredData.push({
                                nama_balita: '{{ $pemeriksaanbalita->nama_balita }}',
                                berat_badan: '{{ $pemeriksaanbalita->berat_badan }}',
                                panjang_badan: '{{ $pemeriksaanbalita->panjang_badan }}',
                                lingkar_kepala: '{{ $pemeriksaanbalita->lingkar_kepala }}',
                                lingkar_lengan: '{{ $pemeriksaanbalita->lingkar_lengan }}',
                                jenis_imunisasi: '{{ $pemeriksaanbalita->jenis_imunisasi }}',
                                created_at: '{{ \Carbon\Carbon::parse($pemeriksaanbalita->created_at)->translatedFormat('d F Y H:i') }}'
                            });
                        }
                    @endforeach
                    // Memperbarui tabel dan grafik dengan data yang sudah difilter
                    updateTableAndChart(filteredData, '#pemeriksaan_balita_table');
                }
            }


            // Fungsi untuk memfilter data berdasarkan bulan
            function filterDataByMonth(selectedMonth, type) {
                var filteredData = [];
                if (type === 'ibu') {
                    @foreach ($data_p_ibu as $pemeriksaanibu)
                        var monthIbu = '{{ \Carbon\Carbon::parse($pemeriksaanibu->created_at)->format('Y-m') }}';
                        if (monthIbu === selectedMonth) {
                            filteredData.push({
                                berat_b: '{{ $pemeriksaanibu->berat_b }}',
                                tinggi_b: '{{ $pemeriksaanibu->tinggi_b }}',
                                tekanan_d: '{{ $pemeriksaanibu->tekanan_d }}',
                                riwayat_p: '{{ $pemeriksaanibu->riwayat_p }}',
                                usia_kehamilan: '{{ $pemeriksaanibu->usia_kehamilan }}',
                                created_at: '{{ \Carbon\Carbon::parse($pemeriksaanibu->created_at)->translatedFormat('d F Y H:i') }}'
                            });
                        }
                    @endforeach
                } else if (type === 'balita') {
                    @foreach ($data_p_balita as $pemeriksaanbalita)
                        var monthBalita =
                            '{{ \Carbon\Carbon::parse($pemeriksaanbalita->created_at)->format('Y-m') }}';
                        if (monthBalita === selectedMonth) {
                            filteredData.push({
                                nama_balita: '{{ $pemeriksaanbalita->nama_balita }}',
                                berat_badan: '{{ $pemeriksaanbalita->berat_badan }}',
                                panjang_badan: '{{ $pemeriksaanbalita->panjang_badan }}',
                                lingkar_kepala: '{{ $pemeriksaanbalita->lingkar_kepala }}',
                                lingkar_lengan: '{{ $pemeriksaanbalita->lingkar_lengan }}',
                                jenis_imunisasi: '{{ $pemeriksaanbalita->jenis_imunisasi }}',
                                created_at: '{{ \Carbon\Carbon::parse($pemeriksaanbalita->created_at)->translatedFormat('d F Y H:i') }}'
                            });
                        }
                    @endforeach
                }
                return filteredData;
            }

            // Fungsi untuk memperbarui tabel dan grafik
            function updateTableAndChart(data, tableSelector) {
                updateTable(data, tableSelector);

                if (tableSelector === '#pemeriksaan_balita_table') {
                    updateChartBalita(data);
                }
            }

            // Fungsi untuk memperbarui grafik data balita
            function updateChartBalita(data) {
                var labels = [];
                var bb_balita = [];
                var pb_balita = [];
                var lk_balita = [];
                var ll_balita = [];

                data.forEach(function(item) {
                    labels.push(item.created_at);
                    bb_balita.push(item.berat_badan);
                    pb_balita.push(item.panjang_badan);
                    lk_balita.push(item.lingkar_kepala);
                    ll_balita.push(item.lingkar_lengan);
                });

                chartbalita.data.labels = labels;
                chartbalita.data.datasets[0].data = bb_balita;
                chartbalita.data.datasets[1].data = pb_balita;
                chartbalita.data.datasets[2].data = lk_balita;
                chartbalita.data.datasets[3].data = ll_balita;
                chartbalita.update();
            }
        });

        // Fungsi untuk memperbarui tabel
        function updateTable(data, tableSelector) {
            var tableBody = $(tableSelector + ' tbody');
            tableBody.empty();

            data.forEach(function(item) {
                var row = "<tr>";
                if (tableSelector === '#pemeriksaan_ibu_table') {
                    row += "<td>" + item.berat_b + " kg</td>" +
                        "<td>" + item.tinggi_b + " cm</td>" +
                        "<td>" + item.tekanan_d + " mmHg</td>" +
                        "<td>" + item.riwayat_p + "</td>" +
                        "<td>" + item.usia_kehamilan + " minggu</td>" +
                        "<td>" + item.created_at + "</td>";
                } else if (tableSelector === '#pemeriksaan_balita_table') {
                    row += "<td>" + item.nama_balita + "</td>" +
                        "<td>" + item.berat_badan + " kg</td>" +
                        "<td>" + item.panjang_badan + " cm</td>" +
                        "<td>" + item.lingkar_kepala + " cm</td>" +
                        "<td>" + item.lingkar_lengan + " cm</td>" +
                        "<td>" + item.jenis_imunisasi + "</td>" +
                        "<td>" + item.created_at + "</td>";
                }
                row += "</tr>";
                tableBody.append(row);
            });
        }

        // Data Ibu
        var labels = [];
        var beratBadan = [];

        @foreach ($data_p_ibu as $pemeriksaanibu)
            labels.push("{{ \Carbon\Carbon::parse($pemeriksaanibu->created_at)->translatedFormat('d F Y') }}");
            beratBadan.push({{ $pemeriksaanibu->berat_b }});

            // Cek jika panjang array lebih dari 10
            if (labels.length > 10) {
                labels.shift(); // Hapus elemen pertama
                beratBadan.shift(); // Hapus elemen pertama
            }
        @endforeach

        var ctxIbu = document.getElementById('chartibu').getContext('2d');
        var chartibu = new Chart(ctxIbu, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Berat Badan (kg)',
                    data: beratBadan,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Data Balita
        var labelbalita = [];
        var bb_balita = [];
        var pb_balita = [];
        var lk_balita = [];
        var ll_balita = [];

        @foreach ($data_p_balita as $pemeriksaanbalita)
            labelbalita.push("{{ \Carbon\Carbon::parse($pemeriksaanbalita->created_at)->translatedFormat('d F Y') }}");
            bb_balita.push({{ $pemeriksaanbalita->berat_badan }});
            pb_balita.push({{ $pemeriksaanbalita->panjang_badan }});
            lk_balita.push({{ $pemeriksaanbalita->lingkar_kepala }});
            ll_balita.push({{ $pemeriksaanbalita->lingkar_lengan }});

            // Cek jika panjang array lebih dari 10
            if (labelbalita.length > 10) {
                labelbalita.shift(); // Hapus elemen pertama
                bb_balita.shift(); // Hapus elemen pertama
                pb_balita.shift(); // Hapus elemen pertama
                pb_balita.shift(); // Hapus elemen pertama
                ll_balita.shift(); // Hapus elemen pertama
            }
        @endforeach

        var ctxBalita = document.getElementById('chartbalita').getContext('2d');
        var chartbalita = new Chart(ctxBalita, {
            type: 'line',
            data: {
                labels: labelbalita,
                datasets: [{
                    label: 'Berat Badan (kg)',
                    data: bb_balita,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                }, {
                    label: 'Panjang Badan (cm)',
                    data: pb_balita,
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgb(255, 159, 64)',
                }, {
                    label: 'Lingkar Kepala (cm)',
                    data: lk_balita,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgb(54, 162, 235)',
                }, {
                    label: 'Lingkar Lengan (cm)',
                    data: ll_balita,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgb(153, 102, 255)',
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
