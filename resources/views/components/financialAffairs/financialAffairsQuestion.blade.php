<div class="col-md-12 border_bottom"></div>
<div class="col-md-12 mt-1">
    <label class="font-weight-bold ">
        {!! $question !!}
        @if (isset($questionname))
            @php
                $color = $questionname == 'None' ? 'red text-bold' : 'green font-weight-normal';
            @endphp
            <span class=" text-c-{{ $color }}">{!! $questionname !!}</span>
        @endif
    </label>
</div>
