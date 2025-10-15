@php
    $reviewUserText = $reviewUserText ?? '';
    $reviewUserImage = $reviewUserImage ?? asset('assets/img/dummy.jpg');
    $reviewUserName = $reviewUserName ?? '';
    $reviewUserType = $reviewUserType ?? 'User';
@endphp

<div class="col-md-3 col-lg-3 col-xl-3 col-sm-3 p-3">
    <div class="Challengesb our_client shadow">

        <div class="w-100">
            <img src="{{ asset('assets/img/Rating.png') }}" class="bk-rating" alt="Rating">
        </div>
        <p class="mt-3 mb-0">
            {!! $reviewUserText !!}
        </p>
        <div class="d-flex align-items-center mt-3">
            <div class="w-25">
                <img src="{{ $reviewUserImage }}" alt="User" class="w-75 h-75 rounded-circle">
            </div>
            <div class="w-75 text-start">
                <p class="text-dark text-bold bk-font-24 mb-1 w-100">{!! $reviewUserName !!}</p>
                <p class="m-0">{!! $reviewUserType !!}</p>
            </div>
        </div>

    </div>
</div>
