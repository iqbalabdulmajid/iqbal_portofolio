@extends('layout')
@section('content')
    <!-- page header -->
    <header id="home" class="header">
        <div class="overlay"></div>
        <div class="header-content container">
            <h1 class="header-title">
                <span class="up">HI!</span>
                <span class="down">I am Iqbal Abdul Majid</span>
            </h1>
            <p class="header-subtitle">Web Developer</p>

            <button class="btn btn-primary">Visit My Works</button>
        </div>
    </header><!-- end of page header -->

    <!-- about section -->
    <section class="section pt-0" id="about">
        <!-- container -->
        <div class="container text-center">
            <!-- about wrapper -->
            <div class="about">
                <div class="about-img-holder">
                    <img src="{{ asset('assets/imgs/home.png') }}" class="about-img"
                        alt="Download free bootstrap 4 landing page, free boootstrap 4 templates, Download free bootstrap 4.1 landing page, free boootstrap 4.1.1 templates, meyawo Landing page">
                </div>
                <div class="about-caption">
                    <p class="section-subtitle">Who Am I ?</p>
                    <h2 class="section-title mb-3">About Me</h2>
                    <p>
                        {{-- Jika nanti sudah buat tabel profile, ganti teks di bawah ini --}}
                        Saya adalah seorang Web Developer yang berdedikasi untuk menciptakan aplikasi web fungsional dan
                        intuitif. Dengan pemahaman mendalam tentang pengembangan Frontend dan Backend, saya fokus pada
                        penulisan kode yang bersih, performa yang optimal, dan pengalaman pengguna yang lancar. Saya
                        menikmati proses memecahkan masalah teknis yang kompleks dan mengubahnya menjadi solusi digital yang
                        bernilai.
                    </p>
                    {{-- Link ke file CV yang diupload di storage --}}
                    <a href="{{ asset('storage/cv/cv-iqbal.pdf') }}" class="btn-rounded btn btn-outline-primary mt-4"
                        target="_blank">
                        Download CV
                    </a>
                </div>
            </div><!-- end of about wrapper -->
        </div><!-- end of container -->
    </section> <!-- end of about section -->
    <section class="section">
        <div class="container text-center">
            <p class="section-subtitle">What I Can Do?</p>
            <h6 class="section-title mb-6">My Skills</h6>
            <div class="row">
                @foreach ($skills as $skill)
                    <div class="col-md-6 col-lg-3">
                        <div class="custom-card-body mt-3">
                            <h6 class="title">{{ $skill->name }}</h6>
                            <div class="progress">
                                <div class="progress-bar bg-primary" role="progressbar"
                                    style="width: {{ $skill->percentage }}%" aria-valuenow="{{ $skill->percentage }}"
                                    aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                            <small class="text-muted">{{ $skill->category }}</small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- portfolio section -->
    <section class="section" id="portfolio">
        <div class="container text-center">
            <p class="section-subtitle">What I Did ?</p>
            <h6 class="section-title mb-6">Portfolio</h6>
            <div class="row">
                @foreach ($projects as $project)
                    <div class="col-md-4 mb-4">
                        <a href="{{ $project->link_demo ?? '#' }}" target="_blank" class="portfolio-card">
                            {{-- Menampilkan gambar dari storage --}}
                            <img src="{{ asset('storage/' . $project->image) }}" class="portfolio-card-img"
                                alt="{{ $project->title }}">
                            <span class="portfolio-card-overlay">
                                <span class="portfolio-card-caption">
                                    <h4>{{ $project->title }}</h4>
                                    <p class="font-weight-normal">Tech: {{ $project->tech_stack }}</p>
                                </span>
                            </span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section> <!-- end of portfolio section -->

    <!-- section -->
    <section class="section-sm bg-primary">
        <!-- container -->
        <div class="container text-center text-sm-left">
            <!-- row -->
            <div class="row align-items-center">
                <div class="col-sm offset-md-1 mb-4 mb-md-0">
                    <h6 class="title text-light">Want to work with me?</h6>
                    <p class="m-0 text-light">Always feel Free to Contact & Hire me</p>
                </div>
                <div class="col-sm offset-sm-2 offset-md-3">
                    {{-- button mengarah ke section contact --}}
                    <a href="#contact" class="btn btn-lg my-font btn-light rounded">Hire Me</a>
                </div>
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </section> <!-- end of section -->

    <!-- blog section -->
    <section class="section" id="blog">
        <div class="container text-center">
            <p class="section-subtitle">Want to see more?</p>
            <h6 class="section-title mb-6">Featured Projects</h6>
            <div class="row">
                @foreach ($featuredProjects as $item)
                    {{-- Tambahkan kolom pembungkus agar layout rapi --}}
                    <div class="col-md-6">
                        <div class="blog-card">
                            <div class="blog-card-header">
                                <img src="{{ asset('storage/' . $item->image) }}" class="blog-card-img"
                                    alt="{{ $item->title }}">
                            </div>
                            <div class="blog-card-body">
                                <h5 class="blog-card-title">{{ $item->title }}</h5>

                                <p class="blog-card-caption">
                                    {{-- Gunakan span jika hanya untuk label agar tidak konflik klik --}}
                                    <span class="text-primary">Tech Stack: {{ $item->tech_stack }}</span>
                                </p>

                                <div class="mb-3 text-left">
                                    {{-- Strip_tags penting agar layout tidak rusak oleh tag HTML dari Rich Editor --}}
                                    {!! Str::limit(strip_tags($item->description), 150) !!}
                                </div>

                                <a href="{{ route('project.show', $item->slug) }}" class="blog-card-link">
                                    Read more <i class="ti-angle-double-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- contact section -->
    <section class="section" id="contact">
        <div class="container text-center">
            <p class="section-subtitle">How can you communicate?</p>
            <h6 class="section-title mb-5">Contact Me</h6>
            <!-- contact form -->
            <form action="{{ route('contact.store') }}" method="POST" class="contact-form col-md-10 col-lg-8 m-auto">
                @csrf {{-- WAJIB: Keamanan Laravel --}}
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                    </div>
                    <div class="form-group col-sm-12">
                        <textarea name="message" id="comment" rows="6" class="form-control" placeholder="Write Something" required></textarea>
                    </div>
                    <div class="form-group col-sm-12 mt-3">
                        <input type="submit" value="Send Message & Chat via WA" class="btn btn-outline-primary rounded">
                    </div>
                </div>
            </form>
        </div><!-- end of container -->
    </section><!-- end of contact section -->
@endsection
