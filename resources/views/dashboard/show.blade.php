@extends('layout')

@section('content')
<header class="header header-mini">
    <div class="container text-center">
        <h1 class="header-title">{{ $project->title }}</h1>
    </div>
</header>

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                {{-- Gambar Proyek --}}
                <img src="{{ asset('storage/' . $project->image) }}" class="img-fluid rounded mb-4" alt="">

                {{-- Deskripsi dari Rich Editor Filament --}}
                <div class="project-content">
                    {!! $project->description !!}
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-4">
                    <h6>Tech Stack</h6>
                    <p class="text-primary">{{ $project->tech_stack }}</p>
                    <hr>
                    @if($project->link_demo)
                        <a href="{{ $project->link_demo }}" target="_blank" class="btn btn-primary btn-block">Live Demo</a>
                    @endif
                    @if($project->link_github)
                        <a href="{{ $project->link_github }}" target="_blank" class="btn btn-outline-dark btn-block">View Code</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
