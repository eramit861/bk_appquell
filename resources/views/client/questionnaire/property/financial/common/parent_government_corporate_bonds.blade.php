<div class="outline-gray-border-area">
    @php $i = 0; @endphp
    @if(!empty($government_corporate_bonds['description']) && is_array($government_corporate_bonds['description']))
        @for($i = 0; $i < count($government_corporate_bonds['description']); $i++)
            @include("client.questionnaire.property.financial.government_corporate_bonds",['government_corporate_bonds'=>$government_corporate_bonds,'i'=>$i])
        @endfor
    @else
        @include("client.questionnaire.property.financial.government_corporate_bonds",['i'=>0,'isEmpty'=>true])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" class="btn-new-ui-default py-1 px-2" onclick="common_financial_addmore('government_corporate_bonds', 'government_corporate_bonds_mutisec'); return false;">
            <i class="bi bi-plus-lg"></i>
            Add Additional Bond(s)
        </button>
    </div>
</div>