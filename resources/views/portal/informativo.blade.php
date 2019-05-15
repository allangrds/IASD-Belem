@extends('base')

@section('content')
    @include('portal.template.header')

    <div class="page">
        <div class="header container">
            @if ($schedule)
                <span class="date">
                    <time datetime={{date('d/m/Y')}}>
                        {{ date('d/m/Y') }}
                    </time>
                </span>
                <h1 class="title">Informativo</h1>
            @else
                <h1 class="title">Hoje não existe informativo</h1>
            @endif
        </div>

        @if ($schedule)
            <div class="content">
                <div class="container">
                    <div class="columns informative">
                        <div class="column is-3">
                            <div class="floated-box">
                                <div class="title-box">
                                    <span class="title">Programação</span>
                                    <hr class="line" />
                                </div>
                                @foreach($schedule->times as $time)
                                    <div class="columns">
                                        <div class="column is-3">{{ $time->time }}</div>
                                        <div class="column is-9">
                                            <ul class="list">
                                                @foreach ($time->descriptions as $description)
                                                    <li>{{ $description->name }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="column is-3">
                            <div class="floated-box">
                                <div class="title-box">
                                    <span class="title">Anúncios</span>
                                    <hr class="line" />
                                </div>
                                @foreach ($news as $new)
                                    <div class="columns notice">
                                        <div class="column">
                                            <p class="title">{{ $new->title }}</p>
                                            <p class="text">
                                                {{ $new->description }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="column">
                            <div class="floated-box">
                                <div class="title-box">
                                    <span class="title">Aniversariantes da semana</span>
                                    <hr class="line" />
                                </div>
                                <div class="columns">
                                    @foreach($members as $member)
                                        <div class="column birthday flex-column align-items-center">
                                            <figure class="image is-128x128">
                                                <img
                                                    class="is-rounded"
                                                    src="/storage/images/photos/{{ $member->image }}"
                                                    alt={{$member->name}}
                                                >
                                            </figure>
                                            <span class="title">{{ $member->name }}</span>
                                            <span class="date">
                                                {{ Carbon\Carbon::parse($member->born_at)->age }} anos
                                            </span>
                                        </div>
                                        @if ($loop->iteration % 3 == 0)
                                            </div>
                                            <div class="columns">
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @include('portal.template.footer')
@endsection
