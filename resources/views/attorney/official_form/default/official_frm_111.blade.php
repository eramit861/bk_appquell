<form name="official_frm_111" id="official_frm_111" class="save_official_forms" action="{{route('generate_official_pdf')}}" method="post">
    @csrf
    <input type="hidden" name="form_id" value="111">
    <input type="hidden" name="client_id" value="<?php echo $client_id;?>">
    <input type="hidden" name="sourcePDFName" value="<?php echo 'form_111.pdf'; ?>">
    <input type="hidden" name="clientPDFName" value="<?php echo $client_id.'_111.pdf'; ?>">
    <input type="hidden" name="<?php echo base64_encode('B_122A-2-Case number1'); ?>" value="<?php echo $caseno; ?>">
    <input type="hidden" name="<?php echo base64_encode('B_122A-2-Debtor1.Name'); ?>" value="<?php echo $onlyDebtor; ?>">
    <input type="hidden" name="<?php echo base64_encode('B_122A-2-Debtor2.Name'); ?>" value="<?php echo $spousename; ?>">
    <section class="page-section official-form-111 padd-20" id="official-form-111">

        <!-- United States Bankruptcy Court -->
        <div class="row">
            <div class="frm111 col-md-12 text-center">
                <div class="row">
                    <div class="frm111 col-md-12 text-center">
                        <h2>{{ __('United States Bankruptcy Court') }}<br>{{ __('FOR THE WESTERN DISTRICT OF MICHIGAN') }}</h2>
                    </div>
                </div>
            </div>
            <div class="frm111 col-md-12 ml-3" style="border:1px solid #000; margin-top: 1rem !important;">
                <div class="row">
                    <div class="frm111 col-md-6 mt-3 p-5" style="border-right:1px solid #000;">
                        <div class="input-group">
                            <label>{{ __('In re:') }}</label>
                            <textarea name="<?php echo base64_encode('Inre-2030'); ?>>" value="" class="form-control" rows="4" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
                            <p style="text-align: right;">{{ __('Debtor(s)') }}</p>
                        </div>
                    </div>
                    <div class="frm111 col-md-6 mt-3 d-flex">
                        <div class="row" style="margin-top: 14px;">
                            <div class="frm111 col-md-3">
                                <label>{{ __('CASE NO.:') }}</label>
                            </div>
                            <div class="frm111 col-md-9">
                                <input name="<?php echo base64_encode('Case number-2030'); ?>" value="<?php echo isset($savedData['case_number']) ? $savedData['case_number'] : ''; ?>" placeholder="" type="text" class=" form-control">
                            </div>
                            <div class="frm111 col-md-3">
                                <label>{{ __('CHAPTER:') }}</label>
                            </div>
                            <div class="frm111 col-md-9">
                                <input name="<?php echo base64_encode('Chapter number-2030'); ?>" value="<?php echo $chapterName; ?>" placeholder="" type="text" class=" form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="frm111 col-md-12">
                <div class="row">
                    <div class="frm111 col-md-12 text-center">
                        <h3>{{ __('DISCLOSURE OF COMPENSATION OF ATTORNEY FOR DEBTOR') }}</h3>
                    </div>
                    <div class="frm111 col-md-12 mt-3 d-flex">
                        <label for=""> <strong>1.</strong></label>
                        <div class="row pl-1">
                            <div class="frm111 col-md-12">
                                <p>
                                    {{ __('Pursuant to 11 U .S.C. § 329(a) and Fed. Bankr. P. 2016(b), I certify that I am the attorney for the above
                                    named debtor(s) and that compensation paid to me within one year before the filing of the petition in
                                    bankruptcy, or agreed to be paid to me, for services rendered or to be rendered on behalf of the debtor(s) in
                                    contemplation of or in connection with the bankruptcy case is as follows:') }}
                                </p>
                            </div>
                            <div class="frm111 col-md-9">
                                <div class="input-group horizontal_dotted_line">
                                    <label>{{ __('For legal services, I have agreed to accept') }}</label>
                                </div>
                            </div>
                            <div class="frm111 col-md-3">
                                <div class="input-group d-flex ">
                                    <div class="input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                    <input name="<?php echo base64_encode('DescMoney_1-2030')?>" type="text" value="<?php echo Helper::priceFormtWithComma('');?>" class="price-field form-control">
                                </div>
                            </div>
                            <div class="frm111 col-md-9">
                                <div class="input-group horizontal_dotted_line">
                                    <label>{{ __('Prior to the filing of this statement I have received .') }}</label>
                                </div>
                            </div>
                            <div class="frm111 col-md-3">
                                <div class="input-group d-flex ">
                                    <div class="input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                    <input type="text" name="<?php echo base64_encode('DescMoney_1a-2030')?>" value="<?php echo Helper::priceFormtWithComma('');?>" class="price-field form-control">
                                </div>
                            </div>
                            <div class="frm111 col-md-9">
                                <div class="input-group horizontal_dotted_line">
                                    <label for="">{{ __('12a. Copy your total current monthly income from line 11Balance Due') }} </label>
                                </div>
                            </div>
                            <div class="frm111 col-md-3">
                                <div class="input-group d-flex ">
                                    <div class="input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                    <input type="text"  name="<?php echo base64_encode('DescMoney_1b-2030')?>" value="<?php echo Helper::priceFormtWithComma('');?>" class="price-field form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- QUE 2 -->

                    <div class="frm111 col-md-12 mt-3 d-flex">
                        <label for=""> <strong>2.</strong></label>
                        <div class="row pl-1">
                            <div class="frm111 col-md-12">
                                <p>
                                    {{ __('The source of the compensation paid to me was:') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="frm111 col-md-12" >
                        <div class="row pl-3">
                            <div class="frm111 col-md-3">
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('Group1-2030#0')?>" value="On" type="checkbox" >
                                    <label>{{ __('Debtor') }}</label>
                                </div>
                            </div>
                            <div class="frm111 col-md-3">
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('Group1-2030#1');?>" value="On" type="checkbox" >
                                    <label>{{ __('Other (specify)') }}</label>
                                </div>
                            </div>
                            <div class="frm111 col-md-6">
                                    <textarea  name="<?php echo base64_encode('Other2-2030');?>" class="noadjust form-control" rows="2"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- QUE 3 -->

                    <div class="frm111 col-md-12 mt-3 d-flex">
                        <label for=""> <strong>3.</strong></label>
                        <div class="row pl-1">
                            <div class="frm111 col-md-12">
                                <p>
                                        {{ __('The source of compensation to be paid to me is:') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="frm111 col-md-12" >
                        <div class="row pl-3">
                            <div class="frm111 col-md-3">
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('Group2-2030#0');?>"  value="On" type="checkbox" >
                                    <label>{{ __('Debtor') }}</label>
                                </div>
                            </div>
                            <div class="frm111 col-md-3">
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('Group2-2030#1');?>" value="On" type="checkbox" >
                                    <label>{{ __('Other (specify)') }}</label>
                                </div>
                            </div>
                            <div class="frm111 col-md-6">
                                    <textarea name="<?php echo base64_encode('Other3-2030');?>" class="noadjust form-control" rows="2"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- QUE 4 -->

                    <div class="frm111 col-md-12 mt-3 d-flex">
                        <label for=""> <strong>4.</strong></label>
                        <div class="row pl-1">
                            <div class="frm111 col-md-12">
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('Group3-2030#0');?>" value="yes" type="checkbox">
                                    <label>{{ __('I have not agreed to share the above-disclosed compensation with any other person unless they are
                                    members and associates of my law firm.') }}</label>
                                </div>
                            </div>
                            <div class="frm111 col-md-12">
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('Group3-2030#1');?>" value="yes" type="checkbox">
                                    <label>{{ __('I have agreed to share the above-disclosed compensation with a other person or persons who are not
                                    members or associates of my law firm. A copy of the agreement, together with a list of the names of the
                                    people sharing in the compensation, is attached.') }}</label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- QUE 5 -->

                    <div class="frm111 col-md-12 mt-3 d-flex">
                        <label for=""> <strong>5.</strong></label>
                        <div class="row pl-1">
                            <div class="frm111 col-md-12">
                                <p>
                                        {{ __('In return for the above-disclosed fee, I have agreed to render legal service for all aspects of the bankruptcy case, including:') }}
                                </p>
                            </div>
                            <div class="frm111 col-md-12 d-flex">
                                <label for="">{{ __('a.') }}&nbsp;</label>
                                <div class="input-group">
                                    <label>{{ __('Analysis of the debtor\' s financial situation, and rendering advice to the debtor in determining whether to file a petition in bankruptcy;') }}</label>
                                </div>
                            </div>
                            <div class="frm111 col-md-12 d-flex mt-2">
                                <label for="">{{ __('b.') }}&nbsp;</label>
                                <div class="input-group">
                                    <label>{{ __('Preparation and filing of any petition, schedules, statements of affairs and plan which may be required;') }}</label>
                                </div>
                            </div>
                            <div class="frm111 col-md-12 d-flex mt-2">
                                <label for="">{{ __('c.') }}&nbsp;</label>
                                <div class="input-group">
                                    <label>{{ __('Representation of the debtor at the meeting of creditors and confirmation hearing, and any adjourned hearings thereof;') }}</label>
                                </div>
                            </div>
                            <div class="frm111 col-md-12 d-flex mt-2">
                                <label for="">{{ __('d.') }}&nbsp;</label>
                                <div class="input-group">
                                    <label>{{ __('Representation of the debtor in adversary proceedings and other contested bankruptcy matters;') }}</label>
                                </div>
                            </div>
                            <div class="frm111 col-md-12 d-flex mt-2">
                                <label for="">{{ __('e.') }}&nbsp;</label>
                                <div class="input-group">
                                    <label>{{ __('[Other provisions as needed]') }}</label>
                                </div>
                            </div>
                            <div class="frm111 col-md-12 pl-3 mt-2">
                                <textarea  name="<?php echo base64_encode('5e-2030');?>"  class=" form-control mr-3 ml-3" rows="5"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- QUE 6 -->

                    <div class="frm111 col-md-12 mt-3">
                        <div class="row pl-1">
                            <div class="frm111 col-md-12">
                                <p>
                                <strong>6.</strong> {{ __('By agreement with the debtor(s), the above-disclosed fee does not include the following services:') }}
                                </p>
                            </div>
                            <div class="frm111 col-md-12 pl-3 ">
                                <textarea name="<?php echo base64_encode('6-2030');?>" class=" form-control mr-3 ml-3" rows="5"></textarea>
                            </div>
                        </div>

                    </div>

                    <div class="form-border mb-3 mt-3" style="margin-left:1.25rem;">
                        <div class="row">
                            <div class="frm111 col-md-12 text-center">
                                <h3>
                                {{ __('CERTIFICATION') }}
                                </h3>
                            </div>

                            <div class="frm111 col-md-12">
                                <p><?php echo $nbsp_10;?>{{ __('I certify that the foregoing is a complete statement of any agreement or arrangement for payment to
                                me for representation of the debtor(s) in this bankruptcy proceeding.') }}</p>
                            </div>

                            <div class="frm111 col-md-4">
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('Date-2030'); ?>" value="<?php echo $currentDate;?>" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
                                    <label style="font-style: italic;">{{ __('Date') }}</label>
                                </div>
                            </div>
                            <div class="frm111 col-md-2"></div>
                            <div class="frm111 col-md-6">
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('Attorneysignature-2030');?>" id="" style=""  type="text" value="<?php echo $attorny_sign;?>" class="form-control" >
                                    <label style="font-style: italic;">{{ __('Signature of Attorney') }}</label>
                                </div>
                            </div>

                            <div class="frm111 col-md-6"></div>
                            <div class="frm111 col-md-6">
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('Attorneylawfirm-2030');?>" id="" style=""  type="text" value="<?php echo $atroneyName;?>" class="form-control" >
                                    <label style="font-style: italic;">{{ __('Name of law firm') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <x-officialForm.generatePdfButton
            title="Generate PDF" divtitle="coles_official-form-111"
    ></x-officialForm.generatePdfButton>
</section>
</form>
