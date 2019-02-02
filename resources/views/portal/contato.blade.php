@extends('base')

@section('content')
    @include('portal.template.header')

    <div class="contact page">
        <div class="header container">
            <h1 class="title">Fale conosco</h1>
        </div>

        <div class="content">
            <div class="container">
                <div class="columns">
                    <div class="column is-8">
                        <form action="">
                            <div class="columns">
                                <div class="column">
                                    <input
                                        aria-label="name"
                                        class="input"
                                        name="name"
                                        placeholder="Digite seu nome"
                                        type="text"
                                    />
                                </div>
                                <div class="column">
                                    <input
                                        aria-label="email"
                                        class="input"
                                        name="email"
                                        placeholder="Digite seu email"
                                        type="text"
                                    />
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column">
                                    <textarea
                                        aria-label="message"
                                        class="textarea"
                                        name="message"
                                        placeholder="Digite sua mensagem"
                                    ></textarea>
                                </div>
                            </div>
                            <input
                                aria-label="Enviar mensagem"
                                class="button is-primary"
                                value="Enviar mensagem"
                                type="submit"
                            />
                        </form>
                    </div>
                    <div class="address column is-4">
                        <span class="title">Endereço</span>
                        <span class="text">
                            Rua Martim Affonso, 152 - Belenzinho,
                            São Paulo - SP, 03057-050
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('portal.template.footer')
@endsection
