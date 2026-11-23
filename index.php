<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Best QR Code Generator</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #f5f3ff 0%, #ffffff 50%, #eff6ff 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 50px;
        }

        .header h1 {
            font-size: clamp(2rem, 5vw, 3rem);
            font-weight: 700;
            background: linear-gradient(135deg, #7c3aed 0%, #2563eb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
        }

        .header p {
            color: #6b7280;
            font-size: 1.125rem;
        }

        /* Progress Steps */
        .progress-container {
            max-width: 800px;
            margin: 0 auto 60px;
        }

        .progress-steps {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            position: relative;
            z-index: 2;
        }

        .step-circle {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1.125rem;
            background: #e5e7eb;
            color: #9ca3af;
            transition: all 0.3s ease;
        }

        .step.active .step-circle,
        .step.completed .step-circle {
            background: linear-gradient(135deg, #7c3aed 0%, #2563eb 100%);
            color: white;
            box-shadow: 0 10px 25px rgba(124, 58, 237, 0.3);
            transform: scale(1.1);
        }

        .step-label {
            margin-top: 10px;
            font-size: 0.875rem;
            font-weight: 500;
            color: #9ca3af;
            transition: color 0.3s;
        }

        .step.active .step-label,
        .step.completed .step-label {
            color: #7c3aed;
        }

        .progress-line {
            position: absolute;
            top: 24px;
            left: 0;
            right: 0;
            height: 4px;
            background: #e5e7eb;
            z-index: 1;
        }

        .progress-line-fill {
            height: 100%;
            background: linear-gradient(135deg, #7c3aed 0%, #2563eb 100%);
            transition: width 0.5s ease;
            border-radius: 2px;
        }

        /* QR Type Grid */
        .qr-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .qr-card {
            background: white;
            padding: 24px;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 2px solid transparent;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            gap: 16px;
        }

        .qr-card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 20px 40px rgba(124, 58, 237, 0.15);
            border-color: #e9d5ff;
        }

        .qr-card-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: linear-gradient(135deg, #f3e8ff 0%, #dbeafe 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        .qr-card:hover .qr-card-icon {
            background: linear-gradient(135deg, #7c3aed 0%, #2563eb 100%);
        }

        .qr-card-icon svg {
            width: 24px;
            height: 24px;
            stroke: #7c3aed;
            transition: stroke 0.3s;
        }

        .qr-card:hover .qr-card-icon svg {
            stroke: white;
        }

        .qr-card-content h3 {
            font-size: 1.125rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 6px;
            transition: color 0.3s;
        }

        .qr-card:hover h3 {
            color: #7c3aed;
        }

        .qr-card-content p {
            font-size: 0.875rem;
            color: #6b7280;
            line-height: 1.4;
        }

        /* Form Container */
        .form-container {
            max-width: 700px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        }

        .form-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 32px;
        }

        .form-header-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: linear-gradient(135deg, #f3e8ff 0%, #dbeafe 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-header-icon svg {
            width: 24px;
            height: 24px;
            stroke: #7c3aed;
        }

        .form-header h2 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #111827;
        }

        .form-header p {
            font-size: 0.875rem;
            color: #6b7280;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #7c3aed;
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 32px;
        }

        .btn {
            padding: 14px 28px;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-back {
            background: white;
            color: #374151;
            border: 2px solid #d1d5db;
        }

        .btn-back:hover {
            background: #f9fafb;
        }

        .btn-primary {
            background: linear-gradient(135deg, #7c3aed 0%, #2563eb 100%);
            color: white;
            flex: 1;
            box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(124, 58, 237, 0.4);
        }

        /* QR Result */
        .qr-result {
            text-align: center;
        }

        .success-icon {
            width: 64px;
            height: 64px;
            background: #d1fae5;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
        }

        .success-icon svg {
            width: 32px;
            height: 32px;
            stroke: #10b981;
        }

        .qr-result h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 8px;
        }

        .qr-result > p {
            color: #6b7280;
            margin-bottom: 32px;
        }

        .qr-display {
            background: linear-gradient(135deg, #f3e8ff 0%, #dbeafe 100%);
            padding: 40px;
            border-radius: 16px;
            margin-bottom: 32px;
        }

        .qr-code-box {
            background: white;
            padding: 24px;
            border-radius: 12px;
            display: inline-block;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .qr-code-box img {
            width: 300px;
            height: 300px;
            max-width: 100%;
        }

        .qr-type-label {
            margin-top: 16px;
            font-size: 0.875rem;
            color: #6b7280;
        }

        .hidden {
            display: none;
        }

        /* Responsive */
        @media (max-width: 640px) {
            body {
                padding: 12px;
            }

            .form-container {
                padding: 24px;
            }

            .step-circle {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }

            .step-label {
                font-size: 0.75rem;
            }

            .qr-grid {
                grid-template-columns: 1fr;
            }

            .button-group {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }

            .qr-code-box img {
                width: 250px;
                height: 250px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Hashback QR Code Generator</h1>
        <p>Create your QR code in seconds</p>
    </div>

    <!-- Progress Steps -->
    <div class="progress-container">
        <div class="progress-line">
            <div class="progress-line-fill" id="progressFill"></div>
        </div>
        <div class="progress-steps">
            <div class="step active" data-step="1">
                <div class="step-circle">1</div>
                <span class="step-label">Select Type</span>
            </div>
            <div class="step" data-step="2">
                <div class="step-circle">2</div>
                <span class="step-label">Input Details</span>
            </div>
            <div class="step" data-step="3">
                <div class="step-circle">3</div>
                <span class="step-label">Generate</span>
            </div>
            <div class="step" data-step="4">
                <div class="step-circle">4</div>
                <span class="step-label">Download</span>
            </div>
        </div>
    </div>

    <!-- Step 1: Select Type -->
    <div id="step1" class="step-content">
        <div class="qr-grid">
            <div class="qr-card" onclick="selectType('url', 'Website URL')">
                <div class="qr-card-icon">
                    <svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                </div>
                <div class="qr-card-content">
                    <h3>Website URL</h3>
                    <p>Direct users to any web page instantly</p>
                </div>
            </div>

            <div class="qr-card" onclick="selectType('vcard', 'vCard')">
                <div class="qr-card-icon">
                    <svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <div class="qr-card-content">
                    <h3>vCard</h3>
                    <p>Share contact details in one scan</p>
                </div>
            </div>

            <div class="qr-card" onclick="selectType('pdf', 'PDF')">
                <div class="qr-card-icon">
                    <svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <div class="qr-card-content">
                    <h3>PDF</h3>
                    <p>Show documents and files easily</p>
                </div>
            </div>

            <div class="qr-card" onclick="selectType('image', 'Image(s)')">
                <div class="qr-card-icon">
                    <svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div class="qr-card-content">
                    <h3>Image(s)</h3>
                    <p>Display photos in a beautiful gallery</p>
                </div>
            </div>

            <div class="qr-card" onclick="selectType('social', 'Social Media')">
                <div class="qr-card-icon">
                    <svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                </div>
                <div class="qr-card-content">
                    <h3>Social Media</h3>
                    <p>Connect all your social profiles</p>
                </div>
            </div>

            <div class="qr-card" onclick="selectType('video', 'Video')">
                <div class="qr-card-icon">
                    <svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                </div>
                <div class="qr-card-content">
                    <h3>Video</h3>
                    <p>Stream videos with a quick scan</p>
                </div>
            </div>

            <div class="qr-card" onclick="selectType('mp3', 'MP3')">
                <div class="qr-card-icon">
                    <svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/></svg>
                </div>
                <div class="qr-card-content">
                    <h3>MP3</h3>
                    <p>Stream music and audio files easily</p>
                </div>
            </div>

            <div class="qr-card" onclick="selectType('text', 'Simple Text')">
                <div class="qr-card-icon">
                    <svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7"/></svg>
                </div>
                <div class="qr-card-content">
                    <h3>Simple Text</h3>
                    <p>Share plain text messages quickly</p>
                </div>
            </div>

            <div class="qr-card" onclick="selectType('business', 'Business Page')">
                <div class="qr-card-icon">
                    <svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <div class="qr-card-content">
                    <h3>Business Page</h3>
                    <p>Showcase your company details</p>
                </div>
            </div>

            <div class="qr-card" onclick="selectType('wifi', 'Wi-Fi')">
                <div class="qr-card-icon">
                    <svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"/></svg>
                </div>
                <div class="qr-card-content">
                    <h3>Wi-Fi</h3>
                    <p>Auto-connect guests to your network</p>
                </div>
            </div>

            <div class="qr-card" onclick="selectType('app', 'App')">
                <div class="qr-card-icon">
                    <svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                </div>
                <div class="qr-card-content">
                    <h3>App</h3>
                    <p>Drive downloads from app stores</p>
                </div>
            </div>

            <div class="qr-card" onclick="selectType('menu', 'Menu')">
                <div class="qr-card-icon">
                    <svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <div class="qr-card-content">
                    <h3>Menu</h3>
                    <p>Display your restaurant offerings</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Step 2: Input Details -->
    <div id="step2" class="step-content hidden">
        <div class="form-container">
            <div class="form-header">
                <div class="form-header-icon" id="formHeaderIcon"></div>
                <div>
                    <h2 id="formTitle">Website URL</h2>
                    <p>Fill in the details below</p>
                </div>
            </div>
            <form id="qrForm"></form>
            <div class="button-group">
                <button class="btn btn-back" onclick="goToStep(1)">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    Back
                </button>
                <button class="btn btn-primary" onclick="generateQR()">
                    Generate QR Code
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Step 3: Generate & Download -->
    <div id="step3" class="step-content hidden">
        <div class="form-container qr-result">
            <div class="success-icon">
                <svg fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            </div>
            <h2>QR Code Generated!</h2>
            <p>Your QR code is ready to download</p>
            <div class="qr-display">
                <div class="qr-code-box">
                    <img id="qrImage" src="" alt="Generated QR Code">
                </div>
                <p class="qr-type-label">Type: <span id="qrTypeLabel"></span></p>
            </div>
            <div class="button-group">
                <button class="btn btn-back" onclick="resetGenerator()">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    Create Another
                </button>
                <button class="btn btn-primary" onclick="downloadQR()">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Download QR Code
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let currentStep = 1;
    let selectedQRType = '';
    let selectedQRName = '';
    let formData = {};

    const formFields = {
        url: [{ name: 'url', label: 'Website URL', type: 'url', placeholder: 'https://example.com' }],
        vcard: [
            { name: 'name', label: 'Full Name', type: 'text', placeholder: 'John Doe' },
            { name: 'email', label: 'Email', type: 'email', placeholder: 'john@example.com' },
            { name: 'phone', label: 'Phone', type: 'tel', placeholder: '+1234567890' },
            { name: 'company', label: 'Company', type: 'text', placeholder: 'Company Name' }
        ],
        pdf: [{ name: 'pdfUrl', label: 'PDF URL', type: 'url', placeholder: 'https://example.com/file.pdf' }],
        image: [{ name: 'imageUrl', label: 'Image URL', type: 'url', placeholder: 'https://example.com/image.jpg' }],
        social: [
            { name: 'platform', label: 'Platform', type: 'select', options: ['Instagram', 'Facebook', 'Twitter', 'LinkedIn', 'TikTok'] },
            { name: 'username', label: 'Username/URL', type: 'text', placeholder: '@username' }
        ],
        video: [{ name: 'videoUrl', label: 'Video URL', type: 'url', placeholder: 'https://youtube.com/watch?v=...' }],
        mp3: [{ name: 'audioUrl', label: 'Audio URL', type: 'url', placeholder: 'https://example.com/audio.mp3' }],
        text: [{ name: 'text', label: 'Your Message', type: 'textarea', placeholder: 'Enter your text message...' }],
        business: [
            { name: 'businessName', label: 'Business Name', type: 'text', placeholder: 'My Business' },
            { name: 'address', label: 'Address', type: 'text', placeholder: '123 Main St' },
            { name: 'phone', label: 'Phone', type: 'tel', placeholder: '+1234567890' },
            { name: 'website', label: 'Website', type: 'url', placeholder: 'https://business.com' }
        ],
        wifi: [
            { name: 'ssid', label: 'Network Name (SSID)', type: 'text', placeholder: 'MyWiFi' },
            { name: 'password', label: 'Password', type: 'text', placeholder: 'password123' },
            { name: 'encryption', label: 'Security', type: 'select', options: ['WPA', 'WEP', 'None'] }
        ],
        app: [
            { name: 'appStore', label: 'App Store', type: 'select', options: ['Apple App Store', 'Google Play Store', 'Both'] },
            { name: 'appUrl', label: 'App URL', type: 'url', placeholder: 'https://apps.apple.com/...' }
        ],
        menu: [
            { name: 'restaurantName', label: 'Restaurant Name', type: 'text', placeholder: 'My Restaurant' },
            { name: 'menuUrl', label: 'Menu URL', type: 'url', placeholder: 'https://example.com/menu' }
        ]
    };

    function selectType(type, name) {
        selectedQRType = type;
        selectedQRName = name;
        formData = {};
        buildForm();
        goToStep(2);
    }

    function buildForm() {
        const form = document.getElementById('qrForm');
        const title = document.getElementById('formTitle');
        title.textContent = selectedQRName;

        form.innerHTML = '';
        const fields = formFields[selectedQRType] || [];

        fields.forEach(field => {
            const group = document.createElement('div');
            group.className = 'form-group';

            const label = document.createElement('label');
            label.textContent = field.label;
            group.appendChild(label);

            let input;
            if (field.type === 'textarea') {
                input = document.createElement('textarea');
                input.rows = 4;
            } else if (field.type === 'select') {
                input = document.createElement('select');
                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = `Select ${field.label}`;
                input.appendChild(defaultOption);

                field.options.forEach(opt => {
                    const option = document.createElement('option');
                    option.value = opt;
                    option.textContent = opt;
                    input.appendChild(option);
                });
            } else {
                input = document.createElement('input');
                input.type = field.type;
            }

            input.name = field.name;
            input.placeholder = field.placeholder;
            input.addEventListener('input', (e) => {
                formData[field.name] = e.target.value;
            });

            group.appendChild(input);
            form.appendChild(group);
        });
    }

    function getQRData() {
        switch (selectedQRType) {
            case 'url':
                return formData.url || 'https://example.com';
            case 'text':
                return formData.text || 'Sample Text';
            case 'wifi':
                return `WIFI:T:${formData.encryption || 'WPA'};S:${formData.ssid || 'WiFi'};P:${formData.password || ''};;`;
            case 'vcard':
                return `BEGIN:VCARD\nVERSION:3.0\nFN:${formData.name || 'John Doe'}\nEMAIL:${formData.email || ''}\nTEL:${formData.phone || ''}\nORG:${formData.company || ''}\nEND:VCARD`;
            default:
                return JSON.stringify(formData);
        }
    }

    function generateQR() {
        const qrData = getQRData();
        const qrImage = document.getElementById('qrImage');
        qrImage.src = `https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=${encodeURIComponent(qrData)}`;

        document.getElementById('qrTypeLabel').textContent = selectedQRName;
        goToStep(3);
    }

    function downloadQR() {
        const qrImage = document.getElementById('qrImage');
        const link = document.createElement('a');
        link.href = qrImage.src;
        link.download = `qr-code-${selectedQRType}.png`;
        link.click();
    }

    function resetGenerator() {
        formData = {};
        selectedQRType = '';
        selectedQRName = '';
        goToStep(1);
    }

    function goToStep(step) {
        currentStep = step;

        // Hide all steps
        document.querySelectorAll('.step-content').forEach(el => {
            el.classList.add('hidden');
        });

        // Show current step
        document.getElementById(`step${step}`).classList.remove('hidden');

        // Update progress
        updateProgress();
    }

    function updateProgress() {
        const steps = document.querySelectorAll('.step');
        const progressFill = document.getElementById('progressFill');

        steps.forEach((step, index) => {
            const stepNum = index + 1;
            step.classList.remove('active', 'completed');

            if (stepNum < currentStep) {
                step.classList.add('completed');
                step.querySelector('.step-circle').innerHTML = '✓';
            } else if (stepNum === currentStep) {
                step.classList.add('active');
                step.querySelector('.step-circle').textContent = stepNum;
            } else {
                step.querySelector('.step-circle').textContent = stepNum;
            }
        });

        // Update progress bar
        const progress = ((currentStep - 1) / 3) * 100;
        progressFill.style.width = progress + '%';
    }

    // Initialize
    updateProgress();
</script>
</body>
</html>