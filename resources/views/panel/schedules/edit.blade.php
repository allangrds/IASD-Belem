@extends('panel.base')

@section('panel_content')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li class="is-active"><a href="#">Programações</a></li>
            <li class="is-active"><a href="#">Editar</a></li>
        </ul>
    </nav>

    <section class="hero is-small">
        <div class="hero-body">
            <h1 class="title">
                Edição
            </h1>
            <h2 class="subtitle">
                de programação
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
        <form method="POST" action="{{ route('panel_schedule_update', ['id' => $function->id]) }}">
            @csrf
            @method('PATCH')
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
                                value="{{ old('name') ? old('name') : $function->name }}"
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
                                value="{{ old('specific_day') ? old('specific_day') : $function->specific_day }}"
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
                                <option
                                        value="domingo"
                                        {{
                                            old('week_day') === 'domingo' || $function->week_day === 'domingo'
                                            ? 'selected'
                                            : ''
                                        }}
                                >
                                    Domingo
                                </option>
                                <option
                                        value="segunda"
                                        {{
                                            old('week_day') === 'segunda' || $function->week_day === 'segunda'
                                            ? 'selected'
                                            : ''
                                        }}
                                >
                                    Segunda
                                </option>
                                <option
                                        value="terca"
                                        {{
                                            old('week_day') === 'terca' || $function->week_day === 'terca'
                                            ? 'selected'
                                            : ''
                                        }}
                                >
                                    Terça
                                </option>
                                <option
                                        value="quarta"
                                        {{
                                            old('week_day') === 'quarta' || $function->week_day === 'quarta'
                                            ? 'selected'
                                            : ''
                                        }}
                                >
                                    Quarta
                                </option>
                                <option
                                        value="quinta"
                                        {{
                                            old('week_day') === 'quinta' || $function->week_day === 'quinta'
                                            ? 'selected'
                                            : ''
                                        }}
                                >
                                    Quinta
                                </option>
                                <option
                                        value="sexta"
                                        {{
                                            old('week_day') === 'sexta' || $function->week_day === 'sexta'
                                            ? 'selected'
                                            : ''
                                        }}
                                >
                                    Sexta
                                </option>
                                <option
                                        value="sabado"
                                        {{
                                            old('week_day') === 'sabado' || $function->week_day === 'sabado'
                                            ? 'selected'
                                            : ''
                                        }}
                                >
                                    Sábado
                                </option>
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
            <div class="new-line">
                @foreach($function->times as $timeKey=>$time)
                    @foreach($time->descriptions as $descriptionKey=>$description)
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
                                            value="{{ $time->time }}"
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
                                            value="{{ $description->name }}"
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
                                @if ($timeKey === 0 && $descriptionKey === 0)
                                    <button
                                        class="button is-small"
                                        id="btnNewTitle"
                                        type=button
                                    >
                                        Adicionar linha
                                    </button>
                                @else
                                    <button
                                        class="button is-outlined is-danger is-small btn-remove"
                                        type="button"
                                    >
                                        Excluir
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endforeach
                @if (strlen($function->times) === 0)
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
                                        />
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
                                        />
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
                @endif
            </div>
            <div class="columns">
                <div class="column">
                    <button class="button is-primary">Editar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
