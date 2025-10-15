<div class="row">

    <div class="district325 col-md-12 " style="border:1px solid #000;border-bottom:none;">
        <div class="row">
            <div class="district325 col-md-6 mt-3">
                <x-officialForm.attorneyPartyName
attorneyDetails={{$attorneydetails}}
></x-officialForm.attorneyPartyName>
</div>

            <div class="district325 col-md-6 mt-3" style="border-left:1px solid #000;">
                <span>{{ __('FOR COURT USE ONLY') }}</span>
            </div>
        </div>
    </div>
    <div class="district325 col-md-12 " style="border:1px solid #000;">
        <div class="row">
            <div class="district325 col-md-4"></div>
            <div class="district325 col-md-4"> {{ __('UNITED STATES BANKRUPTCY COURT CENTRAL DISTRICT OF CALIFORNIA -') }} 
                <x-officialForm.districtListLocal
                                title="Generate PDF"
                            ></x-officialForm.districtListLocal>
            </div>
            <div class="district325 col-md-4"></div>
        </div>
    </div>
    <div class="district325 col-md-12 " style="border:1px solid #000;border-top:none;">
        <div class="row">
            <div class="district325 col-md-6 mt-3" style="border-right:1px solid #000;">
               <x-officialForm.inReDebtor
debtorname={{$debtorname}}
></x-officialForm.inReDebtor>
            </div>
            <div class="district325 col-md-6 mt-3">
                <?php $caseno = Helper::validate_key_value("case_number", $savedData);?>
<x-officialForm.chapterAndcaseNo
    caseno={{$caseno}}
></x-officialForm.chapterAndcaseNo>
                <div class="district325 col-md-12 mt-3 text-center" style="border-top:1px solid #000;border-bottom:1px solid #000;">
                    <h3 class="mt-3">{{ __('VERIFICATION OF MASTER') }} <br> {{ __('MAILING LIST OF CREDITORS') }}<br> {{ __('[LBR 1007-1(a)]') }}  </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="district325 col-md-12 mt-3">
        <x-officialForm.pursuant
creditorsCount={{$creditors_count}}
></x-officialForm.pursuant>
    </div>

    
    <div class="district325 col-md-3 mt-3">
        <x-officialForm.dateIssuedTwo
    currentDate={{$currentDate}}
></x-officialForm.dateIssuedTwo>
    </div>
    <div class="district325 col-md-1"></div>
    <div class="district325 col-md-8 mt-3">
        <x-officialForm.debtorSign
    debtorSign={{$debtor_sign}}
></x-officialForm.debtorSign>
    </div>

    <div class="district325 col-md-3 mt-3">
        <x-officialForm.issuedDateThree
    currentDate={{$currentDate}}
></x-officialForm.issuedDateThree>
    </div>
    <div class="district325 col-md-1"></div>
    <div class="district325 col-md-8 mt-3">
        <x-officialForm.spouseSign
    spouseSign={{$debtor2_sign}}
></x-officialForm.spouseSign>
    </div>


    <div class="district325 col-md-3 mt-3">
       <x-officialForm.dateIssued
    currentDate={{$currentDate}}
></x-officialForm.dateIssued>
    </div>
    <div class="district325 col-md-1"></div>
    <div class="district325 col-md-8 mt-3">
        <x-officialForm.attorneySign
attornySign={{$attorny_sign}}
></x-officialForm.attorneySign>
    </div>



    <div class="district325 col-md-12 mt-3">
 
</div>

</div>
