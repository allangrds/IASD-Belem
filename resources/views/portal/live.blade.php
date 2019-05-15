@extends('base')

@section('content')
    @include('portal.template.header')

    <div class="contact page">
        <div class="header container">
            <h1 class="title">Culto ao vivo</h1>
        </div>

        <div class="content">
            <div class="container">
                <div class="columns">
                    <div class="column">
                        <iframe
                            src="https://www.youtube.com/embed/Os_TB7iQQK8"
                            frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                        >
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('portal.template.footer')
@endsection
