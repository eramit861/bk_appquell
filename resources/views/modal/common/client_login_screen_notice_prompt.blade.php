<div class="modal fade" id="clientLoginNoticePromptModal" tabindex="-1" aria-labelledby="clientLoginNoticePromptModalLabel"
    aria-hidden="true">
    <div class="modal-dialog client-login-screen-notice">
        <div class="modal-content">
            <div class="modal-header">
                <div class="w-100">
                    <img width="300px" src="{{ asset('assets/img/bktextlogoblue.png') }}" alt="attorney-logo">
                    <p class="tagline">Seamless Experience Across All Devices</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="feature-section">
                    <div class="feature-title">
                        Works on Any Device
                    </div>

                    <div class="device-grid">
                        <div class="device-item">
                            <i class="bi bi-phone"></i>
                            <span>Mobile</span>
                        </div>
                        <div class="device-item">
                            <i class="bi bi-tablet"></i>
                            <span>Tablet</span>
                        </div>
                        <div class="device-item">
                            <i class="bi bi-laptop"></i>
                            <span>Laptop</span>
                        </div>
                        <div class="device-item">
                            <i class="bi bi-display"></i>
                            <span>Computer</span>
                        </div>
                    </div>
                </div>

                <div class="sync-feature">
                    <p class="sync-feature-text">
                        <i class="bi bi-arrow-repeat me-2"></i>
                        <strong>Seamless Continuity:</strong> You can initiate the process on any device and
                        effortlessly resume from another with the same email and password across all of them.
                    </p>
                </div>

                <div class="action-buttons">
                    <a href="#" class="btn-app" target="_blank">
                        <i class="bi bi-download btn-icon"></i>
                        Click here to get started using our App
                    </a>

                    <a href="{{ route('client_login') . '?web=1' }}" class="btn-website">
                        <i class="bi bi-globe btn-icon"></i>
                        Click here to get started using our Website
                    </a>
                </div>

                <div class="compatibility-note">
                    Your login credentials work across all platforms for a unified experience
                </div>
            </div>
        </div>
    </div>
</div>
