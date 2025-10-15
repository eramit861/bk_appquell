<div class="container text-center mb-4">
    
         <div class="row">
        <div class="col-md-6 mt-4 text-left">
            <h4>List of creditors fetched from uploaded document</h4>
        </div>
         <div class="col-md-6 mt-4 text-right">
         <?php if (!empty($creditorData) && is_array($creditorData)) {?>
            <a href="javascript:void(0)" class="btn font-weight-bold border-blue-big f-12" onclick="setupCinReport('<?php echo $client_id; ?>','<?php echo $refrenceId; ?>')">Save to creditor list</a>
            <?php } ?>
        </div>
           <div class="col-md-12 mt-4">
 

    <?php
    if (!empty($creditorData) && is_array($creditorData)) {
        ?>
        <div class="table-responsive">

        <table class="table table-hover">
            <thead>
        <tr>
            <th>Creditor Name</th>
            <th>Account number</th>
            <th>account type</th>
            <th>Amount Own</th>
            <th>Date Incurred</th>
            <th>Address</th>
        </tr>
    </thead>
            <?php
            foreach ($creditorData as $credit) {
                ?>
            <tr>
                <td>{{$credit['creditor_name']}}</td>
                <td>{{$credit['account_number']}}</td>
                <td>{{$credit['account_type']}}</td>
                <td>{{$credit['current_balance']}}</td>
                <td>{{$credit['date_opened']}}</td>
                <td>{{$credit['address']['attn']}}, {{$credit['address']['address']}}, {{$credit['address']['city']}}, {{$credit['address']['state']}} <?php echo @$credit['address']['zipCode']; ?> <?php @$credit['address']['zip']; ?></td>
            </tr>
            <?php } ?>
        </table>
        </div>  
        <?php
    }

         ?>

    <?php  ?>
   
   

           </div>  
              
    </div>               
</div>

<style>
    .popup{
        width: 1250px;
    }
    #facebox .content.fbminwidth {
    min-width: 1250px;
    min-height: 150px;
    }
</style>

<script>
setupCinReport = function(client_id,refrence_id) {
		var url = "<?php echo route('cin_report_save'); ?>";
		laws.ajax(url, {client_id:client_id,refrence_id:refrence_id }, function (response) {
		if(isJson(response)){
		var res = JSON.parse(response);
            if (res.status == 0) {
				$.systemMessage(res.msg, 'alert--danger', true);
            }else if(res.status == 1){
				$.systemMessage(res.msg, 'alert--success', true);
				$.facebox.close();
                setTimeout(function () {
					location.reload();
					}, 2000);
			}
		} 
		});
	}
    </script>
	