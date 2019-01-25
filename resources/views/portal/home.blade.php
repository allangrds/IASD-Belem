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

    @include('portal.template.footer')
@endsection
