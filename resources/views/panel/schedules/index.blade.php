@extends('panel.base')

@section('panel_content')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li class="is-active"><a href="#">Programações</a></li>
            <li class="is-active"><a href="#">Listagem</a></li>
        </ul>
    </nav>

    <section class="hero is-small">
        <div class="hero-body">
            <h1 class="title">
                Programações
            </h1>
            <h2 class="subtitle">
                da igreja
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
                <th>Opções</th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($functions as $function)
                    <tr>
                        <td>{{ $function->name }}</td>
                        <td>
                            <div class="columns">
                                <div class="column is-2">
                                    <a
                                        href="{{ route('panel_schedule_edit', $function->id) }}"
                                        class="button is-outlined"
                                    >
                                        Editar
                                    </a>
                                </div>
                                <div class="column is-2">
                                    <form
                                        method="POST"
                                        action="{{ route('panel_schedule_destroy', ['id' => $function->id]) }}"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button class="button is-outlined {{ $function->is_active == true ? 'is-danger' : 'is-primary' }}">
                                            {{ $function->is_active == true ? 'Desativar' : 'Ativar' }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="box">
        {{ $functions->links() }}
    </div>
@endsection
