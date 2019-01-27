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
            <div class="column is-6">
                <section class="news">
                    <h2 class="title">Últimas notícias</h2>
                    <article class="item">
                        <span class="time"><time>
                            25 de julho de 2018, 19:22
                        </time></span>
                        <h1 class="title">Título da notícia</h1>
                        <hr class="separator"/>
                    </article>
                </section>
            </div>
            <div class="column is-6">
                <section class="photos">
                    <h2 class="title">Últimas fotos</h2>
                    <div class="columns">
                        <div class="column">
                            <img
                                class="item"
                                src="/images/home/foto1.png"
                                alt=""
                            />
                        </div>
                        <div class="column">
                            <div class="columns">
                                <div class="column">
                                    <img
                                        class="item"
                                        src="/images/home/foto2.png"
                                        alt=""
                                    />
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column">
                                    <img
                                        class="item"
                                        src="/images/home/foto2.png"
                                        alt=""
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    @include('portal.template.footer')
@endsection
