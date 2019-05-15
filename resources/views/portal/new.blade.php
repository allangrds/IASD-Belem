@extends('base')

@section('content')
    @include('portal.template.header')

    <div class="page">
        <div class="header container">
            <h1 class="title">{{ $new->title }}</h1>
        </div>

        <div class="content">
            <div class="container">
                <div class="columns">
                  <div class="column">
                    <p>
                      {!! nl2br($new->description) !!}
                    </p>
                  </div>
                </div>
                <div class="columns">
                @foreach ($photos as $index => $photo)
                  <div class="column">
                    <a
                      href="/storage/images/photos/{{ $photo->photo }}"
                      target="_blank"
                    >
                      <img src="/storage/images/photos/{{ $photo->photo }}" />
                    </a>
                  </div>
                  @if ($loop->iteration % 4 == 0)
                    </div>
                    <div class="columns">
                  @endif
                @endforeach
                </div>
            </div>
        </div>
    </div>

    @include('portal.template.footer')
@endsection
