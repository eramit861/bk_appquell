<div class="row">

     <div class="district214 col-md-12 text-center">
        <div class="row">
            <div class="district214 col-md-12 text-center">
                <h2>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('EASTERN DISTRICT OF NORTH CAROLINA') }}</h2>
            </div>
            <div class="district214 col-md-4"></div>
            <div class="district214 col-md-3 text-center">
                <select name="<?php echo base64_encode('form1[0].#subform[0].Division[0]'); ?>" id="" class="form-control">
                    <option value=" " selected="true" hidden="true"></option>
                    <option value="Fayetteville">{{ __('Fayetteville') }}</option>
                    <option value="Greenville">{{ __('Greenville') }}</option>
                    <option value="New Bern">{{ __('New Bern') }}</option>
                    <option value="Raleigh">{{ __('Raleigh') }}</option>
                    <option value="Wilmington">{{ __('Wilmington') }}</option>
                    <option value="Wilson">{{ __('Wilson') }}</option>
                </select>
            </div>
            <div class="district214 col-md-1">
                <h2>{{ __('DIVISION') }}</h2>
            </div>
            <div class="district214 col-md-4"></div>
        </div>
    </div>
    <div class="district214 col-md-12 " style="border:1px solid #000; margin-top: 1rem !important;">
        <div class="row">
            <div class="district214 col-md-6 mt-3 p-5" style="border-right:1px solid #000;">
                <div class="input-group">
                    <label>{{ __('In re:') }}</label>
                    <textarea name="<?php echo base64_encode('form1[0].#subform[0].RE[0]'); ?>" value="" class="form-control" rows="4" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
                    <label>{{ __('Debtor(s)') }}</label>
                    <textarea name="<?php echo base64_encode('form1[0].#subform[0].TextField1[0]'); ?>" value="" class="form-control" rows="4" cols="" style="padding-right:5px;"></textarea>
                </div>
            </div>
            <div class="district214 col-md-6 mt-3 d-flex">
                <div class="row" style="margin-top: 14px;">
                <div class="district214 col-md-3">
                        <label>{{ __('CASE NO.:') }}</label>
                    </div>
                    <div class="district214 col-md-9">
                        <input name="<?php echo base64_encode('form1[0].#subform[0].CaseNo[0]'); ?>" value="<?php echo isset($savedData['case_number']) ? $savedData['case_number'] : ''; ?>"  placeholder="" type="text" class=" form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="district214 col-md-12">
        <div class="row">
            <div class="district214 col-md-12 text-center" style="margin-top: 1rem !important;">
                <h3 >{{ __('CERTIFICATION OF MAILING MATRIX') }}<br>{{ __('REQUIRED BY E.D.N.C. LBR 1007-2') }} </h3> 
            </div>
            <div class="district214 col-md-12">
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('I hereby certify under penalty of perjury that the attached list of creditors which has been prepared in the  format required by the clerk is true and accurate to the best of my knowledge and includes all creditors scheduled in the petition.') }}
            </p>
            </div>
        </div>
    </div>
    <div class="district214 col-md-3 mt-3">
        <div class="district214 input-group d-flex">
            <label for="">{{ __('DATED:') }}</label>
            <input name="<?php echo base64_encode('form1[0].#subform[0].Dated[0]'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
        </div>
    </div>
    <div class="district214 col-md-5"></div>
    <div class="district214 col-md-4 mt-3">
        <div class="input-group ml-30 text-center">
            <input name="<?php echo base64_encode('TextBox0'); ?>" value="<?php echo $debtor_sign;?>" type="text" class="form-control">
            <label style="width:205px;">{{ __('Debtor or Attorney for Debtor') }}</label>
        </div>
    </div>

    <div class="district214 col-md-12 mt-3">
         
    </div>   

</div>
