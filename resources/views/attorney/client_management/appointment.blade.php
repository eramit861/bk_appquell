<div>
    <!-- Appointment Details -->
    @if ($displayEvent || !empty($reminderTime) || !empty($reminderLocation))
        <div class="info-section-title"><span onclick="event.stopPropagation();">Recent Appointments</span></div>
    @endif
    
    <div class="appointment-details mt-0">
        <!-- <div class="clandely_msg clandely_msg-{{ $val['id'] }}">
            <div class="appointment-item">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <strong class="text-primary" onclick="event.stopPropagation();">Questionnaire Csdsadasoncierge Service</strong>
                </div>
                <small class="text-muted d-block" onclick="event.stopPropagation();">
                    <i class="fas fa-calendar me-1"></i>Saturday 20th of September 2dasdasdas025 12:30:00 pm - 01:48:00 pm
                </small>
            </div>
        </div> -->

        @if ($displayEvent)
            @if ($clendlyData['event_status'] == 'active')
                @php
                    $sdate = explode("T", $clendlyData['scheduled_event_end_time']);
                    $time = explode(".", $sdate[1]);

                    $stdate = explode("T", $clendlyData['scheduled_event_start_time']);
                    $sttime = explode(".", $stdate[1]);
                @endphp
                <div class="appointment-item">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <strong class="text-info" onclick="event.stopPropagation();">
                            {{ $clendlyData['scheduled_event_name'] }}
                        </strong>
                    </div>
                    <div>
                        <span class="fs-13px text-muted d-block mb-0" onclick="event.stopPropagation();">
                            <i class="fas fa-calendar me-1"></i>
                            {{ date('l jS \of F Y  h:i:s a', strtotime(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $stdate[0] . ' ' . $sttime[0], 'UTC')->setTimezone('America/Los_Angeles'))) }}
                            - {{ date(' h:i:s a', strtotime(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $sdate[0] . ' ' . $time[0], 'UTC')->setTimezone('America/Los_Angeles'))) }}
                        </span>
                    </div>
                </div>
            @endif
        @endif
        
        @if (!empty($reminderTime) || !empty($reminderLocation))
            <div class="appointment-item pb-0">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <strong class="text-reminder" onclick="event.stopPropagation();">Reminder</strong>
                </div>
            </div>
        @endif
        
        @if (!empty($reminderTime))
            <div class="appointment-item">
                <span class="fs-13px text-muted d-block mb-0" onclick="event.stopPropagation();">
                    <i class="fas fa-calendar me-1"></i> {{ $reminderTime }}
                </span>
            </div>
        @endif
        
        @if (!empty($reminderLocation))
            <div class="appointment-item">
                <span class="fs-13px text-muted d-block mb-0" onclick="event.stopPropagation();">
                    <i class="bi bi-geo-alt-fill me-1"></i> {{ $reminderLocation }}
                </span>
            </div>
        @endif
    </div>
</div>