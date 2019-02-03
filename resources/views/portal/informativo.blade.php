@extends('base')

@section('content')
    @include('portal.template.header')

    <div class="page">
        <div class="header container">
            <span class="date">
                <time datetime="2017-02-14">
                    20 de janeiro de 2018
                </time>
            </span>
            <h1 class="title">Informativo</h1>
        </div>

        <div class="content">
            <div class="container">
                <div class="columns informative">
                    <div class="column is-3">
                        <div class="floated-box">
                            <div class="title-box">
                                <span class="title">Programação</span>
                                <hr class="line" />
                            </div>
                            <div class="columns">
                                <div class="column is-3">09:30</div>
                                <div class="column is-9">
                                    <ul class="list">
                                        <li>Boas vindas</li>
                                        <li>Ministério de Louvor</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column is-3">10:30</div>
                                <div class="column is-9">
                                    <ul class="list">
                                        <li>Mensagem pastoral</li>
                                        <li>Louvor</li>
                                        <li>Intervalo</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column is-3">11:10</div>
                                <div class="column is-9">
                                    <ul class="list">
                                        <li>Escola sabatina</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column is-3">12:10</div>
                                <div class="column is-9">
                                    <ul class="list">
                                        <li>Encerramento</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column is-3">
                        <div class="floated-box">
                            <div class="title-box">
                                <span class="title">Anúncios</span>
                                <hr class="line" />
                            </div>
                            <div class="columns notice">
                                <div class="column">
                                    <p class="title">Título do anúncio</p>
                                    <p class="text">
                                        Lorem ipsum dolor sit amet, consectetur
                                        adipiscing elit. Proin dapibus, quam sit
                                        amet aliquam posuere, libero massa
                                        sagittis augue, quis elementum augue
                                        purus in justo. Aliquam ac nisl eu nibh
                                        lacinia placerat. Vestibulum quis nibh
                                        vitae elit egestas iaculis. Integer
                                        tempus iaculis malesuada. Fusce in
                                        tempus lorem.
                                    </p>
                                </div>
                            </div>
                            <div class="columns notice">
                                <div class="column">
                                    <p class="title">Título do anúncio</p>
                                    <p class="text">
                                        Lorem ipsum dolor sit amet, consectetur
                                        adipiscing elit. Proin dapibus, quam sit
                                        amet aliquam posuere, libero massa
                                        sagittis augue, quis elementum augue
                                        purus in justo. Aliquam ac nisl eu nibh
                                        lacinia placerat. Vestibulum quis nibh
                                        vitae elit egestas iaculis. Integer
                                        tempus iaculis malesuada. Fusce in
                                        tempus lorem.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="floated-box">
                            <div class="title-box">
                                <span class="title">Aniversariantes</span>
                                <hr class="line" />
                            </div>
                            <div class="columns">
                                <div class="column birthday">
                                    <figure class="image is-128x128">
                                        <img class="is-rounded" src="https://bulma.io/images/placeholders/128x128.png">
                                    </figure>
                                    <span class="title">José Aguilar</span>
                                    <span class="date">25 anos</span>
                                </div>
                                <div class="column birthday">
                                    <figure class="image is-128x128">
                                        <img class="is-rounded" src="https://bulma.io/images/placeholders/128x128.png">
                                    </figure>
                                    <span class="title">José Aguilar</span>
                                    <span class="date">25 anos</span>
                                </div>
                                <div class="column birthday">
                                    <figure class="image is-128x128">
                                        <img class="is-rounded" src="https://bulma.io/images/placeholders/128x128.png">
                                    </figure>
                                    <span class="title">José Aguilar</span>
                                    <span class="date">25 anos</span>
                                </div>
                                <div class="column birthday">
                                    <figure class="image is-128x128">
                                        <img class="is-rounded" src="https://bulma.io/images/placeholders/128x128.png">
                                    </figure>
                                    <span class="title">José Aguilar</span>
                                    <span class="date">25 anos</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('portal.template.footer')
@endsection
