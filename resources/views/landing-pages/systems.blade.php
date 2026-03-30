<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $landingPage->title ?? 'Custom System Development | Devvidia' }}</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&family=space-grotesk:600,700&family=cairo:400,600,700" rel="stylesheet" />
    
    @php
        $tiktokPixelId = $landingPage->settings['tiktok_pixel_id'] ?? null;
    @endphp
    
    @if($tiktokPixelId)
    <!-- TikTok Pixel Code -->
    <script>
    !function (w, d, t) {
        w.TiktokAnalyticsObject=t;var ttq=w[t]=w[t]||[];ttq.methods=["page","track","identify","instances","debug","on","off","once","ready","alias","group","enableCookie","disableCookie","holdConsent","revokeConsent","grantConsent"],ttq.setAndDefer=function(t,e){t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}};for(var i=0;i<ttq.methods.length;i++)ttq.setAndDefer(ttq,ttq.methods[i]);ttq.instance=function(t){for(
        var e=ttq._i[t]||[],n=0;n<ttq.methods.length;n++)ttq.setAndDefer(e,ttq.methods[n]);return e},ttq.load=function(e,n){var r="https://analytics.tiktok.com/i18n/pixel/events.js",o=n&&n.partner;ttq._i=ttq._i||{},ttq._i[e]=[],ttq._i[e]._u=r,ttq._t=ttq._t||{},ttq._t[e]=+new Date,ttq._o=ttq._o||{},ttq._o[e]=n||{};n=document.createElement("script")
        ;n.type="text/javascript",n.async=!0,n.src=r+"?sdkid="+e+"&lib="+t;e=document.getElementsByTagName("script")[0];e.parentNode.insertBefore(n,e)};
        
        ttq.load('{{ $tiktokPixelId }}');
        ttq.page();
    }(window, document, 'ttq');
    </script>
    <!-- End TikTok Pixel Code -->
    @endif
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #42b883 0%, #35495e 100%);
            color: #2c3e50;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 2rem 1rem;
            position: relative;
            overflow-x: hidden;
        }
        
        [dir="rtl"] body {
            font-family: 'Cairo', 'Inter', sans-serif;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="60" height="60" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="60" height="60" patternUnits="userSpaceOnUse"><path d="M 60 0 L 0 0 0 60" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
        }
        
        .container {
            max-width: 900px;
            width: 100%;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }
        
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .logo-text {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.75rem;
            font-weight: 700;
            color: #ffffff;
            text-shadow: 0 2px 20px rgba(0, 0, 0, 0.3);
        }
        
        .language-switcher {
            display: flex;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.2);
            padding: 0.35rem;
            border-radius: 50px;
            backdrop-filter: blur(10px);
        }
        
        .lang-btn {
            background: transparent;
            border: none;
            color: rgba(255, 255, 255, 0.8);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.9rem;
            font-weight: 600;
            font-family: 'Space Grotesk', sans-serif;
        }
        
        .lang-btn:hover {
            color: #ffffff;
        }
        
        .lang-btn.active {
            background: rgba(255, 255, 255, 0.95);
            color: #42b883;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }
        
        .card {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 24px;
            padding: 3rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .header {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        
        .header h1 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 1rem;
            line-height: 1.2;
        }
        
        .header h1 .highlight {
            background: linear-gradient(135deg, #42b883 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .header p {
            font-size: 1.1rem;
            color: #64748b;
            line-height: 1.7;
        }
        
        .features-list {
            display: flex;
            justify-content: center;
            gap: 3rem;
            margin: 2rem 0;
            flex-wrap: wrap;
            padding: 0 0.5rem;
        }
        
        .feature-item {
            text-align: center;
            padding: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .feature-icon {
            font-size: 1.5rem;
            flex-shrink: 0;
        }
        
        .feature-text {
            font-size: 0.95rem;
            font-weight: 600;
            color: #1e293b;
            white-space: nowrap;
        }
        
        .form-section h2 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.75rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #1e293b;
            font-weight: 600;
            font-size: 0.95rem;
        }
        
        .form-group label .required {
            color: #ef4444;
        }
        
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 1rem;
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            color: #1e293b;
            font-family: inherit;
            font-size: 1rem;
            transition: all 0.3s;
        }
        
        [dir="rtl"] .form-group input,
        [dir="rtl"] .form-group textarea {
            text-align: right;
        }
        
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #42b883;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(66, 184, 131, 0.1);
        }
        
        .form-group textarea {
            resize: vertical;
            min-height: 120px;
            line-height: 1.6;
        }
        
        .btn-submit {
            width: 100%;
            padding: 1.15rem 2rem;
            background: linear-gradient(135deg, #42b883 0%, #35495e 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 16px rgba(66, 184, 131, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            font-family: 'Space Grotesk', sans-serif;
        }
        
        .btn-submit:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 32px rgba(66, 184, 131, 0.4);
        }
        
        .btn-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
        
        .btn-submit .spinner {
            display: none;
            width: 18px;
            height: 18px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }
        
        .btn-submit:disabled .spinner {
            display: block;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        .form-message {
            margin-top: 1.5rem;
            padding: 1.25rem;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 500;
            display: none;
            animation: slideIn 0.3s ease-out;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .form-message.success {
            background: #d1fae5;
            color: #065f46;
            border: 2px solid #42b883;
        }
        
        .form-message.error {
            background: #fee2e2;
            color: #991b1b;
            border: 2px solid #ef4444;
        }
        
        .footer {
            text-align: center;
            margin-top: 2rem;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }
        
        .trust-badges {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 2px solid #f1f5f9;
            flex-wrap: wrap;
        }
        
        .trust-badge {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #64748b;
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .trust-badge .icon {
            color: #42b883;
            font-size: 1.2rem;
        }
        
        .hidden {
            display: none;
        }
        
        /* WhatsApp Floating Button */
        .whatsapp-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
            cursor: pointer;
            transition: all 0.3s;
            z-index: 1000;
            text-decoration: none;
            animation: whatsappPulse 2s ease-in-out infinite;
        }
        
        .whatsapp-float::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: rgba(37, 211, 102, 0.4);
            animation: whatsappRipple 2s ease-out infinite;
            z-index: -1;
        }
        
        .whatsapp-float::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: rgba(37, 211, 102, 0.3);
            animation: whatsappRipple 2s ease-out infinite 1s;
            z-index: -1;
        }
        
        .whatsapp-float:hover {
            transform: scale(1.15);
            box-shadow: 0 6px 30px rgba(37, 211, 102, 0.6);
            animation: whatsappBounce 0.6s ease-in-out;
        }
        
        .whatsapp-float svg {
            width: 32px;
            height: 32px;
            animation: whatsappIconShake 3s ease-in-out infinite;
        }
        
        @keyframes whatsappPulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }
        
        @keyframes whatsappRipple {
            0% {
                width: 100%;
                height: 100%;
                opacity: 1;
            }
            100% {
                width: 200%;
                height: 200%;
                opacity: 0;
            }
        }
        
        @keyframes whatsappBounce {
            0%, 100% {
                transform: scale(1.15);
            }
            50% {
                transform: scale(1.25);
            }
        }
        
        @keyframes whatsappIconShake {
            0%, 100% {
                transform: rotate(0deg);
            }
            10%, 30% {
                transform: rotate(-10deg);
            }
            20%, 40% {
                transform: rotate(10deg);
            }
            50%, 90% {
                transform: rotate(0deg);
            }
        }
        
        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }
            
            .card {
                padding: 2rem 1.5rem;
                border-radius: 20px;
            }
            
            .header h1 {
                font-size: 2rem;
            }
            
            .header p {
                font-size: 1rem;
            }
            
            .features-list {
                gap: 1rem;
                flex-wrap: wrap;
                margin: 1.5rem 0;
            }
            
            .feature-item {
                padding: 0.5rem;
                gap: 0.5rem;
                flex: 1 1 auto;
                min-width: 0;
            }
            
            .feature-icon {
                font-size: 1.2rem;
            }
            
            .feature-text {
                font-size: 0.8rem;
                white-space: normal;
                text-align: left;
            }
            
            .trust-badges {
                flex-direction: column;
                gap: 1rem;
                align-items: center;
            }
            
            .language-switcher {
                padding: 0.25rem;
            }
            
            .lang-btn {
                padding: 0.4rem 0.75rem;
                font-size: 0.85rem;
            }
            
            /* WhatsApp Float */
            .whatsapp-float {
                width: 50px;
                height: 50px;
                bottom: 20px;
                right: 20px;
            }
            
            .whatsapp-float svg {
                width: 26px;
                height: 26px;
            }
        }
        
        @media (max-width: 480px) {
            .card {
                padding: 1.5rem 1rem;
            }
            
            .header h1 {
                font-size: 1.75rem;
            }
            
            .logo-text {
                font-size: 1.5rem;
            }
            
            .top-bar {
                flex-direction: column;
                gap: 1rem;
            }
            
            .features-list {
                gap: 0.75rem;
                flex-direction: column;
                align-items: stretch;
            }
            
            .feature-item {
                justify-content: flex-start;
                text-align: left;
                padding: 0.75rem;
                background: #f8fafc;
                border-radius: 8px;
            }
            
            .feature-text {
                font-size: 0.85rem;
                white-space: normal;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="top-bar">
            <div class="logo">
                <div class="logo-text">💻 Devvidia</div>
            </div>
            
            <div class="language-switcher">
                <button class="lang-btn" data-lang="en" onclick="switchLanguage('en')">EN</button>
                <button class="lang-btn active" data-lang="fr" onclick="switchLanguage('fr')">FR</button>
                <button class="lang-btn" data-lang="ar" onclick="switchLanguage('ar')">AR</button>
            </div>
        </div>
        
        <div class="card">
            <div class="header">
                <h1>
                    <span data-en="Build Your" data-fr="Construisez Votre" data-ar="ابنِ نظامك">Build Your</span>
                    <span class="highlight" data-en="Custom System" data-fr="Système Personnalisé" data-ar="المخصص">Custom System</span>
                </h1>
                <p data-en="Professional system development for your business needs. From ERP to CRM, inventory management to automation." 
                   data-fr="Développement de systèmes professionnels pour vos besoins commerciaux. De l'ERP au CRM, de la gestion des stocks à l'automatisation." 
                   data-ar="تطوير أنظمة احترافية لاحتياجات عملك. من تخطيط موارد المؤسسات إلى إدارة علاقات العملاء والمخزون والأتمتة.">
                    Professional system development for your business needs. From ERP to CRM, inventory management to automation.
                </p>
            </div>
            
            <div class="form-section">
                <h2 data-en="Get Started Today" data-fr="Commencez Aujourd'hui" data-ar="ابدأ اليوم">Get Started Today</h2>
                
                <form id="leadForm">
                    <div class="form-group">
                        <label for="name">
                            <span data-en="Your Name" data-fr="Votre Nom" data-ar="اسمك">Your Name</span>
                            <span class="required">*</span>
                        </label>
                        <input type="text" id="name" name="name" placeholder="Your Name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">
                            <span data-en="Phone Number" data-fr="Numéro de Téléphone" data-ar="رقم الهاتف">Phone Number</span>
                            <span class="required">*</span>
                        </label>
                        <input type="tel" id="phone" name="phone" placeholder="+212 6 12 34 56 78" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="project_idea">
                            <span data-en="Your Project Idea" data-fr="Votre Idée de Projet" data-ar="فكرة مشروعك">Your Project Idea</span>
                            <span class="required">*</span>
                        </label>
                        <textarea id="project_idea" name="project_idea" placeholder="Tell us about your system requirements..." required></textarea>
                    </div>
                    
                    <button type="submit" class="btn-submit">
                        <span class="spinner"></span>
                        <span class="btn-text" data-en="Submit Your Request" data-fr="Soumettre Votre Demande" data-ar="إرسال طلبك">Submit Your Request</span>
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </button>
                    
                    <div id="formMessage" class="form-message"></div>
                </form>
                
                <div class="features-list">
                    <div class="feature-item">
                        <div class="feature-icon">⚡</div>
                        <div class="feature-text" data-en="Fast & Scalable" data-fr="Rapide & Évolutif" data-ar="سريع وقابل للتوسع">Fast & Scalable</div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">🔒</div>
                        <div class="feature-text" data-en="Secure & Reliable" data-fr="Sécurisé & Fiable" data-ar="آمن وموثوق">Secure & Reliable</div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">🎯</div>
                        <div class="feature-text" data-en="Custom Solutions" data-fr="Solutions Sur Mesure" data-ar="حلول مخصصة">Custom Solutions</div>
                    </div>
                </div>
                
                <div class="trust-badges">
                    <div class="trust-badge">
                        <span class="icon">✓</span>
                        <span data-en="Free Consultation" data-fr="Consultation Gratuite" data-ar="استشارة مجانية">Free Consultation</span>
                    </div>
                    <div class="trust-badge">
                        <span class="icon">✓</span>
                        <span data-en="48h Response Time" data-fr="Réponse en 48h" data-ar="رد خلال 48 ساعة">48h Response Time</span>
                    </div>
                    <div class="trust-badge">
                        <span class="icon">✓</span>
                        <span data-en="Expert Developers" data-fr="Développeurs Experts" data-ar="مطورون خبراء">Expert Developers</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer">
            <p>
                &copy; {{ date('Y') }} Devvidia. 
                <span data-en="Building the future, one system at a time." 
                      data-fr="Construire l'avenir, un système à la fois." 
                      data-ar="نبني المستقبل، نظاماً تلو الآخر.">
                    Building the future, one system at a time.
                </span>
            </p>
        </div>
    </div>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/{{ $whatsappPhone }}?text=Bonjour%2C%20je%20souhaite%20discuter%20d%27un%20projet" class="whatsapp-float" id="whatsappFloat" target="_blank" rel="noopener noreferrer">
        <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
    </a>

    <script>
        let currentLang = 'en';
        
        const translations = {
            en: {
                namePlaceholder: 'Your Name',
                phonePlaceholder: '+212 6 12 34 56 78',
                projectPlaceholder: 'Tell us about your system requirements and what you want to build...',
                submitting: 'Submitting...',
                successMessage: '🎉 Success! We\'ll contact you within 24 hours to discuss your project.',
                errorMessage: 'An error occurred. Please try again.',
                validationError: 'Please fill in all required fields.',
                networkError: 'Unable to submit. Please check your connection and try again.'
            },
            fr: {
                namePlaceholder: 'Votre Nom',
                phonePlaceholder: '+212 6 12 34 56 78',
                projectPlaceholder: 'Parlez-nous de vos besoins système et de ce que vous voulez construire...',
                submitting: 'Envoi en cours...',
                successMessage: '🎉 Succès! Nous vous contacterons dans les 24 heures pour discuter de votre projet.',
                errorMessage: 'Une erreur s\'est produite. Veuillez réessayer.',
                validationError: 'Veuillez remplir tous les champs obligatoires.',
                networkError: 'Impossible d\'envoyer. Veuillez vérifier votre connexion et réessayer.'
            },
            ar: {
                namePlaceholder: 'اسمك',
                phonePlaceholder: '+212 6 12 34 56 78',
                projectPlaceholder: 'أخبرنا عن متطلبات نظامك وما تريد بناءه...',
                submitting: 'جاري الإرسال...',
                successMessage: '🎉 نجح! سنتواصل معك خلال 24 ساعة لمناقشة مشروعك.',
                errorMessage: 'حدث خطأ. يرجى المحاولة مرة أخرى.',
                validationError: 'يرجى ملء جميع الحقول المطلوبة.',
                networkError: 'غير قادر على الإرسال. يرجى التحقق من اتصالك والمحاولة مرة أخرى.'
            }
        };
        
        function switchLanguage(lang) {
            currentLang = lang;
            const htmlElement = document.documentElement;
            
            // Update active button
            document.querySelectorAll('.lang-btn').forEach(btn => {
                btn.classList.remove('active');
                if (btn.dataset.lang === lang) {
                    btn.classList.add('active');
                }
            });
            
            // Update HTML lang and dir attributes
            htmlElement.setAttribute('lang', lang);
            htmlElement.setAttribute('dir', lang === 'ar' ? 'rtl' : 'ltr');
            
            // Update all translatable elements
            document.querySelectorAll('[data-en]').forEach(element => {
                const text = element.getAttribute(`data-${lang}`);
                if (text) {
                    if (element.tagName === 'INPUT' || element.tagName === 'TEXTAREA') {
                        element.placeholder = text;
                    } else {
                        element.textContent = text;
                    }
                }
            });
            
            // Update placeholders
            document.getElementById('name').placeholder = translations[lang].namePlaceholder;
            document.getElementById('phone').placeholder = translations[lang].phonePlaceholder;
            document.getElementById('project_idea').placeholder = translations[lang].projectPlaceholder;
            
            // Update WhatsApp floating button
            const whatsappMessages = {
                en: 'Hello%2C%20I%20would%20like%20to%20discuss%20a%20project',
                fr: 'Bonjour%2C%20je%20souhaite%20discuter%20d%27un%20projet',
                ar: 'مرحباً%2C%20أريد%20مناقشة%20مشروع'
            };
            
            const floatingBtn = document.getElementById('whatsappFloat');
            if (floatingBtn) {
                const currentHref = floatingBtn.getAttribute('href');
                const baseUrl = currentHref.split('?')[0];
                floatingBtn.setAttribute('href', baseUrl + '?text=' + whatsappMessages[lang]);
            }
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            const leadForm = document.getElementById('leadForm');
            const formMessage = document.getElementById('formMessage');
            const submitBtn = leadForm.querySelector('.btn-submit');
            const btnText = submitBtn.querySelector('.btn-text');
            
            // Initialize with French
            switchLanguage('fr');
            
            leadForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                const name = document.getElementById('name').value.trim();
                const phone = document.getElementById('phone').value.trim();
                const projectIdea = document.getElementById('project_idea').value.trim();
                
                if (!name || !phone || !projectIdea) {
                    showMessage(translations[currentLang].validationError, 'error');
                    return;
                }
                
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
                
                submitBtn.disabled = true;
                btnText.textContent = translations[currentLang].submitting;
                
                try {
                    const response = await fetch('/landing/submit-lead', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            name: name,
                            phone: phone,
                            project_idea: projectIdea,
                            landing_page: '{{ $landingPage->slug }}'
                        })
                    });
                    
                    const data = await response.json();
                    
                    if (response.ok) {
                        showMessage(translations[currentLang].successMessage, 'success');
                        leadForm.reset();
                        
                        // Google Analytics conversion tracking
                        if (typeof gtag !== 'undefined') {
                            gtag('event', 'conversion', {
                                'event_category': 'Lead',
                                'event_label': '{{ $landingPage->name ?? "Landing Page" }}'
                            });
                        }
                        
                        // TikTok Pixel conversion tracking
                        if (typeof ttq !== 'undefined') {
                            ttq.track('CompleteRegistration', {
                                content_name: '{{ $landingPage->name ?? "Lead Form" }}',
                                content_category: 'Lead',
                                description: '{{ $landingPage->slug }}'
                            });
                            console.log('TikTok Pixel: CompleteRegistration event fired');
                        }
                    } else {
                        showMessage(data.message || translations[currentLang].errorMessage, 'error');
                    }
                } catch (error) {
                    showMessage(translations[currentLang].networkError, 'error');
                    console.error('Form submission error:', error);
                } finally {
                    submitBtn.disabled = false;
                    btnText.textContent = translations[currentLang]['Submit Your Request'] || 'Submit Your Request';
                    switchLanguage(currentLang);
                }
            });
            
            function showMessage(message, type) {
                formMessage.textContent = message;
                formMessage.className = 'form-message ' + type;
                formMessage.style.display = 'block';
                
                if (type === 'success') {
                    setTimeout(() => {
                        formMessage.style.display = 'none';
                    }, 8000);
                }
            }
        });
    </script>
</body>
</html>
