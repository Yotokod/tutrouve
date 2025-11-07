@extends('backend.admin-master')
@section('site-title')
    {{__('Slider')}}
@endsection

@section('content')
<div class="container mt-5">
    <h1>Ajouter un slider</h1>
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
    <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
        @csrf

        <div class="mb-3">
            <label for="image" class="form-label">Image :</label>
            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" required>
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="link" class="form-label">Lien (Facultatif):</label>
            <input type="url" name="link" id="link" class="form-control @error('link') is-invalid @enderror">
            @error('link')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
         <div class="mb-3">
            <label for="titre" class="form-label">Titre (Facultatif):</label>
            <input type="text" name="titre" id="titre" class="form-control @error('titre') is-invalid @enderror">
            @error('titre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
         <div class="mb-3">
            <label for="description" class="form-label">Description (Facultatif):</label>
            <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror">
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Ajouter</button>
        <a href="{{ route('sliders.index') }}" class="btn btn-secondary">Retour</a>
    </form>
</div>
@endsection