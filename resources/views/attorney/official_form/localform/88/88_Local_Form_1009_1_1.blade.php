<div class="lf1009_1_1 row">
    <input type="hidden" name="<?php echo base64_encode('First Name');?>" value="{{$onlyDebtor}}">
    <input type="hidden" name="<?php echo base64_encode('First Name_2');?>" value="{{$spousename}}">
    <input type="hidden" name="<?php echo base64_encode('Text1');?>" value="{{$caseno}}">
    <input type="hidden" name="<?php echo base64_encode('Text2');?>" value="{{$chapterNo}}">
    <div class="lf1009_1_1 col-md-6">
        <div class="lf1009_1_1 section-box">
            <div class="lf1009_1_1 section-header bg-back text-white">
                <p class="lf1009_1_1 font-lg-20">{{ __('Fill in this information to identify your case') }}</p>
            </div>
            <div class="lf1009_1_1 section-body padd-20">
                <div class="lf1009_1_1 row">
                    <div class="lf1009_1_1 col-md-12">
                        <label>{{ __('District Of') }}</label>
                        <div class="lf1009_1_1 input-group">
                            <select class="lf1009_1_1 form-control district-select" id="district_name" name="<?php echo base64_encode('Bankruptcy District Information')?>"> @foreach ($district_names as $district_name)
                                <option <?php echo Helper::validate_key_option('district_attorney', $savedData, $district_name->district_name); ?> value="{{$district_name->district_name}}" class="lf1009_1_1 form-control">{{$district_name->district_name}}</option> @endforeach </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="lf1009_1_1 col-md-12 padd-20">
        <div class="lf1009_1_1 row">
            <div class="lf1009_1_1 col-md-12">
                <div class="lf1009_1_1 form-title mb-3">
                    <h4>{{ __('Local Bankruptcy Form 1009-1.1') }}</h4>
                    <h2 class="lf1009_1_1 font-lg-22">{{ __('Notice of Amendment of Petition, Lists, Schedules, Statements, and/or Addition of Creditors') }}</h2> 
                </div>
            </div>
            <div class="lf1009_1_1 col-md-12">
                <div class="lf1009_1_1 form-subheading">
                    <p class="lf1009_1_1 font-lg-14">{{ __('Please check applicable boxes, complete applicable sections') }} <span class="lf1009_1_1  text-c-red">{{ __('identifying each amendment') }}</span>{{ __(', and attach additional
pages as necessary.') }}</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Part 1 -->

    <div class="lf1009_1_1 col-md-12">
        <div class="lf1009_1_1 row align-items-center">
            <div class="lf1009_1_1 col-md-12">
                <div class="lf1009_1_1 part-form-title mb-3"> <span>{{ __('Part 1') }}</span>
                    <h2 class="lf1009_1_1 font-lg-18">{{ __('Notice') }}</h2>
                </div>
            </div>
            
            <div class="lf1009_1_1 col-md-12">
                <p>
                    You are hereby notified that the debtor has filed amended documents:
                    <input type="text" name="<?php echo base64_encode('You are hereby notified that the debtor has filed amended documents 1');?>" class="lf1009_1_1 form-control mb-1">
                    <input type="text" name="<?php echo base64_encode('You are hereby notified that the debtor has filed amended documents 2');?>" class="lf1009_1_1 form-control mb-1">
                    <input type="text" name="<?php echo base64_encode('undefined');?>" class="lf1009_1_1 form-control width_50percent">
                    {{ __('[petition/list(s)/schedule(s)/statement(s), and/or addition of creditor(s)].') }}
                </p>
            </div>

            <div class="lf1009_1_1 col-md-12">
                <div class="lf1009_1_1 part-form-title mb-3"> <span>{{ __('Part 2') }}</span>
                    <h2 class="lf1009_1_1 font-lg-18">{{ __('Amendments') }}</h2>
                </div>
            </div>

            <div class="lf1009_1_1 col-md-12">
                <label class="lf1009_1_1 text-bold">{{ __('2.1. Petition') }}</label>
                <div class="lf1009_1_1 d-flex pl-4 mt-2">
                    <div class="lf1009_1_1 ">
                        <input type="checkbox" name="<?php echo base64_encode('Not applicable no amendments to Petition');?>" value="On" class="lf1009_1_1 form-control w-auto">
                    </div>
                    <div class="lf1009_1_1  w-100">
                        <p class="lf1009_1_1 mb-2">
                            {{ __('Not applicable (no amendments to Petition)') }}
                        </p>
                    </div>
                </div>
                <div class="lf1009_1_1 d-flex pl-4">
                    <div class="lf1009_1_1 ">
                        <input type="checkbox" name="<?php echo base64_encode('The following sections of the Petition are amended as follows');?>" value="On" class="lf1009_1_1 form-control w-auto">
                    </div>
                    <div class="lf1009_1_1  w-100">
                        <p class="lf1009_1_1 mb-2">
                            {{ __('The following section(s) of the Petition are amended as follows:') }}
                        </p>
                    </div>
                </div>
                <div class="lf1009_1_1  table_sect table_sect_head_border pl-4">
                    <table class="lf1009_1_1 w-100">
                        <tr>
                            <th class="lf1009_1_1 p-2">{{ __('Section of Petition') }}</th>
                            <th class="lf1009_1_1 p-2">{{ __('Information before amendment') }}</th>
                            <th class="lf1009_1_1 p-2">{{ __('New information') }}</th>
                        </tr>
                        <tr>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Section of PetitionRow1');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Information before amendmentRow1');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('New informationRow1');?>" class="lf1009_1_1 form-control"></td>
                        </tr>
                        <tr>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Section of PetitionRow2');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Information before amendmentRow2');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('New informationRow2');?>" class="lf1009_1_1 form-control"></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="lf1009_1_1 col-md-12 mt-3">
                <label class="lf1009_1_1 text-bold">{{ __('2.2. List(s)') }}</label>
                <div class="lf1009_1_1 d-flex pl-4 mt-2">
                    <div class="lf1009_1_1 ">
                        <input type="checkbox" name="<?php echo base64_encode('Not applicable no amendments to Lists');?>" value="On" class="lf1009_1_1 form-control w-auto">
                    </div>
                    <div class="lf1009_1_1  w-100">
                        <p class="lf1009_1_1 mb-2">
                            {{ __('Not applicable (no amendments to List(s))') }}
                        </p>
                    </div>
                </div>
                <div class="lf1009_1_1 d-flex pl-4">
                    <div class="lf1009_1_1 ">
                        <input type="checkbox" name="<?php echo base64_encode('The following Lists are amended as follows');?>" value="On" class="lf1009_1_1 form-control w-auto">
                    </div>
                    <div class="lf1009_1_1  w-100">
                        <p class="lf1009_1_1 mb-2">
                            {{ __('The following List(s) are amended as follows:') }}
                        </p>
                    </div>
                </div>
                <div class="lf1009_1_1  table_sect table_sect_head_border pl-4">
                    <table class="lf1009_1_1 w-100">
                        <tr>
                            <th class="lf1009_1_1 p-2">{{ __('List') }}</th>
                            <th class="lf1009_1_1 p-2">{{ __('Information before amendment') }}</th>
                            <th class="lf1009_1_1 p-2">{{ __('New information') }}</th>
                        </tr>
                        <tr>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('ListRow1');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Information before amendmentRow1_2');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('New informationRow1_2');?>" class="lf1009_1_1 form-control"></td>
                        </tr>
                        <tr>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('ListRow2');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Information before amendmentRow2_2');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('New informationRow2_2');?>" class="lf1009_1_1 form-control"></td>
                        </tr>
                    </table>
                </div>
                <p class="lf1009_1_1 pl-4 mt-3 mb-2">
                    {{ __('Change in creditor’s name or address on List(s):') }}
                </p>
                <div class="lf1009_1_1  table_sect table_sect_head_border pl-4">
                    <table class="lf1009_1_1 w-100">
                        <tr>
                            <th class="lf1009_1_1 p-2">{{ __('Creditor’s name and/or address before amendment') }}</th>
                            <th class="lf1009_1_1 p-2">{{ __('Corrected creditor’s name and/or address') }}</th>
                        </tr>
                        <tr>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Creditors name andor address before amendmentRow1');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Corrected creditors name andor addressRow1');?>" class="lf1009_1_1 form-control"></td>
                        </tr>
                        <tr>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Creditors name andor address before amendmentRow2');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Corrected creditors name andor addressRow2');?>" class="lf1009_1_1 form-control"></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="lf1009_1_1 col-md-12 mt-3">
                <label class="lf1009_1_1 text-bold">{{ __('2.3. Schedule(s)') }}</label>
                <div class="lf1009_1_1 d-flex pl-4 mt-2">
                    <div class="lf1009_1_1 ">
                        <input type="checkbox" name="<?php echo base64_encode('Not applicable no amendments to Schedules');?>" value="On" class="lf1009_1_1 form-control w-auto">
                    </div>
                    <div class="lf1009_1_1  w-100">
                        <p class="lf1009_1_1 mb-2">
                            {{ __('Not applicable (no amendments to Schedules)') }}
                        </p>
                    </div>
                </div>
                <div class="lf1009_1_1 d-flex pl-4">
                    <div class="lf1009_1_1 ">
                        <input type="checkbox" name="<?php echo base64_encode('Schedules are amended as follows');?>" value="On" class="lf1009_1_1 form-control w-auto">
                    </div>
                    <div class="lf1009_1_1  w-100">
                        <p class="lf1009_1_1 mb-2">
                            {{ __('Schedule(s) are amended as follows::') }}
                        </p>
                    </div>
                </div>
                <p class="lf1009_1_1 mb-2 pl-4">
                    {{ __('Schedules A/B:') }}
                </p>
                <div class="lf1009_1_1  table_sect table_sect_head_border pl-4">
                    <table class="lf1009_1_1 w-100">
                        <tr>
                            <th class="lf1009_1_1 p-2">{{ __('Description of property') }}</th>
                            <th class="lf1009_1_1 p-2">{{ __('Interest in property') }}</th>
                            <th class="lf1009_1_1 p-2">{{ __('Current value of entire property') }}</th>
                            <th class="lf1009_1_1 p-2">{{ __('Current value of portion owned') }}</th>
                        </tr>
                        <tr>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Description of propertyRow1');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Interest in propertyRow1');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Current value of entire propertyRow1');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Current value of portion ownedRow1');?>" class="lf1009_1_1 form-control"></td>
                        </tr>
                        <tr>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Description of propertyRow2');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Interest in propertyRow2');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Current value of entire propertyRow2');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Current value of portion ownedRow2');?>" class="lf1009_1_1 form-control"></td>
                        </tr>
                    </table>
                </div>
                <p class="lf1009_1_1 mb-2 pl-4 mt-3">
                    {{ __('Schedules C:') }}
                </p>
                <div class="lf1009_1_1  table_sect table_sect_head_border pl-4">
                    <table class="lf1009_1_1 w-100">
                        <tr>
                            <th class="lf1009_1_1 p-2">{{ __('Amount of the exemption you claim') }}</th>
                            <th class="lf1009_1_1 p-2">{{ __("Current value of debtor's interest") }}</th>
                        </tr>
                        <tr>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Amount of the exemption you claimRow1');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Current value of debtors interestRow1');?>" class="lf1009_1_1 form-control"></td>
                        </tr>
                        <tr>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Amount of the exemption you claimRow2');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Current value of debtors interestRow2');?>" class="lf1009_1_1 form-control"></td>
                        </tr>
                    </table>
                </div>
                <p class="lf1009_1_1 pl-4">
                    {{ __('If you object to this amended claim of exemption, you must file and serve your objection within 30 days after the date
                    this notice is served. Objections must be filed with the Court and a complete copy must be served on debtor’s
                    attorney or debtor, if unrepresented.') }}
                </p>
                
                <p class="lf1009_1_1 mb-2 pl-4">
                    {{ __('Schedules D:') }}
                </p>
                <div class="lf1009_1_1  table_sect table_sect_head_border pl-4">
                    <table class="lf1009_1_1 w-100">
                        <tr>
                            <th class="lf1009_1_1 p-2">{{ __('New creditor or Amendment to existing creditor') }}</th>
                            <th class="lf1009_1_1 p-2">{{ __('Creditor’s name, last 4 digits of account #, mailing address') }}</th>
                            <th class="lf1009_1_1 p-2">{{ __('Claim amount') }}</th>
                            <th class="lf1009_1_1 p-2">{{ __('Collateral') }}</th>
                            <th class="lf1009_1_1 p-2">{{ __('Collateral value') }}</th>
                            <th class="lf1009_1_1 p-2">{{ __('Any other changes') }}</th>
                        </tr>
                        <tr>
                            <td class="lf1009_1_1 p-1">
                                <p class="lf1009_1_1 mb-0">
                                    <input type="checkbox" name="<?php echo base64_encode('New creditor');?>" value="On" class="lf1009_1_1 form-control w-auto">
                                    {{ __('New creditor') }}
                                </p>
                                <p class="lf1009_1_1 mb-0">
                                    <input type="checkbox" name="<?php echo base64_encode('Amendment to existing creditor');?>" value="On" class="lf1009_1_1 form-control w-auto">
                                    {{ __('Amendment to existing creditor') }}
                                </p>
                            </td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Creditors name last 4 digits of account  mailing addressNew creditor Amendment to existing creditor');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Claim amountNew creditor Amendment to existing creditor');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('CollateralNew creditor Amendment to existing creditor');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Collateral valueNew creditor Amendment to existing creditor');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Any other changesNew creditor Amendment to existing creditor');?>" class="lf1009_1_1 form-control"></td>
                        </tr>
                        <tr>
                            <td class="lf1009_1_1 p-1">
                                <p class="lf1009_1_1 mb-0">
                                    <input type="checkbox" name="<?php echo base64_encode('New creditor_2');?>" value="On" class="lf1009_1_1 form-control w-auto">
                                    {{ __('New creditor') }}
                                </p>
                                <p class="lf1009_1_1 mb-0">
                                    <input type="checkbox" name="<?php echo base64_encode('Amendment to existing creditor_2');?>" value="On" class="lf1009_1_1 form-control w-auto">
                                    {{ __('Amendment to existing creditor') }}
                                </p>
                            </td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Creditors name last 4 digits of account  mailing addressNew creditor Amendment to existing creditor_2');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Claim amountNew creditor Amendment to existing creditor_2');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('CollateralNew creditor Amendment to existing creditor_2');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Collateral valueNew creditor Amendment to existing creditor_2');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Any other changesNew creditor Amendment to existing creditor_2');?>" class="lf1009_1_1 form-control"></td>
                        </tr>
                    </table>
                </div>

                
                <p class="lf1009_1_1 mb-2 pl-4 mt-3">
                    {{ __('Schedules E/F:') }}
                </p>
                <div class="lf1009_1_1  table_sect table_sect_head_border pl-4">
                    <table class="lf1009_1_1 w-100">
                        <tr>
                            <th class="lf1009_1_1 p-2">{{ __('New creditor or Amendment to existing creditor') }}</th>
                            <th class="lf1009_1_1 p-2">{{ __('Creditor’s name, last 4 digits of account #, mailing address') }}</th>
                            <th class="lf1009_1_1 p-2">{{ __('Total claim amount') }}</th>
                            <th class="lf1009_1_1 p-2">{{ __('Priority amount (if any)') }}</th>
                            <th class="lf1009_1_1 p-2">{{ __('Any other changes') }}</th>
                        </tr>
                        <tr>
                            <td class="lf1009_1_1 p-1">
                                <p class="lf1009_1_1 mb-0">
                                    <input type="checkbox" name="<?php echo base64_encode('New creditor_3');?>" value="On" class="lf1009_1_1 form-control w-auto">
                                    {{ __('New creditor') }}
                                </p>
                                <p class="lf1009_1_1 mb-0">
                                    <input type="checkbox" name="<?php echo base64_encode('Amendment to existing creditor_3');?>" value="On" class="lf1009_1_1 form-control w-auto">
                                    {{ __('Amendment to existing creditor') }}
                                </p>
                            </td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Creditors name last 4 digits of account  mailing addressNew creditor Amendment to existing creditor_3');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Total claim amountNew creditor Amendment to existing creditor');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Priority amount if anyNew creditor Amendment to existing creditor');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Any other changesNew creditor Amendment to existing creditor_3');?>" class="lf1009_1_1 form-control"></td>
                        </tr>
                        <tr>
                            <td class="lf1009_1_1 p-1">
                                <p class="lf1009_1_1 mb-0">
                                    <input type="checkbox" name="<?php echo base64_encode('New creditor_4');?>" value="On" class="lf1009_1_1 form-control w-auto">
                                    {{ __('New creditor') }}
                                </p>
                                <p class="lf1009_1_1 mb-0">
                                    <input type="checkbox" name="<?php echo base64_encode('Amendment to existing creditor_4');?>" value="On" class="lf1009_1_1 form-control w-auto">
                                    {{ __('Amendment to existing creditor') }}
                                </p>
                            </td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Creditors name last 4 digits of account  mailing addressNew creditor Amendment to existing creditor_4');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Total claim amountNew creditor Amendment to existing creditor_2');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Priority amount if anyNew creditor Amendment to existing creditor_2');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Any other changesNew creditor Amendment to existing creditor_4');?>" class="lf1009_1_1 form-control"></td> 
                        </tr>
                    </table>
                </div>

                <p class="lf1009_1_1 mb-2 pl-4 mt-3">
                    {{ __('Schedules G:') }}
                </p>
                <div class="lf1009_1_1  table_sect table_sect_head_border pl-4">
                    <table class="lf1009_1_1 w-100">
                        <tr>
                            <th class="lf1009_1_1 p-2">{{ __('Contracting/Leasing party and address') }}</th>
                            <th class="lf1009_1_1 p-2">{{ __('What the contract of lease is for') }}</th>
                        </tr>
                        <tr>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('ContractingLeasing party and addressRow1');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('What the contract of lease is forRow1');?>" class="lf1009_1_1 form-control"></td>
                        </tr>
                        <tr>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('ContractingLeasing party and addressRow2');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('What the contract of lease is forRow2');?>" class="lf1009_1_1 form-control"></td>
                        </tr>
                    </table>
                </div>

                <p class="lf1009_1_1 mb-2 pl-4 mt-3">
                    {{ __('Schedules H:') }}
                </p>
                <div class="lf1009_1_1  table_sect table_sect_head_border pl-4">
                    <table class="lf1009_1_1 w-100">
                        <tr>
                            <th class="lf1009_1_1 p-2">{{ __('Co-debtor/spouse, former spouse, or legal equivalent; name and address') }}</th>
                            <th class="lf1009_1_1 p-2">{{ __('Creditor to whom you owe the debt/community state or territory') }}</th>
                        </tr>
                        <tr>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Codebtorspouse former spouse or legal equivalent name and addressRow1');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Creditor to whom you owe the debtcommunity state or territoryRow1');?>" class="lf1009_1_1 form-control"></td>
                        </tr>
                        <tr>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Codebtorspouse former spouse or legal equivalent name and addressRow2');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Creditor to whom you owe the debtcommunity state or territoryRow2');?>" class="lf1009_1_1 form-control"></td>
                        </tr>
                    </table>
                </div>

                <p class="lf1009_1_1 mb-2 pl-4 mt-3">
                    {{ __('Schedules I/J:') }}
                </p>
                <div class="lf1009_1_1  table_sect table_sect_head_border pl-4">
                    <table class="lf1009_1_1 w-100">
                        <tr>
                            <th class="lf1009_1_1 p-2">{{ __('Amended/New information') }}</th>
                        </tr>
                        <tr>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('undefined_2');?>" class="lf1009_1_1 form-control"></td>
                        </tr>
                        <tr>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('undefined_3');?>" class="lf1009_1_1 form-control"></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="lf1009_1_1 col-md-12 mt-3">
                <label class="lf1009_1_1 text-bold">{{ __('2.4. Statement(s)') }}</label>
                <div class="lf1009_1_1 d-flex pl-4 mt-2">
                    <div class="lf1009_1_1 ">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box1');?>" value="Yes" class="lf1009_1_1 form-control w-auto">
                    </div>
                    <div class="lf1009_1_1  w-100">
                        <p class="lf1009_1_1 mb-2">
                            {{ __('Not applicable (no amendments to Statement(s))') }}
                        </p>
                    </div>
                </div>
                <div class="lf1009_1_1 d-flex pl-4">
                    <div class="lf1009_1_1 ">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box3');?>" value="Yes" class="lf1009_1_1 form-control w-auto">
                    </div>
                    <div class="lf1009_1_1  w-100">
                        <p class="lf1009_1_1 mb-2">
                            {{ __('The following Statement(s) are amended as follows:') }}
                        </p>
                    </div>
                </div>
                <div class="lf1009_1_1  table_sect table_sect_head_border pl-4">
                    <table class="lf1009_1_1 w-100">
                        <tr>
                            <th class="lf1009_1_1 p-2">{{ __('Statement') }}</th>
                            <th class="lf1009_1_1 p-2">{{ __('Information before amendment') }}</th>
                            <th class="lf1009_1_1 p-2">{{ __('New information') }}</th>
                        </tr>
                        <tr>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Text3');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Text4');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('New information');?>" class="lf1009_1_1 form-control"></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="lf1009_1_1 col-md-12 mt-3">
                <label class="lf1009_1_1 text-bold">{{ __('2.5. Addition of Creditor(s)') }}</label>
                <div class="lf1009_1_1 d-flex pl-4 mt-2">
                    <div class="lf1009_1_1 ">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box5');?>" value="Yes" class="lf1009_1_1 form-control w-auto">
                    </div>
                    <div class="lf1009_1_1  w-100">
                        <p class="lf1009_1_1 mb-2">
                            {{ __('Not applicable (no additions)') }}
                        </p>
                    </div>
                </div>
                <div class="lf1009_1_1 d-flex pl-4">
                    <div class="lf1009_1_1 ">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box6');?>" value="Yes" class="lf1009_1_1 form-control w-auto">
                    </div>
                    <div class="lf1009_1_1  w-100">
                        <p class="lf1009_1_1 mb-2">
                            {{ __('Creditors have been added as follows (and Schedules D, E, or F have been amended accordingly):') }}
                        </p>
                    </div>
                </div>
                <div class="lf1009_1_1 d-flex pl-4">
                    <div class="lf1009_1_1 ">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box8');?>" value="Yes" class="lf1009_1_1 form-control w-auto">
                    </div>
                    <div class="lf1009_1_1  w-100">
                        <p class="lf1009_1_1 mb-2">
                            {{ __('Creditors have been amended as follows:') }}
                        </p>
                    </div>
                </div>
                <p class="lf1009_1_1 pl-4">
                    {{ __("Change in creditor's name or address:") }}
                </p>
                <div class="lf1009_1_1  table_sect table_sect_head_border pl-4">
                    <table class="lf1009_1_1 w-100">
                        <tr>
                            <th class="lf1009_1_1 p-2">{{ __("Creditor's name and/or address before amendment") }}</th>
                            <th class="lf1009_1_1 p-2">{{ __("Corrected creditor's name and/or address") }}</th>
                        </tr>
                        <tr>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('Text6');?>" class="lf1009_1_1 form-control"></td>
                            <td class="lf1009_1_1 p-1"><input type="text" name="<?php echo base64_encode('undefined_4');?>" class="lf1009_1_1 form-control"></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="lf1009_1_1 col-md-12 mt-3">
                <div class="lf1009_1_1 part-form-title mb-3"> <span>{{ __('Part 3') }}</span>
                    <h2 class="lf1009_1_1 font-lg-18">{{ __('Signature of Debtor’s Attorney or Debtor (if unrepresented)') }}</h2>
                </div>
            </div>

            <div class="lf1009_1_1 col-md-6">
                <x-officialForm.dateSingleHorizontal
                    labelText="Dated:"
                    dateNameField="Text8"
                    currentDate={{$currentDate}}
                ></x-officialForm.dateSingleHorizontal>
            </div>

            <div class="lf1009_1_1 col-md-1">
                <label for="">By:</label>
            </div>
            <div class="lf1009_1_1 col-md-5">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="Signature of Debtor"
                    inputFieldName="Text9"
                    inputValue={{$debtor_sign}}
                ></x-officialForm.debtorSignVerticalOpp>
            </div>

            <div class="lf1009_1_1 col-md-6 mt-1"></div>
            <div class="lf1009_1_1 col-md-2 mt-1">
                <label for="">{{ __('Bar Number (if applicable):') }}</label>
            </div>
            <div class="lf1009_1_1 col-md-4 mt-1">
                <input type="text" name="<?php echo base64_encode('Bar Number if applicable');?>" class="lf1009_1_1 form-control">
            </div>
            
            <div class="lf1009_1_1 col-md-6 mt-1"></div>
            <div class="lf1009_1_1 col-md-2 mt-1">
                <label for="">{{ __('Mailing Address:') }}</label>
            </div>
            <div class="lf1009_1_1 col-md-4 mt-1">
                <input type="text" name="<?php echo base64_encode('Mailing Address');?>" class="lf1009_1_1 form-control" value="{{$debtoraddress}}, {{$debtorCity}} {{$debtorState}}, {{$debtorzip}}">
            </div>

            <div class="lf1009_1_1 col-md-6 mt-1"></div>
            <div class="lf1009_1_1 col-md-2 mt-1">
                <label for="">{{ __('Telephone number:') }}</label>
            </div>
            <div class="lf1009_1_1 col-md-4 mt-1">
                <input type="text" name="<?php echo base64_encode('Telephone number');?>" class="lf1009_1_1 form-control" value="{{$debtorPhoneHome}}">
            </div>

            <div class="lf1009_1_1 col-md-6 mt-1"></div>
            <div class="lf1009_1_1 col-md-2 mt-1">
                <label for="">{{ __('Facsimile number:') }}</label>
            </div>
            <div class="lf1009_1_1 col-md-4 mt-1">
                <input type="text" name="<?php echo base64_encode('Facsimile number');?>" class="lf1009_1_1 form-control">
            </div>

            <div class="lf1009_1_1 col-md-6 mt-1"></div>
            <div class="lf1009_1_1 col-md-2 mt-1">
                <label for="">{{ __('E-mail address:') }}</label>
            </div>
            <div class="lf1009_1_1 col-md-4 mt-1">
                <input type="text" name="<?php echo base64_encode('Email address');?>" class="lf1009_1_1 form-control">
            </div>
            
        </div>
    </div>
</div>