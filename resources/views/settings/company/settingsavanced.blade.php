@extends('layouts.base')

@section('title') Company settings @php $css = "settingsavanced" @endphp @endsection

@section('content')
    <div class="wrapper" id="container">
        @include('components.NavBar.CompanySettings')
        <div class="contenedor-variable" id="cambiable">
            <div class="content-cards">
                @include('components.settings.items.license', ['name' => 'Nombre', 'description' => 'Descripcion'])
            </div>
        </div>
        <div class="contenedor-variable" id="divdepaid">
            <div class="content-cards">
                @include('components.settings.items.PaidMethod', ['name' => 'Nombre', 'description' => 'Descripcion'])
            </div>
        </div>
        <div class="contenedor-variable" id="divdecomuser">
            <div class="content-cards">
                @include('components.settings.items.CompanyUser', ['name' => 'Nombre', 'description' => 'Descripcion'])
            </div>
        </div>
        <div class="contenedor-variable" id="divguides">
            <div class="content-cards">
                @include('components.settings.items.guide', ['name' => 'Nombre', 'description' => 'Descripcion'])
            </div>
        </div>
        <div class="contenedor-variable" id="divdeqa">
            <div class="content-cards">
                @include('components.settings.items.qa', ['name' => 'Nombre', 'description' => 'Descripcion'])
            </div>
        </div>
    </div>
    <script src="{{ Vite::asset('resources/js/settingsavanced.js') }}"></script>
@endsection