@extends('panel.base')

@section('panel_content')
    <section class="hero is-small">
        <div class="hero-body">
            <h1 class="title">
                Painel
            </h1>
            <h2 class="subtitle">
                informações gerais do site
            </h2>
        </div>
    </section>

    <div class="tile is-ancestor has-text-centered">
        <div class="tile is-vertical is-parent is-4">
            <div class="tile is-child box">
                <span class="title">
                    {{ $usersCount }}
                </span>
                <br />
                <span class="subtitle">
                    usuários com perfil ativo
                </span>
            </div>
        </div>
    </div>
@endsection
