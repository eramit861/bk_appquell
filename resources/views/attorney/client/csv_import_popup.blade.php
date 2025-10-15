<div class="modal-content modal-content-div conditional-ques">
    <div class="modal-header align-items-center py-2">
        <h5 class="modal-title d-flex w-100" id="invitemodalLabel">
            Import CSV
        </h5>
    </div>

    <form name="manual_upload_form" enctype="multipart/form-data" id="manual_upload_form" action="{{route('csv_import_save')}}" method="post" novalidate>
        @csrf
        <input type="hidden" name="client_id" value="<?php echo $client_id; ?>">
        <div class="light-gray-div mt-4 mx-3 ">
            <h2>CSV details</h2>
            <div class="row gx-3">
                <div class="col-12">
                    <div class="label-div">
                        <div class="form-group mb-0">
                            <label class="">CSV Source</label>
                            <select class="form-control" name="software">
                                <option value="" selected disabled hidden>Choose CSV Source</option>
                                <option value="1">Jubliee Pro</option>
                                <option value="2">Best Case</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-12 schedule-div d-none">
                    <div class="label-div">
                        <div class="form-group mb-0">
                            <label class="">Schedule</label>
                            <select class="form-control" name="schedule">
                                <option value="" selected disabled hidden>Select Schedule</option>
                                <option value="d">Schedule-D</option>
                                <option value="f">Schedule-F</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group my-3">
                <div class="background_img upload-area popup-upload-area">
                    <div class="upload-area__header desktop w-90" style="left: unset;">
                        <h4 class="text-c-white upload-area__title f-w-500 font-lg-20">CLICK HERE TO SELECT CSV FILE TO UPLOAD <br>OR
                            <br>DRAG/DROP YOUR CSV FILE HERE
                        </h4>
                    </div>
                    <div class="upload-area__header mobile" style="left: 0;">
                        <h4 class="text-c-white upload-area__title f-w-500 font-lg-20">CLICK HERE TO SELECT CSV FILE TO UPLOAD OR DRAG/DROP YOUR CSV FILE HERE</h4>
                    </div>
                    <div class="upload-area__footer w-90" style="left: unset;">
                        <p class="upload-area__paragraph text-center">
                            <span class="font-weight-normal text-c-white text-center font-lg-18 selected_file_name" id="selected_file_name"></span>
                        </p>
                    </div>  
                    <div class=" drop-zoon">
                        <div class="doc-upload">
                            <div class="doc-edit">
                                <input type='file' required class="csv-file-className" name="document_file[]" id="both-licence" accept=".csv" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="bottom-btn-div mx-3 mb-3 w-auto">
            <button type="submit" class="btn font-weight-bold border-blue-big m-0 btn-new-ui-default"><span class="">Submit</span></button>
        </div>
    </form>


</div>



<style>
    .popup {
        width: 850px;
    }

    .background_img {
        position: relative;
        background-image: url("<?php echo asset('assets/img/big_doc_link.jpg') ?>");
        background-repeat: no-repeat;
        background-size: 100% 100%;
        border-radius: 5px;
        min-height: 300px;
    }
</style>

<script>
    $(document).ready(function() {
        $(".csv-file-className").on('change', function(data) {
            var imageFile = data.target.files[0];
            var type = data.target.files[0].type;
            var name = data.target.files[0].name;
            
            var reader = new FileReader();
            if (!name.toLowerCase().endsWith('.csv')) {
                alert('The selected file is not a CSV file.');
                return;
            }
            reader.readAsDataURL(imageFile);
            reader.onload = function(evt) {
                $("#selected_file_name").html(name + " has been selected");
                $("#selected_file_name").show();
            }
        });
        $('select[name="software"]').on('change', function() {
            var inputValue = $(this).val();
            if (inputValue === '2') {
                $('.schedule-div').removeClass('d-none');
            } else {
                $('.schedule-div').addClass('d-none');
            }
        });
    });
</script>