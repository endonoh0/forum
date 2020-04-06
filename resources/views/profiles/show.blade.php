@extends ('layouts.app')

@section ('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-header">
                {{-- Add Avatar form --}}
                    <avatar-form :user="{{ $profileUser }}"></avatar-form>
                </div>

                <br>
                {{-- Profile user's threads and replies --}}
                @forelse ($activities as $date => $activity)
                    <h3 class="card-header">{{ $date }}</h3>
                    <br>
                    @foreach ($activity as $record)
                        @if (view()->exists("profiles.activities.{$record->type}"))
                            @include ("profiles.activities.{$record->type}", ['activity' => $record])
                        @endif
                    @endforeach
                @empty
                    <p>There is no activity for this user yet.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
