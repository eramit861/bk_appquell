<div class="modal fade" id="PresetQuestionsModal" tabindex="-1" aria-labelledby="PresetQuestionsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content modal-content-div ">
            <div class="modal-header">
                <h5 class="modal-title" id="PresetQuestionsModalLabel">Change/Edit Preset Questions</h5>
                <button type="button" class="btn-close pt-3" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="preset_question_frm" id="preset_question_frm"
                    action="{{ route('conditional_questions_save') }}" method="post" enctype="multipart/form-data"
                    novalidate>
                    @csrf

                    <div class="row gx-3">
                        <div class="col-12 col-md-12">
                            <div class="light-gray-div mt-3">
                                <h2>Questions</h2>
                                <div class="row gx-3">
                                    <div class="col-12 table-responsive ">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>#</th>
                                                    <th class="w-100">Question</th>
                                                    <th>Add Preset Question(s)</th>
                                                </tr>
                                                @php $i = 1; @endphp
                                                @foreach ($conditionalQuestionArray as $key => $question)
                                                    @php $checked = ""; @endphp
                                                    <tr>
                                                        <td class="py-1">{{ $i }}</td>
                                                        <td class="py-1">{{ $question }}</td>
                                                        <td class="py-1">
                                                            @foreach ($question_to_show as $value)
                                                                @if ($value == $key)
                                                                    @php $checked = 'checked'; @endphp
                                                                @endif
                                                            @endforeach
                                                            <div class="form-check p-0 text-center">
                                                                <div class="label-div question-area m-0">
                                                                    <!-- Radio Buttons -->
                                                                    <div class="custom-radio-group form-group m-0 mt-1">
                                                                        <input type="radio" id="{{ $key }}_no"
                                                                            class="d-none" name="data[{{ $key }}]"
                                                                            {!! $checked !!} value="0">
                                                                        <label for="{{ $key }}_no"
                                                                            class="btn-toggle btn-red {{ $checked !== 'checked' ? 'active' : '' }}">No</label>

                                                                        <input type="radio" id="{{ $key }}_yes"
                                                                            class="d-none" name="data[{{ $key }}]"
                                                                            {!! $checked !!} value="1">
                                                                        <label for="{{ $key }}_yes"
                                                                            class="btn-toggle btn-green {{ $checked == 'checked' ? 'active' : '' }}">Yes</label>
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
                        <button type="submit"
                            class="btn font-weight-bold border-blue-big m-0 btn-new-ui-default btn-green"><span
                                class="">Save</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
