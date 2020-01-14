@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">

            {{-- Thread --}}
            <div class="card">
                <div class="card-header">
                    <a href="#">{{ $thread->creator->name }}</a> posted:
                    {{ $thread->title }}
                </div>
                <div class="card-body">
                    <div class="body">
                        {{ $thread->body }}
                    </div>
                </div>
            </div>

            <br>

            {{-- Reply --}}
            @foreach ($thread->replies as $reply)
                @include ('threads.reply')
            @endforeach

            {{-- Add Form Reply --}}
            @if (auth()->check())
                <form method="POST" action="{{ $thread->path() . '/replies' }}">
                    @csrf

                    <div class="form-group">
                        <textarea
                            name="body"
                            id="body"
                            class="form-control"
                            placeholder="Have something to say?"
                            rows="5"></textarea>
                    </div>

                    <button type="submit" class="button btn-default">Post</button>
                </form>
            @else
                <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to participate in this discussion.</p>
            @endif
        </div>
    </div>
</div>
@endsection
