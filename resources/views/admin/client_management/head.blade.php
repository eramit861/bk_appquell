<div class="header-section">
    <h1 class="page-title">Concierge Service Clients</h1>
</div>

<div class="filter-section design-csc">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex flex-wrap">
                <button class="btn status-filter-btn btn-new <?php echo ($type == '2') ? 'active' : ''; ?>"
                    onclick="redirectToURL('{{route('admin_concierge_service_list',[$attorneyWise, '2'])}}')">
                    <i class="bi bi-plus-circle-fill mr-1"></i>New
                </button>
                <button class="btn status-filter-btn btn-progress <?php echo ($type == '0') ? 'active' : ''; ?>"
                    onclick="redirectToURL('{{route('admin_concierge_service_list',[$attorneyWise, '0'])}}')">
                    <i class="bi bi-hourglass-split mr-1"></i>In Progress
                </button>
                <button class="btn status-filter-btn btn-done <?php echo ($type == '1') ? 'active' : ''; ?>"
                    onclick="redirectToURL('{{route('admin_concierge_service_list',[$attorneyWise, '1'])}}')">
                    <i class="bi bi-check-circle-fill mr-1"></i>Done
                </button>
                <button class="btn status-filter-btn btn-archived <?php echo ($type == '6') ? 'active' : ''; ?>"
                    onclick="redirectToURL('{{route('admin_concierge_service_list',[$attorneyWise, '6'])}}')">
                    <i class="bi bi-archive-fill mr-1"></i>Archived
                </button>
                <button class="btn status-filter-btn btn-attention <?php echo ($type == '3') ? 'active' : ''; ?>"
                    onclick="redirectToURL('{{route('admin_concierge_service_list',[$attorneyWise, '3'])}}')">
                    <i class="bi bi-exclamation-triangle-fill mr-1"></i>Client Needs Attention
                    <?php if (isset($attentionClientCount)) {
                        echo '<span class="badge-count">' . $attentionClientCount . '</span>';
                    } ?>
                </button>
                <button class="btn status-filter-btn btn-calendar"
                    onclick="redirectToURL('{{route('getclendlywebhook')}}')"
                    style="position: unset !important;">
                    <i class="bi bi-calendar-event-fill mr-1"></i>Calendly Events
                    <span class="badge-count calendy_noti_count hide-data"></span>
                </button>
                <button class="btn status-filter-btn btn-queue <?php echo ($type == '4') ? 'active' : ''; ?>"
                    onclick="redirectToURL('{{route('admin_concierge_service_list',[$attorneyWise, '4'])}}')">
                    <i class="bi bi-list-ul mr-1"></i>Queue
                    <?php if (isset($attentionClientCount)) {
                        echo '<span class="badge-count">' . $queueClientCount . '</span>';
                    } ?>
                </button>
                <button class="btn status-filter-btn btn-document <?php echo ($type == '5') ? 'active' : ''; ?>"
                    onclick="redirectToURL('{{route('admin_concierge_service_list',[$attorneyWise, '5'])}}')">
                    <i class="bi bi-file-earmark-text-fill mr-1"></i>New Document Received
                    <?php if (isset($isAnyClientWithNewDoc)) {
                        echo '<span class="badge-count">' . $isAnyClientWithNewDoc . '</span>';
                    } ?>
                </button>
                <button class="btn status-filter-btn btn-messages <?php echo ($type == '7') ? 'active ' . ((isset($unreadMessageCount) && $unreadMessageCount == 0) ? 'status-queue-imp ' : '') : ''; ?>  <?php echo (isset($unreadMessageCount) && $unreadMessageCount > 0) ? 'tab-waiting' : ((isset($unreadMessageCount) && $unreadMessageCount == 0) ? 'tab-queue' : ''); ?>"
                    onclick="redirectToURL('{{route('admin_concierge_service_list',[$attorneyWise, '7'])}}')">
                    <i class="bi bi-chat-dots-fill mr-1"></i>New Text Messages
                    <?php if (isset($unreadMessageCount)) {
                        echo '<span class="badge-count">' . $unreadMessageCount . '</span>';
                    } ?>
                </button>
                <button class="btn status-filter-btn btn-filed <?php echo ($type == '8') ? 'active' : ''; ?>"
                    onclick="redirectToURL('{{route('admin_concierge_service_list',[$attorneyWise, '8'])}}')">
                    <i class="bi bi-folder-check mr-1"></i>Filed Cases
                    <?php if (isset($fileCaseCount)) {
                        echo '<span class="badge-count">' . $fileCaseCount . '</span>';
                    } ?>
                </button>
            </div>
        </div>
    </div>

    <div class="search-section">
        <form id="searchForm" action="{{route('admin_concierge_service_list', [$attorneyWise, $type])}}" method="GET">
            <div class="row">
                <div class="col-md-4">
                    <label class="filter-label">
                        <i class="bi bi-person mr-2"></i>Attorney
                    </label>

                    <?php if (!empty($attorney)) { ?>
                        <select class="form-select w-100" id="selectAttorneyOption" name="attorney_wise" style="padding: 15px 1rem;">
                            <option value="all">All Attorney</option>
                            <?php foreach ($attorney as $data) { ?>
                                <option value="<?php echo $data['id']; ?>" <?php echo ($attorneyWise == $data['id']) ? 'selected' : ''; ?>><?php echo $data['name']; ?></option>
                            <?php } ?>
                        </select>
                    <?php } ?>
                </div>
                <div class="col-md-6">
                    <label class="filter-label">
                        <i class="bi bi-search mr-2"></i>Search Clients
                    </label>
                    <input type="text" name="q" class="form-control" value="{{@$keyword}}" placeholder="Search by id, name, email, or phone number...">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-search w-100">
                        <i class="bi bi-search mr-2"></i>Search
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>