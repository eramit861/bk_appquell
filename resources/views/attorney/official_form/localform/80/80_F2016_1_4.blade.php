<div class="row">
    <div class="col-md-12 " style="border:1px solid #000;border-bottom:none;">
        <div class="row">
            <div class="col-md-6 p-3">
                <div class="input-grpup">
                    <label>{{ __('Attorney or Party Name, Address, Telephone & FAX Nos., State Bar No. & Email Address') }}</label>
                    <textarea name="<?php echo base64_encode('Party Information'); ?>" value="" class="form-control" rows="10" cols="" style="padding-right:5px;"><?php echo htmlentities($attorneydetails); ?></textarea>
                </div>
            </div>
            <div class="col-md-6 p-3 border_left_1px" >
                <span>{{ __('FOR COURT USE ONLY') }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-12 border_1px p-3 text-center">
        <p class="mb-0">
            {{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('CENTRAL DISTRICT OF CALIFORNIA -') }} 
            <select name="<?php echo base64_encode('Division'); ?>" class="division_select form-control w-auto">
                <option name="<?php echo base64_encode('Division'); ?>" value="**SELECT DIVISION**">{{ __('**SELECT DIVISION**') }}</option>
                <option name="<?php echo base64_encode('Division'); ?>" value="LOS ANGELES DIVISION">{{ __('LOS ANGELES DIVISION') }}</option>
                <option name="<?php echo base64_encode('Division'); ?>" value="RIVERSIDE DIVISION">{{ __('RIVERSIDE DIVISION') }}</option>
                <option name="<?php echo base64_encode('Division'); ?>" value="SANTA ANA DIVISION">{{ __('SANTA ANA DIVISION') }}</option>
                <option name="<?php echo base64_encode('Division'); ?>" value="NORTHERN DIVISION">{{ __('NORTHERN DIVISION') }}</option>
                <option name="<?php echo base64_encode('Division'); ?>" value="SAN FERNANDO VALLEY DIVISION">{{ __('SAN FERNANDO VALLEY DIVISION') }}</option>
            </select>
        </p>
    </div>
    <div class="col-md-12 " style="border:1px solid #000;border-top:none;">
        <div class="row">
            <div class="col-md-6 p-3" style="border-right:1px solid #000;">
                <div class="input-grpup">
                    <label>{{ __('In re:') }}</label>
                    <textarea name="<?php echo base64_encode('Debtor'); ?>" value="" class="form-control" rows="10" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
                </div> {{ __('Debtor(s).') }}
            </div>
            <div class="col-md-6 p-3">
                <div class="">
                    <x-officialForm.caseNo
                        labelText="CASE NO.:"
                        casenoNameField="Case Number"
                        caseno={{$caseno}}
                    ></x-officialForm.caseNo>
                </div>
                <div class="mt-2">
                    <x-officialForm.caseNo
                        labelText="CHAPTER:"
                        casenoNameField="Chapter"
                        caseno={{$chapterNo}}
                    ></x-officialForm.caseNo>
                </div>
                <div class="col-md-12 mt-3 text-center border_top_1px">
                    <h3 class="mt-3">ATTORNEY’S DISCLOSURE <br> {{ __('OF POSTPETITION COMPENSATION') }}<br> ARRANGEMENT WITH DEBTOR<br><br>  <span style="font-weight:normal;">{{ __('[11 U.S.C. § 329(a); FRBP 2016(b)]') }}</span> </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <p>{{ __('1. This disclosure is made by the undersigned attorney as counsel for the Debtor:') }} </p>
        <div class="input-group ml-30">
                    <input name="<?php echo base64_encode('Check Box7'); ?>" value="Yes" type="checkbox">
                    <label for="">
                    {{ __('This disclosure is the undersigned’s initial compensation disclosure in this case.') }}
                    </label>
                </div>
                <div class="input-group ml-30">
                    <input name="<?php echo base64_encode('Check Box8'); ?>" value="Yes" type="checkbox">
                    <label for="">
                    {{ __('This disclosure supplements a previously-filed compensation disclosure in this case.') }}
                    </label>
                </div>
    </div>

    <div class="col-md-12 mt-3">
    <p>2. <strong>{{ __('Postpetition Compensation Arrangement.') }}</strong> {{ __('Pursuant to 11 U.S.C. § 329(a) and FRBP 2016(b), I disclose that I am the attorney for the Debtor and that compensation was paid to me after the petition was filed, and/or was agreed postpetition to be paid to me, for services rendered or to be rendered on behalf of the Debtor in connection with this case.:') }}</p>
    <div class="input-group ml-30">{{ __('For legal services, I agreed postpetition to accept') }}:

    <div class="input-group ml-30 d-flex mt-3">
                    <input name="<?php echo base64_encode('Group1'); ?>" value="Choice1" type="checkbox">
                    <label for="" style="width:205px;">{{ __('hourly rate') }}</label><label>$</label>
                    <input name="<?php echo base64_encode('Text2'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>" type="text" class="form-control price-field">
                    <label>{{ __('or') }}&nbsp;&nbsp;</label>
                    <input name="<?php echo base64_encode('Group1'); ?>" value="Choice2" type="checkbox">
                    <label style="width:150px;">{{ __('flat fee') }}</label><label>$</label>
                    <input name="<?php echo base64_encode('Text3'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>" type="text" class="number price-field">
    </div> 
    <div class="input-group d-flex mt-3">
        <label style="width:400px;">{{ __('Amount I received postpetition, if any:') }} </label><label>$</label>
        <input name="<?php echo base64_encode('Text4'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>" type="text" class="form-control price-field">
    </div>
  
<div class="row align_center sub-child">
    <div class="col-md-9">
        <div class="input-group horizontal_dotted_line">
            <label>{{ __('Balance due') }}</label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="input-group d-flex">
        <div class="input-group-append"> <span class="input-group-text ">$</span> </div>
            <p><input name="<?php echo base64_encode('Text5'); ?>"  type="text" value="<?php echo Helper::priceFormtWithComma('');?>" class="price-field form-control"></p> </div>
    </div>
</div>


    </div> 
</div>

<div class="col-md-12 mt-3">
    <div class="input-group">
    <p>3. 
        <strong>{{ __('Date of Payment:') }}</strong> {{ __('The postpetition compensation was paid to me, and/or the postpetition compensation agreement was entered into, on') }} 
        <i>{{ __('(date)') }}</i>:
        <input name="<?php echo base64_encode('Text37'); ?>" value="" style="width:100px;" placeholder="{{ __('MM/DD/YYYY') }}" type="text" class="date_filed form-control">
    </p>
</div>
</div>

<div class="col-md-12 mt-3">
    <div class="input-group">
    <p>4. <strong>{{ __('Source of Postpetition Compensation.') }}</strong></p>   
</div>

<div class="input-group mt-3 ml-30">
<p>a. <strong>{{ __('Already Paid.') }}</strong> {{ __('The source(s) of the compensation paid to me postpetition was:') }}</p>
</div>
<div class="input-group  ml-30 d-flex">
    <div><input name="<?php echo base64_encode('Check Box26'); ?>" value="Yes" type="checkbox">
        <label>{{ __('Debtor') }}</label>
    </div>
    <div class="ml-30">
        <input name="<?php echo base64_encode('Check Box27'); ?>" value="Yes" type="checkbox">
        <label>{{ __('Other (specify):') }}</label>
        <input name="<?php echo base64_encode('Text6'); ?>" value="" type="text" style="width:200px;"class="form-control">
    </div>
</div>

<div class="input-group mt-3 ml-30">
<p>b. <strong> {{ __('To be Paid.') }}</strong> {{ __('The source(s) of the compensation agreed postpetition to be paid to me is:') }}</p>
</div>
<div class="input-group  ml-30 d-flex">
    <div><input name="<?php echo base64_encode('Check Box28'); ?>" value="Yes" type="checkbox">
        <label>{{ __('Debtor') }}</label>
    </div>
    <div class="ml-30">
        <input name="<?php echo base64_encode('Check Box29'); ?>" value="Yes" type="checkbox">
        <label>{{ __('Other (specify):') }}</label>
        <input name="<?php echo base64_encode('Text7'); ?>" value="" type="text" style="width:200px;"class="form-control">
    </div>
</div>

</div>


<div class="col-md-12 mt-3">
    <p>5. <strong>{{ __('Sharing of Compensation.') }}</strong></p>
    <div class="input-group ml-30">
        <input name="<?php echo base64_encode('Check Box30'); ?>" value="Yes" type="checkbox">
        <label>{{ __('I have not agreed to share the above-disclosed postpetition compensation with any other persons unless they are members or regular associates of my law firm within the meaning of FRBP 9001(10).') }}</label>
    </div>
    <div class="input-group ml-30">
        <input name="<?php echo base64_encode('Check Box31'); ?>" value="Yes" type="checkbox">
        <label>{{ __('I have agreed to share the above-disclosed postpetition compensation with other persons who are not members or regular associates of my law firm within the meaning of FRBP 9001(10). A copy of the agreement, together with a list of the names of the people sharing in the postpetition compensation, is attached.') }}</label>
    </div>
</div>


<div class="col-md-12 mt-3">
    <p>6. <input name="<?php echo base64_encode('Check Box32'); ?>" value="Yes" type="checkbox"> <strong>{{ __('Chapter 7 Cases Only.') }} </strong>{{ __('In chapter 7 bankruptcy cases, a limited scope of appearance is permitted under
LBR 2090-1(a)(3), unless otherwise required by the presiding judge. I have been retained by the Debtor for purposes of a limited appearance. In return for the compensation disclosed above, I have agreed to provide the following legal services:') }}</p>
  
    <div class="input-group ml-30 mt-2">
        <label>a.</label>
        <input name="<?php echo base64_encode('Check Box9'); ?>" value="Yes" type="checkbox">
        <label>{{ __('Any proceeding related to stay motions under 11 U.S.C. § 362.') }}</label>
    </div>
    <div class="input-group ml-30">
        <label>b.</label>
        <input name="<?php echo base64_encode('Check Box10'); ?>" value="Yes" type="checkbox">
        <label>{{ __('Any proceeding involving an objection to the Debtor’s discharge pursuant to 11 U.S.C. § 727.') }}</label>
    </div>
    <div class="input-group ml-30">
        <label>c.</label>
        <input name="<?php echo base64_encode('Check Box11'); ?>" value="Yes" type="checkbox">
        <label>{{ __('Any proceeding to determine whether a specific debt is nondischargeable under 11 U.S.C. § 523.') }}</label>
    </div>
    <div class="input-group ml-30">
        <label>d.</label>
        <input name="<?php echo base64_encode('Check Box12'); ?>" value="Yes" type="checkbox">
        <label>{{ __('Reaffirmation of a debt.') }}</label>
    </div>
    <div class="input-group ml-30">
        <label>e.</label>
        <input name="<?php echo base64_encode('Check Box13'); ?>" value="Yes" type="checkbox">
        <label>{{ __('Any lien avoidance under 11 U.S.C. § 522(f).') }}</label>
    </div>
    <div class="input-group ml-30">
        <label>f.</label>
        <input name="<?php echo base64_encode('Check Box14'); ?>" value="Yes" type="checkbox">
        <label>{{ __('Adversary proceedings (other than those brought under 11 U.S.C. §§ 523 and 727) and other contested bankruptcy matters.') }}</label>
    </div>
    <div class="input-group ml-30">
        <label>g.</label>
        <input name="<?php echo base64_encode('Check Box25'); ?>" value="Yes" type="checkbox">
        <label>{{ __('Other provisions as needed (specify):') }}</label>
        <input name="<?php echo base64_encode('Text7a'); ?>" value="" type="text" style="width:200px;"class="form-control">
    </div>
   
</div>

<div class="col-md-12 mt-3">
    <p>7. <input name="<?php echo base64_encode('Check Box33'); ?>" value="Yes" type="checkbox"> <strong>{{ __('Cases Other than Chapter 7.') }} </strong>{{ __('In return for the above-disclosed fee, I have agreed to render legal services for
the bankruptcy case, including:') }}</p>
    <div class="input-group ml-30">
        <label>a.</label>
        <input name="<?php echo base64_encode('Check Box34'); ?>" value="Yes" type="checkbox">
        <label>{{ __('Representation of the Debtor in adversary proceedings and other contested bankruptcy matters;') }}</label>
    </div>
    <div class="input-group ml-30">
        <label>b.</label>
        <input name="<?php echo base64_encode('Check Box35'); ?>" value="Yes" type="checkbox">
        <label>
            {{ __('Other provisions as needed (specify):') }}
        </label>
    </div>
</div>

<div class="col-md-12 mt-3">
    <p>8. 
        <input name="<?php echo base64_encode('Check Box36'); ?>" value="Yes" type="checkbox">
        <strong>{{ __('Excluded Services.') }}  </strong>
        {{ __('By agreement with the Debtor, the compensation disclosed above does not include fees to
            provide the following services (specify)') }}:  
        <input name="<?php echo base64_encode('Text7b'); ?>" value="" type="text" class="form-control">
    </p>
</div>
   
<div class="col-md-12" style="border:1px solid black;">
<div class="row">
<div class="col-md-12">
    <h3 class="underline text-center"> {{ __('DECLARATION OF ATTORNEY FOR THE DEBTOR') }}</h3>
    <p class="mt-3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('I declare under penalty of perjury that the foregoing, together with any prior compensation disclosures filed by the undersigned, constitutes a complete statement of any agreement or arrangement for payment to me for representation of the Debtor in this bankruptcy case and all amounts received in respect of such representation.') }}</p>
</div>

<div class="col-md-3 mt-3">
        <div class="input-group d-flex">
            <label for="">{{ __('Date:') }}</label>
            <input name="<?php echo base64_encode('Text15'); ?>" value="<?php echo $currentDate;?>" type="text"  placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
        </div>
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-6 mt-3">
        <div class="input-group  ml-30">
            <div class="d-flex">
                <label>{{ __('By') }}:</label> <input name="<?php echo base64_encode('Text16'); ?>" value="<?php echo $attorny_sign;?>" type="text" class="form-control">
                </div>
            <label  style="margin-left:20px;"><i>{{ __('Signature of attorney for the Debtor') }} </i></label>
         </div>
    </div>

    <div class="col-md-3 mt-3">
       
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-6 mt-3">
        <div class="input-group ml-30"><div class="d-flex">
        <label>{{ __('Name:') }}</label> <input name="<?php echo base64_encode('Text17'); ?>" value="<?php echo $attorney_name;?>" type="text" class="form-control"></div>
          <label  style="margin-left:45px;"><i>{{ __('Printed name of attorney') }}</i></label>
         </div>
    </div>

    <div class="col-md-3 mt-3">
      </div>
       <div class="col-md-3"></div>
       <div class="col-md-6 mt-3">
           <div class="input-group ml-30">
            <input name="<?php echo base64_encode('Text18'); ?>" value="<?php echo $atroneyName;?>" type="text" class="form-control">
               <label  style="width:205px;"><i>{{ __('Printed name of law firm') }}</i></label>
            </div>
       </div>
       </div>
</div>

  
<div class="col-md-12 mt-3" style="border:1px solid black;">
<div class="row">
<div class="col-md-12">
    <h3 class="underline text-center"> {{ __('DECLARATION OF THE DEBTOR') }}<br>
       
    </h3>
    <p class=" text-center"> <i>{{ __('(To be completed only if the attorney’s representation is in chapter 7 and of limited scope.)') }}</i></p>
    <p class="mt-3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('I/we declare under penalty of perjury that my attorney has explained to me/us the limited scope of representation as outlined above. I/we understand that I/we have paid or agreed to pay solely for the required services listed in paragraph 6, and that I/we am representing myself/ourselves for any other proceedings, unless a new agreement is reached with an attorney.') }}</p>
</div>

<div class="col-md-3 mt-3">
        <div class="input-group d-flex">
            <label for="">{{ __('Date:') }}</label>
            <input name="<?php echo base64_encode('Text19'); ?>" value="<?php echo $currentDate;?>" type="text"  placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
        </div>
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-3 mt-3">
    <div class="input-group d-flex">
            <label for="">{{ __('Date:') }}</label>
            <input name="<?php echo base64_encode('Text20'); ?>" value="<?php echo $currentDate;?>" type="text"  placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
        </div>
    </div> <div class="col-md-3"></div>


    <div class="col-md-6 mt-3">
        <div class="input-group">
             <input name="<?php echo base64_encode('Text21'); ?>" value="<?php echo $debtor_sign;?>" type="text" class="form-control">
          <label><i>{{ __('Signature of Debtor 1') }}</i></label>
         </div>
    </div>

     <div class="col-md-6 mt-3">
        <div class="input-group">
             <input name="<?php echo base64_encode('Text23'); ?>" value="<?php echo $debtor2_sign;?>" type="text" class="form-control">
          <label><i>{{ __('Signature of Debtor 2 (Joint Debtor)') }}</i></label>
         </div>
    </div>


    <div class="col-md-6 mt-3">
        <div class="input-group">
             <input name="<?php echo base64_encode('Text22'); ?>" value="<?php echo $onlyDebtor;?>" type="text" class="form-control">
          <label><i>{{ __('Printed name of Debtor 1') }}</i></label>
         </div>
    </div>

     <div class="col-md-6 mt-3">
        <div class="input-group">
             <input name="<?php echo base64_encode('Text24'); ?>" value="<?php echo $spousename;?>" type="text" class="form-control">
          <label ><i>{{ __('Printed name of Debtor 2 (Joint Debtor)') }}</i></label>
         </div>
    </div>
 </div>
</div>

<div class="col-md-12 mt-3">
    <h3 class="text-center">{{ __('PROOF OF SERVICE OF DOCUMENT') }}</h3>
    <div class="input-group">
        <label>{{ __('I am over the age of 18 and not a party to this bankruptcy case or adversary proceeding. My business address is:') }}</label>
        <textarea name="<?php echo base64_encode('Address'); ?>" value="" class="form-control"></textarea>
        <p>{{ __('A true and correct copy of the foregoing document entitled') }} <i>{{ __('(specify)') }}</i>: <strong>{{ __('ATTORNEY’S DISCLOSURE OF POSTPETITION COMPENSATION ARRANGEMENT WITH DEBTOR') }}</strong> {{ __('will be served or was served') }} <strong>(a)</strong> {{ __('on the judge in chambers in the form and manner required by LBR 5005-2(d); and') }} <strong>(b)</strong> {{ __('in the manner stated below:') }}</p>
        <p><strong>1. </strong><strong class="underline">{{ __('TO BE SERVED BY THE COURT VIA NOTICE OF ELECTRONIC FILING (NEF)') }}:</strong> {{ __('Pursuant to controlling General Orders and LBR, the foregoing document will be served by the court via NEF and hyperlink to the document. On') }} <i>{{ __('(date)') }}</i> 
        <input name="<?php echo base64_encode('POS Date 1'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control" style="width:100px;">{{ __(', I checked the CM/ECF docket for this bankruptcy case or adversary proceeding and determined that the following persons are on the Electronic Mail Notice List to receive NEF transmission at the email addresses stated below:') }}</p>
        <textarea name="<?php echo base64_encode('Emails'); ?>" value="" class="form-control"></textarea>  
    </div>

    <div class="input-group" style="float:right;">
        <input name="<?php echo base64_encode('POS1'); ?>" value="Choice2" type="checkbox">
        <label>{{ __('Service information continued on attached page') }}</label>
    </div>

  
</div>

<div class="col-md-12">
<div class="input-group mt-3">
        <p><strong>2.</strong> <strong class="underline">{{ __('SERVED BY UNITED STATES MAIL') }}:</strong> On <i>{{ __('(date)') }}</i>
         <input name="<?php echo base64_encode('POS Date 2'); ?>" value="{{$currentDate}}" style="width:100px;" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="form-control date_filed">, {{ __('I served the following persons and/or entities at the last known addresses in this bankruptcy case or adversary proceeding by placing a true and correct copy thereof in a sealed envelope in the United States mail, first class, postage prepaid, and addressed as follows. Listing the judge here constitutes a declaration that mailing to the judge') }} <span class="underline">{{ __('will be completed') }}</span> {{ __('no later than 24 hours after the document is filed.') }}</p>
         <textarea name="<?php echo base64_encode('Judge'); ?>" value="" class="form-control"></textarea>  
    </div>
    <div class="input-group" style="float:right;">
        <input name="<?php echo base64_encode('POS2'); ?>" value="Choice2" type="checkbox">
        <label>{{ __('Service information continued on attached page') }}</label>
    </div>
</div>

<div class="col-md-12 mt-3">
<div class="input-group">
        <p><strong>3.</strong> <strong class="underline">{{ __('SERVED BY PERSONAL DELIVERY, OVERNIGHT MAIL, FACSIMILE TRANSMISSION OR EMAIL') }}</strong> <span class="underline">{{ __('(state method for each person or entity served)</span> Pursuant to F.R.Civ.P. 5 and/or controlling LBR, on') }} <i>{{ __('(date)') }}</i> 
         <input name="<?php echo base64_encode('POS date 3'); ?>" value="{{$currentDate}}" style="width:100px;" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="form-control date_filed">, {{ __('I served the following persons and/or entities by personal delivery, overnight mail service, or (for those who consented in writing to such service method), by facsimile transmission and/or email, as follows. Listing the judge here constitutes a declaration that personal delivery on, or overnight mail to, the judge') }} <span class="underline">{{ __('will be completed') }}</span> {{ __('no later than 24 hours after the document is filed.') }}</p>
         <textarea name="<?php echo base64_encode('Persons'); ?>" value="" class="form-control"></textarea>  
    </div>
    <div class="input-group" style="float:right;">
        <input name="<?php echo base64_encode('POS3'); ?>" value="Choice2" type="checkbox">
        <label>{{ __('Service information continued on attached page') }}</label>
    </div>
</div>

  <div class="col-md-12 mt-3">
    <p>{{ __('I declare under penalty of perjury under the laws of the United States that the foregoing is true and correct.') }}</p>
  </div>

<div class="col-md-2">
    <input name="<?php echo base64_encode('POS date 4'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control"><br>
    <i>{{ __('Date') }}</i>
</div>
<div class="col-md-5">
    <input name="<?php echo base64_encode('Printed NamePg3'); ?>" value="<?php echo $onlyDebtor;?>" type="text" class="form-control"><br>
    <i>{{ __('Printed Name') }}</i>
</div>
<div class="col-md-5">
    <input name="<?php echo base64_encode('SignaturePg3'); ?>" value="<?php echo $debtor_sign;?>" type="text" class="form-control"><br>
    <i>{{ __('Signature') }}</i>
</div>

  

    <div class="col-md-12 mt-3">
 
</div>

</div>
