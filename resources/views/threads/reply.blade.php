<reply :attributes="{{ $reply }}" inline-template v-cloak>
    <div id="reply-{{ $reply->id }}" class="card">
        <div class="card-header">
            <div class="level">
                <h6 class="flex">
                {{-- Link to profile --}}
                    <a href="{{ route('profile', $reply->owner) }}">
                        {{ $reply->owner->name }}
                    </a> said {{ $reply->created_at->diffForHumans() }}...
                </h6>

                @if (Auth::check())
                    {{-- Favorite --}}
                    <div>
                        <favorite :reply="{{ $reply }}"></favorite>
                    </div>
                @endif
            </div>
        </div>

        {{-- Edit the reply --}}
        <div class="card-body">
            <div v-if="editing">
                <div class="form-group">
                    <textarea class="form-control" v-model="body"></textarea>
                </div>
                {{-- Update the reply --}}
                <button class="button btn-xs btn-primary" @click.once="update">Update</button>
                {{-- Cancel the edit --}}
                <button class="button btn-xs btn-link" @click="cancel">Cancel</button>
            </div>

            <div v-else v-text="body"></div>
        </div>

        @can ('update', $reply)
            {{-- Delete reply --}}
            <div class="card-footer level">
                <button class="btn-info btn-xs mr-1" @click="editing = true">Edit</button>
                <button class="btn-info btn-xs btn-danger" @click="destroy">Delete</button>
            </div>
        @endcan
    </div>
</reply>
<br>

