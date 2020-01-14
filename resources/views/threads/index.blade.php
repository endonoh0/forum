@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($threads as $thread)
                <article class="card">
                    <div class="card-header level">
                        {{-- Thread title --}}
                        <h4 class="flex">
                            <a href="{{ $thread->path() }}">
                                {{ $thread->title }}
                            </a>
                        </h4>
                        {{-- Reply count --}}
                        <a href="{{ $thread->path() }}">
                            {{ $thread->replies_count }} {{ Str::plural('reply', $thread->replies_count) }}
                        </a>
                    </div>
                    {{-- Thread body --}}
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
