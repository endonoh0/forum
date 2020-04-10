@forelse ($threads as $thread)
    <article class="card">
        <div class="card-header level">
            {{-- Thread title --}}
            <div class="flex">
                <h4>
                    <a href="{{ $thread->path() }}">
                        @if (auth()->check() && $thread->hasUpdatesFor(auth()->user()))
                            <strong>
                                {{ $thread->title }}
                            </strong>
                        @else
                            {{ $thread->title }}
                        @endif
                    </a>
                </h4>

                {{-- Thread Creator --}}
                <h5>
                    Posted By: <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a>
                </h5>
            </div>
            {{-- Reply count --}}
            <a href="{{ $thread->path() }}">
                {{ $thread->replies_count }} {{ Str::plural('reply', $thread->replies_count) }}
            </a>
        </div>
        {{-- Thread body --}}
        <div class="card-body">
            {{ $thread->body }}
        </div>
        {{-- Visit count --}}
        <div class="card-footer">
            {{ $thread->visits }} Visits
        </div>
    </article>
 <br>
 @empty
    <p>There are no relevant results at this time.</p>
@endforelse
