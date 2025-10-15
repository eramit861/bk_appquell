<div class="row">
    <div class="col-md-6 border_1px p-3">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF NEW JERSEY') }}</h3>
    </div>
    <div class="col-md-6"></div>
    <div class="col-md-6 border_1px p-3 bt-0">
        <label class="text-bold">{{ __('Caption in Compliance with D.N.J. LBR 9004-1(b)') }}</label>
        <textarea name="<?php echo base64_encode('Text1'); ?>" class="form-control" rows="7">{{$attorneydetails}}</textarea>
    </div>
    <div class="col-md-6"></div>
    <div class="col-md-6 border_1px p-3 bt-0">
        <div class="input-grpup ">
            <label>{{ __('In re:') }}</label>
            <textarea name="<?php echo base64_encode('Text2'); ?>" value="" class="form-control" rows="5" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
        </div> 
    </div>
    <div class="col-md-6 p-3">
        <div>
            <x-officialForm.caseNo
                labelText="Case No.:"
                casenoNameField="Text3"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-1">
            <x-officialForm.caseNo
                labelText="Adv. No.:"
                casenoNameField="Text4"
                caseno=""
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-1">
            <x-officialForm.caseNo
                labelText="Hearing Date:"
                casenoNameField="Text5"
                caseno=""
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-1">
            <x-officialForm.caseNo
                labelText="Judge:"
                casenoNameField="Text6"
                caseno=""
            ></x-officialForm.caseNo>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center">{{ __('ATTORNEY CERTIFICATION') }}<br>{{ __('RE: FACSIMILE SIGNATURE') }}</h3>
        <p class="mt-3 p_justify">
            <span class="pl-4"></span>
            I, 
            <input name="<?php echo base64_encode('Text7'); ?>" type="text" class="form-control width_30percent" value="{{$onlyDebtor}}">
            , {{ __('attorney for') }} 
            <input name="<?php echo base64_encode('Text8'); ?>" type="text" class="form-control width_30percent" value="{{$attorney_name}}">
            , {{ __('having electronically filed a Certification, or other pleading required to be signed under oath or
            penalty of perjury, containing the facsimile signature of') }} 
            <input name="<?php echo base64_encode('Text9'); ?>" type="text" class="form-control width_30percent">
            {{ __("in the above captioned matter, hereby certify in accordance with the Court's") }} 
            <span class="text_italic">{{ __('General Order
            Establishing Procedure for Electronic Submission of Documents Containing Facsimile
            Signatures,') }}</span> {{ __('dated November 19 th 2004:') }}
        </p>
        <div class="d-flex">
            <label for="">1.</label>
            <div class="p_justify pl-3">
                <p>{{ __('The Affiant has acknowledged the genuineness of the original signature.') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <label for="">2.</label>
            <div class="p_justify pl-3">
                <p>{{ __('The original document was executed in completed form prior to facsimile transmission.') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <label for="">3.</label>
            <div class="p_justify pl-3">
                <p>{{ __('The document or a copy with an original signature affixed to it will be obtained by me
                    within seven (7) business days after the date the document or pleading with the facsimile
                    signature was electronically filed with the Court.') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <label for="">4.</label>
            <div class="p_justify pl-3">
                <p>{{ __('I will maintain the document containing the original signature in paper form for a period
                    not less than seven years from the date of closure of the case or proceeding in which the
                    document is filed.') }}</p>
            </div>
        </div>
        <p>{{ __('I hereby certify that the above is true.') }}</p>
    </div>

    <div class="col-md-6">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Text10"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6">
        <input name="<?php echo base64_encode('Text11'); ?>" type="text" class="form-control" value="{{$attorny_sign}}">
        <div class="row mt-2">
            <div class="col-md-3">
                <label for="">{{ __('Attorney for') }}</label>
            </div>
            <div class="col-md-9">
                <textarea name="<?php echo base64_encode('Text12'); ?>" class="form-control" rows="2">Debtor(s): <?php echo $debtorname ?? ''; ?></textarea>
            </div>
        </div>
    </div>

</div>