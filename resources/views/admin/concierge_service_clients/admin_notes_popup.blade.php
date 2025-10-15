<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="card listing-card">
           
            <div class="card-block px-0 py-0">
                <form id="add_form" action="{{route('admin_update_notes')}}" method="post">
                    @csrf
                    <div class="container">

                        <div class="form-group mt-3">
                            <h4 class="mb-3">My Notes</h4>
                            <textarea required rows="4" class="form-control" name="note" placeholder="Enter New Note"></textarea>
                            <input type="hidden" name="client_id" value="<?php echo $client_id;?>">
                        </div>

                        
                        <div class="form-group">
                        <button type="submit" class="btn btn-theme-black">Save</button>
                        </div>
                    </div>
               
                </form>
            </div>
            <div class="card-block">
                <h4>List of Notes</h4>
                <table class="w-100">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="65%">Note</th>
                            <th width="30%">Date</th>
                        </tr>
                    </thead>
                    <?php $i = 1;
                            foreach ($notes as $key => $data) { ?>
                    <tbody>
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$data['note']}}</td>
                            <td>{{DateTimeHelper::dbDateToDisplay($data['created_at'],true)}}</td>
                        </tr>
                    </tbody>
                    <?php $i++;
                            } ?>
                </table>
            </div>
        </div>
</div> 
</div>
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
</script>
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
min-width: 650px;
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
