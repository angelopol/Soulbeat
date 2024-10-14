@extends('layouts.base')

@section('title') Reviews @php $css = "showreviews" @endphp @endsection

@section('content')
    @include('components.NavBar.aside')

    <div class="wrapper-of-playlist">
        @include('components.NavBar.profile')
        <nav class="all-reviews">
            <div class="content">
                @include('components.profile.review_full', [
                    'photo' => Vite::asset('resources/assets/images/tipa1.jpg'),
                    'name' => 'Jeremy osborn', 'body' => 'i really enjoy your style of rap slfhdsl jghlkj dfghdf ljghsdfj j hdfjhglsdjgh fdslg'
                ])
            </div>
        </nav>
    </div>
@endsection