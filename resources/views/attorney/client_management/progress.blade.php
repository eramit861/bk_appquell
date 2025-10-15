<div class="info-section">
    <div class="info-section-title"><span onclick="event.stopPropagation();">Completeness</span></div>

    <div class="progress-item" onclick="event.stopPropagation();">
        <small>Questionnaire:</small>
        <div class="progress-bar-custom">
            <div class="progress-fill progress-complete" style="width: {{ $client_percent[$val['id']]['all_percentage'] }}%"></div>
        </div>
        <small>{{ $client_percent[$val['id']]['all_percentage'] }}%</small>
    </div> 
    <div class="progress-item" onclick="event.stopPropagation();">
        <small>Documents:&nbsp;&nbsp;&nbsp;&nbsp;</small>
        <div class="progress-bar-custom">
            <div class="progress-fill progress-partial" 
                 style="width: {{ $documentProgress['progress'] }}%"></div>
        </div>
        <small>{{ $documentProgress['progress'] }}%</small>
    </div>
</div>