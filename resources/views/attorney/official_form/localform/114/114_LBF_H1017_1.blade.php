<div class="row">


    <input type="hidden" name="<?php echo base64_encode('Debtor 1'); ?>" value="<?php echo $onlyDebtor;?>">
    <input type="hidden" name="<?php echo base64_encode('Debtor 2'); ?>" value="<?php echo $spousename;?>">
    <input type="hidden" name="<?php echo base64_encode('Case No'); ?>" value="<?php echo isset($savedData['case_number']) ? $savedData['case_number'] : '';?>">
    <div class="row padd-20">
        <div class=" col-md-6">
            <div class=" section-box">
                <div class=" section-header bg-back text-white">
                    <p class=" font-lg-20">{{ __('Fill in this information to identify your case') }}</p>
                </div>
                <div class="section-body padd-20">
                    <div class="row">
                        <div class=" col-md-12">
                            <label>{{ __('District Of') }}</label>
                            <div class=" input-group">
                                <select class="form-control district-select" id="district_name" name="<?php echo base64_encode('Bankruptcy District Information')?>"> @foreach ($district_names as $district_name)
                                    <option <?php echo Helper::validate_key_option('district_attorney', $savedData, $district_name->district_name); ?> value="{{$district_name->district_name}}" class="form-control">{{$district_name->district_name}}</option> @endforeach </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=" col-md-6"></div>
        <div class=" col-md-12 mb-3 mt-3">
            <h4>{{ __('Local Form H1017-1 (3/16)') }}</h4>
            <div class=" form-title">
                <h2 class="font-lg-22">{{ __('Chapter 7 Debtor’s Motion and Notice
                    for Conversion of Case to Another Chapter') }}</h2>
            </div>
        </div>
        <div class=" col-md-12">
            <div class="form-subheading">
                <p class=" p_justify text_italic">
                    {{ __('[Use this form only if this case was not converted previously from another chapter.]') }}
                </p>

                <p>
                    This case has not been converted previously under 11 U.S.C. § 1112, 1208, or 1307. The debtor
                    moves under 11 U.S.C. § 706(a) to convert this case to chapter: 
                    <input type="checkbox" name="<?php echo base64_encode('H1017-1Check Box1');?>" value="Yes" class="form-control w-auto ml-3">
                    11 
                    <input type="checkbox" name="<?php echo base64_encode('H1017-1Check Box2');?>" value="Yes" class="form-control w-auto ml-3">
                    12 
                    <input type="checkbox" name="<?php echo base64_encode('H1017-1Check Box3');?>" value="Yes" class="form-control w-auto ml-3">
                    {{ __('13.') }}
                </p>
                <p class="">
                    {{ __('NOTICE IS GIVEN:') }}
                </p>
                <p class=" p_justify">
                    <span class="pl-4"></span>
                    {{ __('Your rights may be affected. You should read this motion and any accompanying papers carefully
                    and discuss them with your attorney if you have one in this bankruptcy case. (If you do not have an
                    attorney, you may wish to consult one.)') }}
                </p>
                <p class=" p_justify">
                    <span class="pl-4"></span>
                    {{ __('If you do not want the court to convert this case to the chapter checked above, then you or your
                    attorney must file by the following date an objection and request for a hearing.') }}
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <label for="">{{ __('Deadline to object and request a hearing:') }} </label>
        </div>
        <div class="col-md-6">
            <input type="text" name="<?php echo base64_encode('H1017-1Deadline');?>" class="form-control">
            <p class=" text_italic">[Enter a date <span class=" underline">{{ __('at least') }}</span> {{ __('14 days after the date this motion is filed.]') }}</p>
        </div>

        <div class="col-md-12">
            <p>{{ __('Any objection must be filed with the court at:') }}</p>
        </div>

        <div class="col-md-4"></div>
        <div class="col-md-8">
            <p>
                {{ __('United States Bankruptcy Court') }}<br>
                District of Hawaii<br>
                {{ __('1132 Bishop Street, Suite 250') }}<br>
                {{ __('Honolulu, HI 96813.') }}
            </p>
        </div>

        <div class="col-md-12">
            <p class="p_justify">
                {{ __('If you mail your response to the court for filing, you must mail it early enough so the court will receive
                it on or before the deadline above. If you or your attorney do not take these steps, the court may
                decide that you do not oppose the relief sought and may enter an order granting the motion.') }}
            </p>
        </div>

        <div class="col-md-6 ">
            <div class="text-center">
                <input type="text" name="<?php echo base64_encode('H1017-1Debtor 1/s/');?>" class="form-control" value="<?php echo $onlyDebtor ?>">
                <label class="float_left">{{ __('Debtor 1') }}</label>
                <label for="">{{ __('[Print name and sign]') }} </label>
            </div>
            <div class="mt-2">
                <x-officialForm.dateSingleHorizontal
                    labelText="Dated:"
                    dateNameField="H1017-1Date 1"
                    currentDate={{$currentDate}}
                ></x-officialForm.dateSingleHorizontal>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="text-center">
                <input type="text" name="<?php echo base64_encode('H1017-1Debtor 2/s/');?>" class="form-control" value="<?php echo $spousename ?>">
                <label class="float_left">{{ __('Debtor 2') }}</label>
                <label for="">{{ __('[Print name and sign]') }} </label>
            </div>
            <div class="mt-2">
                <x-officialForm.dateSingleHorizontal
                    labelText="Dated:"
                    dateNameField="H1017-1Date 2"
                    currentDate={{$currentDate}}
                ></x-officialForm.dateSingleHorizontal>
            </div>
        </div>
    </div>   

</div>
