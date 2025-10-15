@extends("layouts.attorney")
@section('content')
@include("layouts.flash")
<div class="row">
	<?php
    $val = $User;
	?>
	<!--[ Recent Users ] start-->
	<div class="col-xl-12 col-md-12">
		<div class="card listing-card">
		@include("attorney.client.common",["video" => $video,'totals' => $totals, 'val' => $val, 'type' => $type])
			</div>
			<div class="questionnaire-main-title">

					<h3 class="text-c-blue f-w-800"> Upload Credit Report<small> {{ __('(File should be a PDF) (File size up to 5 MB)') }}</small></h3>
				</div>
			<div class="card-block px-0 py-0">
				<div class="container ">


			<form name="form-image" id="form-image" action="{{route('credit_report_uploads')}}" method="post" enctype="multipart/form-data" novalidate>
			@csrf
			<div class="modal-body">
				<div class="row">
				<div class="col-md-2"></div>
					<div class="col-md-8">
						<div class="upload-area" style="border:none;">
							<!-- Header -->
							<!-- End Header -->
							<!-- Drop Zoon -->
							<div class="upload-area__drop-zoon drop-zoon"  style="border:none;">
								<span class="drop-zoon__icon">
									<i class='fa fa-cloud-upload-alt'></i>
								</span>
								<div class="doc-upload">
									<div class="doc-edit">
											<input type="hidden" name="client_id" id="client_id" value="<?php echo $val['id']; ?>">
											<input type='file'  name="report_file" id="image-licence" accept=".pdf"/>
											<label for="driving-licence"><strong>{{ __('DRAG & DROP') }}</strong><br>{{ __('your files here to upload, or browse') }}</label>
											<label id="drop_file_name" class="drop_file_name"></label>
									</div>
								</div>
							</div>
							<div class="doc-preview hide_img_preview position-relative" id="img__preview__DL">
								<img id="image-licence-imagePreview" src=""
									alt="{{ __('User profile picture') }}">
								<span class="edit-img"><i class="feather icon-edit"></i></span>
							</div>
							<!-- End Drop Zoon -->
						</div>

					</div>

					<div class="col-md-2"></div>

					<div class="col-md-12 mt-4">
					<div class="questionnaire-main-title">
						<h5 class="text-c-blue f-w-800"> {{ __('Uploaded Files:') }}</h5>
					</div>
					</div>
					<div class="col-md-12">
					<ul class="grids--onefifth ui-sortable" id="sortable">
						<?php
	                    $i = 1;
	foreach ($uploadedFiles as $file) {?>
					<li id="" class="ui-sortable-handle">
						<div class="logoWrap">
							<?php 
								$fileUrl = '#';
								if (config('filesystems.disks.s3.bucket')) {
									try {
										$fileUrl = \Storage::disk('s3')->temporaryUrl($file['path'], now()->addDays(2));
									} catch (\Exception $e) {
										\Log::error('S3 temporaryUrl failed in creditform: ' . $e->getMessage());
										$fileUrl = '#';
									}
								}
							?>
							<a title="click here to download" target="_blank" href="<?php echo $fileUrl; ?>" download>
							<div class="logothumb">
								<img src="{{url('assets/img/pdf-icon.svg')}}" width="60" title="" alt="PDF Icon">
							</div>
							</a>
							<span class="fix_delete"><a onclick="confirmDeleteDoc(this)" href="javascript:void(0)" id="<?php  echo route('attorney_delete_credit_report', ['id' => $User->id, 'file_name' => $file['name']]); ?>"><i class="fas fa-trash fa-lg" data-bs-toggle="tooltip" title="" data-original-title="Delete"></i></a></span>
						</div>
						<p style="font-size:10px;width:100%;text-align:center;"><strong><?php echo $file['name']; ?></strong></p>

					</li>
					<?php $i++;
	} ?>

					</ul>
					</div>

					<div class="col-md-2"></div>
					<div class="col-md-8">
					<br>

					<div class="text-right">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
					<button type="submit" class="btn font-weight-bold border-blue-big">{{ __('Save changes') }}</button>
					</div>
					</div>
					<div class="col-md-2"></div>




				</div>


			</div>

			</form>

</div>
</div>
</div>
</div>
<style>

	.fix_delete{
   position: absolute;
   right: 10px;
   top: 10px;
}
	.file-title{position: absolute;
    bottom: 0px;
    left: 0;
    font-size: 10px;}
	.logothumb .deleteLink {
    width: 20px;
    text-align: center;
    line-height: 20px;
    height: 20px;
    position: absolute;
    right: 10px;
    top: 10px;
    background: rgba(0, 0, 0, 0.8);
    color: #fff;
    font-size: 0.8em;
    border-radius: 50%;
}
.upload-area{background-color: #EDEEF0;}
.grids--onefifth {
    margin: 20px 0 0 -30px;
    list-style: none;
}label#drop_file_name {
    position: absolute;
    top: 80px;
}
.doc-upload label{ bottom: -22px;}
.logothumb img {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    -webkit-transform: translate(-50%, -50%);
    max-width: 100%;
    max-height: 100%;
}
.logothumb {
    position: relative;
    width: 100%;
    height: auto;
    border: 1px solid rgba(0, 0, 0, 0.05);
    padding: 0 0 50%;
    display: block;
    text-align: center;
    vertical-align: middle;
    background: #f3f6f8;
    border-radius: 5px;
    margin: 0 0 10px 0;
}
.grids--onefifth li {
    width: 20%;
}
.logoWrap {
    margin: 10px 0 5px 0;
    position: relative;
}
.grids--onefifth li {
    display: inline-block;
    vertical-align: top;
    padding: 0 0 10px 30px;
    position: relative;
    margin: 0 -4px 0 0;
}
.drop_file_name{
      display: block;
      top: 130px;
      color: #012cae;
   }
</style>
<script>
	   jQuery(document).ready(function(){
   	$("#image-licence").on('change',function (data) {
           var imageFile = data.target.files[0];
   		var type = data.target.files[0].type;
   		var name = data.target.files[0].name;

           var reader = new FileReader();
           reader.readAsDataURL(imageFile);
           reader.onload = function (evt) {
   			$("#drop_file_name").html(name+" has been selected");
   			$("#drop_file_name").show();
           }
       });
       jQuery('.btn-ocr').on('click', function(){
           let filename = $(this).data('filename');
           let url = $(this).data('ocrurl')+"/debts/"+filename;

           $('#page_loader').show();
           $.post(url,function(response){
               $('#page_loader').hide();
               $("#ocr_output .ocr-content").html(JSON.stringify(response));
               $("#ocr_output").modal('show');
           });

       });
   });
	confirmDeleteDoc = function(sobj){
      var url = sobj.id;
      if (!confirm(langLbl.confirmDelete)) {
                return;
            }
            window.location = url;
   }
function file_upload_modal(client_id){
	$("#image_document_upload_modal").find("#client_id").val(client_id);
	$("#image_document_upload_modal").modal('show');
}
</script>
@endsection
