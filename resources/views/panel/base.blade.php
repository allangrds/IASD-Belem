@extends('base')

@section('content')
    <div class="panel">
        <nav class="navbar is-white" role="navigation" aria-label="main navigation">
            <div class="container">
                <div class="navbar-brand">
                    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navMenu">
                        <span aria-hidden="true"></span>
                        <span aria-hidden="true"></span>
                        <span aria-hidden="true"></span>
                    </a>
                </div>

                <div id="navMenu" class="navbar-menu">
                    <div class="navbar-start">
                        <a class="navbar-item" href={{ route('portal_home') }}>
                            Home
                        </a>
                        <a class="navbar-item" href="">
                            Culto ao vivo
                        </a>
                        <a class="navbar-item" href={{ route('portal_informativo') }}>
                            Informativo
                        </a>
                        <a class="navbar-item" href={{ route('portal_lideranca') }}>
                            Liderança
                        </a>
                        <a class="navbar-item" href="">
                            Nossa história
                        </a>
                        <a class="navbar-item" href={{ route('portal_contato') }}>
                            Fale conosco
                        </a>
                    </div>
                    <div class="navbar-end">
                        <div class="navbar-item is-hoverable">
                            <a class="navbar-link">{{ Auth::user()->email }}</a>

                            <div class="navbar-dropdown">
                                <a class="navbar-item" href="{{ route('logout') }}">
                                    Sair
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="columns">
                <div class="column is-3">
                    <aside class="menu">
                        <ul class="menu-list">
                            <li>
                                <a class="@if (Route::currentRouteName() === 'panel_home') is-active @endif"
                                   href={{ route('panel_home') }}
                                >
                                    Painel
                                </a>
                            </li>
                        </ul>
                        <p class="menu-label">
                            Membros da igreja
                        </p>
                        <ul class="menu-list">
                            <li>
                                <a class="@if (Route::currentRouteName() === 'panel_church_members_create') is-active @endif"
                                   href={{ route('panel_church_members_create') }}
                                >
                                    Criar
                                </a>
                            </li>
                            <li>
                                <a class="@if (Route::currentRouteName() === 'panel_church_members') is-active @endif"
                                   href={{ route('panel_church_members') }}
                                >
                                    Listagem
                                </a>
                            </li>
                        </ul>
                        <p class="menu-label">
                            Cargos
                        </p>
                        <ul class="menu-list">
                            <li>
                                <a class="@if (Route::currentRouteName() === 'panel_members_function_create') is-active @endif"
                                   href={{ route('panel_members_function_create') }}
                                >
                                    Criar
                                </a>
                            </li>
                            <li>
                                <a class="@if (Route::currentRouteName() === 'panel_members_function') is-active @endif"
                                   href={{ route('panel_members_function') }}
                                >
                                    Listagem
                                </a>
                            </li>
                        </ul>
                        <p class="menu-label">
                            Departamentos
                        </p>
                        <ul class="menu-list">
                            <li>
                                <a class="@if (Route::currentRouteName() === 'panel_departments_create') is-active @endif"
                                   href={{ route('panel_departments_create') }}
                                >
                                    Criar
                                </a>
                            </li>
                            <li>
                                <a class="@if (Route::currentRouteName() === 'panel_departments') is-active @endif"
                                   href={{ route('panel_departments') }}
                                >
                                    Listagem
                                </a>
                            </li>
                        </ul>
                        <p class="menu-label">
                            Programações
                        </p>
                        <ul class="menu-list">
                            <li>
                                <a class="@if (Route::currentRouteName() === 'panel_schedule_create') is-active @endif"
                                   href={{ route('panel_schedule_create') }}
                                >
                                    Criar
                                </a>
                            </li>
                            <li>
                                <a class="@if (Route::currentRouteName() === 'panel_schedule') is-active @endif"
                                   href={{ route('panel_schedule') }}
                                >
                                    Listagem
                                </a>
                            </li>
                        </ul>
                        <p class="menu-label">
                            Notícias
                        </p>
                        <ul class="menu-list">
                            <li>
                                <a class="@if (Route::currentRouteName() === 'panel_news_create') is-active @endif"
                                   href={{ route('panel_news_create') }}
                                >
                                    Criar
                                </a>
                            </li>
                            <li>
                                <a class="@if (Route::currentRouteName() === 'panel_news') is-active @endif"
                                   href={{ route('panel_news') }}
                                >
                                    Listagem
                                </a>
                            </li>
                        </ul>
                        @if(Auth::user()->can('handle_user'))
                            <p class="menu-label">
                                Usuários
                            </p>
                            <ul class="menu-list">
                                <li>
                                    <a class="@if (Route::currentRouteName() === 'panel_users_create') is-active @endif"
                                       href={{ route('panel_users_create') }}
                                    >
                                        Criar
                                    </a>
                                </li>
                                <li>
                                    <a class="@if (Route::currentRouteName() === 'panel_users') is-active @endif"
                                        href={{ route('panel_users') }}
                                    >
                                        Listagem
                                    </a>
                                </li>
                            </ul>
                        @endif
                    </aside>
                </div>
                <div class="column">
                    @yield('panel_content')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // Get all "navbar-burger" elements
            const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

            // Check if there are any navbar burgers
            if ($navbarBurgers.length > 0) {

                // Add a click event on each of them
                $navbarBurgers.forEach( el => {

                    el.addEventListener('click', () => {
                        // Get the target from the "data-target" attribute
                        const target = el.dataset.target;
                        console.log(el.dataset.target)
                        const $target = document.getElementById(target);

                        // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
                        el.classList.toggle('is-active');
                        $target.classList.toggle('is-active');

                    });
                });
            }

        });
    </script>
@endsection
