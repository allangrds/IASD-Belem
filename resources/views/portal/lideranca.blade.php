@extends('base')

@section('content')
    @include('portal.template.header')

    <div class="page">
        <div class="header container">
            <h1 class="title">Liderança</h1>
        </div>

        <div class="content leadership">
            <div class="container">
                <div class="columns">
                    <div class="column is-2">
                        <div class="floated-box">
                            <span class="title">Pastor</span>

                            <figure class="image is-128x128">
                                <img
                                    class="is-rounded"
                                    src="https://bulma.io/images/placeholders/128x128.png"
                                    alt="pastor"
                                />
                            </figure>

                            <hr />

                            <span class="name">Jose da Silva</span>
                            <span class="email">jose@gmail.com</span>
                            <span class="phone">(11)97485-9685</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('portal.template.footer')
@endsection
