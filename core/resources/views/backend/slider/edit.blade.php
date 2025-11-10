@extends('backend.admin-master')
@section('site-title')
    {{__('Slider')}}
@endsection

@section('content')
<div class="container mt-5">
    <h1>Modifier le slider</h1>
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
    <form action="{{ route('sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data" class="mt-4">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="image" class="form-label">Image actuelle :</label>
            <div>
                  <img src="https://www.tutrouve.com/core/public/sliders/{{ $slider->image }}" alt="Slider Image" class="img-thumbnail" style="width: 150px; height: auto;">
            </div>
            <label for="image" class="form-label">Changer l'image :</label>
            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="link" class="form-label">Lien (Facultatif):</label>
            <input type="url" name="link" id="link" class="form-control @error('link') is-invalid @enderror" value="{{ $slider->link }}">
            @error('link')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
          <div class="mb-3">
            <label for="titre" class="form-label">Titre (Facultatif):</label>
            <input type="text" name="titre" id="titre" class="form-control @error('titre') is-invalid @enderror" value="{{ $slider->titre }}">
            @error('titre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description (Facultatif):</label>
            <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" value="{{ $slider->description }}">
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Mettre à jour</button>
        <a href="{{ route('sliders.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
