@extends('panel.base')

@section('panel_content')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li class="is-active"><a href="#">Programações</a></li>
            <li class="is-active"><a href="#">Criar</a></li>
        </ul>
    </nav>

    <section class="hero is-small">
        <div class="hero-body">
            <h1 class="title">
                Criação
            </h1>
            <h2 class="subtitle">
                de programações da igreja
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
        <form method="POST" action="{{ route('panel_schedule_create') }}" enctype="multipart/form-data">
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
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <div class="field">
                        <label class="label" for="name">Mostrar em dia específico</label>
                        <div class="control">
                            <input
                                class="input dt"
                                name="specific_day"
                                required
                                type="text"
                                value="{{ old('specific_day') }}"
                            />
                            @if ($errors->has('specific_day'))
                                <span class="has-text-danger" role="alert">
                                    {{ $errors->first('specific_day') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <div class="field">
                        <label class="label" for="name">Mostrar em dias da semana</label>
                        <div class="control">
                            <select name="week_day" class="input">
                                <option disabled selected>Escolha uma opção</option>
                                <option value="">Nenhuma</option>
                                <option value="domingo">Domingo</option>
                                <option value="segunda">Segunda</option>
                                <option value="terca">Terça</option>
                                <option value="quarta">Quarta</option>
                                <option value="quinta">Quinta</option>
                                <option value="sexta">Sexta</option>
                                <option value="sabado">Sábado</option>
                            </select>
                            @if ($errors->has('week_day'))
                                <span class="has-text-danger" role="alert">
                                    {{ $errors->first('week_day') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <div class="field">
                        <label class="label" for="time">Horário</label>
                        <div class="control">
                            <input
                                autofocus
                                class="input"
                                name="time[]"
                                placeholder="Nome"
                                required
                                type="time"
                                value="{{ old('time[]') }}"
                            />
                            @if ($errors->has('time'))
                                <span class="has-text-danger" role="alert">
                                    {{ $errors->first('time') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="field">
                        <label class="label" for="title">Título</label>
                        <div class="control">
                            <input
                                autofocus
                                class="input"
                                name="title[]"
                                placeholder="Título"
                                required
                                type="text"
                                value="{{ old('title') }}"
                            />
                            @if ($errors->has('title'))
                                <span class="has-text-danger" role="alert">
                                    {{ $errors->first('title') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="column flex align-items-flex-end">
                    <button
                        class="button is-small"
                        id="btnNewTitle"
                        type=button
                    >
                        Adicionar linha
                    </button>
                </div>
            </div>
            <div class="new-line"></div>
            <div class="columns">
                <div class="column">
                    <button class="button is-primary">Criar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
