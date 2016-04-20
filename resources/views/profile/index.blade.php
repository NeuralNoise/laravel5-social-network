@extends('templates.default')

@section('content')
	<div class="row">
    <div class="col-lg-5">

          @include('user.partials.userblock')
          <hr>

           @if (!$statuses->count())
              <p>{{ $user->getFirstNameOrUsername() }} hasnt posted anything yet</p>
           @else

           @endif

     </div>
     <div class="col-lg-4 col-lg-offset-3">
            @if (Auth::user()->hasFriendRequestPending($user))
                 <p>Waiting for {{ $user->getNameOrUsername() }} to accept your request.</p>
             @elseif (Auth::user()->hasFriendRequestReceived($user))
                 <a href="{{ route('friends.accept', ['username'=>$user->username]) }}" class="btn btn-primary">Accept Friend Request</a>
             @elseif (Auth::user()->isFriendsWith($user))
                 <p>You and {{ $user->getNameOrUsername() }} are friends.</p>

                 <form action="#" method="POST">
                     <input type="submit" value="Delete Friend" class="btn btn-primary">
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 </form>
            @elseif (Auth::user()->id !== $user->id)
                 <a href="{{ route('friends.add', ['username'=>$user->username]) }}" class="btn btn-primary">Add as friend</a>
            @endif

            <h4>{{ $user->getFirstNameOrUsername() }}'s friends</h4>

            @if (!$user->friends()->count())
                  <p>{{ $user->getFirstNameOrUsername() }} has no friends</p>
            @else
                    @foreach($user->friends() as $user)
                        @include('user/partials/userblock')
                 @endforeach
            @endif
     </div>
  </div>
@stop