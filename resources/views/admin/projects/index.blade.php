@php
    use \Carbon\Carbon;
@endphp

@extends('layouts.admin')

@section('content')
    <h2>Progetti</h2>

    {{-- Visualizzazione degli errori di validazione --}}
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Messaggio di errore dalla sessione --}}
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    {{-- Messaggio di successo dalla sessione --}}
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabella per visualizzare i progetti --}}
    <table class="table table-hover w-100 ">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Titolo</th>
                <th scope="col">Tipo</th>
                <th scope="col">Data</th>
                <th scope="col">Azioni</th>
            </tr>
        </thead>
        <tbody>
            {{-- Loop sui progetti con gestione del caso in cui non ci siano progetti --}}
            @forelse ($projects as $project)
                <tr>
                    {{-- ID del progetto --}}
                    <td>{{ $project->id }}</td>

                    {{-- Titolo del progetto --}}
                    <td>{{ $project->title }}</td>

                    {{-- Tipo del progetto --}}
                    @if ($project->type)
                    <td> {{ $project->type->title }} </td>
                    @else
                    <td>Nothing</td>
                    @endif


                    {{-- Data dell'ultimo aggiornamento formattata --}}
                    <td>{{ Carbon::parse($project->updated_at)->format('d/m/Y') }}</td>

                    {{-- Colonna delle azioni: visualizza, modifica, elimina --}}
                    <td>
                        {{-- Pulsante per visualizzare --}}
                        <a class="btn btn-success" href="{{ route('admin.projects.show', $project) }}">
                            <i class="fa-regular fa-eye"></i>
                        </a>

                        {{-- Pulsante per modificare --}}
                        <a class="btn btn-warning" href="{{ route('admin.projects.edit', $project) }}">
                            <i class="fa-solid fa-pencil"></i>
                        </a>

                        {{-- Form per eliminare con conferma --}}
                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Sei sicuro di voler cancellare {{ $project->title }} dalla collezione?')" >
                            @csrf
                            @method('DELETE')
                            {{-- Pulsante per confermare l'eliminazione --}}
                            <button class="btn btn-danger" type="submit">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            {{-- Messaggio in caso non ci sia nulla da mostrare --}}
            @empty
                <tr>
                    <td colspan="4" class="text-center">Nessun Prodotto da Mostrare</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $projects->links('pagination::bootstrap-5') }}
@endsection
