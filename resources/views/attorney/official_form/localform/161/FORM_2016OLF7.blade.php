<div>
    <div class="text-center">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF MASSACHUSETTS') }}</h3>
    </div>
    <div class="row my-4">
        <div class="col-md-6 border_1px p-3 br-0">
            <div class="input-group ">
                <label>{{ __('In re:') }}</label>
                <textarea name="<?php echo base64_encode('Text10')?>" value="" class=" form-control" rows="4" style="padding-right:5px;">{{$debtorname}}</textarea>
                <label class=" float_right">{{ __('Debtor') }}</label>
            </div>
        </div>
        <div class="col-md-6 border_1px p-3">
            <div>
                <x-officialForm.caseNo
                    labelText="Case No."
                    casenoNameField="Text11"
                    caseno={{$caseno}}
                ></x-officialForm.caseNo>
            </div>
            <div class="mt-2">
                <x-officialForm.caseNo
                    labelText="Chapter"
                    casenoNameField="Text12"
                    caseno={{$chapterNo}}
                ></x-officialForm.caseNo>
            </div>
        </div>
        <div class="col-md-12 mt-20">
            <div class="text-center">
                <h3>{{ __('DECLARATION RE: ELECTRONIC FILING') }}</h3>
            </div>
            <div class="mt-3 p_justify">
                <label class="text-bold">{{ __('PART I - DECLARATION') }}</label>
                <p class="mt-3"><span class="ml-4"></span> I[We]
                    <input type="text" name="<?php echo base64_encode('Text1')?>" value="{{$onlyDebtor}}" class="form-control width_30percent">and 
                    <input type="text" name="<?php echo base64_encode('Text2')?>" value="{{$spousename}}" class="form-control width_30percent">
                    , {{ __('hereby declare(s) under penalty of perjury that all of the information
                    contained in my') }} 
                    <input type="text" value="<?php echo !empty($spousename) ? "jointly" : "singly"; ?>" name="<?php echo base64_encode('Text4')?>" class="form-control width_30percent mt-1">
                     {{ __('(singly or jointly the "Document"), filed electronically, is true
                    and correct. I understand that this DECLARATION is to be filed with the Clerk of Court electronically
                    concurrently with the electronic filing of the Document. I understand that failure to file this DECLARATION
                    may cause the Document to be struck and any request contained or relying thereon to be denied, without
                    further notice.') }}
                </p>
                <p class="mt-3"><span class="ml-4"></span>
                    {{ __('I further understand that, pursuant to the Massachusetts Electronic Filing Local Rule (MEFR) 7(b), all
                    paper documents containing original signatures executed under the penalties of perjury and filed electronically
                    with the Court are the property of the bankruptcy estate and shall be maintained by the authorized CM/ECF
                    Registered User for a period of five (5) years after the closing of this case.') }}
                </p>
            </div>
        </div>

        <div class="col-md-6 mt-3">
            <x-officialForm.dateSingleHorizontal
                labelText="Dated:"
                dateNameField="Text9"
                currentDate={{$currentDate}}
            ></x-officialForm.dateSingleHorizontal>
        </div>
        <div class="col-md-6 mt-3">
            <div class="">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="(Affiant)"
                    inputFieldName="Text5"
                    inputValue=""
                ></x-officialForm.debtorSignVerticalOpp>
            </div>
            <div class="mt-1">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="(Joint Affiant)"
                    inputFieldName="Text6"
                    inputValue=""
                ></x-officialForm.debtorSignVerticalOpp>
            </div>
        </div>

        
        <div class="col-md-12 mt-20">
            <div class="mt-3 p_justify">
                <label class="text-bold">{{ __('PART II - DECLARATION OF ATTORNEY (IF AFFIANT IS REPRESENTED BY COUNSEL)') }}</label>
                <p class="mt-3"><span class="ml-4"></span>
                    {{ __('I certify that the affiant(s) signed this form before I submitted the Document, I gave the affiant(s) a
                    copy of the Document and this DECLARATION, and I have followed all other electronic filing requirements
                    currently established by local rule and standing order. This DECLARATION is based on all information of which I
                    have knowledge and my signature below constitutes my certification of the foregoing under Fed. R. Bankr. P.
                    9011. I have reviewed and will comply with the provisions of MEFR 7.') }}
                </p>
            </div>
        </div>
    </div>
    
    <div class="col-md-12 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Text7"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="row ">
        <div class="col-md-6"></div>
        <div class="col-md-1 p-2">
            <label class="">{{ __('Signed:') }}</label>
        </div>
        <div class="col-md-5">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="(Attorney for Affiant - /s/used by Registered ECF Users Only)"
            inputFieldName="Text8"
            inputValue="{{$attorny_sign}}"
        ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

</div>

