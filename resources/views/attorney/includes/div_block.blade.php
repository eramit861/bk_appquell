<div class="col-md-{{ $size }}">
    <label class="font-weight-bold ">
        {{ $label }}: <span class="font-weight-normal">
            {{ Helper::validate_key_loop_value($key, @$finacial_affairst, $i) }}
        </span>
    </label>
</div>
