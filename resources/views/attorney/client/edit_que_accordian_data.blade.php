@php
$formstep = \App\Models\FormsStepsCompleted::where(['client_id' => $val['id']])->first();
$fields = [
    'can_edit_basic_info' => ['label' => 'Basic Information', 'icon' => 'group'],
    'can_edit_property' => ['label' => 'Property', 'icon' => 'group1'],
    'can_edit_debts' => ['label' => 'Debts', 'icon' => 'group2'],
    'can_edit_income' => ['label' => 'Current Income', 'icon' => 'group3'],
    'can_edit_expenase' => ['label' => 'Current Expenses', 'icon' => 'group4'],
    'can_edit_sofa' => ['label' => 'Statement of <br>Financial Affairs', 'icon' => 'group5'],
];
@endphp

<div class="light-gray-div mt-3 mb-3">
    <h2>Allow client to edit questionnaire</h2>

    <div class="row dis_client">
        @foreach($fields as $key => $field)
            <div class="col-12 col-xl-2 col-lg-3 col-md-4 col-sm-6">
                <label class="custom-card package package-101 mt-2 w-100">
                    <input type="checkbox" class="packages" id="{{$key}}" value="1" onchange="allowClientEditQues('{{ $key }}')" 
                        {!! Helper::validate_key_toggle($key, $formstep, 1) !!}
                    >
                    <span class="radio-btn w-100" style="width: 100% ! important">
                        <i class="fas fa-check-circle"></i>
                        <div class="package-desc">
                            @php
                                $src = asset("assets/img/{$field['icon']}-gray-icon.svg");
                                if (Helper::validate_key_value($key, $formstep) == 1) {
                                    $src = asset("assets/img/{$field['icon']}-white-icon.svg");
                                }
                            @endphp
                            <p class="text-bold px-2 mx-2">{!! $field['label'] !!}</p>                            
                        </div>
                    </span>
                </label>
            </div>

        @endforeach
    </div>

</div>