@extends('layouts.admin')

@section('content')
    <h2>Tecnologie</h2>

    @if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="my-4">
        <form action="{{ route('admin.technologies.store') }}" method="POST" class="d-flex">
            @csrf
            <input type="search" placeholder="Nuova Tecnologia" class="form-control me-2" name="title">
            <button class="btn btn-outline-success " type="submit">Invia</button>
        </form>
    </div>

    <table class="table table-crud">
        <thead>
          <tr>
            <th scope="col">Tecnologie</th>
            <th scope="col">Azioni</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($technologies as $technology)
            <tr>
              <td>
                <form
                  action="{{ route('admin.technologies.update', $technology) }}"
                  method="POST"
                  id="form-edit-{{ $technology->id }}">
                    @csrf
                    @method('PUT')
                    <input type="text" value="{{ $technology->title }}" name="title">
                </form>
              </td>
              <td class="d-flex">
                <button
                  class="btn btn-warning me-2"
                  onclick="submitForm({{ $technology->id }})"><i class="fa-solid fa-pen"></i></button>
                <form
                  action="{{ route('admin.technologies.destroy', $technology)}}"
                  method="POST"
                  onsubmit="return confirm('Sei sicuro di volerla eliminare?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                </form>
              </td>
            </tr>
            @endforeach
        </tbody>
      </table>

      <script>
        function submitForm(id){
            const form = document.getElementById(`form-edit-${id}`);
            form.submit();
        }
      </script>
@endsection
