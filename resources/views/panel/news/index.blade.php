@extends('panel.base')

@section('panel_content')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li class="is-active"><a href="#">Notícias</a></li>
            <li class="is-active"><a href="#">Listagem</a></li>
        </ul>
    </nav>

    <section class="hero is-small">
        <div class="hero-body">
            <h1 class="title">
                Notícias
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
                <th>Título</th>
                <th>Descrição</th>
                <th>Publicada em</th>
                <th>Criada em</th>
                <th>Atualizada em</th>
                <th>Opções</th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($news as $new)
                    <tr>
                        <td>{{ $new->title }}</td>
                        <td>{{ $new->description }}</td>
                        <td>{{ $new->published_at->format('d/m/Y') }}</td>
                        <td>{{ $new->created_at->format('d/m/Y H:m:s') }}</td>
                        <td>{{ $new->updated_at->format('d/m/Y H:m:s') }}</td>
                        <td>
                            <div class="columns">
                                <div class="column is-4">
                                    <a
                                        href="{{ route('panel_news_edit', $new->id) }}"
                                        class="button is-outlined"
                                    >
                                        Editar
                                    </a>
                                </div>
                                <div class="column is-4">
                                    <form
                                        method="POST"
                                        action="{{ route('panel_news_destroy', ['id' => $new->id]) }}"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button class="button is-outlined {{ $new->is_active == true ? 'is-danger' : 'is-primary' }}">
                                            {{ $new->is_active == true ? 'Desativar' : 'Ativar' }}
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
        {{ $news->links() }}
    </div>
@endsection
