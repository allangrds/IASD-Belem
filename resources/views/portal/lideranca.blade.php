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
                    @foreach($leaderships as $leadership)
                        <div class="column is-2">
                            <div class="floated-box is-vertical-center flex-column">
                                @if ($leadership->department_id)
                                    <span class="subtitle">
                                        Líder
                                    </span>
                                @endif
                                <span class="title">
                                    @if ($leadership->function_id)
                                        @foreach($functions as $function)
                                            @if($function->id == $leadership->function_id)
                                                {{ $function->name }}
                                            @endif
                                        @endforeach
                                    @else
                                        @foreach($departments as $department)
                                            @if($department->id == $leadership->department_id)
                                                {{ $department->name }}
                                            @endif
                                        @endforeach
                                    @endif
                                </span>

                                <figure class="image is-128x128">
                                    @if($leadership->image && strlen($leadership->image) > 1)
                                        <img
                                            class="is-rounded"
                                            src="/storage/images/photos/{{ $leadership->image }}"
                                            alt={{ $leadership->name }}
                                        />
                                    @else
                                        <img
                                            class="is-rounded"
                                            src="https://bulma.io/images/placeholders/128x128.png"
                                            alt="a circle"
                                        />
                                    @endif
                                </figure>

                                <hr />

                                <span class="name">{{ $leadership->name }}</span>
                                <span class="email">{{ $leadership->email }}</span>
                                <span class="phone">{{ $leadership->telephone }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @include('portal.template.footer')
@endsection
