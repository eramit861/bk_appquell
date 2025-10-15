<?php $is_price_table = $is_price_table ?? false; ?>
<section id="pricing_sec"
    class="pls_choose bk-plan-section   <?php if ($is_price_table) { ?>pt-0<?php } ?> position-relative">
    <div class="container">
        <?php if (!$is_price_table) { ?>
        <div class="row">
            <div class="col-md-12 tittle_heading mw-100 mb-3 mt-5">
                @if (request()->is('/'))
                    <h3 class="bk-font-36 text-center">{{ __('landingpage.pricing_sec_heading') }}</h3>
                @else
                    <h1 class="bk-font-36 text-center">{{ __('landingpage.pricing_sec_heading') }}</h1>
                @endif
            </div>
        </div>
        <?php } ?>
        <?php if (!$is_price_table) { ?>
        <div class="row g-1 position-relative">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="assistancebg">
                    <div class="assistance">
                        <div class="assistance_cont text-c-black mb-3 mt-2">Please give us a quick call or use the link
                            below to schedule a demo before selecting a package. This will help us guide you toward the
                            most cost-effective option tailored to your firm’s unique needs, maximizing your benefits.
                            We’re dedicated to building a longterm partnership that delivers far more value than cost.
                        </div>

                        <div class="d-md-flex justify-content-center">
                            <div class="tri_merge_btn mb-5 me-md-4">
                                <a target="_blank" href="<?php echo Helper::CALENDY_BOOK_A_MEETING_URL . '?month=' . date('Y-m'); ?>"
                                    class="bk-main-button button-blue">{{ __('landingpage.pricing_sec_footer_btn1') }}</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php } ?>


        <?php $language = Config::get('app.locale'); ?>

        <div class="row g-2 center-slider bk-pricelists">

            <!-- STANDARD -->
            <div class="col-md-4 mb-4 mb-xl-0 p-2 standard">
                <div class="price_table price_table_1 pt1" id="price_table">
                    <div class="pricing-badge">
                        <div class="badge-text-container">
                            <span class="badge-text">
                                <span class="span-cr">Credit Reports</span>
                                <span class="span-aiw">Auto Imported with</span>
                                <span class="span-bkqai">BKQ - AI</span>
                                <span class="span-price">ONLY $15.99</span>
                                <span class="span-pd">per Debtor</span>
                            </span>
                        </div>
                    </div>
                    <div class="bk-price-data">
                        <div class="price_table_tp tap-1">
                            <h4 class="label-text">{{ str_replace('Subscription', '', $planNames[100]) }}</h4>
                            <h5 class="label-price"><sup>*</sup>${{ $planPrices[100] }}</h5>
                        </div>
                        <div class="apply_now text-center apply_now_active">
                            <?php if ($is_price_table) { ?>
                            <a href="<?php echo route('attorney_price_table', ['package_id' => 100]); ?>"
                                onclick="setSubscription(this,'100','<?php echo \App\Models\AttorneySubscription::BASIC_SUBSCRIPTION_PLAN_PRICE; ?>','Standard','#cecece')"
                                class="bk-main-button button-transparent-price package_id_100">SELECT</a>
                            <?php } else { ?>
                            <a href="{{ route('register', ['package_id' => 'standard']) }}"
                                class="bk-main-button button-transparent-price">Click here to sign up with Standard
                                Questionnaire(s)</a>
                            <?php } ?>
                        </div>
                        <div class="price_list">
                            <ul id="price-list">
                                <!-- The first few items are always visible -->
                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class="text-bold">Interactive Web & App Based Questionnaire</span>
                                        <br><span>(All Client App features included)</span>
                                    </p>
                                </li>
                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class="text-bold">Full Access to Apple & Google Apps</span>
                                    </p>
                                </li>
                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class="text-bold">Automated Client Document Collection</span>
                                    </p>
                                </li>
                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class="text-bold">Built in Revolutionary Follow up system</span>
                                    </p>
                                </li>
                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class="text-bold">Dynamic Questioning</span>
                                    </p>
                                </li>
                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class="text-bold">Text Messaging</span>
                                    </p>
                                </li>
                                <!-- Remaining items are initially hidden -->

                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class="text-bold">Common Creditor List</span>
                                        <br><span>Auto Complete addresses in Web & Apps</span>
                                    </p>
                                </li>
                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class="text-bold">Attorney/Client Document Portal</span>
                                        <br><span>Send/Receive Documents between Atty & Clients thru system portal (no
                                            more emails of client(s) data)</span>
                                    </p>
                                </li>
                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class="text-bold">Questionnaire in English & Spanish All client tutorial
                                            videos,</span>
                                        <br><span>questionnaire And atty to client chat translated to either
                                            language</span>
                                    </p>
                                </li>
                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class="text-bold">Client Questionnaire Imports Into CSV files</span>
                                        <br><span>Imports into most major petition preparation systems</span>
                                    </p>
                                </li>
                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class="text-bold">Storage of Clients Data & Docs</span>
                                        <br><span>2 Years</span>
                                    </p>
                                </li>
                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class="text-bold">Brand/White label as own software</span>
                                        <br><span></span>
                                    </p>
                                </li>
                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class="text-bold">Integrated Links to Websites for Client Resources</span>
                                        <br><span>Such as: KBB, NADA, Court sites, Zillow & Redfin</span>
                                    </p>
                                </li>
                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class="text-bold">Payroll Assistant</span>
                                        <br><span>(Additional
                                            ${{ \App\Models\AttorneySubscription::BASIC_SUBSCRIPTION_PAYROLL_PRICE }}
                                            per individual)</span>
                                        <br><span>(This calculates all your client up loaded pay-stubs in the CMI
                                            Period)</span>
                                    </p>
                                </li>
                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class=" text-bold">Credit Report</span>
                                        <br><span>(Additional
                                            ${{ \App\Models\AttorneySubscription::BASIC_CREDIT_REPORT_PRICE }})</span>
                                    </p>
                                </li>
                                <!-- ... Add other list items here ... -->
                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class="text-bold">Concierge Service</span>
                                        <br><span>We review all uploaded documents and the entire questionnaire with
                                            your client (Additional
                                            ${{ \App\Models\AttorneySubscription::STANDARD_CONCIERGE_SERVICE_PACKAGE_PRICE }}
                                            per case)</span>
                                    </p>
                                </li>

                                <!--li>
                            <i class="fas fa-check"></i>
                            <p><span class="text-bold">Paralegal Check</span>
                                <br><span>(Additional ${{ \App\Models\AttorneySubscription::BASIC_PARALEGAL_ADDON_PRICE }})</span>
                            </p>
                        </li-->

                            </ul>
                        </div>
                    </div>
                    <div class="view_more_button">
                        <a href="#">Show More</a>
                    </div>
                </div>
            </div>

            <!-- STANDARD PLUS -->
            <div
                class="col-md-4 mb-4 mb-xl-0 p-2 standard {{ in_array(Route::currentRouteName(), ['home']) ? 'hide-data' : '' }}">
                <div class="price_table price_table_1 pt1" id="price_table">
                    <div class="bk-price-data">
                        <div class="price_table_tp tap-1">
                            <h4>{{ str_replace('Subscription', '', $planNames[148]) }}</h4>
                            <h5><sup>*</sup>${{ $planPrices[148] }}</h5>
                        </div>
                        <div class="apply_now text-center apply_now_active">
                            <?php if ($is_price_table) { ?>
                            <a href="<?php echo route('attorney_price_table', ['package_id' => 148]); ?>"
                                onclick="setSubscription(this,'148','<?php echo \App\Models\AttorneySubscription::BASIC_PLUS_SUBSCRIPTION_PRICE; ?>','Standard Plus','#cecece')"
                                class="bk-main-button button-transparent-price package_id_148">SELECT</a>
                            <?php } else { ?>
                            <a href="{{ route('register', ['package_id' => 'basic_plus']) }}"
                                class="bk-main-button button-transparent-price">Click here to sign up with Standard Plus
                                Questionnaire(s)</a>
                            <?php } ?>
                        </div>
                        <div class="price_list">
                            <ul id="price-list">
                                <!-- The first few items are always visible -->
                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class="text-bold">ALL Standard Features INCLUDED</span>
                                    </p>
                                </li>
                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class="text-bold">Credit Report - Included</span>
                                    </p>
                                </li>

                                <!--li>
                            <i class="fas fa-check"></i>
                            <p><span class="text-bold">Paralegal Check</span>
                                <br><span>(Additional ${{ \App\Models\AttorneySubscription::BASIC_PARALEGAL_ADDON_PRICE }})</span>
                            </p>
                        </li-->

                            </ul>
                        </div>
                    </div>
                    <div class="view_more_button">
                        <a href="#">Show More</a>
                    </div>
                </div>
            </div>

            <!-- PREMIUM -->
            <div class="col-md-4 p-2">
                <div class="price_table pt2 hover_active" id="price_table">
                    <div class="pricing-badge">
                        <div class="badge-text-container">
                            <span class="badge-text">
                                <span class="span-cr">Credit Reports</span>
                                <span class="span-aiw">Auto Imported with</span>
                                <span class="span-bkqai">BKQ - AI</span>
                                <span class="span-price">ONLY $15.99</span>
                                <span class="span-pd">per Debtor</span>
                            </span>
                        </div>
                    </div>
                    <div class="bk-price-data">
                        <div class="price_table_tp tap-2">
                            <h4 class="label-text">{{ str_replace('Subscription', '', $planNames[101]) }}</h4>
                            <h5 class="label-price"><sup>*</sup>${{ $planPrices[101] }}</h5>
                        </div>
                        <div class="apply_now text-center">
                            <?php if ($is_price_table) { ?>
                            <a href="<?php echo route('attorney_price_table', ['package_id' => 101]); ?>"
                                onclick="setSubscription(this,'101','<?php echo \App\Models\AttorneySubscription::PREMIUM_SUBSCRIPTION_PLAN_PRICE; ?>','Premium','#0c00aa')"
                                class="bk-main-button button-transparent-price package_id_101">SELECT</a>
                            <?php } else { ?>
                            <a href="{{ route('register', ['package_id' => 'premium']) }}"
                                class="bk-main-button button-transparent-price">Click here to sign up with Premium
                                Questionnaire(s)</a>
                            <?php } ?>
                        </div>
                        <div class="price_list">
                            <ul>
                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class=" text-bold">ALL Standard Features INCLUDED</span>
                                    </p>
                                </li>
                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class=" text-bold">Concierge Service</span><br>
                                        <span> We review all uploaded documents and the entire questionnaire with your
                                            client.</span>
                                    </p>
                                </li>
                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class=" text-bold">Storage of Client Data & Docs</span><br>
                                        <span> 3 Years</span>
                                    </p>
                                </li>
                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class=" text-bold">Payroll Assistant Discount</span><br>
                                        <span>(Additional
                                            ${{ \App\Models\AttorneySubscription::PREMIUM_SUBSCRIPTION_PAYROLL_PRICE }})</span>
                                    </p>
                                </li>
                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class=" text-bold">Bank Statement Assistant Discount</span><br>
                                        <!--span>(Additional ${{ \App\Models\AttorneySubscription::PREMIUM_PLUS_BANK_STATEMENT_PRICE }})</span-->
                                    </p>
                                </li>
                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class=" text-bold">Profit Loss Assistant </span>
                                        <br><span>(Additional
                                            ${{ \App\Models\AttorneySubscription::PREMIUM_PROFIT_LOSS_ASSISTANT_PRICE }}
                                            per individual)</span>
                                    </p>
                                </li>
                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class=" text-bold">Credit Report</span>
                                        <br><span>(Additional
                                            ${{ \App\Models\AttorneySubscription::PREMIUM_CREDIT_REPORT_PRICE }})</span>
                                    </p>
                                </li>

                                <!--li>
                  <i class="fas fa-check"></i>
                  <p><span class=" text-bold">Paralegal Check</span>
                    <br><span> (Additional ${{ \App\Models\AttorneySubscription::PREMIUM_PLUS_PARALEGAL_ADDON_PRICE }}) </span>
                  </p>
                </li-->

                            </ul>
                        </div>
                    </div>

                </div>
            </div>

            <!-- PREMIUM PLUS -->
            <div class="col-md-4 p-2 {{ in_array(Route::currentRouteName(), ['home']) ? 'hide-data' : '' }}">
                <div class="price_table pt2 hover_active" id="price_table">
                    <div class="bk-price-data">
                        <div class="price_table_tp tap-2">
                            <h4>{{ str_replace('Subscription', '', $planNames[121]) }}</h4>
                            <h5><sup>*</sup>${{ $planPrices[121] }}</h5>
                        </div>
                        <div class="apply_now text-center">
                            <?php if ($is_price_table) { ?>
                            <a href="<?php echo route('attorney_price_table', ['package_id' => 121]); ?>"
                                onclick="setSubscription(this,'121','<?php echo \App\Models\AttorneySubscription::PREMIUM_PLUS_SUBSCRIPTION_PLAN_PRICE; ?>','Premium Plus','#0c00aa')"
                                class="bk-main-button button-transparent-price package_id_121">SELECT</a>
                            <?php } else { ?>
                            <a href="{{ route('register', ['package_id' => 'premiumplus']) }}"
                                class="bk-main-button button-transparent-price">Click here to sign up with Premium Plus
                                Questionnaire(s)</a>
                            <?php } ?>
                        </div>
                        <div class="price_list">
                            <ul>
                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class=" text-bold">ALL Standard & Premium Features INCLUDED</span>
                                    </p>
                                </li>

                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class=" text-bold">Credit Report - Included </span>
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Ultimate -->
            <div class="col-md-4 p-2">
                <div class="price_table pt3">
                    <div class="pricing-badge">
                        <div class="badge-text-container">
                            <span class="badge-text">
                                <span class="span-cr">Credit Reports</span>
                                <span class="span-aiw">Auto Imported with</span>
                                <span class="span-bkqai">BKQ - AI</span>
                                <span class="span-price">ONLY $15.99</span>
                                <span class="span-pd">per Debtor</span>
                            </span>
                        </div>
                    </div>
                    <div class="bk-price-data">
                        <div class="price_table_tp tap-5">
                            <h4 class="label-text">Ultimate </h4>
                            <h5 class="label-price"><sup>*</sup>${{ $planPrices[135] }}</h5>
                        </div>
                        <div class="apply_now text-center">
                            <?php if ($is_price_table) { ?>
                            <a href="<?php echo route('attorney_price_table', ['package_id' => 135]); ?>"
                                onclick="setSubscription(this,'135','<?php echo \App\Models\AttorneySubscription::ULTIMATE_SUBSCRIPTION_PLAN_PRICE; ?>','Ultimate','#000000')"
                                class="bk-main-button button-transparent-price package_id_135">SELECT</a>
                            <?php } else { ?>
                            <a href="{{ route('register', ['package_id' => 'ultimate']) }}"
                                class="bk-main-button button-transparent-price">Click here to sign up with Ultimate
                                Questionnaire(s)</a>
                            <?php } ?>
                        </div>
                        <div class="price_list">
                            <ul>
                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class=" text-bold">Individual Debtor $129.99</span>
                                    </p>
                                </li>
                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class=" text-bold">Joint Debtor Case $159.00</span>
                                    </p>
                                </li>

                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class=" text-bold">ALL Standard, Premium & Premium Plus Features
                                            INCLUDED</span>
                                    </p>
                                </li>

                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class=" text-bold">Payroll Assistant - Included</span><br>
                                    </p>
                                </li>

                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class=" text-bold">Bank Statement - Included</span>
                                    </p>
                                </li>

                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class=" text-bold">Profit Loss Assistant </span>
                                        <br><span>(Additional
                                            ${{ \App\Models\AttorneySubscription::ULTIMATE_PROFIT_LOSS_ASSISTANT_PRICE }})</span>
                                    </p>
                                </li>
                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class=" text-bold">Credit Report</span>
                                        <br><span>(Additional
                                            ${{ \App\Models\AttorneySubscription::ULTIMATE_CREDIT_REPORT_PRICE }})</span>
                                    </p>
                                </li>
                                <li>
                                    <small>*Must use short form Provided</small>
                                </li>
                                <!--<li>
                  <i class="fas fa-check"></i>
                  <p><span class=" text-bold">Profit Loss Assistant </span>
                    <br><span>(Additional ${{ \App\Models\AttorneySubscription::ULTIMATE_PROFIT_LOSS_ASSISTANT_PRICE }})</span>
                  </p>
                </li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ultimate Plus -->
            <div class="col-md-4 p-2 {{ in_array(Route::currentRouteName(), ['home']) ? 'hide-data' : '' }}">
                <div class="price_table pt3">
                    <div class="bk-price-data">
                        <div class="price_table_tp tap-5">
                            <h4>Ultimate Plus </h4>
                            <h5><sup>*</sup>${{ $planPrices[164] }}</h5>
                        </div>
                        <div class="apply_now text-center">
                            <?php if ($is_price_table) { ?>
                            <a href="<?php echo route('attorney_price_table', ['package_id' => 164]); ?>"
                                onclick="setSubscription(this,'164','<?php echo \App\Models\AttorneySubscription::ULTIMATE_PLUS_SUBSCRIPTION_PLAN_PRICE; ?>','Ultimate Plus','#000000')"
                                class="bk-main-button button-transparent-price package_id_164">SELECT</a>
                            <?php } else { ?>
                            <a href="{{ route('register', ['package_id' => 'ultimateplus']) }}"
                                class="bk-main-button button-transparent-price">Click here to sign up with Ultimate
                                Plus Questionnaire(s)</a>
                            <?php } ?>
                        </div>
                        <div class="price_list">
                            <ul>
                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class=" text-bold">ALL Standard, Premium & Premium Plus, Ultimate Features
                                            INCLUDED</span>
                                    </p>
                                </li>
                                <li>
                                    <i class="fas fa-check"></i>
                                    <p><span class=" text-bold">Credit Report - Included</span>
                                    </p>
                                </li>

                                <!--<li>
                  <i class="fas fa-check"></i>
                  <p><span class=" text-bold">Profit Loss Assistant </span>
                    <br><span>(Additional ${{ \App\Models\AttorneySubscription::ULTIMATE_PROFIT_LOSS_ASSISTANT_PRICE }})</span>
                  </p>
                </li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<div class="d-md-flex justify-content-center">
    <div class="tri_merge_btn mt-2 mt_2 me-md-4">
        <a target="_blank" href="https://calendly.com/bkquestionnaire/consulltation?month=<?php echo date('Y-m'); ?>"
            class="bk-main-button button-white">{{ __('landingpage.pricing_sec_footer_btn1') }}</a>
    </div>
    <div class="tri_merge_btn mt-2 mt_2">
        <?php
        $videos = VideoHelper::getAdminVideos();
$tutorial = $videos[Helper::LANDING_PAGE_AFTER_MAIN_VIDEO] ?? [];
$video = VideoHelper::getVideos($tutorial);
?>
        <a href="javascript:void(0)" data-bs-toggle="modal" onclick="run_tutorial_videos(this,'#video_modal')"
            title="Click to See Full App Demo" data-video="<?php echo $language == 'en' ? $video['en'] : $video['sp']; ?>"
            class="bk-main-button button-transparent">{{ __('landingpage.pricing_sec_footer_btn2') }}</a>
    </div>
</div>
