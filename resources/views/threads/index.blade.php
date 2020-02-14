@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @forelse ($threads as $thread)
                <article class="card">
                    <div class="card-header level">
                        {{-- Thread title --}}
                        <h4 class="flex">
                            <a href="{{ $thread->path() }}">
                                @if ($thread->hasUpdatesFor(auth()->user()))
                                    <strong>
                                        {{ $thread->title }}
                                    </strong>
                                @else
                                    {{ $thread->title }}
                                @endif
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
             @empty
                <p>There are no relevant results at this time.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
