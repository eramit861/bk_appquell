class DocumentManagementManager {
    constructor(config) {
        this.clientId = config.clientId;
        this.csrfToken = config.csrfToken;
        this.generateZipUrl = config.generateZipUrl;
        this.progressUrl = config.progressUrl;
        
        this.zippingInProgress = false;
        this.clientDocsReady = false;
        
        this.init();
    }

    init() {
        this.bindEvents();
    }

    bindEvents() {
        $('#generate-zip').click((e) => this.handleZipGeneration(e));
    }

    handleZipGeneration(e) {
        if (this.zippingInProgress) {
            return;
        }

        if (this.clientDocsReady) {
            this.clientDocsReady = false;
            $('#progress-bar').hide();
            return;
        }

        e.preventDefault();

        $('#progress-bar').css('width', '0%');
        $('#progress-bar').show();
        $('#zip-download-main-text').hide();
        $('#zip-download-progress-text').text("Preparing files (0%)").show();

        this.zippingInProgress = true;

        $.ajax({
            url: this.generateZipUrl,
            async: true,
            type: 'POST',
            data: {
                _token: this.csrfToken,
                client_id: this.clientId
            },
            success: (response) => {
                this.pollProgress(this.clientId, response.downloadLink);
            },
            error: (xhr) => {
                alert('Error: ' + xhr.responseJSON.error);
            },
        });
    }

    pollProgress(clientId, downloadLink) {
        let percentCompleted = 0;
        const MAX_ZIP_SECONDS = 1080; // 3 minutes
        let secondsPassed = 0;
        const intervalSeconds = 1.5;

        const interval = setInterval(() => {
            $.ajax({
                url: this.progressUrl,
                async: true,
                type: 'GET',
                data: { client_id: clientId },
                success: (progress) => {
                    secondsPassed += intervalSeconds;

                    // max time reached
                    if (secondsPassed > MAX_ZIP_SECONDS) {
                        clearInterval(interval);
                        $('#zip-download-progress-text').text("An error occurred.  Please contact support for assistance.");
                        return;
                    }

                    if(progress.current_file === 'empty docs'){
                        $('#generate-zip').prop('disabled', true);
                        clearInterval(interval);
                        $('#progress-bar').hide();
                        $('#zip-download-progress-text').text('No documents found for this client');
                        return;
                    }

                    // illusion of progress until threshold percent
                    const illusionThreshold = 95;
                    percentCompleted += this.randomIntFromRange(3, 15);
                    if (percentCompleted > illusionThreshold) {
                        percentCompleted = illusionThreshold;
                    }

                    if (progress.progress && progress.progress > illusionThreshold) {
                        percentCompleted = progress.progress;
                    }

                    $('#progress-bar').css('width', percentCompleted+'%');
                    $('#zip-download-progress-text').text('Preparing files ('+percentCompleted+'%)');
                    $('#generate-zip').prop('disabled', true);
                    
                    if (progress.progress == 100) {
                        clearInterval(interval);
                        
                        this.zippingInProgress = false;
                        this.clientDocsReady = true;
                        $('#generate-zip').prop('disabled', false);
                        
                        // set download link
                        $('#generate-zip').attr('href', '/'+progress.current_file);

                        setTimeout(() => {
                            $('#zip-download-progress-text').hide();
                            $('#zip-download-main-text').show();
                        }, 1000);
                    }
                },
                error: () => {
                    this.zippingInProgress = false;
                    clearInterval(interval);
                },
            });
        }, intervalSeconds * 1000); // Poll every intervalSeconds
    }

    randomIntFromRange(min, max) { // min and max included 
        return Math.floor(Math.random() * (max - min + 1) + min);
    }
}

// Initialize when document is ready
$(document).ready(function () {
    const documentManagementConfig = {
        clientId: window.documentManagementClientId,
        csrfToken: window.documentManagementCsrfToken,
        generateZipUrl: window.documentManagementGenerateZipUrl,
        progressUrl: window.documentManagementProgressUrl
    };

    window.documentManagementManager = new DocumentManagementManager(documentManagementConfig);
});

