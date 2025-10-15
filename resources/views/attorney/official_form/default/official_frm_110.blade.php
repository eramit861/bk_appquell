<form name="official_frm_110" id="official_frm_110" class="save_official_forms"  action="{{route('generate_official_pdf')}}" method="post">
                    @csrf
                    <input type="hidden" name="form_id" value="110">
                    <input type="hidden" name="client_id" value="<?php echo $client_id;?>">
                    <input type="hidden" name="sourcePDFName" value="<?php echo 'form_110.pdf'; ?>">
                    <input type="hidden" name="clientPDFName" value="<?php echo $client_id.'_110.pdf'; ?>">
                    <input type="hidden" name="<?php echo base64_encode('B_122A-2-Case number1'); ?>" value="<?php echo $caseno; ?>">
                    <input type="hidden" name="<?php echo base64_encode('B_122A-2-Debtor1.Name'); ?>" value="<?php echo $onlyDebtor; ?>">
                    <input type="hidden" name="<?php echo base64_encode('B_122A-2-Debtor2.Name'); ?>" value="<?php echo $spousename; ?>">
              	  <section class="page-section official-form-110 padd-20" id="official-form-110">

                        <!-- Notice -->
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="text-center mb-3">
                                    <h2 class="font-lg-18">{{ __('Notice Required by 11 U.S.C. § 342(b) for
                                        Individuals Filing for Bankruptcy (Form 2010)') }}</h2> </div>
                            </div>
                            <div class="col-md-12">
                                <div class="notice-box"> <strong class="d-block">{{ __('This notice is for you if:') }}</strong>
                                    <p><strong> {{ __('You are an individual filing for bankruptcy,
                                            and') }}</strong> <strong> Your debts are primarily consumer debts.</strong> {{ __('Consumer debts are defined in 11 U.S.C. § 101(8) as “incurred by an individual primarily for a personal, family, or household purpose.”') }} </p>
                                </div>
                                <div class="input-group mt-3">
                                    <h3>
                                        {{ __('The types of bankruptcy that are
                                        available to individuals') }}
                                    </h3>
                                    <p>{{ __('Individuals who meet the qualifications may file under one of four different chapters of the Bankruptcy Code:') }}</p>
                                    <ul>
                                        <li>{{ __('Chapter 7 — Liquidation') }}</li>
                                        <li>{{ __('Chapter 11— Reorganization') }}</li>
                                        <li>{{ __('Chapter 12— Voluntary repayment plan for family farmers or fishermen') }}</li>
                                        <li>{{ __('Chapter 13— Voluntary repayment plan for individuals with regular income') }}</li>
                                    </ul> <strong>{{ __('You should have an attorney review your
                                        decision to file for bankruptcy and the choice of
                                        chapter.') }} </strong> </div>
                                <div class="input-group mt-3 liquidation-chap">
                                    <h3>
                                        {{ __('Chapter 7: Liquidation') }}
                                    </h3>
                                    <p class="mt-3">$245 filing fee
                                        <br> {{ __('$78 administrative fee') }}
                                        <br> + $15 trustee surcharge
                                        <br>
                                    <div class="total"> {{ __('$338 total fee') }} </div>
                                    </p>
                                    <p>{{ __('Chapter 7 is for individuals who have financial difficulty preventing them from paying their debts and who are willing to allow their nonexempt property to be used to pay their creditors. The primary purpose of filing under chapter 7 is to have your debts discharged. The bankruptcy discharge relieves you after bankruptcy from having to pay many of your pre-bankruptcy debts. Exceptions exist for particular debts, and liens on property may still be enforced after discharge. For example, a creditor may have the right to foreclose a home mortgage or repossess an automobile.') }}
                                        <br>
                                        <br> {{ __('However, if the court finds that you have committed certain kinds of improper conduct described in the Bankruptcy Code, the court may deny your discharge.') }}
                                        <br>
                                        <br> {{ __('You should know that even if you file chapter 7 and you receive a discharge, some debts are not discharged under the law. Therefore, you may still be responsible to pay:') }}</p>
                                    <ul>
                                        <li>{{ __('most taxes;') }} </li>
                                        <li>{{ __('most student loans;') }}</li>
                                        <li>{{ __('domestic support and property settlement obligations;') }}</li>
                                        <li>{{ __('most fines, penalties, forfeitures, and criminal restitution obligations; and') }}</li>
                                        <li>{{ __('certain debts that are not listed in your bankruptcy papers.') }}</li>
                                    </ul>
                                    <p>{{ __('You may also be required to pay debts arising from:') }}</p>
                                    <ul>
                                        <li>{{ __('fraud or theft;') }}</li>
                                        <li>{{ __('fraud or defalcation while acting in breach of fiduciary capacity;') }}</li>
                                        <li>{{ __('intentional injuries that you inflicted; and') }} </li>
                                        <li>{{ __('most fines, penalties, forfeitures, and criminal restitution obligations; and') }}</li>
                                        <li>{{ __('death or personal injury caused by operating a motor vehicle, vessel, or aircraft while intoxicated from alcohol or drugs.') }} </li>
                                    </ul>
                                    <p> {{ __('If your debts are primarily consumer debts, the court can dismiss your chapter 7 case if it finds that you have enough income to repay creditors a certain amount. You must file Chapter 7 Statement of Your Current Monthly Income (Official Form 122A–1) if you are an individual filing for bankruptcy under chapter 7. This form will determine your current monthly income and compare whether your income is more than the median income that applies in your state.') }}
                                        <br> If your income is not above the median for your state, you will not have to complete the other chapter 7 form, the Chapter 7 Means Test Calculation (Official Form 122A–2).
                                        <br> {{ __('If your income is above the median for your state, you must file a second form —the Chapter 7 Means Test Calculation (Official Form 122A–2). The calculations on the form— sometimes called the Means Test—deduct from your income living expenses and payments on certain debts to determine any amount available to pay unsecured creditors. If your income is more than the median income for your state of residence and family size, depending on the results of the Means Test, the U.S. trustee, bankruptcy administrator, or creditors can file a motion to dismiss your case under § 707(b) of the Bankruptcy Code. If a motion is filed, the court will decide if your case should be dismissed. To avoid dismissal, you may choose to proceed under another chapter of the Bankruptcy Code.') }}
                                        <br> If you are an individual filing for chapter 7 bankruptcy, the trustee may sell your property to pay your debts, subject to your right to exempt the property or a portion of the proceeds from the sale of the property. The property, and the proceeds from property that your bankruptcy trustee sells or liquidates that you are entitled to, is called exempt property. Exemptions may enable you to keep your home, a car, clothing, and household items or to receive some of the proceeds if the property is sold.
                                        <br> {{ __('Exemptions are not automatic. To exempt property, you must list it on Schedule C: The Property You Claim as Exempt (Official Form 106C). If you do not list the property, the trustee may sell it and pay all of the proceeds to your creditors.') }}
                                        <br> </p>
                                </div>
                                <div class="input-group mt-3 liquidation-chap">
                                    <h3>
                                        {{ __('Chapter 11: Reorganization') }}
                                    </h3>
                                    <p class="mt-3">$1,167 filing fee
                                        <br> {{ __('+ $571 administrative fee') }}
                                        <br>
                                    <div class="total"> {{ __('$1,738 total fee') }} </div>
                                    <p class="mt-3">{{ __('Chapter 11 is often used for reorganizing a business, but is also available to individuals. The provisions of chapter 11 are too complicated to summarize briefly.') }} </p>
                                </div>
                                <div class="warning-box">
                                    <div class="war-header">
                                        <h4>{{ __('Read These Important Warnings') }}</h4> </div>
                                    <div class="warn-body"> <strong>
                                            {{ __('Because bankruptcy can have serious long-term financial and legal
                                            consequences, including loss of
                                            your property, you should hire an attorney and carefully consider
                                            all of
                                            your options before you file.
                                            Only an attorney can give you legal advice about what can happen as
                                            a
                                            result of filing for bankruptcy
                                            and what your options are. If you do file for bankruptcy, an
                                            attorney
                                            can help you fill out the forms
                                            properly and protect you, your family, your home, and your
                                            possessions.') }}<br><br>
                                            Although the law allows you to represent yourself in bankruptcy
                                            court,
                                            you should understand that
                                            many people find it difficult to represent themselves successfully.
                                            The
                                            rules are technical, and a
                                            mistake or inaction may harm you. If you file without an attorney,
                                            you
                                            are still responsible for knowing
                                            and following all of the legal requirements.<br><br>
                                            {{ __('You should not file for bankruptcy if you are not eligible to file
                                            or if
                                            you do not intend to file the
                                            necessary documents.') }}<br><br>
                                            {{ __('Bankruptcy fraud is a serious crime; you could be fined and
                                            imprisoned
                                            if you commit fraud in your
                                            bankruptcy case. Making a false statement, concealing property, or
                                            obtaining money or property by
                                            fraud in connection with a bankruptcy case can result in fines up to
                                            $250,000, or imprisonment for up to
                                            20 years, or both. 18 U.S.C. §§ 152, 1341, 1519, and 3571.') }}
                                        </strong> </div>
                                </div>
                                <div class="input-group mt-3 liquidation-chap">
                                    <h3>
                                        {{ __('Chapter 12: Repayment plan for family
                                        farmers or fishermen') }}
                                    </h3>
                                    <p class="mt-3">$200 filing fee
                                        <br> {{ __('+ $78 administrative fee') }}
                                        <br>
                                    <div class="total"> {{ __('$278 total fee') }} </div>
                                    <p class="mt-3">{{ __('Similar to chapter 13, chapter 12 permits family farmers and fishermen to repay their debts over a period of time using future earnings and to discharge some debts that are not paid.') }} </p>
                                </div>
                                <div class="input-group mt-3 liquidation-chap">
                                    <h3>
                                        {{ __('Chapter 13: Repayment plan for
                                        individuals with regular
                                        income') }}
                                    </h3>
                                    <p class="mt-3">$235 filing fee
                                        <br> {{ __('+ $78 administrative fee') }}
                                        <br>
                                    <div class="total"> {{ __('$313 total fee') }} </div>
                                    <p class="mt-3">Chapter 13 is for individuals who have regular income and would like to pay all or part of their debts in installments over a period of time and to discharge some debts that are not paid. You are eligible for chapter 13 only if your debts are not more than certain dollar amounts set forth in 11 U.S.C. § 109Under chapter 13, you must file with the court a plan to repay your creditors all or part of the money that you owe them, usually using your future earnings. If the court approves your plan, the court will allow you to repay your debts, as adjusted by the plan, within 3 years or 5 years, depending on your income and other factors.
                                        <br>
                                        <br> {{ __('After you make all the payments under your plan, many of your debts are discharged. The debts that are not discharged and that you may still be responsible to pay include:') }}
                                        <br>
                                        <br>
                                    <ul>
                                        <li> {{ __('domestic support obligations,') }} </li>
                                        <li> {{ __('most student loans,') }} </li>
                                        <li> {{ __('certain taxes,') }} </li>
                                        <li> {{ __('debts for fraud or theft,') }} </li>
                                        <li> {{ __('debts for fraud or defalcation while acting in a fiduciary capacity,') }} </li>
                                        <li> {{ __('most criminal fines and restitution obligations,') }} </li>
                                        <li> {{ __('certain debts that are not listed in your bankruptcy papers,') }} </li>
                                        <li> {{ __('certain debts for acts that caused death or personal injury, and') }} </li>
                                        <li> {{ __('certain long-term secured debts') }}</li>
                                    </ul>
                                    </p>
                                </div>
                                <div class="warning-form">
                                    <h4>{{ __('Warning: File Your Forms on Time') }}</h4>
                                    <p> Section 521(a)(1) of the Bankruptcy Code requires that you promptly file detailed information about your creditors, assets, liabilities, income, expenses and general financial condition. The court may dismiss your bankruptcy case if you do not file this information within the deadlines set by the Bankruptcy Code, the Bankruptcy Rules, and the local rules of the court. For more information about the documents and their deadlines, go to: <a href="http://www.uscourts.gov/forms/bankruptcy-forms">
                                            {{ __('http://www.uscourts.gov/forms/bankruptcy-forms') }}</a> </p>
                                </div>
                                <div class="input-group">
                                    <h3>{{ __('Bankruptcy crimes have serious
                                        consequences') }}</h3>
                                    <p>
                                    <ul>
                                        <li> {{ __('If you knowingly and fraudulently conceal assets or make a false oath or statement under penalty of perjury—either orally or in writing—in connection with a bankruptcy case, you may be fined, imprisoned, or both.') }} </li>
                                        <li> {{ __('All information you supply in connection with a bankruptcy case is subject to examination by the Attorney General acting through the Office of the U.S. Trustee, the Office of the U.S. Attorney, and other offices and employees of the U.S. Department of Justice.') }} </li>
                                    </ul>
                                    </p>
                                </div>
                                <div class="input-group">
                                    <h3>{{ __('Make sure the court has your
                                        mailing address') }}</h3>
                                    <p> {{ __('The bankruptcy court sends notices to the mailing address you list on Voluntary Petition for Individuals Filing for Bankruptcy (Official Form 101). To ensure that you receive information about your case, Bankruptcy Rule 4002 requires that you notify the court of any changes in your address.A married couple may file a bankruptcy case together—called a joint case. If you file a joint case and each spouse lists the same mailing address on the bankruptcy petition, the bankruptcy court generally will mail you and your spouse one copy of each notice, unless you file a statement with the court asking that each spouse receive separate copies.') }} </p>
                                </div>
                                <div class="input-group">
                                    <h3>{{ __('Understand which services you
                                        could receive from credit
                                        counseling agencies') }}</h3>
                                    <p> {{ __('The law generally requires that you receive a credit counseling briefing from an approved credit counseling agency. 11 U.S.C. § 109(h). If you are filing a joint case, both spouses must receive the briefing. With limited exceptions, you must receive it within the 180 days before you file your bankruptcy petition. This briefing is usually conducted by telephone or on the Internet.') }}
                                        <br> In addition, after filing a bankruptcy case, you generally must complete a financial management instructional course before you can receive a discharge. If you are filing a joint case, both spouses must complete the course.
                                        <br> You can obtain the list of agencies approved to provide both the briefing and the instructional course from: <a href="http://www.uscourts.gov/servicesforms/bankruptcy/credit-counseling-and-debtoreducation-courses">{{ __('http://www.uscourts.gov/servicesforms/bankruptcy/credit-counseling-and-debtoreducation-courses') }}</a>.
                                        <br> {{ __('In Alabama and North Carolina, go to:') }}
                                        <br> <a href="http://www.uscourts.gov/servicesforms/bankruptcy/credit-counseling-anddebtor-education-courses">{{ __('http://www.uscourts.gov/servicesforms/bankruptcy/credit-counseling-anddebtor-education-courses') }}</a>
                                        <br>{{ __('If you do not have access to a computer, the clerk of the bankruptcy court may be able to help you obtain the list.') }} </p>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                      <x-officialForm.generatePdfButton
                          title="Generate PDF" divtitle="coles_official-form-110"
                      ></x-officialForm.generatePdfButton>
					</section>
			</form>
