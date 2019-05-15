@extends('base')

@section('content')
    @include('portal.template.header')

    <section class="container featured">
        <div class="columns">
            <div class="column floated-box is-3-desktop is-3-tablet">
                <div class="content">
                    <img
                        class="icon"
                        src="/images/home/culto.png"
                        alt="Computar com botão de play"
                    />
                    <h1 class="title">Culto ao vivo</h1>
                    <h2 class="subtitle">Veja nosso culto da sua casa</h2>
                    <a class="button is-link" href="">
                        Acompanhe agora
                    </a>
                </div>
            </div>

            <div class="column floated-box is-3-desktop is-3-tablet">
                <div class="content">
                    <img
                        class="icon"
                        src="/images/home/informativo.png"
                        alt="Um folder dobrado"
                    />
                    <h1 class="title">Informativo</h1>
                    <h2 class="subtitle">Veja a programação de 20/12</h2>
                    <a class="button is-link" href="">
                        Ler agora
                    </a>
                </div>
            </div>

            <div class="column floated-box is-3-desktop is-3-tablet">
                <div class="content">
                    <img
                        class="icon"
                        src="/images/home/lideranca.png"
                        alt="Um grupo de pessoas"
                    />
                    <h1 class="title">Liderança</h1>
                    <h2 class="subtitle">Conheça nossos líderes</h2>
                    <a class="button is-link" href="">
                        Ver informações
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="container last-activity">
        <div class="columns">
            <div class="column is-5">
                <section class="news">
                    <h2 class="title">Últimas notícias</h2>
                    @foreach ($news as $new)
                        <article class="item">
                        <span class="time"><time>
                            publicada em {{ $new->published_at->format('d/m/Y') }}
                        </time></span>
                            <h1 class="title">
                                <a
                                    href="{{ route('portal_noticias_descricacao', $new->id) }}"
                                    target="_blank"
                                >
                                    {{ $new->title }}
                                </a>
                            </h1>
                            <hr class="separator"/>
                        </article>
                    @endforeach
                    <div class="columns">
                        <div class="column">
                            {{ $news->links() }}
                        </div>
                    </div>
                </section>
            </div>
            <div class="column is-offset-2 is-5">
                <section class="photos">
                    <h2 class="title">Últimas fotos</h2>
                    @if ($photos[0])
                        <div class="columns">
                            <div class="column">
                                <a
                                    href="/storage/images/photos/{{ $photos[0]->photo }}"
                                    target="_blank"
                                >
                                    <img class="item" src="/storage/images/photos/{{ $photos[0]->photo }}" />
                                </a>
                            </div>
                            <div class="column">
                                <div class="columns">
                                    <div class="column">
                                        @if ($photos[1])
                                            <a
                                                href="/storage/images/photos/{{ $photos[1]->photo }}"
                                                target="_blank"
                                            >
                                                <img class="item" src="/storage/images/photos/{{ $photos[1]->photo }}" />
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="column">
                                        @if ($photos[2])
                                            <a
                                                href="/storage/images/photos/{{ $photos[2]->photo }}"
                                                target="_blank"
                                            >
                                                <img class="item" src="/storage/images/photos/{{ $photos[2]->photo }}" />
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="columns">
                        <div class="column">
                            {{ $photos->links() }}
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    @include('portal.template.footer')
@endsection
