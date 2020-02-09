@extends('layouts.app')

@section('content')
    <thread-view :initial-replies-count="{{ $thread->replies_count }}" inline-template>
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    {{-- Thread --}}
                    <div class="card">
                        <div class="card-header">
                            <div class="level">
                                <span class="flex">
                    {{-- Link to profile --}}
                                    <a href="{{ route('profile', $thread->creator) }}">
                                        {{ $thread->creator->name }}</a> posted: {{ $thread->title }}</span>
                    {{-- Delete thread --}}
                                @can ('update', $thread)
                                    <form method="POST" action="{{ $thread->path() }}">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-link">Delete Thread</button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    {{-- Thread body --}}
                        <div class="card-body">
                            {{ $thread->body }}
                        </div>
                    </div>
                    <br>

                    {{-- Reply --}}
                    <replies @added="repliesCount++" @removed="repliesCount--"></replies>
                    <br>
                </div>

                {{-- Meta Information --}}
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <p>
                                This thread was published {{ $thread->created_at->diffForHumans() }} by
                                {{-- link to profile --}}
                                <a href="#">{{ $thread->creator->name }}</a>, and currently
                                has <span v-text="repliesCount"></span> {{ Str::plural('comment', $thread->replies_count) }}.
                            </p>

                            <p>
                                <subscribe-button :active="{{ json_encode($thread->isSubscribedTo) }}"></subscribe-button>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </thread-view>
@endsection
