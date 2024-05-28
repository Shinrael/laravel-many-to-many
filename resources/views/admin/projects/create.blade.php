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
    <h1>Aggiungi un Progetto al Database!</h1>
    <div class="row">
        <div class="col-10">
            <!-- Form -->
            <form action="{{ route('admin.projects.store') }}" method="POST">
                @csrf

                <!-- Campo per il titolo -->
                <div class="mb-3">
                  <label for="title" class="form-label">Titolo</label>
                  <input
                    name="title"
                    type="text"
                    class="form-control @error('title') is-invalid @enderror"
                    id="title"
                    value="{{ old('title') }}">
                    @error('title')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <!-- Campo per il testo del progetto -->
                <div class="mb-3">
                  <label for="body" class="form-label">Testo</label>
                    <textarea
                        name="body"
                        type="text"
                        class="form-control @error('body') is-invalid @enderror"
                        id="body"
                        value="{{ old('body') }}">
                    </textarea>
                  @error('body')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>


                <!-- Pulsante per inviare il form -->
                <button type="submit" class="btn btn-success">Aggiungi il nuovo Progetto </button>
                <!-- Pulsante per resettare il form -->
                <button type="reset" class="btn btn-warning">Reset</button>
              </form>
        </div>
    </div>
</div>

@endsection
