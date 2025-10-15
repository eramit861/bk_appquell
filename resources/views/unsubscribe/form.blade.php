<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unsubscribe - BK Assistant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <style>
        :root {
            --bs-primary: #0B01AA;
            --bs-body-bg: #f9f9f9;
            --bs-body-color: #818181;
            --bs-card-color: #4a4a4a;
            --bs-white: #fff;
            --bs-black: #282828;
            --border-radius: 8px;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --light-gray-color: #f0eeee;
            --light-gray-border: #a9a9a9;
        }

        body {
            background: linear-gradient(135deg, #80acf3 0%, #1d4ed8 100%);
            min-height: 100vh;
            font-family: 'Outfit', sans-serif;
            color: var(--bs-body-color);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .unsubscribe-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .unsubscribe-card {
            background: var(--bs-white);
            border-radius: var(--border-radius);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 500px;
            width: 100%;
            text-align: center;
            border: 1px solid var(--light-gray-border);
        }

        .logo {
            max-width: 300px;
            margin-bottom: 30px;
        }

        .unsubscribe-icon {
            font-size: 3rem;
            color: var(--danger-color);
            margin-bottom: 20px;
        }

        .unsubscribe-icon.success {
            color: var(--success-color);
        }

        .card-title {
            color: var(--bs-card-color);
            font-weight: 600;
            margin-bottom: 20px;
        }

        .btn-unsubscribe {
            background-color: transparent;
            color: var(--danger-color);
            border: 1px solid var(--danger-color);
            font-size: 14px;
            font-weight: 500;
            padding: 12px 30px;
            border-radius: var(--border-radius);
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
        }

        .btn-unsubscribe:hover {
            background-color: var(--danger-color);
            color: var(--bs-white);
            border-color: var(--danger-color);
            cursor: pointer;
        }

        .btn-unsubscribe:disabled {
            background-color: #6c757d;
            border-color: #6c757d;
            color: var(--bs-white);
            cursor: not-allowed;
        }

        .success-message {
            color: var(--success-color);
            font-weight: 500;
            background-color: rgba(40, 167, 69, 0.1);
            padding: 15px;
            border-radius: var(--border-radius);
            border: 1px solid rgba(40, 167, 69, 0.2);
        }

        .error-message {
            color: var(--danger-color);
            font-weight: 500;
            background-color: rgba(220, 53, 69, 0.1);
            padding: 15px;
            border-radius: var(--border-radius);
            border: 1px solid rgba(220, 53, 69, 0.2);
        }

        .contact-info {
            background: var(--light-gray-color);
            border-radius: var(--border-radius);
            padding: 25px;
            margin-top: 30px;
            border: 1px solid var(--light-gray-border);
        }

        .contact-info h6 {
            color: var(--bs-card-color);
            margin-bottom: 15px;
            font-weight: 600;
        }

        .contact-info p {
            margin: 8px 0;
            color: var(--bs-body-color);
        }

        .contact-info a {
            color: var(--bs-primary);
            text-decoration: none;
        }

        .contact-info a:hover {
            text-decoration: underline;
        }

        .text-muted {
            color: var(--bs-body-color) !important;
        }

        .mb-3 {
            margin-bottom: 1rem !important;
        }

        .mb-4 {
            margin-bottom: 1.5rem !important;
        }

        .mt-3 {
            margin-top: 1rem !important;
        }

        .small {
            font-size: 0.875rem;
        }

        .me-2 {
            margin-right: 0.5rem !important;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="white" opacity="0.1"/><circle cx="80" cy="40" r="3" fill="white" opacity="0.05"/><circle cx="60" cy="80" r="1" fill="white" opacity="0.1"/></svg>');
            animation: float 20s infinite linear;
            pointer-events: none;
            z-index: -1;
        }

        @keyframes float {
            0% {
                transform: translateY(0px) rotate(0deg);
            }

            100% {
                transform: translateY(-20px) rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div class="unsubscribe-container">
        <div class="unsubscribe-card">
            <img src="{{ asset('assets/img/bkq_logo.png') }}" alt="BK Assistant" class="logo">

            @if ($isUnsubscribed)
                <div class="unsubscribe-icon success">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3 class="card-title mb-3">Already Unsubscribed</h3>
                <p class="text-muted mb-4">
                    Hello {{ $client->name }}, you have already unsubscribed from our automated emails.
                </p>
                <div class="success-message">
                    <i class="fas fa-info-circle me-2"></i>
                    You will no longer receive automated notification emails from BK Assistant.
                </div>
            @else
                <div class="unsubscribe-icon">
                    <i class="fas fa-envelope-open"></i>
                </div>
                <h3 class="card-title mb-3">Unsubscribe from Automated Emails</h3>
                <p class="text-muted mb-4">
                    Hello {{ $client->name }}, are you sure you want to unsubscribe from our automated notification
                    emails?
                </p>
                <p class="text-muted mb-4">
                    You will no longer receive important updates and notifications about your case.
                </p>

                <button type="button" class="btn-unsubscribe" id="unsubscribeBtn">
                    <i class="fas fa-ban me-2"></i>
                    Yes, Unsubscribe Me
                </button>

                <div id="message" class="mt-3" style="display: none;"></div>
            @endif

            <div class="contact-info">
                <h6><i class="fas fa-headset me-2"></i>Need Help?</h6>
                <p><i class="fas fa-phone me-2"></i>Phone: <a href="tel:(888)356-5777">(888) 356-5777</a></p>
                <p><i class="fas fa-envelope me-2"></i>Email: <a
                        href="mailto:info@bkassistant.net">info@bkassistant.net</a></p>
                <p class="small text-muted mt-3">
                    If you have any questions or concerns, please don't hesitate to contact us.
                </p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const unsubscribeBtn = document.getElementById('unsubscribeBtn');
            
            if (unsubscribeBtn) {
                unsubscribeBtn.addEventListener('click', function() {
                    console.log('Unsubscribe button clicked');
                    const btn = this;
                    const messageDiv = document.getElementById('message');

            // Disable button and show loading
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';

            // Make AJAX request
            fetch('{{ route('unsubscribe.process', $token) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({})
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        messageDiv.className = 'mt-3 success-message';
                        messageDiv.innerHTML = '<i class="fas fa-check-circle me-2"></i>' + data.message;
                        messageDiv.style.display = 'block';

                        // Hide button and show success state
                        btn.style.display = 'none';

                        // Update icon and title
                        const iconElement = document.querySelector('.unsubscribe-icon');
                        iconElement.innerHTML = '<i class="fas fa-check-circle"></i>';
                        iconElement.classList.add('success');
                        document.querySelector('h3').textContent = 'Successfully Unsubscribed';
                    } else {
                        messageDiv.className = 'mt-3 error-message';
                        messageDiv.innerHTML = '<i class="fas fa-exclamation-circle me-2"></i>' + data.message;
                        messageDiv.style.display = 'block';

                        // Re-enable button
                        btn.disabled = false;
                        btn.innerHTML = '<i class="fas fa-ban me-2"></i>Yes, Unsubscribe Me';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    messageDiv.className = 'mt-3 error-message';
                    messageDiv.innerHTML =
                        '<i class="fas fa-exclamation-circle me-2"></i>An error occurred. Please try again or contact support.';
                    messageDiv.style.display = 'block';

                    // Re-enable button
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fas fa-ban me-2"></i>Yes, Unsubscribe Me';
                });
                }); // Close the click event listener
            } else {
                console.log('Unsubscribe button not found');
            }
        });
    </script>
</body>

</html>
