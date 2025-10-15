<div class="row align-items-center">
    <div class="col-md-12">
        <div class="part-form-title mb-3"> <span>{{ __('Part 5') }}</span>
            <h2 class="font-lg-18">{{ __('Sign Below') }}</h2>
        </div>
    </div>
</div>
<div class="form-border mb-3">
    <div class="row">
        <div class="col-md-12">
            <strong>
                {{ __('By signing here under penalty of perjury, I declare that I cannot afford
                to pay the filing fee either in full or in installments. I also declare
                that the information I provided in this application is true and correct.') }}
            </strong>
        </div>

        <div class="col-md-5 mt-3">
            <div class="input-group">
                <input name="{{ base64_encode('undefined_38') }}" id="" style="" type="text" value="{{ $debtorSign }}" class="form-control">
                <label>{{ __('Signature of Debtor 1') }}</label>
            </div>
        </div>
        <div class="col-md-5 mt-3">
            <div class="input-group">
                <input name="{{ base64_encode('undefined_39') }}" id="" style="" type="text" value="{{ $debtor2Sign }}" class="form-control">
                <label>{{ __('Signature of Debtor 2') }}</label>
            </div>
        </div>
        <div class="col-md-2 mt-3"></div>

        <div class="col-md-5 mt-3">
            <div class="input-group d-flex">
                <label for="">{{ __('Date') }}</label> &nbsp;
                <input name="{{ base64_encode('Date') }}" value="{{ $currentDate }}" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control" style="width:110px;">
            </div>
        </div>
        <div class="col-md-5 mt-3">
            <div class="input-group d-flex">
                <label for="">{{ __('Date') }}</label> &nbsp;
                <input name="{{ base64_encode('Date_2') }}" value="{{ $currentDate }}" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control" style="width:110px;">
            </div>
        </div>
        <div class="col-md-2 mt-3"></div>

    </div>
</div>
