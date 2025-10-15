<div class="row">
    <div class="col-md-12 text-bold">
        <p>{{ __('FLNB Local Form 36-M') }}</p>
    </div>

    <div class="col-md-4 mt-1">
        <p class="mb-2">{{ __('Case No. (if known)') }} : <input type="text" name="<?php echo base64_encode('topmostSubform[0].Page1[0].Text01[0]');?>" value="{{$caseno}}" class="form-control w-auto"></p>
        <label for="">{{ __('Debtor Name(s):') }}</label>
        <textarea name="<?php echo base64_encode('topmostSubform[0].Page1[0].Text01[1]');?>" class="form-control" rows="2">{{$debtorname}}</textarea>
    </div>
    <?php
        for ($k = 1 ; $k <= 23; $k++) {
            ?>
    <div class="col-md-4 mt-1">
        <textarea name="<?php echo base64_encode('Text'.$k);?>" class="form-control" rows="5"></textarea>
    </div>
    <?php
        }
        ?>

</div>