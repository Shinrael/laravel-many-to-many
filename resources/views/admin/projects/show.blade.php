@php
    use \Carbon\Carbon;
@endphp

@extends('layouts.admin')

@section('content')

<div class="container bg-white py-3 my-2">

    <h1>{{ $project->title }} <a class="btn btn-warning" href="{{ route('admin.projects.edit', $project) }}"><i class="fa-solid fa-pencil"></i></a> </h1>

    @if ($project->type)
        <p> Tipo: <span class="badge text-bg-warning">{{ $project->type->title }}</span></p>
    @else
        <p> Tipo: <span class="badge text-bg-danger">Nothing</span></p>
    @endif


    <div class="my-5">
        <p>{{ $project->body }}</p>
    </div>


    <div class="my-5">
        <p>Data Progetto:  {{ Carbon::parse($project->updated_at)->format('d/m/Y') }}</p>
    </div>

    <div class="my-5">
        <a href=" {{ route('admin.projects.index') }} " class="btn btn-primary" >Torna ai progetti</a>
    </div>
</div>

@endsection

