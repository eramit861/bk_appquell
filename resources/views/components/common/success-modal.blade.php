<?php
/**
 * Shared Success Modal Component
 * Usage:
 *   @include('components.common.success-modal', ['attorney_company' => $attorney_company ?? []])
 */
?>

<?php
    $attorneyUrl = Helper::validate_key_value('attorney_appointment_url', $attorney_company ?? []);
$attorneyPhone = Helper::validate_key_value('attorney_phone', $attorney_company ?? []);
?>

<!-- Bootstrap Modal HTML -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content p-4">
            <!-- Close Button -->
            <button type="button" class="btn-close ml-auto" data-bs-dismiss="modal" aria-label="Close"></button>

            <div class="text-center">
                <!-- Check Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#198754" class="bi bi-check-circle-fill mb-3" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </svg>

                <!-- Title -->
                <h4 class="modal-title" id="thankYouModalLabel">Thank You for Your Submission!</h4>

                <!-- Body Text -->
                <p class="fs-5">Your submission has been successfully received. Your attorney will review your information and get back to you shortly.</p>
                <p>If you'd like to schedule an appointment or discuss your case, please feel free to use the options below:</p>

                <!-- Buttons -->
                <div class="d-flex justify-content-center gap-3">
                    <?php if (!empty($attorneyUrl)) { ?>
                        <a href="<?php echo !empty($attorneyUrl) ? $attorneyUrl : 'javascript:void(0);'; ?>" target="_blank" class="btn btn-success btn-lg">Make an Appointment</a>
                    <?php } ?>
                    <a href="<?php echo !empty($attorneyPhone) ? 'tel:' . $attorneyPhone : 'javascript:void(0);'; ?>" class="btn btn-info btn-lg">Call Attorney <?php echo !empty($attorneyPhone) ? '(' . $attorneyPhone . ')' : ''; ?></a>
                </div>
            </div>
        </div>
    </div>
    </div>


