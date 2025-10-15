<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF ALASKA') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text1"
            debtorname={{$debtorname}}
            rows="4">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Text2"
                caseno={{$caseno}}>
        </x-officialForm.caseNo>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter:"
                casenoNameField="Text3"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
        <p class="mt-3 text-center"><span class="text-bold ">{{ __('DECLARATION RE: ELECTRONIC FILING') }}</span><br>
        {{ __('[INDIVIDUALS]') }}</p>
    </div>
    <div class="col-md-12 mt-2 pl-0">
        <p class="text-bold">{{ __('PART I - DECLARATION OF DEBTOR(S)') }}</p>
        <p class="p_justify"><span class="pl-4"></span>
        {{ __('I [We]') }} <input name="<?php echo base64_encode('Text4'); ?>" type="text" value="{{$onlyDebtor}}" class="form-control width_30percent"> and
            <input name="<?php echo base64_encode('Text5'); ?>" type="text" value="{{$spousename}}" class="form-control width_30percent">
            {{ __(',the undersigned debtor(s),') }} <span class="text_italic text-bold"> {{ __('hereby declare under penalty of perjury') }} </span> {{ __('that the information given or to be given my
            [our] attorney and the information provided in the following electronically-filed documents and any amendments 
            thereto, is or will be true and correct: petition; statements; schedules; Verification of Creditor Matrix (AK LBF 40);
            Official Form 423; Official Form 2830; any notice of address change; any report required under Federal Rule of Bankruptcy
            Procedure 1019(5); chapter 11, 12 or 13 plan (if this is a case under such chapter); and any chapter 11 disclosure statement
            (hereinafter referred to as the “Documents”). I [We] consent to my [our] attorney sending my [our] Documents to the United 
            States Bankruptcy Court electronically. I [We] understand that this Declaration re: Electronic Filing is to be filed with
            the Clerk of Court not later than 14 days following the date the petition is electronically filed. I [We] understand that
            failure to file the signed original of this Declaration with the Bankruptcy Court will result in the dismissal of my [our]
            case after a hearing on shortened time of no less than seven days’ notice') }}
        </p>
        <p class="p_justify"><span class="pl-4"></span>
          {{ __('If debtor is an individual whose debts are primarily consumer debts and has chosen to file under chapter 7:
          I am [We are] aware that I [we] may proceed under chapter 7, 11, 12 or 13 of Title 11, United States Code,
          understand the relief available under each such chapter, and choose to proceed under chapter 7. I [We] request
          relief in accordance with the chapter specified in my [our] related petition.') }}
        </p>
    </div>
    <div class="col-md-12">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Text6"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div> 
    <div class="col-md-4 mt-2">
        <div class="d-flex">
            <span class=" mt-2">{{ __('Signed:') }}</span>
            <div class="w-100">
                <input name="<?php echo base64_encode('Text7'); ?>" type="text" value="{{$debtor_sign}}" class="form-control">
                <p class="text-center">{{ __('(Debtor)') }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mt-2">
        <input name="<?php echo base64_encode('Text8'); ?>" type="text" value="{{$debtor2_sign}}" class="form-control">
        <p class="text-center">{{ __('(Joint Debtor)') }}</p>
    </div>
    <div class="col-md-4">
    </div>

    <div class="col-md-12 mt-2 pl-0">
        <p class="text-bold">{{ __('PART II - DECLARATION OF ATTORNEY') }}</p>
        <p class="p_justify"><span class="pl-4"></span>
            I  <span class="text_italic text-bold"> {{ __('declare under penalty of perjury') }} </span>  {{ __('that the debtor(s) signed this form before I electronically submitted the Documents (as that term is defined above).') }}
            <span class="text_italic text-bold"> {{ __('Before filing') }} </span>{{ __(', I will give the debtor(s) a copy of all documents to be filed with the United States Bankruptcy Court, and have followed all other requirements
            of electronic filing promulgated by PACER. I further declare that I have examined or will examine the debtor(s)’ Documents and any amendments thereto,
            and, to the best of my knowledge and belief, they are or will be true, correct, and complete. I further declare that I have informed the debtor(s) that 
            [he or she or they] may proceed under chapter 7, 11, 12 or 13 of Title 11, United States Code, and have explained the relief available under each such chapter.
            This declaration is based on all information of which I have knowledge.') }}
        </p>
    </div>
    <div class="col-md-12">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Text9"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div> 
    <div class="col-md-4 mt-2">
    </div>
    <div class="col-md-4 mt-2">
    </div>
    <div class="col-md-4">
        <input name="<?php echo base64_encode('Text10'); ?>" type="text" value="{{$attorney_name}}" class="form-control">
        <p>{{ __('Attorney for Debtor(s)') }}</p>
    </div>
</div>

 
