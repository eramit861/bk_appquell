<div class="modal fade" id="YesNoQuestionsModal" tabindex="-1" aria-labelledby="YesNoQuestionsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content modal-content-div ">
            <div class="modal-header">
                <h5 class="modal-title" id="YesNoQuestionsModalLabel">List of Questions</h5>
                <button type="button" class="btn-close pt-3" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
                                                <th>Action</th>
                                            </tr>
                                            @php $i = 1; @endphp
                                            @foreach ($questions as $key => $data)
                                                @php 
                                                    $question_id = $data['id'];
                                                    $question = $data['question'];
                                                @endphp
                                                <tr class="tr_{{ $question_id }}">
                                                    <td class="py-1">{{ $i }}</td>
                                                    <td class="py-0">
                                                        <div class="label-div mb-0 py-2">
                                                            <input type="text" name="" id=""
                                                                class="form-control-none font-weight-normal edit_question_input_{{ $question_id }} "
                                                                value="{{ $data['question'] }}" readonly="true">
                                                        </div>
                                                    </td>
                                                    <td class="py-1">
                                                        <div class="d-flex align-items-center">                                                            
                                                            <button type="button" class="ml-auto view_client_btn me-2 submit edit_question_submit_{{$question_id}} d-none" title="Save" onclick="update_question_fn('{{$question_id}}','{{$question}}')">
                                                                <i class="bi bi-check-lg"></i>
                                                                Save
                                                            </button>
                                                            <button type="button" class="ml-auto view_client_btn me-2 edit edit_question_{{$question_id}}" title="Edit" onclick="edit_question('{{$question_id}}')">
                                                                <i class="bi bi-pencil-square"></i>
                                                                Edit
                                                            </button>
                                                            <button type="button" class="delete-div" title="Delete" onclick="soft_delete_question('{{$question_id}}')">
                                                                <i class="bi bi-trash3"></i>
                                                                Delete
                                                            </button>
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
                    <div class="col-12">
                        <form id="add_form" action="{{ route('attorney_concierge_question_save') }}" method="post">
                            @csrf
                            <div class="light-gray-div mt-0 mx-0">
                                <h2>New Question</h2>
                                <div class="row gx-3">
                                    <div class="col-12">
                                        <div class="label-div">
                                            <div class="form-group mb-0">
                                                <label class="">Enter Question</label>
                                                <textarea required rows="3" class="form-control h-unset" name="question" placeholder="Enter New Question"></textarea>
                                            </div>
                                            @if ($errors->has('company_name'))
                                                <p class="help-block text-danger mt-2">
                                                    {{ $errors->first('company_name') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bottom-btn-div w-auto">
                                <button type="submit"
                                    class="btn font-weight-bold border-blue-big m-0 btn-new-ui-default btn-green"><span
                                        class="">Save</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .table-responsive .view_client_btn.submit{
        border-color: #28a745 !important;
        color: #28a745 !important;
    }

    .table-responsive .view_client_btn.submit:hover{
        background: #28a745 !important;
        color: #ffffff !important;
    }
</style>

@push('scripts')
<script>
  window.YesNoQuestionsConfig = {
    routes: {
      update: "{{ route('attorney_concierge_question_update') }}",
      delete: "{{ route('attorney_concierge_question_delete') }}"
    }
  };
</script>
<script src="{{ asset('assets/js/attorney/yes-no-questions.js') }}"></script>
@endpush
