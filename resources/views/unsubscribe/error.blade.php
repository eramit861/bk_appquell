<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unsubscribe Error - BK Assistant</title>
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
            background-color: var(--bs-body-bg);
            min-height: 100vh;
            font-family: 'Outfit', sans-serif;
            color: var(--bs-body-color);
        }

        .error-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .error-card {
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

        .error-icon {
            font-size: 3rem;
            color: var(--danger-color);
            margin-bottom: 20px;
        }

        .card-title {
            color: var(--bs-card-color);
            font-weight: 600;
            margin-bottom: 20px;
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

        body {
            background: linear-gradient(135deg, #80acf3 0%, #1d4ed8 100%);
            text-align: center;
            position: relative;
            overflow: hidden;
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
    <div class="error-container">
        <div class="error-card">
            <img src="{{ asset('assets/img/bkq_logo.png') }}" alt="BK Assistant" class="logo">
            
            <div class="error-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h3 class="card-title mb-3">Invalid Unsubscribe Link</h3>
            <p class="text-muted mb-4">
                {{ $message }}
            </p>
            
            <div class="contact-info">
                <h6><i class="fas fa-headset me-2"></i>Need Help?</h6>
                <p><i class="fas fa-phone me-2"></i>Phone: <a href="tel:(888)356-5777">(888) 356-5777</a></p>
                <p><i class="fas fa-envelope me-2"></i>Email: <a href="mailto:info@bkassistant.net">info@bkassistant.net</a></p>
                <p class="small text-muted mt-3">
                    If you continue to receive unwanted emails, please contact us and we will help you unsubscribe manually.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
