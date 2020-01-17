@extends ('layouts.app')

@section ('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-header">
                    {{-- Profile header --}}
                    <h2>
                        {{ $profileUser->name }}
                    </h2>
                </div>

                <br>
                {{-- Profile user's threads and replies --}}
                @foreach ($activities as $date => $activity)
                    <h3 class="card-header">{{ $date }}</h3>
                    <br>
                    @foreach ($activity as $record)
                        @include ("profiles.activities.{$record->type}", ['activity' => $record])
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
@endsection
