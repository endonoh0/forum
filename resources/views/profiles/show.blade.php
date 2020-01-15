@extends ('layouts.app')

@section ('content')
    <div class="container">
        <div class="card-header">
            {{-- Profile header --}}
            <h1>
                {{ $profileUser->name }}
                <small>Since {{ $profileUser->created_at->diffForHumans() }}</small>
            </h1>
        </div>

        <br>
        {{-- All profile user's thread --}}
        @foreach ($threads as $thread)
            <div class="card">
                <div class="card-header">
                    <div class="level">
                        <span class="flex">
                            <a href="#">{{ $thread->creator->name }}</a> posted:
                            {{ $thread->title }}
                        </span>
                        <span>{{ $thread->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                <div class="card-body">
                    {{ $thread->body }}
                </div>
            </div>
            <br>
        @endforeach

        {{ $threads->links() }}
    </div>
@endsection
