@extends('layouts.app')

@section('content')
    <div class="container">
        @if(count($posts) > 0)
            <div class="row justify-content-center">
                <div class="col-4 justify-content-center">
                    <?php
                        $allUsers = \App\User::all();
                    ?>

                    <div class="col-12 text-center">
                        <h1>All Users</h1>
                        <hr>
                    </div>
                    <div class="col-12 justify-content-center">
                        @foreach ($allUsers as $eachUser)
                            @if($eachUser->id != $authUser->id)
                                <?php
                                    $profileImage = $eachUser->profile->image ? $eachUser->profile->image : "/profile/no-img.png";
                                ?>
                                <div class="col-12 pb-3" style="display: flex">
                                    <div class="card text-center align-self-center" style="width: 25rem;">
                                        <div class="card-body">
                                            <img src="/storage/{{ $profileImage }}" class="rounded rounded-circle mx-auto d-block" alt="{{ $eachUser->username }}" style="max-width:100px">
                                            <h5 class="card-title">{{ $eachUser->username }}</h5>
                                            <p class="card-text">{{ $eachUser->profile->description }}</p>
                                            <a href="/profile/{{ $eachUser->id }}" class="btn btn-primary">Go to Profile</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-8">
                    <h1 class="text-center">Posts</h1>
                    <hr>
                    @foreach($posts as $post)
                        <div class="col-6 offset-3 d-flex align-items-center pb-2">
                            <div class="pr-3">
                                <img src="{{ $post->user->profile->profileImage() }}" class="w-100 rounded-circle" style="max-width:50px">
                            </div>
                            <div>
                                <div class="font-weight-bold">
                                    <a href="/profile/{{ $post->user->id }}" class="pr-3">
                                        <span class="text-dark">{{ $post->user->username }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 offset-3">
                                <a href="/profile/{{ $post->user->id }}"><img src="/storage/{{ $post->image }}" class="w-100"></a>
                            </div>
                        </div>
                        <div class="row pt-2 pb-4">
                            <div class="col-6 offset-3">
                                <div>
                                    <p>
                                        <span class="font-weight-bold">
                                            <a href="/profile/{{ $post->user->id }}">
                                                <span class="text-dark">{{ $post->user->username }}</span>
                                            </a>
                                        </span> {{$post->caption}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        @else
            <?php
                $allUsers = \App\User::all();
            ?>

            <div class="row col-8 offset-2 justify-content-center">
                <h1>Start following Users</h1>
            </div>
            <hr class="col-6">
            @foreach ($allUsers as $eachUser)
                @if($eachUser->id != $authUser->id)
                    <?php
                        $profileImage = $eachUser->profile->image ? $eachUser->profile->image : "/profile/no-img.png";
                    ?>
                    <div class="row col-8 offset-2 justify-content-center pb-3">
                        <div class="card text-center align-self-center" style="width: 25rem;">
                            <div class="card-body">
                                <img src="/storage/{{ $profileImage }}" class="rounded rounded-circle mx-auto d-block" alt="{{ $eachUser->username }}" style="max-width:100px">
                                <h5 class="card-title">{{ $eachUser->username }}</h5>
                                <p class="card-text">{{ $eachUser->profile->description }}</p>
                                <a href="/profile/{{ $eachUser->id }}" class="btn btn-primary">Go to Profile</a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif

        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
