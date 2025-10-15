@php
    $web_view = Session::get('web_view');
    $onChangeRoute = route('client_profit_loss_popup_joint');
    $saveRoute = route('client_profit_loss_joint_setup');
@endphp
<div class="modal-dialog m-0">
    <div class="modal-content profit-loss-popup">
        <div class="modal-header align-items-center py-2">
            <h5 class="modal-title d-flex w-100" id="invitemodalLabel">
                Profit/Loss Statement
            </h5>

            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
        </div>
        <div class="modal-body p-0">
            <div class="card-body b-0-i popup-main-body">
                <form name="proftloss_form" action="" method="post" novalidate>
                    @csrf
                    <div class="profitlosspopup  profitpopup">
                        <div class="row no-border-elements">
                            @for ($i = 1; $i <= 1; $i++)
                                @csrf
                                <x-questionnaire.income.profitLossPopup.profitlossPopupContent
                                    :incomeProfitLoss="$income_profit_loss"
                                    onchangeFunction="profit_loss_type(this,'{{ $onChangeRoute }}', '{{ $additional }}', '{{ $existing_type }}')"
                                    onchangeMonthFunction="changeMonth(this,'{{ $onChangeRoute }}', '{{ $additional }}', '{{ $existing_type }}')"
                                    :web_view="$web_view"
                                    :majorLawProfitLossLabels="$majorLawProfitLossLabels"
                                    :basicInfoPartA="$BasicInfoPartA"
                                    :basicInfoPartB="$BasicInfo_PartB"
                                    :final_date="$final_date"
                                    :attProfitLossMonths="$attProfitLossMonths"
                                    onclickSubmitFunction="verifyHasBussiness('{{ $saveRoute }}', '{{ $additional }}', '{{ $existing_type }}' )">
                                </x-questionnaire.income.profitLossPopup.profitlossPopupContent>
                            @endfor
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@if($web_view ?? false)
    @push('tab_styles')
        <link rel="stylesheet" href="{{ asset('assets/css/client/profit_loss_conditional.css') }}">
    @endpush
@endif
@push('tab_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/client/profit_loss.css') }}">
@endpush