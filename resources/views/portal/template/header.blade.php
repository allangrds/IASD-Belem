<header class="header">
    <div class="container">
        <nav
            aria-label="main navigation"
            class="navbar"
            role="navigation"
        >
            <div class="navbar-brand">
                <a
                    aria-expanded="false"
                    aria-label="menu"
                    class="navbar-burger burger"
                    data-target="navbar-menu"
                    role="button"
                >

                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>
            <div class="navbar-menu">
                <div class="navbar-end">
                    <a class="
                            navbar-item
                            @if (Route::currentRouteName() === 'portal_home') is-active @endif"
                        "
                        href={{ route('portal_home') }}
                    >
                        home
                    </a>
                    <a class="
                        navbar-item
                        @if (Route::currentRouteName() === 'portal_culto') is-active @endif"
                    ">
                        culto ao vivo
                    </a>
                    <a class="
                        navbar-item
                        @if (Route::currentRouteName() === 'portal_informativo') is-active @endif"
                    ">
                        informativo
                    </a>
                    <a class="
                            navbar-item
                            @if (Route::currentRouteName() === 'portal_lideranca') is-active @endif"
                        "
                        href={{ route('portal_lideranca') }}
                    >
                        liderança
                    </a>
                    <a class="
                        navbar-item
                        @if (Route::currentRouteName() === 'portal_historia') is-active @endif"
                    ">
                        nossa história
                    </a>
                    <a class="
                            navbar-item
                            @if (Route::currentRouteName() === 'portal_contato') is-active @endif"
                        "
                        href={{ route('portal_contato') }}
                    >
                        fale conosco
                    </a>
                    <div class="navbar-item">
                        <div class="buttons">
                            <a class="button">
                                Entrar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div class="hero">
        <div class="container logo-container">
            <a href="href={{ route('portal_home') }}">
                <img
                    alt="IASD Belém - Logo"
                    class="logo"
                    src="/images/header/logo.png"
                />
            </a>
        </div>
    </div>
</header>
