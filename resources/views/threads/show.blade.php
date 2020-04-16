@extends('layouts.app')

@section ('header')
    <link rel="stylesheet" type="text/css" href="/css/vendor/jquery.atwho.css">
@endsection

@section('content')
    <thread-view :thread="{{ $thread }}" inline-template>
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    {{-- Thread --}}
                    <div class="card">
                        <div class="card-header">
                            <div class="level">
                    {{-- Thread creator avatar --}}
                                <img src="{{ $thread->creator->avatar_path }}" alt="{{ $thread->creator->name }}" width="25" height="25" class="mr-3">

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
                                <subscribe-button :active="{{ json_encode($thread->isSubscribedTo) }}" v-if="signedIn"></subscribe-button>

                                <button class="btn btn-secondary"
                                    v-if="authorize('isAdmin')"
                                    @click="toggleLock"
                                    v-text="locked ? 'Unlock' : 'Lock'"></button>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </thread-view>
@endsection
