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
                    <div class="column">
                        @if (session('message'))
                            <div class="notification is-success">
                                {{ session('message') }}
                            </div>
                        @endif

                        @if ($errors->has('page'))
                            <div class="notification is-danger">
                                {{ $errors->first('page') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="columns">
                    <div class="column is-8">
                        <form method="POST" action="{{ route('portal_contato_post') }}">
                            @csrf
                            <div class="columns">
                                <div class="column">
                                    <input
                                        aria-label="name"
                                        class="input"
                                        name="name"
                                        placeholder="Digite seu nome"
                                        type="text"
                                    />
                                    @if ($errors->has('name'))
                                        <span class="has-text-danger" role="alert">
                                            {{ $errors->first('name') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="column">
                                    <input
                                        aria-label="email"
                                        class="input"
                                        name="email"
                                        placeholder="Digite seu email"
                                        type="text"
                                    />
                                    @if ($errors->has('email'))
                                        <span class="has-text-danger" role="alert">
                                            {{ $errors->first('email') }}
                                        </span>
                                    @endif
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
                                    @if ($errors->has('message'))
                                        <span class="has-text-danger" role="alert">
                                            {{ $errors->first('message') }}
                                        </span>
                                    @endif
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
