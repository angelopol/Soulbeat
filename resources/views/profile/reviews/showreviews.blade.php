@extends('layouts.base')

@section('title') Reviews @php $css = "showreviews" @endphp @endsection

@section('content')
    @include('components.NavBar.aside')

    <div class="wrapper-of-playlist">
        @include('components.NavBar.profile')
        <nav class="all-reviews">
            <div class="content">
                @foreach ($reviews as $review)
                    @include('components.profile.review_full', [
                        'photo' => Storage::url($review->UserPhoto), 'title' => $review->title, 'qualify' => $review->qualify,
                        'name' => $review->PersonName.' '.$review->PersonFullName, 'body' => $review->body
                    ])
                @endforeach
            </div>
        </nav>
    </div>
@endsection