@extends('topbar')

@section('content')
    <div class="py-5"
        style="background-image: url('img/welcome/bghijau.png'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h class="display-4 fw-bold text-white">“Jagalah tubuhmu sayangi hidupmu.”
                        <span class="text-white" style="font-weight: bold">Cek Kesehatan Ibu dan
                            Anak</span>
                    </h>
                    <p class="lead my-4 text-white">"Jadikan Posyandu sebagai momen berharga bagi si kecil dan kita!"</p><a
                        class="btn btn-outline-primaryn" href="#CekPemeriksaan">Cek Sekarang</a>
                </div>
                <div class="col-lg-6"><img alt="" class="img-fluid" src="{{ asset('img/welcome/uwonge.png') }}">
                </div>
            </div>
        </div>
    </div>
    <!-- End Page 1 -->

    <!-- Page 2 -->
    <section id="Tutorial" class="py-5">
        <div class="container">
            <div class="text-center mx-md-auto"> <span class="lead h5"></span>
                <h2 class="h1">Tutorial Cek Pemeriksaan</h2>
            </div>
            <div class="row justify-content-center" style="border-bottom: 2px solid #ececec;">
                <div class="col-6 col-md-4 mb-5" style="border-left: 2px solid #FF5E63;">
                    <div class="text-center px-lg-3"><i class="my-3 fas fa-hospital-user fa-6x" style="color:#FF5E63;"></i>
                        <h3 style="color:#FF5E63;">Datang ke Posyandu dan Daftar Identitas</h3>
                        <p>Kunjungi posyandu terdekat di wilayah Anda.</p>
                        <p>Berikan informasi identitas Anda kepada petugas posyandu untuk didaftarkan dalam sistem.</p>
                    </div>
                </div>
                <div class="col-6 col-md-4 mb-5" style="border-top: 2px solid #FFCD6E;">
                    <div class="text-center px-lg-3">
                        <div style="position: relative; display: inline-block;"><i class="my-3 fas fa-stethoscope fa-6x"
                                style="color:#FFCD6E;"></i>
                        </div>
                        <h3 style="color:#FFCD6E;">Lakukan Pemeriksaan di Posyandu</h3>
                        <p>Lakukan pemeriksaan kesehatan yang diperlukan di posyandu.</p>
                        <p>Petugas posyandu akan mencatat hasil pemeriksaan Anda dalam sistem.</p>
                    </div>
                </div>
                <div class="col-6 col-md-4 mb-5" style="border-right: 2px solid #3B82F4;">
                    <div class="text-center px-lg-3">
                        <div style="position: relative; display: inline-block;"> <i class="my-3 fas fa-globe fa-6x"
                                style="color:#3B82F4;"></i>
                        </div>
                        <h3 style="color:#3B82F4;">Buka Website Sipkia</h3>
                        <p>Akses website Sipkia melalui perangkat komputer atau smartphone Anda.</p>
                        <p>Ketik alamat website Sipkia di browser Anda dan tekan enter.</p>
                    </div>
                </div>
                <div class="col-6 col-md-4 mb-5" style="border-bottom: 2px solid #52D1BD;">
                    <div class="text-center px-lg-3">
                        <div style="position: relative; display: inline-block;"> <i class="my-3 fas fa-id-card fa-6x"
                                style="color:#52D1BD;"></i>
                        </div>
                        <h3 style="color:#52D1BD;">Masukkan NIK Anda</h3>
                        <p>Masukkan NIK Anda ke dalam kolom yang tersedia di bawah ini.</p><a href="#CekPemeriksaan" <i
                            class="fa-solid fa-circle-arrow-down fa-3x"></i> </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Page 2 -->

    <!-- Page 3 -->
    <section id="CekPemeriksaan" class="py-5"
        style="background-image: url('img/welcome/bghijau.png'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="container">
            <div class="row justify-content-center text-center text-white">
                <div class="col-lg-12">
                    <span class="text-muted fw-bold">Cek Pemeriksaan</span>
                    <h2 class="display-5" style="font-weight: bold">Ibu dan Balita</h2>
                    <p class="lead">"Masukkan NIK jika anda sudah mendaftar di Posyandu Terdekat!"</p>
                    <div class="mx-auto col-md-8 col-xl-7 col-xxl-6 mt-3">
                        <a class="collapse-item" href="{{ route('ibu') }}"></a>
                        <form action="{{ route('cek.nik') }}" method="GET">
                            @csrf
                            <div class="input-group mb-3">
                                <input name="nik_ibu" class="form-control bg-light rounded mr-3" placeholder="Masukkan NIK"
                                    type="text">
                                <button class="btn btn-outline-primaryn" type="submit">Cek</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Page 3 -->

    <!-- Page 4 -->
    <section id="About" class="py-5" style="">
        <div class="position-relative rounded-2 mx-3 mx-lg-10" style="">
            <div class="container content-space-2 content-space-lg-3" style="border-bottom: 3px solid #ececec;">
                <div class="row justify-content-center" style="">
                    <div class="col col-lg-9 text-center" style="">
                        <img class="mb-2" src="{{ asset('img/sipkiahijau.png') }}" alt="Custom Icon"
                            style="width: 123px; height: 50px; ">
                        <p class="lead text-muted" style="">Sebuah platform yang dirancang khusus untuk memperbaiki
                            proses pelayanan kesehatan di
                            Posyandu. Dengan fokus pada pelayanan ibu dan anak, SIPKIA memungkinkan pendataan, pemeriksaan,
                            dan pemantauan kesehatan yang lebih efisien dan efektif.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-7 mb-5 mb-lg-0" style="">
                        <div class="pe-lg-6">
                            <figure class="browser" style=""> <img class="img-fluid"
                                    src="{{ asset('img/welcome/website.png') }}" alt="FreeFrontend.dev" style="">
                            </figure>
                        </div>
                    </div>
                    <div class="col-lg-5 mb-5" style="">
                        <h2 style="">SIPKIA beroperasi di lingkungan Posyandu:</h2>
                        <ul class="list-unstyled lead text-muted">
                            <li><i class="fa-solid fa-circle-check text-primary small me-2 mr-2"></i>Pendaftaran dan
                                Pendataan.</li>
                            <li><i class="fa-solid fa-circle-check text-primary small me-2 mr-2"></i>Pemeriksaan dan
                                Diagnosis.
                            </li>
                            <li><i class="fa-solid fa-circle-check text-primary small me-2 mr-2"></i>Pencatatan dan Rekam
                                Medis.</li>
                            <li><i class="fa-solid fa-circle-check text-primary small me-2 mr-2"></i>Cek Pemeriksaan:
                                Pasien dapat memeriksa hasil pemeriksaan.</li>
                        </ul> <a class="btn btn-primary text-light" href="#CekPemeriksaan">Cek Pemeriksaan</a>
                        <hr class="mb-1 mt-4"> <span class="lead text-muted">Supported</span>
                        <div class="row">
                            <div class="col-auto py-3"> <a
                                    href="https://id.wikipedia.org/wiki/Pusat_kesehatan_masyarakat"> <img
                                        class="img-fluid" src="img/kia.png" style="max-height: 40px;"> </a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Page 4 -->


    <!-- Page 5 -->
    <section id="Contact" class="py-1">
        <div class="container" style="border-bottom: 3px solid #ececec;">
            <div class="row justify-content-center text-center mb-2 mb-lg-4">
                <div class="col-15 col-lg-8 col-xxl-7 text-center mx-auto">
                    <span class="text-muted">Our Team</span>
                    <h2 class="display-5 fw-bold">Kelompok 2</h2>
                    <p class="lead">“Hidup adalah perjalanan, bukan tujuan akhir. Nikmatilah setiap langkahnya.”</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4 col-lg-3"> <!-- Adjusted column size -->
                    <div class="card text-center border-0 mb-3 bg-transparent">
                        <div class="card-body p-3">
                            <div class="mb-2 mx-lg-2 mx-xxl-5"><img class="img-fluid rounded-circle shadow-lg"
                                    src="{{ asset('img/author/yanti.png') }}"></div>
                            <h5 class="fw-bold">Yanti Febriana</h5>
                            <div class="text-muted">
                                G41220739
                            </div>
                            <div class="d-flex justify-content-center">
                                <a style="font-size: 30px; margin-right: 10px;"
                                    href="https://www.instagram.com/_yfbriana?igsh=MXEwcTU2OXNpdmdwcw=="><i
                                        class="fa-brands fa-instagram" style="color: #ec466a;"></i></a>
                                <a style="font-size: 30px; margin-right: 10px;" href="#"><i
                                        class="fa-brands fa-facebook" style="color: #3584fc;"></i></a>
                                <a style="font-size: 30px; margin-right: 10px;" href="#"><i
                                        class="fa-brands fa-x-twitter" style="color: #404441;"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3"> <!-- Adjusted column size -->
                    <div class="card text-center border-0 mb-3 bg-transparent">
                        <div class="card-body p-3">
                            <div class="mb-2 mx-lg-2 mx-xxl-5"><img class="img-fluid rounded-circle shadow-lg"
                                    src="{{ asset('img/author/dia.png') }}"></div>
                            <h5 class="fw-bold">Dia Priyani</h5>
                            <div class="text-muted">
                                G41220809
                            </div>
                            <div class="d-flex justify-content-center">
                                <a style="font-size: 30px; margin-right: 10px;"
                                    href="https://www.instagram.com/_diapryni?igsh=OHhjMHl4YjU3bjlh"><i
                                        class="fa-brands fa-instagram" style="color: #ec466a;"></i></a>
                                <a style="font-size: 30px; margin-right: 10px;" href="#"><i
                                        class="fa-brands fa-facebook" style="color: #3584fc;"></i></a>
                                <a style="font-size: 30px; margin-right: 10px;" href="#"><i
                                        class="fa-brands fa-x-twitter" style="color: #404441;"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3"> <!-- Adjusted column size -->
                    <div class="card text-center border-0 mb-3 bg-transparent">
                        <div class="card-body p-3">
                            <div class="mb-2 mx-lg-2 mx-xxl-5"><img class="img-fluid rounded-circle shadow-lg"
                                    src="{{ asset('img/author/dapi.png') }}"></div>
                            <h5 class="fw-bold">Mudafiatun Isriyah</h5>
                            <div class="text-muted">
                                G41220859
                            </div>
                            <div class="d-flex justify-content-center">
                                <a style="font-size: 30px; margin-right: 10px;"
                                    href="https://www.instagram.com/dafiadaf?igsh=MWR2ZHo5aXV1Znl0OA=="><i
                                        class="fa-brands fa-instagram" style="color: #ec466a;"></i></a>
                                <a style="font-size: 30px; margin-right: 10px;" href="#"><i
                                        class="fa-brands fa-facebook" style="color: #3584fc;"></i></a>
                                <a style="font-size: 30px; margin-right: 10px;" href="#"><i
                                        class="fa-brands fa-x-twitter" style="color: #404441;"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3"> <!-- Adjusted column size -->
                    <div class="card text-center border-0 mb-3 bg-transparent">
                        <div class="card-body p-3">
                            <div class="mb-2 mx-lg-2 mx-xxl-5"><img class="img-fluid rounded-circle shadow-lg"
                                    src="{{ asset('img/author/trisna.png') }}"></div>
                            <h5 class="fw-bold">Trisna Dwi Hapsari</h5>
                            <div class="text-muted">
                                G41220991
                            </div>
                            <div class="d-flex justify-content-center">
                                <a style="font-size: 30px; margin-right: 10px;"
                                    href="https://www.instagram.com/trisnadw.h?igsh=MWw0eDVpdTQ4Y2d0NA=="><i
                                        class="fa-brands fa-instagram" style="color: #ec466a;"></i></a>
                                <a style="font-size: 30px; margin-right: 10px;" href="#"><i
                                        class="fa-brands fa-facebook" style="color: #3584fc;"></i></a>
                                <a style="font-size: 30px; margin-right: 10px;" href="#"><i
                                        class="fa-brands fa-x-twitter" style="color: #404441;"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3"> <!-- Adjusted column size -->
                    <div class="card text-center border-0 mb-0 bg-transparent">
                        <div class="card-body p-3">
                            <div class="mb-2 mx-lg-2 mx-xxl-5"><img class="img-fluid rounded-circle shadow-lg"
                                    src="{{ asset('img/author/eko1.png') }}"></div>
                            <h5 class="fw-bold">Eko Hofianto</h5>
                            <div class="text-muted">
                                G41221005
                            </div>
                            <div class="d-flex justify-content-center">
                                <a style="font-size: 30px; margin-right: 10px;"
                                    href="https://www.instagram.com/eko_hofianto/"><i class="fa-brands fa-instagram"
                                        style="color: #ec466a;"></i></a>
                                <a style="font-size: 30px; margin-right: 10px;" href="#"><i
                                        class="fa-brands fa-facebook" style="color: #3584fc;"></i></a>
                                <a style="font-size: 30px; margin-right: 10px;" href="#"><i
                                        class="fa-brands fa-x-twitter" style="color: #404441;"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Page 5 -->

    <!-- Page 6 -->
    <!-- End Page 6 -->

    <!-- Page 7 -->
    <!-- End Page 7 -->

    <!-- Page 8 -->
    <!-- End Page 8 -->


    <!-- End Isi -->


    <!-- Scripts -->
    <!-- End Scripts -->
@endsection
