@extends('backend.admin-master')
@section('site-title')
    {{__('Slider')}}
@endsection

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Liste des sliders</h1>
    <a href="{{ route('sliders.create') }}" class="btn btn-primary mb-3">Ajouter un slider</a>
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
    @if($sliders->isEmpty())
        <div class="alert alert-info">Aucun slider trouvé.</div>
    @else
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Image</th>
                    <th>Lien</th>
                     <th>Titre</th>
                      <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sliders as $slider)
                <tr>
                    <td>
                        <img src="https://www.tutrouve.com/core/public/sliders/{{ $slider->image }}" alt="Slider Image" class="img-thumbnail" style="width: 100px; height: auto;">
                    </td>
                    <td>
                        <a href="{{ $slider->link }}" target="_blank">{{ $slider->link ?? 'Pas de lien' }}</a>
                    </td>
                     <td>
                        <p>{{ $slider->titre ?? 'Aucun' }}</p>
                    </td>
                     <td>
                        <p>{{ $slider->description ?? 'Aucun' }}</p>
                    </td>
                    <td>
                        <a href="{{ route('sliders.edit', $slider->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('sliders.destroy', $slider->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Etes-vous sur de vouloir supprimer ce slider ?');">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
