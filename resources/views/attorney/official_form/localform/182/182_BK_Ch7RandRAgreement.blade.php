<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('WESTERN DISTRICT OF MISSOURI') }}
        </h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
       <x-officialForm.inReDebtorCustom
            debtorNameField="Text1"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="Text2"
            caseno="{{$caseno}}">
        </x-officialForm.caseNo>
    </div>
    <div class="col-md-12 mt-3">
        <h3 class="text-center mb-3">{{ __('RIGHTS AND RESPONSIBILITIES AGREEMENT BETWEEN') }}<br>{{ __('CHAPTER 7 DEBTORS AND THEIR ATTORNEYS') }}</h3>
        <p class="p_justify">
            {{ __('It is important for persons who file a Chapter 7 bankruptcy case to understand their rights
            and responsibilities. It is also important for them to know what their attorneys’
            responsibilities are and the necessity of communicating openly with their attorneys to
            make the case successful. Attorneys’ clients also are entitled to expect certain services to
            be performed by their attorneys. In order to assure that clients and their attorneys
            understand their rights and responsibilities in the bankruptcy process, the following
            Rights and Responsibilities have been adopted by the Bankruptcy Court for the Western
            District of Missouri. The signatures below indicate that the responsibilities outlined in the
            agreement have been accepted by the Clients and their attorneys. Nothing in this
            agreement is intended to modify, enlarge or abridge the rights and responsibilities of a
            “debt relief agency,” as that term is defined and used in 11 U.S.C. § 101, et seq.') }}
        </p>
        <p class="p_justify">
            {{ __('Unless otherwise ordered by the Court, any attorney retained to represent you in a
            Chapter 7 case is responsible for representing you on all matters arising in the case unless
            otherwise agreed as to adversary proceedings and conversions to another Chapter of the
            Bankruptcy Code. The attorney is not, however, obligated to represent you in an appeal
            to another Court. The attorney may not withdraw from a bankruptcy case in this District
            unless (a) the attorney and you agree to the attorney’s withdrawal and another attorney
            enters the case on your behalf, or (b) the case is converted to another Chapter of the
            Bankruptcy Code; or (c) the Court, after notice and a hearing, approves an attorney’s
            motion for withdrawal or substitution of attorneys. When appropriate, the attorney may
            apply to the Court for compensation that is additional to the maximum initial fees set out
            in this agreement.') }}
        </p>
        <div class="d-flex">
            <div class="">
                <span class="text-bold pr-2">I.</span>
            </div>
            <div class="w-100">
                <p class="p_justify text-bold">
                   {{ __('BEFORE THE CASE IS FILED, YOU AGREE TO TIMELY:') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
           <span class="pr-2">1.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                   {{ __('Discuss with your attorney your goals in filing the case.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
           <span class="pr-2">2.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('Cooperate with your attorney in preparing all required bankruptcy papers and
                    documents, thoroughly reviewing drafts of documents, and advising your attorney of corrections needed.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
           <span class="pr-2">3.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                {{ __('Provide your attorney with all documentation he or she requests, including but not limited to accurate copies of the following documents:') }}
                </p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div class="">
           <span class="pr-2">a.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('Certificate of Credit Counseling, together with the debt repayment plan, if
                    any, prepared by the nonprofit budget and credit counseling agency that
                    provided individual counseling services to you prior to bankruptcy.') }}
                </p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div class="">
           <span class="pr-2">b.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                {{ __('Proof of income you received from all') }} <span class="underline"> {{ __('sources') }} </span> {{ __('the 6-month period before
                    your case was filed. Some examples include paycheck stubs, Social
                    Security statements, worker’s compensation payments, income from rental
                    property, pensions, disability payments, self-employment income, child and
                    spousal support, and other payments. If you are self-employed or own a
                    business, you should provide report(s) disclosing monthly income and
                    expenses for the 6-month period before the case was filed.') }}
                </p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div class="">
           <span class="pr-2">c.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('Federal and state income tax returns, or transcripts of returns, for the most
                    recently ended tax year, as well as any other returns requested by your attorney.') }}
                </p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div class="">
           <span class="pr-2">d.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('Proof of your identity and Social Security number. Some examples are
                    your driver’s license, passport, or other document containing your photograph.') }}
                </p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div class="">
           <span class="pr-2">e.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('A record of your interest, if any, in an educational individual retirement account or a qualified State tuition program.') }}
                </p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div class="">
           <span class="pr-2">f.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('The name, address and telephone number of any person or state agency to
                    whom you owe back child or spousal support or make current child or
                    spousal support payments. Include all supporting documents for the
                    payments. Some examples of supporting documents are a court order, a
                    declaration of voluntary support payments, a separation agreement, a
                    divorce decree, and a property settlement agreement.') }}
                </p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div class="">
           <span class="pr-2">g.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('The name, address and telephone number of any person or state agency to
                    whom you owe back child or spousal support or make current child or
                    spousal support payments. Include all supporting documents for the
                    payments. Some examples of supporting documents are a court order, a
                    declaration of voluntary support payments, a separation agreement, a
                    divorce decree, and a property settlement agreement.') }}
                </p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div class="">
           <span class="pr-2">g.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                   {{ __('Any insurance policies requested by your attorney.') }}
                </p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div class="">
           <span class="pr-2">h.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('Documents relating to any inheritance to which you are entitled.') }}
                </p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div class="">
           <span class="pr-2">i.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('Documents relating to any legal action in which you are a party.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="text-bold pr-2">II.</span>
            </div>
            <div class="w-100">
                <p class="p_justify text-bold">
                {{ __('AFTER THE CASE IS FILED, YOU AGREE TO TIMELY AND
                PROMPTLY COMPLY WITH ALL APPLICABLE CHAPTER 7 RULES
                AND PROCEDURES, INCLUDING BUT NOT LIMITED TO:') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="pr-2">1.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                     {{ __('Attend the § 341(a) meeting of creditors at the time(s) ordered.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="pr-2">2.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                {{ __('Keep the Chapter 7 trustee and your attorney informed of your current address and telephone number and employment status.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="pr-2">3.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('Inform your attorney of any wage garnishments, seizure of assets or liens that
                    occur or continue after the filing of your bankruptcy case.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="pr-2">4.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('Provide copies of all federal tax returns or transcripts to your attorney when
                    requested, and pay over to your attorney or the trustee, as directed, the nonexempt portion of any tax refunds.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="pr-2">5.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('Contact your attorney promptly if you are sued on a scheduled debt or if you file a
                    lawsuit or intend to settle any dispute relating to events that occurred prior to the
                    filing of your bankruptcy case') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="pr-2">6.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('Provide on a timely basis all information or documentation requested by your
                    attorney, including all information needed to respond to any motion or objection
                    seeking relief in your bankruptcy case.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="pr-2">7.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                {{ __('Provide your attorney with any tax returns, account statements, pay stubs, or other documentation necessary to comply with any audit requests') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="pr-2">8.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('Respond promptly to all communications from your attorney.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="text-bold pr-2">{{ __('III.') }}</span>
            </div>
            <div class="w-100">
                <p class="p_justify text-bold">
                    {{ __('BEFORE THE CASE IS FILED, YOUR ATTORNEY AGREES TO
                    PROVIDE ALL SERVICES NECESSARY FOR REPRESENTATION,
                    INCLUDING BUT NOT LIMITED TO:') }}
                </p>
            </div>
        </div>
        <p>Attorney will personally*:</p>
        <div class="d-flex">
            <div class="">
                <span class="pr-2">1.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                {{ __('Meet with you to review your assets, liabilities, income, and expenses.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="pr-2">2.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('Counsel you regarding the advisability of filing either a chapter 13 or a chapter 7
                    case, discuss bankruptcy procedures, and answer your questions.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="pr-2">3.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('Review the completed petition, statements, schedules, and all amendments with you.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="pr-2">4.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('Explain to you the attorney’s fees that are being charged in the case, how and
                    when those attorney’s fees are determined and paid, and whether additional fees
                    will be charged for representation in adversary proceedings that might be filed in
                    the case, or in the event the case is converted to another Chapter.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="pr-2">5.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('Provide a fully signed copy of this document to you.') }}
                </p>
            </div>
        </div>
        <p>{{ __('With the assistance of staff under his or her supervision, your attorney will:') }}</p>
        <div class="d-flex">
            <div class="">
                <span class="pr-2">6.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('Verify the number and status of any prior bankruptcy case(s) filed by you or any related entity.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="pr-2">7.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('Timely prepare and file your petition, statements, schedules, required documents and certificates, and all necessary amendments to these filings.') }}
                </p>
            </div>
        </div>
        <p>
            * {{ __('The term “personally” means that the described service will be performed only by an
            attorney who is a member in good standing of the Bar and admitted to practice before the
            bankruptcy court. The service shall not be performed by a non-attorney even if that
            individual is employed by the attorney and is under the direct supervision and control of
            that attorney.') }}
        </p>
        <div class="d-flex">
            <div class="">
                <span class="pr-2 text-bold">IV.</span>
            </div>
            <div class="w-100">
                <p class="p_justify text-bold">
                    {{ __('AFTER THE CASE IS FILED, YOUR ATTORNEY AGREES TO
                    PROVIDE ALL SERVICES NECESSARY FOR REPRESENTATION,
                    INCLUDING BUT NOT LIMITED TO:') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="pr-2">1.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('Advise you of the requirement to attend the § 341(a) meeting of creditors and
                    inform you of the date, time, and place of the meeting. In the case of a joint filing,
                    inform you and your spouse that both of you must appear at the meeting.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="pr-2">2.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('Inform you that you must be punctual for the § 341(a) meeting of creditors or the
                    meeting may be continued to a later date.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="pr-2">3.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('Attend the § 341(a) meetings and any court hearings, either personally or through
                    another attorney from his or her firm or through an appearance attorney who has
                    been adequately briefed on the case.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="pr-2">4.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('Advise you if an appearance attorney will stand in for him or her at the § 341(a)
                    meeting or any court hearing, and explain to you in advance, if possible, the role
                    and identity of the appearance attorney. In any event, it is your attorney’s
                    responsibility to adequately prepare the appearance attorney for the meeting or
                    hearing by providing all documents and information in sufficient time to allow for
                    proper representation of you.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="pr-2">5.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('Notify you on a timely basis if any pleading seeking relief against you is filed.
                    This notification shall specify a deadline by which you should contact your
                    attorney to discuss a response to the pleading and may state that if you do not
                    contact the attorney timely, such attorney may choose not to file a response. Such
                    notification should explain the potential consequences of not filing a response to
                    the pleading.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="pr-2">6.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('If your attorney is contacted by you on a timely basis, as provided in paragraph 5,
                    such attorney will timely respond in an appropriate manner to any pleading seeking relief against you') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="pr-2">7.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('Prepare, file, and serve on a timely basis any necessary amended statements and
                    schedules and any change of address, based on information provided by you.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="pr-2">8.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('Monitor all information filed in your case for accuracy and completeness.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="pr-2">9.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('File objections to claims when appropriate.') }}
                </p>
            </div>
        </div>

        <div class="d-flex">
            <div class="">
                <span class="pr-2">10.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                {{ __('Prepare and file a proof of claim for a creditor when appropriate.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="pr-2">11.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('Advise you of the effect of proposed reaffirmation agreements and, where appropriate, negotiate alternate terms with secured creditors.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="pr-2">12.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('Attend any hearing scheduled by the court on a reaffirmation agreement,
                    regardless whether such attorney has signed off on the agreement.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="pr-2">13.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('Unless otherwise agreed before the bankruptcy case is filed, your attorney will
                    represent you in adversary proceedings, including but not limited to objections to
                    discharge and/or dischargeability. Unless otherwise agreed before the case is
                    filed, your attorney will also continue to represent you if the case is converted to
                    another Chapter of the Bankruptcy Code. The attorney is not, however, obligated
                    to represent you in an appeal to another Court.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="pr-2">14.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('If your attorney has not been retained to represent you in adversary proceedings,
                    and an adversary proceeding is then filed against you, the attorney will, within 7
                    days after receiving notice of the adversary proceeding, explain to you the
                    estimated cost of providing representation in the adversary proceeding, the risks
                    and consequences of an adverse judgment, and the risks and consequences of
                    proceeding without counsel. In addition, the attorney shall advise you of the date
                    by which a response to the adversary proceeding is due in order to avoid a
                    judgment being entered against you based on your failure to respond. And, the
                    attorney shall advise whether you may be eligible to participate in a program in
                    your part of the district to provide eligible debtors with attorneys at no or reduced
                    charge, and who to contact about participation in such a program.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="pr-2">15.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('Prepare, file, and serve any other motion that may be necessary to appropriately
                    represent you in the bankruptcy case, including but not limited to motions to
                    impose or extend the automatic stay.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="pr-2">16.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('Respond promptly to your questions and communications for the duration of the
                    case, and provide all other legal services that are necessary for the proper
                    administration of the bankruptcy case.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="pr-2">17.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('Advise you of the requirement to complete an instructional course in personal
                    financial management, and the consequences of not doing so.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="pr-2">18.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('Represent you at a discharge hearing, if required.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="pr-2">19.</span>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('Represent you in connection with any audit request.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <span class="pr-2 text-bold">V.</span>
            </div>
            <div class="w-100">
                <p class="p_justify text-bold">
                    {{ __('ALLOWANCE AND PAYMENT OF ATTORNEYS’ FEES') }}
                </p>
            </div>
        </div>
        <p>
        {{ __('You and your attorney agree that the fee for all legal services to be provided in the
            bankruptcy case will be') }}
            <span class="w-auto">$<x-officialForm.inputText name="circle the appropriate verb include representation in adversary proceedings and" class="w-auto  price-field" value=""></x-officialForm.inputText>.</span>
            {{ __('You agree to pay this fee. This fee does/does not
            (circle the appropriate verb) include representation in adversary proceedings and
            does/does not include representation if the case is converted to another Chapter. (If
            neither is designated, representation is included)') }}
        </p>
        <p>
            {{ __('If you dispute the legal services provided or the fees charged by your attorney, you may
            file an objection with the Court. Should your attorney’s continued representation create a
            hardship, such attorney may seek a court order allowing him or her to withdraw from the
            case. Under Local Rule 2091-1, such attorney will not be allowed to withdraw until
            another attorney enters the case, unless good cause is shown for the withdrawal') }}
        </p>
        <p><span class="underline">{{ __('Client’s Signature.') }}</span>
            {{ __('By signing this agreement, you certify that you have read the
            agreement and understand and agree to carry out the terms of the agreement to the best of
            your ability, and that you have received a signed copy of the agreement.') }}
        </p>
        <p><span class="underline">{{ __('Attorney’s Signature.') }}</span>
            {{ __('By signing this agreement, your attorney certifies that, before the
            case was filed, he or she personally met with you and counseled and explained to you all
            matters as required by this agreement.') }} 
        </p>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor"
            inputFieldName="Debtor"
            inputValue="{{$debtor_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
        <div class="mt-2">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor"
            inputFieldName="Debtor_2"
            inputValue="{{$debtor2_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-2">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Attorney"
            inputFieldName="Attorney"
            inputValue="{{$attorny_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
    <div class="col-md-6 mt-3">
       <x-officialForm.dateSingle
            labelText="Date"
            dateNameField="Date"
            currentDate="{{$currentDate}}">
        </x-officialForm.dateSingle>
        <div class="mt-2">
            <x-officialForm.dateSingle
                labelText="Date"
                dateNameField="Date_2"
                currentDate="{{$currentDate}}">
            </x-officialForm.dateSingle>
        </div>
        <div class="mt-2">
            <x-officialForm.dateSingle
                labelText="Date"
                dateNameField="Date_3"
                currentDate="{{$currentDate}}">
            </x-officialForm.dateSingle>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <p>{{ __('Instructions: Do not file the form with the court. Instead file the text only entry Debtor Attorney Certification re Rights.') }}</p>
        <p>ECF Event: <span class="text-bold">Bankruptcy>Other>{{ __('Debtor Attorney Certification re Rights (text)') }}</span></p>
    </div>

</div>
