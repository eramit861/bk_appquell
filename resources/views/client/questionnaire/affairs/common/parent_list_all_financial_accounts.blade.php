<div class="outline-gray-border-area">
    @if(!empty($finacial_affairs['list_all_financial_accounts_data']['institution_name']) && is_array($finacial_affairs['list_all_financial_accounts_data']['institution_name']) && isset($finacial_affairs['list_all_financial_accounts_data']['institution_name'][0]) && !empty($finacial_affairs['list_all_financial_accounts_data']['institution_name'][0]))
        @for($i = 0; $i < count($finacial_affairs['list_all_financial_accounts_data']['institution_name']); $i++)
            @include("client.questionnaire.affairs.list_all_financial_accounts",['finacial_affairs'=>$finacial_affairs['list_all_financial_accounts_data'],$i])
        @endfor
    @else
        @include("client.questionnaire.affairs.list_all_financial_accounts", ['i' => 0, 'isEmpty'=>true])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" id="add-more-residence-form" class="btn-new-ui-default py-1 px-2" onclick="addlistAllFinancialAccountsForm(); return false;">
            <i class="bi bi-plus-lg"></i>
            Add Additional Closed Account(s)
        </button>
    </div>
</div>