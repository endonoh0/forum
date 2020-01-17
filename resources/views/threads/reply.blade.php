<div id="reply-{{ $reply->id }}" class="card">
    <div class="card-header">
        <div class="level">
            <h6 class="flex">
            {{-- Link to profile --}}
                <a href="{{ route('profile', $reply->owner) }}">
                    {{ $reply->owner->name }}
                </a> said {{ $reply->created_at->diffForHumans() }}...
            </h6>
            {{-- Favorite form --}}
            <div>
                <form method="POST" action="/replies/{{ $reply->id }}/favorites">
                    @csrf

                    <button type="submit" class="button btn-default" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                        {{ $reply->favorites_count }} {{ Str::plural('Favorite', $reply->favorites_count) }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="card-body">
        {{ $reply->body }}
    </div>

    @can ('update', $reply)
        {{-- Delete reply --}}
        <div class="card-footer">
            <form method="POST" action="/replies/{{ $reply->id }}">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger btn-xs">Delete</button>
            </form>
        </div>
    @endcan
</div>
<br>


