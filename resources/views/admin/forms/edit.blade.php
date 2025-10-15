@extends("layouts.admin")
@section('content')
@include("layouts.flash")
<div class="row">
    <!--[ Recent Users ] start-->
    <div class="col-xl-12 col-md-12">
        <div class="card listing-card">
            <div class="card-header">

            </div>
            <div class="card-block px-0 py-0">
                <form action="{{route('admin_forms_update',$form->form_id)}}" method="post">
                    @csrf
                    <div class="container">

                        <div class="form-group">
                            <label>Form Name</label>
                            <input type="text"
                                class="form-control {{ $errors->has('form_name') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter form name here " name="form_name"
                                value="{{old('form_name',$form->form_name)}}">
                            @if ($errors->has('form_name'))
                            <p class="help-block text-danger">{{ $errors->first('form_name') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Form Tab</label>
                            <textarea type="text" rows="4"
                                class="form-control {{ $errors->has('form_tab') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter form tab here "
                                name="form_tab">{{old('form_name',$form->form_tab)}}</textarea>
                            @if ($errors->has('form_tab'))
                            <p class="help-block text-danger">{{ $errors->first('form_tab') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Form Tab Content</label>
                            <textarea type="text" rows="8"
                                class="form-control {{ $errors->has('form_tab_content') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter form tab content here "
                                name="form_tab_content">{{old('form_name',$form->form_tab_content)}}</textarea>
                            @if ($errors->has('form_tab_content'))
                            <p class="help-block text-danger">{{ $errors->first('form_tab_content') }}</p>
                            @endif
                            <p class="text-muted mt-1">
                                <strong>Hint:</strong>
                                <br>
                                1. <em>Normal Local form:</em> <code>9_form_name</code>
                                (where <code>9</code> is the district ID, and <code>form_name</code> is the file name).<br>
                                2. <em>Trustee Local form:</em> <code>9_5_7_form_name</code>
                                (where <code>9</code> is the district ID, <code>5</code> is the trustee ID,
                                <code>7</code> is the chapter type, and <code>form_name</code> is the file name).<br>
                                <strong class="text-danger">Note:</strong> This name will be used for the view and PDF file. Changing the format may affect PDF generation.
                            </p>
                        </div>

                        <div class="form-group">
                            <label>Form Tab Description</label>
                            <textarea type="text" rows="8"
                                class="form-control"
                                placeholder="Enter form tab description here " name="form_tab_description">{{$form->form_tab_description}}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Is suppliment?</label>
                            <select name="is_uppliment" class="form-control">
                                <option <?php if ($form->is_uppliment == 0) {
                                    echo "selected";
                                } ?> value="0">No</option>
                                <option <?php if ($form->is_uppliment == 1) {
                                    echo "selected";
                                } ?> value="1">Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Form Type</label>
                            <select name="type" class=" form-control form_type">
                                <option value=""> select form type </option>
                                <option value="local" @if ($form->type == 'local')
                                    selected
                                    @endif>Local</option>
                                <option value="default" @if ($form->type == 'default')
                                    selected
                                    @endif>Default</option>
                            </select>
                            @if ($errors->has('type'))
                            <p class="help-block text-danger">{{ $errors->first('type') }}</p>
                            @endif
                        </div>

                        <div class="form-group district_group">
                            <label>District</label>
                            <select value="{{ old('zipcode') }}" name="zipcode" class=" form-control" onchange="getTrusteeList(this)">
                                @foreach($district_names as $key => $district)
                                <option value="{{$district->id}}" {{($district->id == $form->zipcode ? 'selected': '')}} data-short-name="{{$district->short_name}}">(ID: {{$district->id}}) {{$district->district_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group chapter_type">
                            <label>Chapter</label>
                            <select value="{{ old('chapter_type') }}" name="chapter_type" class="required form-control">
                                <option <?php echo 7 == $form->chapter_type ? 'selected' : ''; ?> value="7">Chapter 7</option>
                                <option <?php echo 13 == $form->chapter_type ? 'selected' : ''; ?> value="13">Chapter 13</option>
                            </select>
                        </div>

                        <div class="trustee" style="display: none;" id="trustee-list-edit">
                            @include('admin.forms.trustee_list', ['selected_item' => $form->trustee])
                        </div>

                        <a href="{{route('admin_forms_index')}}" class="btn btn-theme-black">Back</a>
                        <button type="submit" class="btn btn-theme-black">Submit</button>
                        <br><br>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--[ Recent Users ] end-->
</div>
<script>
    $(document).ready(function() {
        let districtSelect = document.querySelector('select[name="zipcode"]');
        if (districtSelect && districtSelect.options.length > 0) {
            $('.trustee').show();
            getTrusteeList(districtSelect);
        }

        $('.form_type').change(function() {
            var type = $(this).val();
            if (type == "local") {
                $('.district_group, .chapter_type, .trustee').show();
            } else {
                $('.district_group, .chapter_type, .trustee').hide();
            }
        });
    });

    async function getTrusteeList(selectElement) {
        // Get the selected option
        let selectedOption = selectElement.options[selectElement.selectedIndex];

        // Get the data-short-name from the selected option
        let state = selectedOption.getAttribute('data-short-name');

        let url = "{{route('get_trustee_list_for_form')}}";

        selected_item = "{{ $form->trustee }}";

        try {
            const response = await $.ajax({
                url: url,
                type: 'POST',
                data: {
                    'state': state,
                    'selected_item': selected_item
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            if (response.status) {
                $('.trustee').show();
                if (response.html) {
                    $(`#trustee-list-edit`).html(response.html);
                } else {
                    $('#trustee-list-edit').html('<p class="text-muted">No trustee data found for the selected district.</p>');
                }
            }
        } catch (xhr) {
            console.error(xhr.responseText);
        }
    }
</script>
<!-- [ Main Content ] end -->
@endsection