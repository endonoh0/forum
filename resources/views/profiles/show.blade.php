@extends ('layouts.app')

@section ('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-header">
                    {{-- Profile header --}}
                    <h2>
                        {{ $profileUser->name }}
                        <small>Since {{ $profileUser->created_at->diffForHumans() }}</small>
                    </h2>
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
        </div>
    </div>
@endsection
