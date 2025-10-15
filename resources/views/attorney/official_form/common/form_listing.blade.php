@if (!empty($forms))
    <div class="nav-localheading LocalForm">{{ $mainLabel }}
        @if ($addLFAnchor && !empty($additional_form_url))
            <a class="text-c-blue additionaltextform" target="_blank" href="{{ $additional_form_url }}">{{ __('Additional Local Forms') }}</a>
        @endif
    </div>
    @php $singleFormTitle = ""; @endphp
    @foreach($forms as $disdata)
    @if(($disdata['type'] == 'local' && ($disdata['form_tab_content'] != 'official_form_mailing_matrix')
    && $disdata['is_uppliment']!=1) || ($disdata['is_uppliment']==1 && is_array($supplimentForm) &&
    in_array($disdata['form_tab_content'], $supplimentForm)))
    <li class="localformli small-font-item" style="position: relative;">
        <input type="checkbox" class="localform-include check_include_form checkbox_mt"
            value="{{ $disdata['form_tab_content'] }}" checked></input>
        @php $singleFormTitle = (isset($disdata['form_tab_description']) && !empty($disdata['form_tab_description'])) ? '' : 'singleFormTitle'; @endphp
        <a href="#{{ $disdata['form_tab_content'] }}"
            onclick="collesped('{{ $disdata['form_tab_content'] }}')"
            class="nav-link width990 width80 text-left id_{{ $disdata['form_tab_content'] }} {{ $singleFormTitle }}"
            id="section{{ $i++ }}-tab" role="tab">
            <span class="dislocal">{{ $disdata['form_name'] }}</span>
            <span class="desc-tab">
                {{ isset($disdata['form_tab_description']) && !empty($disdata['form_tab_description']) ? $disdata['form_tab_description'] : '' }}
            </span>
        </a><span class="individual_pdf_icon" data-form_id="{{ $disdata['form_tab_content'] }}"><img
                src="{{ url('assets/img/pdf-icon.svg') }}" alt="pdf icon" /></span>
        <br>
        @if($disdata['form_tab_content'] == "80_F1007_1")
        <input type="checkbox" class="form-control local_combine_with_default" style="width: 20px;"
            value="{{ $disdata['form_tab_content'] }}"> <span>{{ __('Combine with default') }}</span>
        @endif
    </li>
    @endif
    @endforeach
@endif