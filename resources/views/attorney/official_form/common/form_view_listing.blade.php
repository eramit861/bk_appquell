@if (!empty($forms))
    <span class="nav-localheading" style="padding-left:0px;">{{ $mainLabel }}</span>
@endif
@foreach($forms as $disdata)
@if($disdata['type'] == 'local' && $disdata['chapter_type'] != 13 && ($disdata['form_tab_content']
!= 'official_form_mailing_matrix'))
<button type="button"
    class="avoid-this collapsible test fil_{{$disdata['form_tab_content']}} {{ in_array($disdata['form_tab_content'], $confirm_html_forms_json) ? 'checked' : '' }}">{{$disdata['form_name']}}
    <span
        class="desc-tab">{!! (isset($disdata['form_tab_description']) && !empty($disdata['form_tab_description'])) ? '<br>' . $disdata['form_tab_description'] : '' !!}</span>
    <label class="chek_collespe"><input
            onclick="htmlChecked('{{ $disdata['form_tab_content'] }}')"
            class="collesped_check" type="checkbox" name="{{$disdata['form_tab_content']}}"
            @if (in_array($disdata['form_tab_content'], $confirm_html_forms_json)) checked @endif
            value="1">
        <span class="checkmark"></span></label>
</button>


<div class="collapsible_content" id="coles_{{$disdata['form_tab_content']}}">
    <form name="official_{{$disdata['form_tab_content']}}" class="save_official_forms"
        id="official_{{$disdata['form_tab_content']}}" action="{{route('generate_official_pdf')}}"
        method="post">
        @csrf
        <input type="hidden" name="form_id" value="{{$disdata['form_tab_content']}}">
        <input type="hidden" name="client_id" value="{{ $client_id }}">
        <section class="page-section official-form-122a─2 padd-20"
            id="{{$disdata['form_tab_content']}}">
            <div class="container pl-2 pr-0">
                @if (file_exists( resource_path() .
                '/views/attorney/official_form/localform/'.$disdata['zipcode'].'/'.$disdata['form_tab_content'].'.blade.php'))
                @include("attorney.official_form.localform.form",['key'=>$disdata['zipcode'],'formname'=>$disdata['form_tab_content']])
                @endif
                <div class="col-md-12 mt-3 row">
                    <x-officialForm.generatePdfButtonlocal title="Generate PDF"
                        divtitle="coles_{{$disdata['form_tab_content']}}">
                    </x-officialForm.generatePdfButtonlocal>
                </div>
            </div>
        </section>
    </form>
</div>
@endif
@endforeach