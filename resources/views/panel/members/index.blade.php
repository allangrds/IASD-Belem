@extends('panel.base')

@section('panel_content')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li class="is-active"><a href="#">Membros da igreja</a></li>
            <li class="is-active"><a href="#">Listagem</a></li>
        </ul>
    </nav>

    <section class="hero is-small">
        <div class="hero-body">
            <h1 class="title">
                Membros da igreja
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
                <th>Foto</th>
                <th>Nome</th>
                <th>Data de nascimento</th>
                <th>Cargo</th>
                <th>Departamento</th>
                <th>Ativo</th>
                <th>Opções</th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($members as $user)
                    <tr>
                        <td>
                            @if($user->image)
                                <figure class="image is-64x64">
                                    <img
                                        class="is-rounded"
                                        src="/storage/images/photos/{{ $user->image }}"
                                        alt={{ $user->name }}
                                    />
                                </figure>
                            @endif
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->born_at->format('d/m/Y') }}</td>
                        <td>
                            @foreach($functions as $function)
                                @if($function->id == $user->function_id)
                                    {{ $function->name }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($departments as $department)
                                @if($department->id == $user->department_id)
                                    {{ $department->name }}
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $user->is_active == true ? 'Sim' : 'Não' }}</td>
                        <td>
                            <a
                                href="{{ route('panel_church_members_edit', $user->id) }}"
                                class="button is-outlined"
                            >
                                Editar
                            </a>
                        </td>
                        <td>
                            <form
                                method="POST"
                                action="{{ route('panel_church_members_destroy', ['id' => $user->id]) }}"
                            >
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

    <div class="box">
        {{ $members->links() }}
    </div>
@endsection
