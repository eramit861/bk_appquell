@if ($message = Session::get('success'))
<div style="display:block;" class="alert alert--positioned alert--success bg-primary">
        <div class="close"></div>
        <div class="sysmsgcontent content">{{ $message }}</div>
    </div>
@endif

@if ($message = Session::get('error'))
<div style="display:block;" class="alert alert--positioned alert--danger">
        <div class="close"></div>
        <div class="sysmsgcontent content">{{ $message }}</div>
    </div>
@endif

@if ($message = Session::get('custom'))
<div class="alert b-light alert-block text-dark" style="display:block !important;">
    <button type="button" class="close" data-bs-dismiss="alert">×</button>
    <strong>{!! $message !!}</strong>
</div>
@endif

@if ($message = Session::get('warning'))
<div style="display:block;" class="alert alert--positioned alert--danger">
        <div class="close"></div>
        <div class="sysmsgcontent content">{{ $message }}</div>
    </div>
@endif

@if ($message = Session::get('info'))
<div style="display:block;" class="alert alert--positioned alert--danger">
        <div class="close"></div>
        <div class="sysmsgcontent content">{{ $message }}</div>
    </div>
@endif

@if ($errors->any())
<div style="display:block;" class="alert alert--positioned">
        <div class="close"></div>
        <div class="sysmsgcontent content">{{ $message }}</div>
    </div>
@endif
@php
    $auto_close = !isset($auto_close) ? true : $auto_close;
@endphp

@if($auto_close != false)
<script>
   if(!$('div.alert').hasClass('alert--process')){
    const messageEl = document.querySelector('.information-area .sysmsgcontent');

    // Get the text content
    const text = messageEl?.textContent || '';
    
    // Count the number of words
    const wordCount = text.trim().split(/\s+/).length;
    const wordsPerSecond = 3.5; // moderate pace
    const bufferSeconds = 2;
    const timeout = wordCount > 0 ? (Math.ceil((wordCount / wordsPerSecond) + bufferSeconds) * 1000) : 3000; // in milliseconds

        setTimeout(function () {
             $(document).trigger('close.sysmsgcontent');
            }, timeout);
   }
</script>
@endif

