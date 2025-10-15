<form class="official_frm_106d save_official_forms" name="official_frm_106d_step2_add2" id="official_frm_106d_step2_add2" action="{{route('generate_official_pdf')}}" method="post">
    @csrf
    <x-officialForm.homeLoan.hiddenInputs
        formId="{{$formId}}"
        clientId="{{$clientId}}"
        sourcePDFName="{{ $sourcePDFName }}"
        clientPDFName="{{ $clientPDFName }}"
        caseNumber="{{ $caseNumber }}"
        debtor1="{{ $debtor1 }}"
        debtor2="{{ $debtor2 }}"
    ></x-officialForm.homeLoan.hiddenInputs>
    <!-- use below variable for PArt D -->
    <x-officialForm.homeLoan.part2Title></x-officialForm.homeLoan.part2Title>
    <div class="form-border">
        <x-officialForm.homeLoan.part2SubTitle></x-officialForm.homeLoan.part2SubTitle>
        @for($k = 0; $k <= 5; $k++)
            @php
                $fieldName = LocalFormHelper::schDStep2($k + 1);
            @endphp
            <x-officialForm.homeLoan.part2FormDetails
                :fieldName="$fieldName"
                :partDpart2add="$partDpart2add"
                :codebtor1List="$codebtor1List"
                :i="($k + 1)"
                :k="$k"
            ></x-officialForm.homeLoan.part2FormDetails>
            @php
                $i++;
            @endphp
        @endfor

        <x-officialForm.homeLoan.bottomInputs
            :pagefrom="$pagefrom"
            :totalPage="$totalPage"
        ></x-officialForm.homeLoan.bottomInputs>
    </div>
</form>
