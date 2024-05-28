@extends('layouts.admin')

@section('content')

<div class="container my-5 bg-white py-3">

    <!-- Se ci sono errori di validazione, mostra un'alert con la lista degli errori -->
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Titolo della pagina -->
    <h1>Modifica il tuo progetto!</h1>
    <div class="row">
        <div class="col-10">
            <!-- Form -->
            <form action="{{ route('admin.projects.update', $project) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Campo per il titolo -->
                <div class="mb-3">
                  <label for="title" class="form-label">Titolo</label>
                  <input
                    name="title"
                    type="text"
                    class="form-control @error('title') is-invalid @enderror"
                    id="title"
                    value="{{ $project->title, old('title') }}">
                    @error('title')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                {{-- Campo per i tipi --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Tipologia</label>
                    <select name="type_id" aria-label="Default select example" class="form-select">
                        <option value="">Seleziona una tipologia</option>
                        @foreach ($types as $type)
                            <option
                              value="{{ $type->id }}"
                              @if (old('type_id', $project->type?->id) == $type->id) selected @endif>
                                {{ $type->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Campo per le tecnologie --}}
                <div class="mb-3">
                    <label class="form-label">Tecnologie</label>
                    <div class="btn-group btn-group-sm" role="group">
                        @foreach ($technologies as $technology)
                            <input
                              name="technologies[]"
                              type="checkbox"
                              class="btn-check"
                              id="technology_{{$technology->id}}"
                              autocomplete="off"
                              value="{{ $technology->id }}"
                              @if ($errors ->any() && in_array($technology->id, old('technologies', []))
                                    || !$errors->any() && $project->technologies->contains($technology))
                                  checked
                              @endif>
                            <label class="btn btn-outline-primary" for="technology_{{$technology->id}}">{{ $technology->title }}</label>
                        @endforeach
                    </div>
                </div>

                <!-- Campo per il testo del progetto -->
                <div class="mb-3">
                  <label for="body" class="form-label">Testo</label>
                    <textarea
                        name="body"
                        type="text"
                        class="form-control @error('body') is-invalid @enderror"
                        id="body">{{ $project->body, old('body') }}</textarea>
                  @error('body')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>


                <!-- Pulsante per inviare il form -->
                <button type="submit" class="btn btn-success">Salva il Progetto </button>
              </form>
        </div>
    </div>
</div>

@endsection
