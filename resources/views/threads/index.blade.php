@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @foreach ($threads as $thread)
                <article class="card">
                    <h4 class="card-header">
                        <a href="{{ $thread->path() }}">
                            {{ $thread->title }}
                        </a>
                    </h4>
                    <div class="card-body">
                        {{ $thread->body }}
                    </div>
                </article>
             <br>
            @endforeach

        </div>
    </div>
</div>
@endsection
