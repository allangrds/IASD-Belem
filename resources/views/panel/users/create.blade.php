@extends('panel.base')

@section('panel_content')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li class="is-active"><a href="#">Usuários</a></li>
            <li class="is-active"><a href="#">Criar</a></li>
        </ul>
    </nav>

    <section class="hero is-small">
        <div class="hero-body">
            <h1 class="title">
                Criação
            </h1>
            <h2 class="subtitle">
                de usuário
            </h2>
        </div>
    </section>

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

    <div class="box">
        <form method="POST" action="{{ route('panel_users_store') }}">
            @csrf
            <div class="columns">
                <div class="column">
                    <div class="field">
                        <label class="label" for="name">Nome</label>
                        <div class="control">
                            <input
                                autofocus
                                class="input"
                                id="name"
                                name="name"
                                placeholder="Nome"
                                required
                                type="text"
                                value="{{ old('name') }}"
                            />
                            @if ($errors->has('name'))
                                <span class="has-text-danger" role="alert">
                                    {{ $errors->first('name') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="field">
                        <label class="label" for="email">Email</label>
                        <div class="control">
                            <input
                                class="input"
                                id="email"
                                name="email"
                                placeholder="Email"
                                required
                                type="email"
                                value="{{ old('email') }}"
                            />
                            @if ($errors->has('email'))
                                <span class="has-text-danger" role="alert">
                                    {{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="field">
                        <label class="label" for="password">Senha</label>
                        <div class="control">
                            <input
                                class="input"
                                id="password"
                                name="password"
                                placeholder="Senha"
                                required
                                type="password"
                            />
                            @if ($errors->has('password'))
                                <span class="has-text-danger" role="alert">
                                    {{ $errors->first('password') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <button class="button is-primary">Criar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
