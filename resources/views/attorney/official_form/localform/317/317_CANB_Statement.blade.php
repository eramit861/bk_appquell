<div class="row">
    <div class="col-md-12">
        <p class="alert-red text-center">{{ __('Provide this completed form to the trustee assigned to your bankruptcy case. Do not file
             this form with the Court. In accordance with Bankruptcy Rule 9037, redact social security numbers, financial account 
             numbers and other personal data identifiers appearing on attachments to this form.') }}</p>
    </div>
    <div class="col-md-12 text-center mb30">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }} <br>{{ __('NORTHERN DISTRICT OF CALIFORNIA') }}</h3>
    </div>
    <div class="col-md-6 mt-3">
        <div class="input-group">
            <label>{{ __('In Re:') }}</label>
            <textarea name="<?php echo base64_encode('Text1'); ?>" class="form-control" rows="4" cols=""><?php echo $debtorname ?? ''; ?></textarea>
        </div>
    </div>
    <div class="col-md-3 mt-3">
        <div class="input-group">
            <label>{{ __('Case Number:') }}</label>
            <input name="<?php echo base64_encode('Text2'); ?>" class="form-control" type="text" value="<?php echo Helper::validate_key_value('case_number', $savedData); ?>">
        </div>
    </div>
    <div class="col-md-3 mt-3">
        <div class="input-group">
            <label>{{ __('Chapter Number:') }}</label>
            <select name="<?php echo base64_encode('Chapter'); ?>" class="form-control">
                <option name="<?php echo base64_encode('Chapter'); ?>" selected="selected"value="7">7</option>
                <option name="<?php echo base64_encode('Chapter'); ?>" value="11">11</option>
                <option name="<?php echo base64_encode('Chapter'); ?>" value="12">12</option>
                <option name="<?php echo base64_encode('Chapter'); ?>" value="13">13</option>
            </select>
        </div>
    </div>

    <div class="col-md-12">
        <p class="text-center underline">{{ __('STATEMENT RE PAYMENT ADVICES') }}</p>
    </div>

    <div class="col-md-12">
        <div class="form-group"> 
            <div class="d-block radio-primary mt-3">
                <input name="<?php echo base64_encode('Radio Button3'); ?>" type="radio"  name="conf" value="1" class="payment_received" />
                <label for="" class="cr">{{ __('Attached are copies of all payment advices (employment pay stubs) that I/we received from my/
                    our employer(s) within 60 days before the filing of this bankruptcy case.') }}</label>
            </div>
            <div class="d-block radio-primary mt-3">
                <input name="<?php echo base64_encode('Radio Button3'); ?>" type="radio" name="conf" value="0" class="not_payment_received" />
                <label for="" class="cr">{{ __('My/our payment advices for the 60 day period before the filing of this bankruptcy case are not 
                    available.   Attached is a certification stating why my/our payment advices are unavailable, 
                    providing an estimate of payments received within the 60 day period and also providing other 
                    evidence, if any, of the payments received.') }}</label>
            </div>
        </div>
        <p class=" mt-3">{{ __('I/we declare under penalty of perjury that the above statement is true and correct to the best of my/our 
            knowledge, information, and belief.') }}</p>
    </div>

    <div class="col-md-4">
        <div class="d-flex radio-primary mt-3"> 
            <label>{{ __('Date:') }}</label>	
            <input name="<?php echo base64_encode('Text4'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="<?php echo $currentDate ?>" class="date_filed  form-control">												
        </div>
    </div>
    <div class="col-md-8">
        <div class="d-inline t-primary mt-3"> <label>&nbsp;</label>
            <input name="<?php echo base64_encode('Text5'); ?>" value="<?php echo $debtor_sign;?>" type="text" class="form-control"><br><p class="text-center">{{ __('Signature of Debtor') }}</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="d-flex radio-primary mt-3"> 
            <label>{{ __('Date:') }}</label>	
            <input name="<?php echo base64_encode('Text6'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="<?php echo $currentDate ?>" class="date_filed  form-control">												
        </div>
    </div>
    <div class="col-md-8">
        <div class="d-inline t-primary mt-3"> <label>&nbsp;</label>
            <input name="<?php echo base64_encode('Text7'); ?>" value="<?php echo $debtor2_sign;?>" type="text" class="form-control"><br><p class="text-center">{{ __('Signature of Joint Debtor') }}</p>
        </div>
    </div>


    <div class="col-md-4">
        <div class="d-flex radio-primary mt-3"> 
            <label>{{ __('Date:') }}</label>	
            <input name="<?php echo base64_encode('Text8'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="<?php echo $currentDate ?>" class="date_filed  form-control">												
        </div>
    </div>
    <div class="col-md-8">
        <div class="d-inline t-primary mt-3"> <label>&nbsp;</label>
            <input name="<?php echo base64_encode('Text9'); ?>" value="<?php echo $attorny_sign;?>" type="text" class="form-control"><br><p class="text-center">{{ __('Signature of Attorney') }}</p>
        </div>
    </div>

    <div class="col-md-12"><p>
    {{ __('DECLARATION AND SIGNATURE OF NON-ATTORNEY BANKRUPTCY PETITION PREPARER (See 11 U.S.C. § 110)') }}
    </p></div>

    <div class="col-md-12">
        <p>{{ __('I declare under penalty of perjury that: (1) I am a bankruptcy petition preparer as defined in 11 
        U.S.C. § 110; (2) I prepared this document for compensation and have provided the debtor with a copy 
        of this document and the notices and information required under 11 U.S.C. §§ 110(b), 110(h) and 
        342(b); and (3) if rules or guidelines have been promulgated pursuant to 11 U.S.C. § 110(h) setting a 
        maximum fee for services chargeable by bankruptcy petition preparers, I have given the debtor notice 
        of the maximum amount before preparing any document for filing for a debtor or accepting any fee from 
        the debtor, as required by that section') }}</p>
    </div>

    <div class="col-md-7">
        <div class="input-group"> 
            <label>{{ __('Print or Type Name of Bankruptcy Petition Preparer:') }}</label>
            <input name="<?php echo base64_encode('Text10'); ?>" type="text" class="form-control">											
        </div>
    </div>
    <div class="col-md-5">
        <div class="input-group"> 
            <label>{{ __('Social Security Number:') }}</label>
            <input name="<?php echo base64_encode('Text11'); ?>" type="text" value="" class="form-control">	
        </div>
    </div>
    <div class="col-md-12">
        <p>{{ __('If the bankruptcy petition preparer is not an individual, state the name, title (if any), address, and 
        social security number of the officer, principal, responsible person, or partner who signs this document') }}</p>
    </div>
    <div class="col-md-8">
        <textarea name="<?php echo base64_encode('Text12'); ?>" class="form-control"></textarea>
    </div>


    <div class="col-md-6">
        <div class="input-group"> 
            <label>{{ __('Signature of Bankruptcy Petition Preparer:') }} </label>
            <input name="<?php echo base64_encode('Text13'); ?>" type="text" value="" class="form-control">												
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group">
            <label>{{ __('Date:') }}</label>
            <input name="<?php echo base64_encode('Text14'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" class="date_filed form-control">
        </div>
    </div>
    <div class="col-md-12">
        <p>{{ __('Names and Social Security numbers of all other individuals who prepared or assisted in preparing this 
             document, unless the bankruptcy petition preparer is not an individual:') }}</p>
    </div>
    <div class="col-md-8">
        <textarea name="<?php echo base64_encode('Text15'); ?>" class="form-control"></textarea>
    </div>
    <div class="col-md-12">
        <p>{{ __('If more than one person prepared this document, attach additional signed sheets conforming to the 
            appropriate Official Form for each person.') }}
        </p>
        <p class="mt-3">
            <i>{{ __('A bankruptcy petition preparer’s failure to comply with the provisions of title 11 and the Federal Rules 
                of Bankruptcy Procedure may result in fines or imprisonment or both. 11 U.S.C. §110; 18 U.S.C. §156.') }}
            </i>
        </p>
    </div>
    <div class="col-md-12 mt-3">
         
    </div>
</div>
