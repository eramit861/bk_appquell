<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" style="border: none; border-radius: 12px; box-shadow: 0 10px 40px rgba(0,0,0,0.15);">
            <!-- Header Section with Blue Background -->
            <div class="modal-header"
                style="background: linear-gradient(135deg, #6494ed 0%, #4a7bd8 100%); border-radius: 12px 12px 0 0; border: none; padding: 2rem; position: relative;">
                <!-- Close Button -->
                <button type="button" class="btn-close btn-close-white position-absolute"
                    style="top: 1rem; right: 1rem; z-index: 10;" data-bs-dismiss="modal" aria-label="Close"></button>

                <div class="text-center w-100">
                    <!-- Success Icon with Animation -->
                    <div class="mb-3">
                        <div
                            style="width: 80px; height: 80px; background: rgba(255,255,255,0.2); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; backdrop-filter: blur(10px);">
                            <i class="bi bi-check-circle-fill text-white" style="font-size: 2.5rem;"></i>
                        </div>
                    </div>
                    <!-- Title -->
                    <h3 class="modal-title text-white mb-2" id="successModalLabel" style="font-weight: 600;">
                        Submission Successful!
                    </h3>
                    <p class="text-white" style="opacity: 0.9; font-size: 1.1rem; margin: 0;">
                        Thank you for providing your information
                    </p>
                </div>
            </div>

            <!-- Body Section -->
            <div class="modal-body" style="padding: 2rem;">
                <!-- Status Message -->
                <div class="text-center mb-4">
                    <div class="alert"
                        style="background: #e8f5e8; border: 1px solid #c3e6c3; border-radius: 8px; padding: 1rem;">
                        <div style="display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                            <i class="bi bi-check-circle text-success" style="font-size: 1.25rem;"></i>
                            <strong style="color: #28a745;">Your information has been received</strong>
                        </div>
                    </div>
                </div>

                <!-- Information Text -->
                <div class="text-center mb-4">
                    <p style="color: #6c757d; font-size: 1rem; line-height: 1.6; margin-bottom: 1rem;">
                        Your submission has been successfully sent to the law firm. One of our staff will reach out to
                        you shortly to discuss your financial situation and how we can help.
                    </p>

                    @if ($attorney->id == 55026)
                    <div class="mb-4 d-flex justify-content-center">
                        <div class="ratio ratio-16x9" style="border-radius: 8px; overflow: hidden; max-width: 80%;">
                            <iframe width="1316" height="740" src="https://www.youtube.com/embed/JXzM7UOMOaE"
                                title="Bill Collectors Lie (duh)" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                    </div>
                    @endif

                    <p style="color: #495057; font-size: 0.95rem; margin-bottom: 0;">
                        <strong>Need immediate assistance?</strong> Use the options below to connect with us:
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="row g-3">
                    <?php if (!empty($attorneyUrl)) { ?>
                    <div class="col-md-6">
                        <a href="<?php echo !empty($attorneyUrl) ? $attorneyUrl : 'javascript:void(0);'; ?>" target="_blank"
                            class="btn w-100 d-flex align-items-center justify-content-center gap-2"
                            style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); 
                                      border: none; 
                                      padding: 0.875rem 1.5rem; 
                                      border-radius: 8px; 
                                      color: white; 
                                      font-weight: 500; 
                                      text-decoration: none;
                                      transition: all 0.3s ease;
                                      box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);"
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 15px rgba(40, 167, 69, 0.4)';"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(40, 167, 69, 0.3)';">
                            <i class="bi bi-calendar-check" style="font-size: 1.125rem;"></i>
                            Schedule Appointment
                        </a>
                    </div>
                    <?php } ?>

                    <div class="<?php echo !empty($attorneyUrl) ? 'col-md-6' : 'col-12'; ?>">
                        <a href="<?php echo !empty($attorneyPhone) ? 'tel:' . $attorneyPhone : 'javascript:void(0);'; ?>"
                            class="btn w-100 d-flex align-items-center justify-content-center gap-2"
                            style="background: linear-gradient(135deg, #6494ed 0%, #4a7bd8 100%); 
                                      border: none; 
                                      padding: 0.875rem 1.5rem; 
                                      border-radius: 8px; 
                                      color: white; 
                                      font-weight: 500; 
                                      text-decoration: none;
                                      transition: all 0.3s ease;
                                      box-shadow: 0 2px 8px rgba(100, 148, 237, 0.3);"
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 15px rgba(100, 148, 237, 0.4)';"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(100, 148, 237, 0.3)';">
                            <i class="bi bi-telephone-fill" style="font-size: 1.125rem;"></i>
                            Call Attorney<?php echo !empty($attorneyPhone) ? ' (' . $attorneyPhone . ')' : ''; ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
