<div class="row">
    <!--[ Recent Users ] start-->
    <div class="col-xl-12 col-md-12">
        <div class="card listing-card">
            <div class="card-header">

            </div>
            <div class="card-block px-0 py-0">
                <form id="localadd_form" action="{{route('additional_form_update',$district_id)}}" method="post">
                    @csrf
                    <div class="container">

                        <div class="form-group">
                            <label>Additional local Form url</label>
                            <input type="url"
                                class="form-control" required
                                placeholder="Enter form url here" name="additional_form_url"
                                value="{{$additional_form_url}}">
                          
                        </div>

                        
                        <div class="form-group">
                        <button type="submit" class="btn btn-theme-black">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--[ Recent Users ] end-->
</div>
<style>
         label.error {color: red;font-style: italic;  }
		</style>
		<script>
			$(document).ready(function(){
				
				$("#localadd_form").validate({
					
					errorPlacement: function (error, element) {
						if($(element).parents(".form-group").next('label').hasClass('error')){
							
							$(element).parents(".form-group").next('label').remove();
							$(element).parents(".form-group").after($(error)[0].outerHTML);
						}else{
							
							$(element).parents(".form-group").after($(error)[0].outerHTML);
						}
					},
					success: function(label,element) {
						label.parent().removeClass('error');
						
						$(element).parents(".form-group").next('label').remove();
					},
				});
				});
		</script>