@extends("layouts.admin")
@section('content')
@include("layouts.flash")
<div class="row">
	<!--[ Recent Users ] start-->
	<div class="col-xl-12 col-md-12">
		<div class="card listing-card">
			<div class="card-header pb-0">
				<div class="search-list">
					<div class="col-md-12">
						<div class="row">
							<div class="p-0 m-0 col-md-12">
								<h4>Calendly Events</h4>
							</div>
                            <div class="col-md-12 p-0 m-0 tabnav">
                                
								<a href="{{route('getclendlywebhook','upcoming')}}" class="<?php if ($type == 'upcoming') {
								    echo "is_active";
								}?> btn border-blue font-weight-bold tab-new f-12">
									<span class="card-title-text">Upcoming Appointments</span>
								</a>
								<a href="{{route('getclendlywebhook','old')}}" class="<?php if ($type == 'old') {
								    echo "is_active";
								}?> btn border-blue font-weight-bold tab-progress f-12">
									<span class="card-title-text">Past Appointments</span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card-block px-0 py-0">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>

								<th>Client Id</th>
                                <th>Event Name / User Name / Email / Phone</th>
                                <th>Attorney</th>
                                <th>Event Details</th>
							</tr>
						</thead>
						<tbody>
						<?php



                        if (!empty($list)) {
                            $calendlyList = [];
                            foreach ($list as $webhok) {

                                $webhokcan = explode("T", $webhok['scheduled_event_end_time']);
                                $calendlyList[$webhokcan[0]][] = $webhok->toArray();
                            }
                            foreach ($calendlyList as $dateDay => $list) { ?>
                                <tr><th colspan='4'><?php echo date_format(date_create($dateDay), 'l jS \of F Y');?></th></tr>
                                <?php
                               foreach ($list as $val) {
                                   $eventName = str_replace('/', ' ', $val['scheduled_event_name'] ?? '');

                                   ?>
							<tr class="unread statuc_<?php echo $eventName; ?> status_{{$val['event_status']}} client-<?php echo $val['id']; ?>">
								<td>
                                    <?php if ($val['client_id'] > 0) { ?>
                                    <a href="{{route('attorney_form_submission_view',['id'=>$val['client_id']])}}">{{$val['client_id']}}</a>
                                    <?php } ?>
                                </td>
                                <td>{{$val['scheduled_event_name']}}<br>{{$val['user_name']}}<br>{{$val['user_email']}}<br>{{$val['phone_no']}}</td>
                                <td>{{$val['attorney_name']}}</td>
                                <td>{{$val['event_status']}} <br>
                                <?php if ($val['event_status'] == 'canceled') { ?> <strong>Reason:</strong> {{$val['cancel_reason']}}<br>
                                <strong>Cancel by:</strong> {{$val['canceled_by']}}<br>
                                <strong>Cancel on:</strong> <?php
                                   $cdate = explode("T", $val['cancel_created_at']);
                                    $ctime = explode(".", $cdate[1]);
                                    ?>{{DateTimeHelper::dbDateToDisplay($cdate[0])}} {{$ctime[0]}}<?php }?>
                                <?php if ($val['rescheduled'] == 1) {?> 
                                    <strong>Rescheduled:</strong> Yes<br>
                                    <strong>Reschedule Url:</strong> {{$val['reschedule_url']}}
                                <?php } ?>
                                <?php if ($val['event_status'] == 'active') {
                                    $sdate = explode("T", $val['scheduled_event_end_time']);
                                    $time = explode(".", $sdate[1]);

                                    $stdate = explode("T", $val['scheduled_event_start_time']);
                                    $sttime = explode(".", $stdate[1]);

                                    ?>
                                     <strong>Event start On: </strong>
                                      <?php  echo date('l jS \of F Y  h:i:s a', strtotime(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $stdate[0].' '.$sttime[0], 'UTC')->setTimezone('America/Los_Angeles'))); ?><br>
                                    
                                    <strong>Event end On: </strong>
                                    <?php  echo date('l jS \of F Y  h:i:s a', strtotime(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $sdate[0].' '.$time[0], 'UTC')->setTimezone('America/Los_Angeles'))); ?><br>

                                    <a target="_blank" href="{{$val['reschedule_url']}}">Click to Reschedule</a> <br>
                                    <a target="_blank" href="{{$val['cancel_url']}}">Click to Cancel</a> 
                                    <?php } ?>
                                </td>
                                
							</tr>
						<?php }
                               }
                        }?>
						</tbody>
					</table>
				</div>
				<div class="pagination px-2">
					<?php if (!empty($client)) {?>
					{{ $client->appends()->links() }}
					<?php }?>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
    .table-hover tbody tr.status_canceled:hover{
        background-color:red;
        color:#fff!important;
    }
    .table-hover tbody tr.statuc_Consultation:hover,.table-hover tbody tr.statuc_Consultation:hover td,.table-hover tbody tr.statuc_Consultation:hover a{
        background-color:rgb(23, 232, 133) !important;
        color:#000!important;
    }
    .statuc_Consultation, .statuc_Consultation td, .statuc_Consultation a{
        color:#000!important;
        background-color:rgb(23, 232, 133) !important;
    }
    .table-hover tbody tr.statuc_Final:hover{
        background-color:#012cae !important;
        color:#fff!important;
    }
    .statuc_Final{
        background-color:#012cae !important;
    }
    .table-hover tbody tr.statuc_Client:hover,.table-hover tbody tr.statuc_Client:hover td,
    .table-hover tbody tr.statuc_Questionnaire:hover,.table-hover tbody tr.statuc_Questionnaire:hover td
    {
        background-color:royalblue;
        color:#fff!important;
    }
   tr td,tr td a{color:#fff !important;}
   tr td a{text-decoration:underline;font-weight:bold;}
    tr.status_canceled{
        background-color:red;
        color:#fff!important;
    }
    tr.statuc_Client,tr.statuc_Client td,tr.statuc_Client td a,
    tr.statuc_Questionnaire,tr.statuc_Questionnaire td,tr.statuc_Questionnaire td a
    {
        background-color:royalblue;
        color:#fff !important;
    }
    .table-hover tbody tr.statuc_Attorney:hover,.table-hover tbody tr.statuc_Attorney:hover td
    {
        background-color:green;
        color:#fff!important;
    }
    tr.statuc_Attorney,tr.statuc_Attorney td,tr.statuc_Attorney td a
    {
        background-color:green;
        color:#fff !important;
    }
    .statuc_Process{
        background-color:#454545 !important;
		color:#fff!important;
    }
	tr.statuc_Process td,tr.statuc_Process td span.color-premium-plus,tr.statuc_Process td span>strong>a,tr.statuc_Process td i.fas{
		color:#fff!important;
    }
    
    </style>
@endsection
