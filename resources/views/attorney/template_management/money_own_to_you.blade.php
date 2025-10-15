@php
    $conditionalQuestionArray = [
        'alimony_child_support' => 'Are you or your spouse getting or expecting any family support, such as child support and/or alimony?',
        'unpaid_wages' => "Are you or your spouse getting, or have you applied for, any of these: Social Security (SSI/SSDI), VA benefits, unemployment, disability, workers' comp, unpaid wages, sick or vacation pay , or repayment of a personal loan?",
        'life_insurance' => 'Do you or your spouse have any interests in any life insurance policy with a cash value, such as whole or universal life?',
        'insurance_policies' => 'Do you or a spouse, if applicable, have any Health Savings Accounts (HSA) and/or Flex Savings Accounts (FSA)? ',
        'inheritances' => 'Do you or a spouse, if applicable, have any interest in property that is due to you from someone who has died?',
        'injury_claims' => 'If married, do you or your spouse have any current or potential claims or lawsuits related to the items listed below?',
        'other_claims' => 'Do you or a spouse, if applicable, have any potential legal claims (even if they are not fully settled or determined) that could affect your financial situation, including claims where you might owe or be owed money?',
        'is_business_property' => 'If married, do you or your spouse own or have any legal or equitable interest in any business property?',
        'is_farm_property' => 'If married, do you or your spouse have any legal or equitable interest in any farm or commercial fishing property?',
        'other_financial' => 'If married, do you or your spouse have any other personal or financial property not listed elsewhere in this questionnaire?',
    ];
    $templateData = !empty($templateData) ? Helper::validate_key_value('data', $templateData) : [];
@endphp

<form name="financial_assets_data_save" id="financial_assets_data_save" action="{{route('template_data_save')}}" method="post" novalidate>
    @csrf
    <input type="hidden" name="type" value="{{ $type }}">

                    <div class="row gx-3">
                        <div class="col-12 col-md-12">
                            <div class="light-gray-div mt-3">
                                <h2>Enable/Disable Questions</h2>
                                <div class="row gx-3">
                                    <div class="col-12 table-responsive ">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>#</th>
                                                    <th class="question-text">Question</th>
                                                    <th class="custom-radio-group">Manage Question Display</th>
                                                </tr>
                                                @php $i = 1; @endphp
                                                @foreach ($conditionalQuestionArray as $key => $question)
                                                    @php $checked = ""; @endphp
                                                    <tr>
                                                        <td class="py-1">{{ $i }}</td>
                                                        <td class="py-1 question-text">{{ $question }}</td>
                                                        <td class="py-1">
                                                             @if (empty($templateData))
                                                                @php $checked = 'checked'; @endphp
                                                            @else
                                                                @php $checked = ''; @endphp
                                                                @if (isset($templateData[$key]) && $templateData[$key] == 1)
                                                                    @php $checked = 'checked'; @endphp
                                                                @endif
                                                            @endif
                                                            <div class="form-check p-0 text-center">
                                                                <div class="label-div question-area m-0">
                                                                    <!-- Radio Buttons -->
                                                                    <div class="custom-radio-group form-group m-0 mt-1">
                                                                        <input type="radio" id="{{ $key }}_yes"
                                                                            class="d-none" name="data[{{ $key }}]"
                                                                            {!! $checked !!} value="1">
                                                                        <label for="{{ $key }}_yes"
                                                                            class="btn-toggle btn-green {{ $checked == 'checked' ? 'active' : '' }}">Enable</label>

                                                                        <input type="radio" id="{{ $key }}_no"
                                                                            class="d-none" name="data[{{ $key }}]"
                                                                            {!! $checked !!} value="0">
                                                                        <label for="{{ $key }}_no"
                                                                            class="btn-toggle btn-red {{ $checked !== 'checked' ? 'active' : '' }}">Disable</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @php $i++; @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 
    <div class="bottom-btn-div">
        <button type="submit" class="btn font-weight-bold border-blue-big m-0 btn-new-ui-default btn-green"><span class="">Save</span></button>
    </div>
</form>