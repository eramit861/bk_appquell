@extends("layouts.admin")
@section('content')
@include("layouts.flash")
<div class="row">
	<!--[ Recent Users ] start-->
	<div class="col-xl-12 col-md-12">
		<div class="card listing-card" id="clientTabsContent">
			<div class="card-header">
				<div class="search-list">
					<div class="col-md-12">
						
						@include('admin.client_management.head')

						<!-- <div class="row">
							
							<div class="col-md-12 tabnav">
								


								
							</div>
						</div> -->
					</div>
				</div>
			</div>
			<div class="card-block px-0 py-0">
				<div class="card-body border-top-left-radius-none">
					<!-- Active Clients Tab -->
					<div class="tab-pane fade show active" id="active" role="tabpanel">
						@include('admin.client_management.list')
					</div>
					<div class="d-flex justify-content-between align-items-center px-2 paginationb" id="the_table">
						@if ($client->count())
						<div class="shoing">
							@if ($client->count())
							Showing {{ $client->firstItem() }} to {{ $client->lastItem() }} of {{ $client->total() }} entries
							@endif
						</div>
						<div>
							{{ $client->appends(['q' => $keyword])->links() }}
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
	.requested_access {
		background-color: #e4cacd;
		border-radius: 5px;
		border: 1px solid #f00;
		padding: 5px;
		font-weight: bold;
		color: #f00;
	}

	.requested_access:hover {
		color: #ff0000;
	}

	.unread-indicator {
		position: absolute;
		top: -4px;
		right: 2px;
		width: 11px;
		height: 11px;
		background-color: red;
		border-radius: 50%;
		border: 2px solid white;
	}

	.message-unread-indicator {
		position: absolute;
		top: -3px;
		left: 8px;
		width: 11px;
		height: 11px;
		background-color: red;
		border-radius: 50%;
		border: 2px solid white;
	}

	.table-hover tbody tr.status_canceled:hover {
		background-color: red;
		color: #fff !important;
	}

	.table-hover tbody tr.statuc_Consultation:hover,
	.table-hover tbody tr.statuc_Consultation:hover td {
		background-color: rgb(23, 232, 133) !important;
		color: #000 !important;
	}

	.statuc_Consultation,
	.statuc_Consultation td {
		color: #000 !important;
		background-color: rgb(23, 232, 133) !important;
	}

	.table-hover tbody tr.statuc_Final:hover,
	.table-hover tbody tr.statuc_Final:hover td span.color-premium-plus {
		background-color: #012cae !important;
		color: #fff !important;
	}

	.statuc_Final {
		background-color: #012cae !important;
		color: #fff !important;
	}

	tr.statuc_Final td,
	tr.statuc_Final td span.color-premium-plus,
	tr.statuc_Final td span>strong>a,
	tr.statuc_Final td i.fas {
		color: #fff !important;
	}

	.statuc_Process {
		background-color: #454545 !important;
		color: #fff !important;
	}



	tr.statuc_Process td,
	tr.statuc_Process td span.color-premium-plus,
	tr.statuc_Process td span>strong>a,
	tr.statuc_Process td i.fas,
	tr.statuc_Process td a {
		color: #fff !important;
	}

	.table-hover tbody tr.statuc_Client:hover,
	.table-hover tbody tr.statuc_Client:hover td,
	.table-hover tbody tr.statuc_Questionnaire:hover,
	.table-hover tbody tr.statuc_Questionnaire:hover td,
	.table-hover tbody tr.statuc_Client:hover td span.color-ultimate {
		background-color: royalblue;
		color: #fff !important;
	}

	tr.statuc_Client a,
	tr.statuc_Final .text-c-green,
	tr.statuc_Final a,
	tr.statuc_concierge_service_done a,
	tr.statuc_concierge_service_done .text-c-green,
	tr.statuc_Client .text-c-green {
		color: #fff !important;
	}

	tr.statuc_Client a.link-unerline,
	tr.statuc_Final a.link-unerline,
	tr.statuc_concierge_service_done a.link-unerline {
		border: 1px solid #fff;
	}

	tr td a {
		text-decoration: underline;
	}

	tr.status_canceled {
		background-color: red;
		color: #fff !important;
	}

	tr.statuc_Client,
	tr.statuc_Client td,
	tr.statuc_Questionnaire,
	tr.statuc_Questionnaire td,
	tr.statuc_Client td span.color-ultimate {
		background-color: royalblue;
		color: #fff !important;
	}

	.status-done {
		color: #fff;
		font-weight: bold;
		background-color: #008000;
		border: 1px solid #008000;
		border-radius: 5px;
		padding: 5px;
	}

	.status-done-imp {
		color: #fff;
		background-color: #008000 !important;
		border: 1px solid #008000 !important;
	}

	.status-queue-imp {
		color: #fff;
		background-color: #00bf00 !important;
		border: 1px solid #00bf00 !important;
	}

	.tab-new {
		border: 2px solid #012cae;
		color: #012cae;
		background-color: #c9d1f2;
	}

	.is_active.tab-new {
		border: 2px solid #012cae;
	}

	.tab-progress {
		border: 2px solid #ffcb00;
		color: #ffcb00;
		background-color: #fffbee;
	}

	.is_active.tab-progress {
		border: 2px solid #ffcb00;
		background-color: #ffcb00;
	}

	.hover-black:hover {
		color: #000;
	}

	.tab-progress:hover {
		color: #ffcb00;
	}

	.is_active.tab-progress:hover {
		color: #fff;
	}

	.tab-done {
		border: 2px solid #008000;
		color: #008000;
		background-color: #c9f2c9;
	}

	.tab-done:hover {
		color: #008000;
	}

	.tab-queue {
		border: 2px solid #00bf00;
		color: #00bf00;
		background-color: #c9f2c9;
	}

	.tab-queue:hover {
		color: #00bf00;
	}

	.status-queue-imp.tab-queue:hover {
		color: #fff;
	}

	.tab-waiting {

		border: 2px solid #f00;
		color: #f00;
		background-color: #e4cacd;
	}

	.is_active.tab-waiting {
		border: 2px solid #f00;
		color: #fff;
		background-color: #FF0066;
	}

	.tab-waiting:hover {
		color: #fff;
	}

	.is_active.tab-done:hover {
		color: #fff;
	}

	.pending {
		color: #ffcb00;
		font-weight: bold;
		background-color: #fffbee;
		border: 1px solid #ffcb00;
		border-radius: 5px;
		padding: 5px;
	}


	.link-unerline {
		background-color: #c9f2c9;
		border-radius: 5px;
		border: 1px solid #008000;
		padding: 5px;
		font-weight: bold;
	}

	.link-unerline-notes {
		background-color: #c9d1f2;
		border-radius: 5px;
		border: 1px solid #004480;
		padding: 5px;
		font-weight: bold;
	}

	.notes_btn {
		color: #012cae;
		text-decoration: none;
		-webkit-text-decoration-skip: objects;
	}

	.activate_btn {
		color: #008000;
		text-decoration: none;
		-webkit-text-decoration-skip: objects;
	}

	.activate_btn:hover {
		color: #05ae05;
		border: 1px solid #05ae05;
	}

	.link-unerline-new {
		background-color: #3e5bb5;
		border-radius: 5px;
		border: 1px solid #012cae;
		padding: 2px 5px;
		font-weight: bold;
		color: white;
	}

	.link-unerline-new:hover {
		color: white;
	}

	span.noti_count {
		position: absolute;
		top: -20px;
		background: red;
		width: auto;
		height: 21px;
		line-height: 20px;
		border-radius: 25px;

		padding-left: 5px;
		font-weight: normal;
		color: #fff;
		padding-right: 5px;
		font-size: 10px;
	}

	@keyframes blink {
		0% {
			opacity: 1;
		}

		50% {
			opacity: 0;
		}

		100% {
			opacity: 1;
		}
	}

	.blinking-text {
		text-align: center;
		margin-top: 20%;
		color: red;
		animation: blink 1s infinite;
	}

	.event_list .color-standard {
		color: #989898 !important;
	}

	.event_list {
		background-color: #eaefff !important;
	}

	@media screen and (max-width:1440px) {

		.table td,
		.table th {
			padding: 0.7rem 0.2rem;
		}
	}
</style>
<script>
	$(document).ready(function() {
		$("#selectAttorneyOption").on("change", function() {
			$("#searchForm").submit();
		});

		const jsonClientData = <?php echo json_encode($jsonClientData); ?>;
		const clientIds = <?php echo json_encode($clientIds); ?>;

		let classesNoConsider = [];

		if (jsonClientData) {
			$.each(jsonClientData, function(className, html) {
				$.each(clientIds, function(index, clientid) {
					if (className === 'client-' + clientid ||
						className === 'clandely_msg-' + clientid ||
						className === 'event_color_class-' + clientid) {
						if (className === 'clandely_msg-' + clientid) {
							$('.' + className).html(html);
						} else {
							$('.' + className).addClass(html);
						}

						classesNoConsider.push(className);
					}
				});

				if (className === 'unreadMsg' && html !== '') {
					$('.calendy_noti_count').removeClass('hide-data');
					$('.calendy_noti_count').html(html);
				}
				if (!classesNoConsider.includes(className) && className !== 'unreadMsg') {
					$('.' + className).html(html);
				}
			});
		}

		document.querySelectorAll('#clientTabsContent .client-card *').forEach(el => {
			const onclickCode = el.getAttribute('onclick');
			if (onclickCode && onclickCode.includes('stopPropagation')) {
				el.classList.add('stop-prop-cursor');
			}
		});
	});

	conciergeServiceStatus = function(client_id, attorney_id, url) {
		if (!confirm("Are you sure you want to mark it done?")) {
			return;
		}
		laws.ajax(url, {
			client_id: client_id,
			attorney_id: attorney_id
		}, function(response) {
			var res = JSON.parse(response);
			if (res.status == 0) {
				$.systemMessage(res.msg, 'alert--danger', true);
			} else {
				$.systemMessage(res.msg, 'alert--success', true);
				$(".activate-btn-" + client_id).addClass('hide-data');
				$(".done-btn-" + client_id).removeClass('hide-data');
				setTimeout(function() {
					location.reload();
				}, 2000);
			}
		});
	};
	conciergeServiceInprogress = function(client_id, attorney_id, url) {
		if (!confirm("Are you sure you want to mark it in progress?")) {
			return;
		}
		laws.ajax(url, {
			client_id: client_id,
			attorney_id: attorney_id
		}, function(response) {
			var res = JSON.parse(response);
			if (res.status == 0) {
				$.systemMessage(res.msg, 'alert--danger', true);
			} else {
				$.systemMessage(res.msg, 'alert--success', true);
				location.reload();
			}
		});
	};


	function toggleToQueue(clientId, attId, ClientName, prevStatus) {
		if (prevStatus == 1) {
			showConfirmation("Are you sure you want to remove " + ClientName + " to queue?", function(confirmed) {
				if (confirmed) {
					addRemoveClientFromQueue(clientId, attId, 0)
				}
			});
		} else {
			showConfirmation("Are you sure you want to move " + ClientName + " to queue?", function(confirmed) {
				if (confirmed) {
					addRemoveClientFromQueue(clientId, attId, 1)
				}
			});
		}
	}

	addRemoveClientFromQueue = function(client_id, att_id, status) {
		var url = '<?php echo route('add_remove_client_from_queue'); ?>';
		laws.ajax(url, {
			client_id: client_id,
			att_id: att_id,
			status: status
		}, function(response) {
			var res = JSON.parse(response);
			if (res.status == 0) {
				$.systemMessage(res.msg, 'alert--danger', true);
			} else {
				$.systemMessage(res.msg, 'alert--success', true);
				setTimeout(function() {
					location.reload();
				}, 2000);
			}
		});
	};



	function toggleConciergeNotification(clientId, attId, ClientName, prevStatus) {
		if (prevStatus == 1) {
			showConfirmation("Are you sure you want to enable Concierge emails for " + ClientName + " ?", function(confirmed) {
				if (confirmed) {
					disableConciergeNotification(clientId, attId, 0)
				}
			});
		} else {
			showConfirmation("Are you sure you want to disable Concierge emails for " + ClientName + " ?", function(confirmed) {
				if (confirmed) {
					disableConciergeNotification(clientId, attId, 1)
				}
			});
		}
	}

	disableConciergeNotification = function(client_id, att_id, status) {
		var url = '<?php echo route('disable_client_concierge_mail'); ?>';
		laws.ajax(url, {
			client_id: client_id,
			att_id: att_id,
			status: status
		}, function(response) {
			var res = JSON.parse(response);
			if (res.status == 0) {
				$.systemMessage(res.msg, 'alert--danger', true);
			} else {
				$.systemMessage(res.msg, 'alert--success', true);
				setTimeout(function() {
					location.reload();
				}, 2000);
			}
		});
	};

	openNotesPopup = function(client_id) {
		var district = client_id;
		ajaxurl = "<?php echo route('notes_popup'); ?>";
		laws.ajax(ajaxurl, {
			client_id: client_id
		}, function(response) {
			laws.updateFaceboxContent(response, 'large-fb-width  p-0');
		});
	}

	openEditRequestPopup = function(client_id) {
		ajaxurl = "<?php echo route('edit_request_popup'); ?>";
		laws.ajax(ajaxurl, {
			client_id: client_id
		}, function(response) {
			laws.updateFaceboxContent(response, 'large-fb-width  p-0');
		});
	}

	openAdminNotesPopup = function(client_id) {
		var district = client_id;
		ajaxurl = "<?php echo route('admin_notes_popup'); ?>";
		laws.ajax(ajaxurl, {
			client_id: client_id
		}, function(response) {
			laws.updateFaceboxContent(response, 'large-fb-width  p-0');
		});
	}
	openDocumentsPopup = function(client_id) {
		var district = client_id;
		ajaxurl = "<?php echo route('documents_popup'); ?>";
		laws.ajax(ajaxurl, {
			client_id: client_id
		}, function(response) {
			laws.updateFaceboxContent(response, 'large-fb-width  p-0');
		});
	}

	getSimpleTextMessages = function(client_id) {

		$.systemMessage(langLbl.processing, 'alert--process', true);
		var district = client_id;
		ajaxurl = "<?php echo route('admin_simpletext_messages'); ?>";
		laws.ajax(ajaxurl, {
			client_id: client_id
		}, function(response) {
			$.systemMessage.close();
			$('.message-indicator-' + client_id).remove();
			laws.updateFaceboxContent(response, 'large-fb-width p-0');
		});
	}

	showSubscriptionAddon = function(client_id) {
		var divHtml = $(".subscription-addon-" + client_id).html();
		if (divHtml !== '') {
			laws.updateFaceboxContent(divHtml, 'subscription-addon large-fb-width p-0 bg-unset');
		}

	}

	function redirectToURL(url) {
		$('#page_loader').show();
		window.location.href = url;
	}
</script>
@endsection