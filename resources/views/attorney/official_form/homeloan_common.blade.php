<div class="row pl-0 pt-0  column-heading">
    <?php if ($i == 1) { ?>
    <div class="pl-0 pt-0 col-md-1">
        <div class="input-group black-heading">
            <label><strong class="mb-0">{{ __('Part 1:') }}</strong></label>
        </div>
    </div>
    <div class="col-md-6 pl-0">
        <div class="input-group pl-3 b-bottom-2 gray-row">
            <label class="f10"> <strong>{{ __('Additional Page') }}</strong><br>
            {{ __('After listing any entries on this page, number them beginning with 2.3, followed by 2.4, and so forth.') }}
            </label>
        </div>
    </div>
    <x-officialForm.homeLoan.columnAmountOfClaimBox></x-officialForm.homeLoan.columnAmountOfClaimBox>
    <?php } ?>
</div>
