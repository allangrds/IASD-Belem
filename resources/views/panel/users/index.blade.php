@extends('panel.base')

@section('panel_content')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li class="is-active"><a href="#">Usuários</a></li>
            <li class="is-active"><a href="#">Listagem</a></li>
        </ul>
    </nav>

    <section class="hero is-small">
        <div class="hero-body">
            <h1 class="title">
                Usuários
            </h1>
            <h2 class="subtitle">
                presentes no site
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
        <table class="table is-striped is-hoverable is-fullwidth">
            <thead>
                <th>Nome</th>
                <th>Email</th>
                <th>Ativo</th>
                <th>Opções</th>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->is_active == true ? 'Sim' : 'Não' }}</td>
                        <td>
                            <form method="POST" action="{{ route('panel_users_destroy', ['id' => $user->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button class="button is-outlined {{ $user->is_active == true ? 'is-danger' : 'is-primary' }}">
                                    {{ $user->is_active == true ? 'Desativar' : 'Ativar' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
