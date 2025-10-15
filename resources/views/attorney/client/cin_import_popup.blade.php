<div class="modal-content modal-content-div conditional-ques">
    <div class="modal-header align-items-center py-2">
        <h5 class="modal-title d-flex w-100" id="invitemodalLabel">
        Import Annual Credit Report 
        </h5>
    </div>

    <form name="manual_upload_form" enctype="multipart/form-data" id="manual_upload_form" action="{{route('cin_report_upload')}}" method="post" novalidate>
        @csrf
        <input type="hidden" name="client_id" value="<?php echo $client_id;?>">

        <div class="light-gray-div mt-4 mx-3">
            <h2>CIN Report</h2>
            <div class="form-group ">    
                <div class="upload-area popup-upload-area ">
                    <div class="upload-area__header">
                        <h4 class="text-c-blue upload-area__title f-w-800 font-lg-22">Please Attach a file</h4>
                        <p class="upload-area__paragraph text-center">
                            <span class="text-c-blue">File should be in PDF.</span><br>
                        </p>
                    </div>
                    <div class="upload-area__drop-zoon drop-zoon">
                        <div class="doc-upload">
                            <span class="drop-zoon__icon">
                                <i class="fa fa-cloud-upload-alt"></i>
                            </span>
                            <div class="doc-edit">
                                <input type='file' required  class="" name="report_file" id="both-licence" accept=".pdf" />
                                <label for="driving-licence"><strong>Drag and/or Drop</strong><br>
                                </label>
                                <label id="drop_file_name" class="drop_file_name"></label>
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
    .popup{
        width: 850px;
    }
</style>

<script>
    $(document).ready(function() {
        $("#both-licence").on('change',function (data) {
            var imageFile = data.target.files[0];
            var type = data.target.files[0].type;
            var name = data.target.files[0].name;
            var reader = new FileReader();
            if (!name.toLowerCase().endsWith('.pdf')) {
                alert('The selected file is not a PDF file.');
                return;
            }
            reader.readAsDataURL(imageFile);
            reader.onload = function (evt) {
                $("#drop_file_name").html(name+" has been selected");
                $("#drop_file_name").show();           
            }
       });   
       $('select[name="software"]').on('change', function() {
            var inputValue = $(this).val();
            if (inputValue === '2') {
                $('.schedule-div').removeClass('d-none');
            }else{
                $('.schedule-div').addClass('d-none');
            }
        });   
    });
</script>