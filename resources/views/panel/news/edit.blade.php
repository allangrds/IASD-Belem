@extends('panel.base')

@section('panel_content')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li class="is-active"><a href="#">Notícias</a></li>
            <li class="is-active"><a href="#">Editar</a></li>
        </ul>
    </nav>

    <section class="hero is-small">
        <div class="hero-body">
            <h1 class="title">
                Edição
            </h1>
            <h2 class="subtitle">
                de notícias
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

            @if ($errors->has('photo.*'))
                <div class="notification is-danger">
                    {{ $errors->first('photo.*') }}
                </div>
            @endif
        </div>
    </div>

    <div class="box">
        <form method="POST" action="{{ route('panel_news_update', ['id' => $news->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="columns">
                <div class="column">
                    <div class="field">
                        <label class="label" for="title">Nome</label>
                        <div class="control">
                            <input
                                autofocus
                                class="input"
                                id="title"
                                name="title"
                                placeholder="Título"
                                required
                                type="text"
                                value="{{ old('title') ? old('title') : $news->title }}"
                            />
                            @if ($errors->has('title'))
                                <span class="has-text-danger" role="alert">
                                    {{ $errors->first('title') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <div class="field">
                        <label class="label" for="show_on_home">Mostrar na home</label>
                        <div class="control">
                            <label class="radio">
                                <input
                                    type="radio"
                                    name="show_on_home"
                                    value="true"
                                    {{
                                        old('show_on_home') === 'true' || $news->show_on_home === 1
                                            ? 'checked'
                                            : ''
                                    }}
                                />
                                Sim
                            </label>
                            <label class="radio">
                                <input
                                    type="radio"
                                    name="show_on_home"
                                    value="false"
                                    {{
                                        old('show_on_home') === 'false' || $news->show_on_home === 0
                                            ? 'checked'
                                            : ''
                                    }}
                                />
                                Não
                            </label>
                            @if ($errors->has('show_on_home'))
                                <span class="has-text-danger" role="alert">
                                    {{ $errors->first('show_on_home') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <div class="field">
                        <label class="label" for="show_on_informative">Mostrar no informativo</label>
                        <div class="control">
                            <label class="radio">
                                <input
                                    type="radio"
                                    name="show_on_informative"
                                    value="true"
                                    {{
                                        old('show_on_informative') === 'true' || $news->show_on_informative === 1
                                            ? 'checked'
                                            : ''
                                    }}
                                />
                                Sim
                            </label>
                            <label class="radio">
                                <input
                                    type="radio"
                                    name="show_on_informative"
                                    value="false"
                                    {{
                                        old('show_on_informative') === 'false' || $news->show_on_informative === 0
                                            ? 'checked'
                                            : ''
                                    }}
                                />
                                Não
                            </label>
                            @if ($errors->has('show_on_informative'))
                                <span class="has-text-danger" role="alert">
                                    {{ $errors->first('show_on_informative') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <div class="field">
                        <label class="label" for="description">Descrição</label>
                        <div class="control">
                            <textarea
                                id="description"
                                name="description"
                                class="textarea has-fixed-size"
                                placeholder="Descrição da notícia"
                            >{{ old('description') ? old('description') : $news->description }}</textarea>
                            @if ($errors->has('description'))
                                <span class="has-text-danger" role="alert">
                                    {{ $errors->first('description') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <div class="field">
                        <label class="label" for="name">Publicar em</label>
                        <div class="control">
                            <input
                                class="input dt"
                                name="published_at"
                                placeholder="Publicar em"
                                required
                                type="text"
                                value="{{ old('published_at') ? old('published_at') : $news->published_at }}"
                            />
                            @if ($errors->has('published_at'))
                                <span class="has-text-danger" role="alert">
                                    {{ $errors->first('published_at') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <div class="field">
                        <label class="label" for="description">Fotos atuais</label>
                    </div>
                </div>
            </div>
            @foreach ($photos as $photo)
                <div class="columns">
                    <div class="column">
                        <div class="field">
                            <img src="/storage/images/photos/{{ $photo->photo }}" />
                        </div>
                    </div>
                    <div class="column">
                        <div class="control">
                            <div class="field">
                                <label class="checkbox">
                                    <input type="checkbox" name="photo_exclude[]" value="{{ $photo->photo }}" />
                                    Excluir
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="columns">
                <div class="column">
                    <div class="field">
                        <label class="label" for="description">Novas fotos</label>
                        <div class="control">
                            <div class="file has-name">
                                <label class="file-label">
                                    <input class="file-input" type="file" name="photo[]">
                                    <span class="file-cta">
                                            <span class="file-icon">
                                                <i class="fas fa-upload"></i>
                                            </span>
                                            <span class="file-label">
                                                Escolha um arquivo...
                                            </span>
                                        </span>
                                    <span class="file-name">Local do arquivo</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="field">
                        <div class="control">
                            <button class="button is-small margin-top-20" type="button" id="btnNewPhoto">
                                Mais
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="new-line"></div>
            <div class="columns">
                <div class="column">
                    <button class="button is-primary">Editar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
