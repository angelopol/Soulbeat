@extends('layouts.base')

@section('title') Company settings @php $css = "settingsavanced" @endphp @endsection

@section('content')
    <div class="wrapper" id="container">
        @include('components.NavBar.CompanySettings')
        {{ $errors }}
        <div class="contenedor-variable" id="cambiable">
            <div class="content-cards">
                @foreach ($licenses as $license)
                    @include('components.settings.items.license', ['name' => $license->name, 'description' => $license->feature, 'license' => $license])
                @endforeach
            </div>
        </div>
        <div class="contenedor-variable" id="divdepaid">
            <div class="content-cards">
                @foreach ($PaidMethods as $PaidMethod)
                    @include('components.settings.items.PaidMethod', ['name' => $PaidMethod->name, 'description' => $PaidMethod->description])
                @endforeach
            </div>
        </div>
        <div class="contenedor-variable" id="divdecomuser">
            <div class="content-cards">
                @foreach ($users as $user)
                    @include('components.settings.items.CompanyUser', [
                        'name' => $user->UserName, 'description' => $user->email,
                        'LastName' => $user->FullName, 'PersonName' => $user->name
                    ])
                @endforeach
            </div>
        </div>
        <div class="contenedor-variable" id="divguides">
            <div class="content-cards">
                @foreach ($guides as $guide)
                    @include('components.settings.items.guide', ['name' => $guide->title, 'description' => $guide->summary])
                @endforeach
            </div>
        </div>
        <div class="contenedor-variable" id="divdeqa">
            <div class="content-cards">
                @foreach ($qas as $qa)
                    @include('components.settings.items.qa', ['name' => $qa->question, 'description' => $qa->answer])
                @endforeach
            </div>
        </div>
    </div>
    <script src="/resources/js/settingsavanced.js"></script>
@endsection