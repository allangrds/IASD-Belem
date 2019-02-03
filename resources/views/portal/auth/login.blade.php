@extends('base')

@section('content')
<section class="hero is-fullheight">
  <div class="hero-body">
    <div class="container">
        <div class="column is-4 is-offset-4 ">
            <div class="box">
                <div class="columns">
                    <div class="column">
                        @if ($errors->has('page'))
                            <div class="notification is-danger">
                                {{ $errors->first('page') }}
                            </div>
                        @endif
                    </div>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="field">
                        <label class="label">Email</label>
                        <div class="control">
                            <input
                                autofocus
                                class="input {{ $errors->has('email') ? ' is-danger' : '' }}"
                                name="email"
                                placeholder="Seu email"
                                required
                                type="email"
                                value="{{ old('email') }}"
                            />
                            @if ($errors->has('email'))
                                <span class="has-text-danger" role="alert">
                                    {{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Senha</label>
                        <div class="control">
                            <input
                                class="input {{ $errors->has('password') ? ' is-danger' : '' }}"
                                name="password"
                                placeholder="Sua senha"
                                required
                                type="password"
                            />
                            @if ($errors->has('password'))
                                <span class="has-text-danger" role="alert">
                                    {{ $errors->first('password') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <button class="button is-primary is-large is-fullwidth">
                        Entrar
                    </button>
                </form>
            </div>
        </div>
    </div>
  </div>
</section>
@endsection
