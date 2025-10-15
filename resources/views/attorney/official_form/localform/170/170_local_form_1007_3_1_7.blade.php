<div class="row">
    
    <div class=" col-md-12 text-center mb-3">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF MINNESOTA') }}</h3>
    </div>
    
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text3"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div>
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Text4"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
    </div> 

    <div class=" col-md-12 text-center mt-3">
        <h3>{{ __('NOTICE OF RESPONSIBILITIES OF') }}<br>{{ __('CHAPTER 7 DEBTORS AND THEIR ATTORNEYS') }}</h3>
    </div>

    <div class=" col-md-12 mt-3">
        <p>
            <span class="pl-4"></span>
            {{ __('This Notice lists certain responsibilities of debtors and their attorneys. Nothing in this
            document changes, limits, or in any way alters the debtor’s or the debtor’s attorney’s obligations
            under the Bankruptcy Code, the local and national rules, or any rule of professional
            responsibility.') }}
        </p>
        <div class="d-flex">
            <div class="">
                <label for=""></label>
            </div>
            <div class="pl-4">
                <p class="pl-2">{{ __('UNLESS THE COURT ORDERS OTHERWISE:') }}</p>
            </div>
        </div>
        <div class="d-flex mt-3">
            <div class="">
                <label for="">I.</label>
            </div>
            <div class="pl-4">
                <p class="mb-2">{{ __('Before the case is filed, the attorney for the chapter 7 debtor shall, at a minimum:') }}</p>
                <div class="d-flex">
                    <div class="">
                        <label for="">A.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">{{ __('Meet with the debtor to review and analyze the debtor’s real and personal
                            property, debts, income, and expenses and advise the debtor on whether to file a
                            bankruptcy petition;') }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">B.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">{{ __('Explain the various bankruptcy and non-bankruptcy options, the consequences
                            of filing under chapters 7, 11 or 13 and answer the debtor’s questions;') }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">C.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">{{ __('Explain to the debtor how the attorney’s fees are paid;') }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">D.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">{{ __('Advise the debtor of the requirement to provide to the trustee the most recently-
                            filed tax return(s) at least seven days prior to the scheduled meeting of creditors.
                            In addition, advise the debtor of the requirement to attend the meeting of
                            creditors and identify the documents the debtor must bring to the meeting;') }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">E.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">{{ __('Advise the debtor that providing false information in the bankruptcy schedules or
                            false testimony at the meeting of creditors or other hearing or trial may expose
                            the debtor to criminal prosecution and denial of discharge;') }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">F.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">{{ __('Advise the debtor of the necessity of maintaining liability, collision, and
                            comprehensive insurance on vehicles securing loans or leases;') }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">G.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">{{ __('Timely prepare and file the debtor’s petition, schedules, statements, certificates,
                            and other documents required to commence a case, and review them for
                            accuracy contemporaneously with the filing.') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex mt-3">
            <div class="">
                <label for="">II.</label>
            </div>
            <div class="pl-4">
                <p class="mb-2">{{ __('After the case is filed, the attorney for the chapter 7 debtor shall, at a minimum:') }}</p>
                <div class="d-flex">
                    <div class="">
                        <label for="">A.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">{{ __('Ensure that the debtor is adequately represented by an attorney at the meeting
                            of creditors;') }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">B.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">{{ __('Prepare, file, and serve any necessary amendments to the petition, schedules,
                            and statements;') }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">C.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">{{ __('Promptly respond to the debtor’s questions throughout the case;') }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">D.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">{{ __('Consider and advise the debtor concerning the debtor’s options to buy, sell or
                            refinance real or personal property and assume or reject executory contracts or
                            unexpired leases;') }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">E.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">{{ __('Prepare and file a proof of claim for a creditor when appropriate to protect the
                            debtor’s interest;') }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">F.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">{{ __('Fully advise the debtor of the legal effect and consequences of proposed
                            reaffirmation agreements and any defaults thereunder and, where appropriate,
                            negotiate alternate terms with secured creditors, ensure that any agreement is
                            fully and properly completed and filed and appear at any hearing, if required;') }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">G.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">{{ __('Advise the debtor in motions for relief from the automatic stay, file objections
                            when appropriate, and appear, when required, at any hearing;') }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">H.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">{{ __('Prepare, file, and serve responses to motions for dismissal of the case;') }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">I.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">{{ __('Advise the debtor of the requirement to complete an instructional course in
                            personal financial management and the consequences of not doing so;') }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">J.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">{{ __('Represent the debtor in connection with any audit request; and') }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">K.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">{{ __('Represent the debtor in bringing and defending any and all other matters or
                            proceedings in the bankruptcy case as necessary for the proper administration of
                            the case.') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex mt-3">
            <div class="">
                <label for="">{{ __('III.') }}</label>
            </div>
            <div class="pl-4">
                <p class="mb-2">{{ __('The attorney shall comply with Local Rule 9010-3 and represent the debtor in bringing
                    and defending all matters in the bankruptcy case until a substitution of attorney is filed or
                    an order is entered allowing the attorney to withdraw.') }}</p>
                <p class="mb-2">{{ __('Unless otherwise agreed, the attorney has no responsibility to represent the debtor in
                    adversary proceedings. However, if an adversary proceeding is filed against the debtor,
                    the attorney will explain to the debtor the estimated cost of providing representation in
                    the adversary proceeding, the risks and consequences of an adverse judgment, and the
                    risks and consequences of proceeding without counsel, as well as the sources, if any, of
                    possible pro bono representation.') }}</p>                
            </div>
        </div>
        <div class="d-flex mt-3">
            <div class="">
                <label for="">IV.</label>
            </div>
            <div class="pl-4">
                <p class="mb-2">{{ __('Before the case is filed, the chapter 7 debtor shall:') }}</p>
                <div class="d-flex">
                    <div class="">
                        <label for="">A.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">{{ __('Fully disclose, review and analyze with the attorney the debtor’s real and
                            personal property, all debts, income, expenses and all other financial information
                            needed to properly complete the schedules and statements;') }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">B.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">{{ __('Prior to and throughout the case respond promptly to all communications from
                            the attorney;') }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">C.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">{{ __('Explain to the debtor how the attorney’s fees are paid;Prior to and throughout the case, timely provide the attorney with full and
                            accurate financial and other information and documentation the attorney
                            requests, INCLUDING BUT NOT LIMITED TO:') }}</p>                        
                        <div class="d-flex">
                            <div class="">
                                <label for="">1.</label>
                            </div>
                            <div class="pl-4">
                                <p class="mb-2">{{ __('A Certificate of Credit Counseling and any debt repayment plan;') }}</p>
                            </div>
                        </div>                  
                        <div class="d-flex">
                            <div class="">
                                <label for="">2.</label>
                            </div>
                            <div class="pl-4">
                                <p class="mb-2">Proof of income received from <span class=" underline">{{ __('all sources') }}</span> {{ __('in the six-month period
                                    preceding filing, including pay stubs, social security statements, workers’
                                    compensation payments, income from rental property, pensions, disability
                                    payments, child and spousal support, and income from self-employment;') }}</p>
                            </div>
                        </div>                  
                        <div class="d-flex">
                            <div class="">
                                <label for="">3.</label>
                            </div>
                            <div class="pl-4">
                                <p class="mb-2">{{ __('The most recently filed federal and state income tax returns, or transcripts
                                    of returns, as well as any other returns requested by the attorney, the
                                    trustee, the court, or a party in interest;') }}</p>
                            </div>
                        </div>                  
                        <div class="d-flex">
                            <div class="">
                                <label for="">4.</label>
                            </div>
                            <div class="pl-4">
                                <p class="mb-2">{{ __('A government-issued photo identification and proof of social security
                                    number, such as a social security card or W-2;') }}</p>
                            </div>
                        </div>                  
                        <div class="d-flex">
                            <div class="">
                                <label for="">5.</label>
                            </div>
                            <div class="pl-4">
                                <p class="mb-2">{{ __('A record of interest, if any, in an educational individual retirement account
                                    or a qualified state tuition program;') }}</p>
                            </div>
                        </div>                  
                        <div class="d-flex">
                            <div class="">
                                <label for="">6.</label>
                            </div>
                            <div class="pl-4">
                                <p class="mb-2">{{ __('The name, address, and telephone number of any person or state agency
                                    to whom the debtor owes back child or spousal support or makes current
                                    child or spousal support payments, and any and all supporting court
                                    orders, declarations of voluntary support payments, separation
                                    agreements, divorce decrees, or property settlement agreements;') }}</p>
                            </div>
                        </div>                  
                        <div class="d-flex">
                            <div class="">
                                <label for="">7.</label>
                            </div>
                            <div class="pl-4">
                                <p class="mb-2">{{ __('Any insurance policies requested by the attorney;') }}</p>
                            </div>
                        </div>                  
                        <div class="d-flex">
                            <div class="">
                                <label for="">8.</label>
                            </div>
                            <div class="pl-4">
                                <p class="mb-2">{{ __('Vehicle titles for all cars, trucks, motorcycles, boats, ATVs, and other
                                    vehicles titled in the debtor’s name;') }}</p>
                            </div>
                        </div>                  
                        <div class="d-flex">
                            <div class="">
                                <label for="">9.</label>
                            </div>
                            <div class="pl-4">
                                <p class="mb-2">{{ __('Legal descriptions for all real property, wherever located, owned by the
                                    debtor or titled in the debtor’s name, or in which the debtor has any
                                    interest whatsoever, including but not limited to, a timeshare, remainder
                                    interest, or life estate;') }}</p>
                            </div>
                        </div>                  
                        <div class="d-flex">
                            <div class="">
                                <label for="">10.</label>
                            </div>
                            <div class="pl-4">
                                <p class="mb-2">{{ __('Documents relating to any inheritance to which the debtor is entitled or
                                    may be entitled;') }}</p>
                            </div>
                        </div>                  
                        <div class="d-flex">
                            <div class="">
                                <label for="">11.</label>
                            </div>
                            <div class="pl-4">
                                <p class="mb-2">{{ __('Information relating to any foreclosures, repossessions, seizures, wage
                                    garnishments, liens, or levies on assets which occurred in the preceding
                                    12 months or continues after the filing of the case;') }}</p>
                            </div>
                        </div>                  
                        <div class="d-flex">
                            <div class="">
                                <label for="">12.</label>
                            </div>
                            <div class="pl-4">
                                <p class="mb-2">{{ __('Information and documents relating to any prior bankruptcies filed by the
                                    debtor(s) or any related entity;') }}</p>
                            </div>
                        </div>                  
                        <div class="d-flex">
                            <div class="">
                                <label for="">13.</label>
                            </div>
                            <div class="pl-4">
                                <p class="mb-2">{{ __('Any changes in income or financial condition, such as job loss, illness,
                                    injury, inheritance, or lottery winnings before or during the case;') }}</p>
                            </div>
                        </div>                  
                        <div class="d-flex">
                            <div class="">
                                <label for="">14.</label>
                            </div>
                            <div class="pl-4">
                                <p class="mb-2">{{ __('Information and documents relating to any lawsuits in which the debtor is
                                    involved before or during the case or claims the debtor has or may have
                                    against third parties;') }}</p>
                            </div>
                        </div>                  
                        <div class="d-flex">
                            <div class="">
                                <label for="">15.</label>
                            </div>
                            <div class="pl-4">
                                <p class="mb-2">{{ __('Information relating to any seizure of tax refunds by the IRS or
                                    Department of Revenue;') }}</p>
                            </div>
                        </div>                  
                        <div class="d-flex">
                            <div class="">
                                <label for="">16.</label>
                            </div>
                            <div class="pl-4">
                                <p class="mb-2">{{ __('All information or documentation needed to respond to any motion or
                                    objection in the bankruptcy case;') }}</p>
                            </div>
                        </div>                  
                        <div class="d-flex">
                            <div class="">
                                <label for="">17.</label>
                            </div>
                            <div class="pl-4">
                                <p class="mb-2">{{ __('Any tax returns, account statements, pay stubs, or other documentation
                                    necessary to timely comply with requests made by the United States
                                    Trustee or the Chapter 7 Trustee or any audit requests.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">D.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">{{ __('Cooperate with the attorney in preparing, reviewing, and signing the petition,
                            schedules, statements, and all other documents required for filing a bankruptcy
                            case.') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex mt-3">
            <div class="">
                <label for="">V.</label>
            </div>
            <div class="pl-4">
                <p class="mb-2">{{ __('After the case is filed, the chapter 7 debtor shall:') }}</p>
                <div class="d-flex">
                    <div class="">
                        <label for="">A.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">{{ __('Timely and promptly comply with all applicable bankruptcy rules and procedures;') }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">B.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">{{ __('Appear punctually at the meeting of creditors with recent proof of income, a
                            government-issued photo identification card, proof of social security number, and
                            copies of all financial account statements covering the date the bankruptcy
                            petition was filed;') }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">C.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">{{ __('Contact the attorney before buying, refinancing, or contracting to sell real
                            property and before entering into any loan agreement until the debtor receives a
                            discharge;') }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">D.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">{{ __('Keep the court, the trustee, and the attorney informed of the debtor’s current
                            address and telephone number; and') }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">E.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">{{ __('Complete an approved debtor education course and provide the certificate of
                            attendance to the attorney for filing.') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex mt-3">
            <div class="">
                <label for="">VI.</label>
            </div>
            <div class="pl-4">
                <p class="mb-2">{{ __('The chapter 7 debtor’s attorney shall, both before and after the case is filed, comply with
                    all applicable professional and ethical rules and shall exercise civility in dealings with all
                    entities with which the attorney comes in contact. The attorney shall also advise the
                    chapter 7 debtor to likewise act in a civil and courteous manner, to dress in a manner
                    appropriate for a federal proceeding and debtors shall do so.') }}</p>              
            </div>
        </div>
        <p class=" p_justify mt-3">
            <span class="underline">{{ __('Signatures') }}</span>{{ __('. By signing this acknowledgment, the debtor and the attorney certify they have read
            it and understand what is required of the debtor and the attorney in this bankruptcy case.') }}
        </p>
    </div>

    <div class="col-md-6 mt-3">
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Debtor 1"
                inputFieldName="Text46"
                inputValue={{$onlyDebtor}}
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
    <div class="col-md-6 mt-3">
        <div class=" float_right">
            <x-officialForm.dateSingle
                labelText="Date"
                dateNameField="Text49"
                currentDate={{$currentDate}}
            ></x-officialForm.dateSingle>
        </div>
    </div>
    <div class="col-md-6">
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Debtor 2"
                inputFieldName="Text47"
                inputValue={{$spousename}}
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
    <div class="col-md-6">
        <div class=" float_right">
            <x-officialForm.dateSingle
                labelText="Date"
                dateNameField="Text50"
                currentDate={{$currentDate}}
            ></x-officialForm.dateSingle>
        </div>
    </div>
    <div class="col-md-6">
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Attorney"
                inputFieldName="Text48"
                inputValue={{$attorney_name}}
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
    <div class="col-md-6">
        <div class=" float_right">
            <x-officialForm.dateSingle
                labelText="Date"
                dateNameField="Text51"
                currentDate={{$currentDate}}
            ></x-officialForm.dateSingle>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <p class=" p_justify">
            {{ __('A fully executed copy of this document must be filed with the petition commencing the
            bankruptcy case of the debtor(s).') }}
        </p>
    </div>
</div>