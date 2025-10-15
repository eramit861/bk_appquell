<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="card listing-card">
           
            <div class="card-block px-0 py-0">
                <form id="add_form" action="{{route('add_division_to_state',$state_code)}}" method="post">
                    @csrf
                    <div class="container">

                        <div class="form-group mt-3">
                            <h4 class="mb-3">Division Name</h4>
                            <input type="text"
                                class="form-control" required
                                placeholder="Enter New Division Name" name="division_name"
                                value="">
                          
                        </div>

                        
                        <div class="form-group">
                        <button type="submit" class="btn btn-theme-black">Save</button>
                        </div>
                    </div>
               
                </form>
            </div>
            <?php if (!empty($divisions)) {?>
            <div class="card-block">
                <h4>List of Divisions</h4>
                <table class="w-100">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="65%">Division Name</th>
                            <th width="30%">Id in Jubliee</th>
                        </tr>
                    </thead>
                    <?php $i = 1;
                foreach ($divisions as $division) { ?>
                    <tbody>
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$division['division_name']}}</td>
                            <td>
                                <div class="d-flex">
                                    <div class="w-100">
                                        <input type="text" class="form-control id-control" placeholder="" maxlength="3" pattern="^[0-9]{3}$" name="id_in_jubliee_{{$division['id']}}" value="<?php echo $division['id_in_jubliee'];?>">
                                    </div>
                                    <div class="pl-2 ">
                                        <i onclick="update_id_in_jubliee('<?php echo $division['id'];?>')" class="fas fa-check ml-1 pt-2 update"></i>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>

                    <?php $i++;
                } ?>
                </table>
            </div>
                <?php } ?>
        </div>
</div> 
</div>
<style>
         label.error {color: red;font-style: italic;  }
         th{
            border-top: 1px solid #eaeaea;
            border-bottom: 1px solid #eaeaea;
            color: #414141;
         }
         table thead {
            background-color: #EDEEF0;
        } 
        table thead th{
            padding: 5px 10px 5px 10px;
        }
        table tbody td{
            padding: 5px 10px 5px 10px;
        }
        table tbody td{
            border-top: 1px solid #eaeaea;
        }
        .id-control{
            padding: 3px 12px;
        }
        #facebox .content.fbminwidth {
            min-width: 550px;
            min-height: 400px;
        }
        .card .card-block, .card .card-body {
            padding: 30px 15px;
        }
        .update{
            color: #012cae;
            cursor: pointer;
        }
		</style>
		<script>
			$(document).ready(function(){
				
				$("#add_form").validate({
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
            update_id_in_jubliee = function(id){
                var url = "<?php echo route('update_id_in_jubliee'); ?>";
                var id_value = $("[name='id_in_jubliee_"+id+"']").val();
                laws.ajax(url, {id:id, id_value: id_value}, function(res) { 
                    var ans = $.parseJSON(res);
                    if (ans.status == 1) {
                        $.systemMessage(ans.msg, 'alert--success', true);
                    } else {
                        $.systemMessage(ans.msg, 'alert--danger', true);
                    }
                });
            }
		</script>