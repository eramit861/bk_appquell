<div class="row">
    <div class="col-md-12 text-center mt-3">
        <h3>{{ __('STATEMENT OF RELATED CASES') }}<br>
        {{ __('INFORMATION REQUIRED BY LBR 1015-2') }} <br>
            {{ __('UNITED STATES BANKRUPTCY COURT, CENTRAL DISTRICT OF CALIFORNIA') }}</h3>
    </div>
    <div class="col-md-12 mt-3">
        <div class="input-group">
            <ol type="1">
                <li>
                    <p>{{ __('1. A petition under the Bankruptcy Act of 1898 or the Bankruptcy Reform Act of 1978 has previously been filed by or 
                        against the debtor, his/her spouse, his or her current or former domestic partner, an affiliate of the debtor, any 
                        copartnership or joint venture of which debtor is or formerly was a general or limited partner, or member, or any 
                        corporation of which the debtor is a director, officer, or person in control, as follows: (Set forth the complete number 
                        and title of each such of prior proceeding, date filed, nature thereof, the Bankruptcy Judge and court to whom 
                        assigned, whether still pending and, if not, the disposition thereof. If none, so indicate. Also, list any real property 
                        included in Schedule A/B that was filed with any such prior proceeding(s).') }}</p>
                    <textarea name="<?php echo base64_encode('Statement Related field 1'); ?>"  class="form-control">{{ __('NONE') }}</textarea>
                </li>

                <li>
                    <p>{{ __('2. (If petitioner is a partnership or joint venture) A petition under the Bankruptcy Act of 1898 or the Bankruptcy Reform 
                        Act of 1978 has previously been filed by or against the debtor or an affiliate of the debtor, or a general partner in the 
                        debtor, a relative of the general partner, general partner of, or person in control of the debtor, partnership in which the 
                        debtor is a general partner, general partner of the debtor, or person in control of the debtor as follows: (Set forth the 
                        complete number and title of each such prior proceeding, date filed, nature of the proceeding, the Bankruptcy Judge 
                        and court to whom assigned, whether still pending and, if not, the disposition thereof. If none, so indicate. Also, list 
                        any real property included in Schedule A/B that was filed with any such prior proceeding(s).)') }}</p>
                    <textarea name="<?php echo base64_encode('Statement Related field 2'); ?>" value="" class="form-control">{{ __('NONE') }}</textarea>
                </li>

                <li>
                    <p>{{ __('3. (If petitioner is a corporation) A petition under the Bankruptcy Act of 1898 or the Bankruptcy Reform Act of 1978 has 
                        previously been filed by or against the debtor, or any of its affiliates or subsidiaries, a director of the debtor, an officer 
                        of the debtor, a person in control of the debtor, a partnership in which the debtor is general partner, a general partner 
                        of the debtor, a relative of the general partner, director, officer, or person in control of the debtor, or any persons, firms 
                        or corporations owning 20% or more of its voting stock as follows: (Set forth the complete number and title of each 
                        such prior proceeding, date filed, nature of proceeding, the Bankruptcy Judge and court to whom assigned, whether 
                        still pending, and if not, the disposition thereof. If none, so indicate. Also, list any real property included in Schedule 
                        A/B that was filed with any such prior proceeding(s).)') }}</p>
                    <textarea name="<?php echo base64_encode('Statement Related field 3'); ?>" value="" class="form-control"><?php echo $relatedCasesContent; ?></textarea>
                </li>

                <li>
                    <p>{{ __('4. (If petitioner is an individual) A petition under the Bankruptcy Reform Act of 1978, including amendments thereof, has 
                        been filed by or against the debtor within the last 180 days: (Set forth the complete number and title of each such 
                        prior proceeding, date filed, nature of proceeding, the Bankruptcy Judge and court to whom assigned, whether still 
                        pending, and if not, the disposition thereof. If none, so indicate. Also, list any real property included in Schedule A/B
                        that was filed with any such prior proceeding(s).)') }}</p>
                    <textarea name="<?php echo base64_encode('Statement Related field 4'); ?>"  class="form-control"><?php echo $priorCasesContent;?><?php echo $pendingCaseContent; ?><?php echo empty($priorCasesContent) && empty($pendingCaseContent) ? 'NONE' : ''; ?></textarea>
                </li>
            </ol>
            <p class="mt-3">{{ __('I declare, under penalty of perjury, that the foregoing is true and correct') }}</p>

        </div>
        </div>

        <div class="col-md-7 mt-3">
            <div class="input-group d-flex">
                <label style="width:100px;">{{ __('Executed at') }} </label>
                <input name="<?php echo base64_encode('Statement Related Executed at'); ?>" value="{{$debtorCity}}" style="width:300px;" type="text" class="form-control"><label style="width:100px;">{{ __(', California') }}</label>
            </div>
        </div>

        <div class="col-md-5  mt-3">
            <div class="input-group">
                <input name="<?php echo base64_encode('Statement Related Signature Debtor 1'); ?>" value="<?php echo $debtor_sign;?>" type="text" class="form-control"><br>{{ __('Signature of Debtor 1') }}
            </div>
        </div>

        <div class="col-md-7 mt-3">
            <div class="input-group d-flex">
                <label style="width:120px;">{{ __('Date:') }} </label>
                <input name="<?php echo base64_encode('Date'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
            </div>
        </div>

        <div class="col-md-5 mt-3">
            <div class="input-group">
                <input name="<?php echo base64_encode('Statement Related Signature Debtor 2'); ?>" value="<?php echo $debtor2_sign;?>" type="text" class="form-control"><br>{{ __('Signature of Debtor 2') }}
            </div>
        </div>

       
</div>
<style>
    ol{padding:0px;margin:0px;}
    ol {

  list-style-type: decimal !important;
}
</style>