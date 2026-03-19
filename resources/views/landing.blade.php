<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Devvidia - Custom Software Solutions</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&family=space-grotesk:500,600,700" rel="stylesheet" />
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: #ffffff;
            color: #1a202c;
            overflow-x: hidden;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        
        /* Navigation */
        nav {
            padding: 1.5rem 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .nav-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #667EEA 0%, #4A90E2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .nav-links {
            display: flex;
            gap: 2.5rem;
            list-style: none;
        }
        
        .nav-links a {
            color: #4a5568;
            text-decoration: none;
            font-size: 0.95rem;
            transition: color 0.3s;
            font-weight: 500;
        }
        
        .nav-links a:hover {
            color: #667EEA;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
            color: white;
            padding: 0.75rem 1.75rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: transform 0.3s, box-shadow 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: none;
            cursor: pointer;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(37, 211, 102, 0.4);
        }
        
        .btn-secondary {
            background: transparent;
            color: #A8B2D1;
            padding: 0.75rem 1.75rem;
            border: 1px solid rgba(168, 178, 209, 0.3);
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
            display: inline-block;
        }
        
        .btn-secondary:hover {
            border-color: #4A90E2;
            color: #ffffff;
        }
        
        /* Hero Section */
        .hero {
            padding: 6rem 0 5rem;
            overflow: hidden;
            background: linear-gradient(135deg, #667EEA 0%, #764BA2 100%);
            position: relative;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M 100 0 L 0 0 0 100" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grid)"/></svg>');
            opacity: 0.5;
        }
        
        .hero .container {
            position: relative;
            z-index: 1;
        }
        
        .hero-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }
        
        .hero-text {
            text-align: left;
        }
        
        .hero h1 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 3.8rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            color: #ffffff;
            text-shadow: 0 2px 20px rgba(0, 0, 0, 0.2);
        }
        
        .hero h1 .highlight {
            color: #FFD700;
            text-shadow: 0 0 30px rgba(255, 215, 0, 0.5);
        }
        
        .hero p {
            font-size: 1.15rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2.5rem;
            line-height: 1.8;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        
        .hero-buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: flex-start;
        }
        
        /* Hero Showcase */
        .hero-showcase {
            position: relative;
            height: 500px;
        }
        
        .showcase-container {
            position: relative;
            width: 100%;
            height: 100%;
        }
        
        .showcase-item {
            position: absolute;
            width: 280px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.3);
            border: 2px solid rgba(255, 255, 255, 0.2);
            animation: float 6s ease-in-out infinite;
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            opacity: 0;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }
        
        .showcase-item.visible {
            opacity: 1;
        }
        
        .showcase-item:hover {
            transform: scale(1.05);
            z-index: 10 !important;
        }
        
        .showcase-item.position-1 {
            top: 0;
            left: 0;
            z-index: 3;
            animation-delay: 0s;
        }
        
        .showcase-item.position-2 {
            top: 100px;
            right: 20px;
            z-index: 2;
            animation-delay: 2s;
        }
        
        .showcase-item.position-3 {
            bottom: 20px;
            left: 60px;
            z-index: 1;
            animation-delay: 4s;
        }
        
        .showcase-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }
        
        .showcase-placeholder {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #667EEA 0%, #4A90E2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
        }
        
        .showcase-label {
            padding: 1rem;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            color: #1a202c;
            font-weight: 600;
            text-align: center;
            font-size: 0.9rem;
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(2deg);
            }
        }
        
        /* Services Section */
        .services {
            padding: 6rem 0;
            background: #f7fafc;
        }
        
        .section-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 1rem;
            font-weight: 700;
            background: linear-gradient(135deg, #667EEA 0%, #764BA2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .section-subtitle {
            text-align: center;
            color: #718096;
            font-size: 1.1rem;
            margin-bottom: 4rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
        }
        
        .service-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 2.5rem;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
        .service-card:hover {
            transform: translateY(-10px);
            background: #ffffff;
            border-color: #667EEA;
            box-shadow: 0 20px 40px rgba(102, 126, 234, 0.15);
        }
        
        .service-icon {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            display: inline-block;
            padding: 1rem;
            background: linear-gradient(135deg, #667EEA 0%, #764BA2 100%);
            border-radius: 16px;
        }
        
        .service-card h3 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #1a202c;
            font-weight: 600;
        }
        
        .service-card p {
            color: #718096;
            line-height: 1.8;
        }
        
        /* Projects Section */
        .projects {
            padding: 6rem 0;
            background: linear-gradient(135deg, #667EEA 0%, #764BA2 100%);
            position: relative;
        }
        
        .projects::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="2" cy="2" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100%" height="100%" fill="url(%23dots)"/></svg>');
        }
        
        .projects .container {
            position: relative;
            z-index: 1;
        }
        
        .projects .section-title {
            color: #ffffff;
            background: none;
            -webkit-text-fill-color: #ffffff;
        }
        
        .projects .section-subtitle {
            color: rgba(255, 255, 255, 0.9);
        }
        
        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2.5rem;
        }
        
        .project-card {
            background: rgba(255, 255, 255, 0.95);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }
        
        .project-card:hover {
            transform: translateY(-10px) scale(1.02);
            border-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        }
        
        .project-image {
            height: 250px;
            background: linear-gradient(135deg, #667EEA 0%, #4A90E2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            overflow: hidden;
            position: relative;
        }
        
        .project-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
        }
        
        .project-image .icon-fallback {
            font-size: 3rem;
            z-index: 1;
        }
        
        .project-content {
            padding: 2rem;
            background: #ffffff;
        }
        
        .project-content h3 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #1a202c;
            font-weight: 600;
        }
        
        .project-content p {
            color: #718096;
            margin-bottom: 1.5rem;
            line-height: 1.7;
        }
        
        /* Contact Section */
        .contact {
            padding: 6rem 0;
            background: #f7fafc;
        }
        
        .contact .section-title {
            color: #1a202c;
            background: linear-gradient(135deg, #667EEA 0%, #764BA2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .contact .section-subtitle {
            color: #718096;
        }
        
        .contact-form {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #4a5568;
            font-weight: 600;
        }
        
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            background: #f7fafc;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            color: #1a202c;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s;
        }
        
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667EEA;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }
        
        .form-submit {
            width: 100%;
        }
        
        /* Footer */
        footer {
            padding: 3rem 0;
            background: #1a202c;
            color: #ffffff;
        }
        
        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 2rem;
        }
        
        footer p {
            color: rgba(255, 255, 255, 0.7);
        }
        
        .footer-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }
        
        .footer-links a {
            color: #A8B2D1;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-links a:hover {
            color: #ffffff;
        }
        
        .copyright {
            color: #A8B2D1;
            font-size: 0.9rem;
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
        }
        
        .whatsapp-float:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 30px rgba(37, 211, 102, 0.6);
        }
        
        /* Language Switcher */
        .language-switcher {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            background: #f7fafc;
            padding: 0.25rem;
            border-radius: 10px;
        }
        
        .language-switcher button {
            background: transparent;
            border: none;
            color: #4a5568;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.9rem;
            font-weight: 600;
        }
        
        .language-switcher button.active {
            background: linear-gradient(135deg, #667EEA 0%, #764BA2 100%);
            color: #ffffff;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
        }
        
        .language-switcher button:hover {
            color: #667EEA;
        }
        
        .language-switcher button.active:hover {
            color: #ffffff;
        }
        
        .hidden {
            display: none;
        }
        
        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #4a5568;
        }
        
        /* Tablet & Mobile Responsive */
        @media (max-width: 1024px) {
            .container {
                padding: 0 1.5rem;
            }
            
            .hero h1 {
                font-size: 3rem;
            }
            
            .showcase-item {
                width: 240px;
            }
            
            .projects-grid {
                grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            }
        }
        
        @media (max-width: 768px) {
            /* Container */
            .container {
                padding: 0 1rem;
            }
            
            /* Navigation */
            nav {
                padding: 1rem 0;
            }
            
            .nav-content {
                flex-wrap: wrap;
                gap: 1rem;
            }
            
            .logo {
                font-size: 1.25rem;
            }
            
            .logo svg {
                width: 20px;
                height: 20px;
            }
            
            .nav-links {
                display: none;
            }
            
            .language-switcher {
                padding: 0.15rem;
            }
            
            .language-switcher button {
                padding: 0.4rem 0.75rem;
                font-size: 0.85rem;
            }
            
            .btn-primary {
                padding: 0.6rem 1.25rem;
                font-size: 0.9rem;
            }
            
            .btn-primary svg {
                width: 16px;
                height: 16px;
            }
            
            .btn-primary .btn-text {
                display: none;
            }
            
            .btn-primary::after {
                content: 'WhatsApp';
                font-size: 0.85rem;
            }
            
            /* Hero Section */
            .hero {
                padding: 3rem 0 2rem;
            }
            
            .hero-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            
            .hero-text {
                text-align: center;
            }
            
            .hero h1 {
                font-size: 2.2rem;
                line-height: 1.3;
                margin-bottom: 1rem;
            }
            
            .hero p {
                font-size: 1rem;
                margin-bottom: 2rem;
            }
            
            .hero-buttons {
                flex-direction: column;
                justify-content: center;
                align-items: center;
                gap: 1rem;
            }
            
            .hero-buttons a {
                width: 100%;
                max-width: 300px;
                justify-content: center;
                text-align: center;
            }
            
            /* Hero Showcase */
            .hero-showcase {
                height: 320px;
                order: -1;
            }
            
            .showcase-item {
                width: 180px;
            }
            
            .showcase-item img,
            .showcase-placeholder {
                height: 120px;
            }
            
            .showcase-label {
                padding: 0.75rem;
                font-size: 0.8rem;
            }
            
            .showcase-item.position-1 {
                top: 0;
                left: 50%;
                transform: translateX(-50%);
            }
            
            .showcase-item.position-2 {
                top: 80px;
                right: 10px;
                left: auto;
            }
            
            .showcase-item.position-3 {
                bottom: 10px;
                left: 10px;
            }
            
            /* Services Section */
            .services {
                padding: 4rem 0;
            }
            
            .section-title {
                font-size: 2rem;
                margin-bottom: 0.75rem;
            }
            
            .section-subtitle {
                font-size: 1rem;
                margin-bottom: 3rem;
            }
            
            .services-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            
            .service-card {
                padding: 2rem;
            }
            
            .service-icon {
                font-size: 2rem;
                padding: 0.75rem;
            }
            
            .service-card h3 {
                font-size: 1.3rem;
            }
            
            /* Projects Section */
            .projects {
                padding: 4rem 0;
            }
            
            .projects-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            
            .project-card {
                border-radius: 16px;
            }
            
            .project-image {
                height: 200px;
            }
            
            .project-content {
                padding: 1.5rem;
            }
            
            .project-content h3 {
                font-size: 1.3rem;
            }
            
            .project-content p {
                font-size: 0.95rem;
            }
            
            /* Contact Section */
            .contact {
                padding: 4rem 0;
            }
            
            .contact-form {
                padding: 2rem;
                border-radius: 16px;
            }
            
            .form-group input,
            .form-group textarea {
                padding: 0.85rem;
                font-size: 0.95rem;
            }
            
            /* Footer */
            footer {
                padding: 2rem 0;
            }
            
            .footer-content {
                flex-direction: column;
                text-align: center;
                gap: 1.5rem;
            }
            
            .footer-links {
                flex-direction: column;
                gap: 1rem;
            }
            
            /* WhatsApp Float */
            .whatsapp-float {
                width: 50px;
                height: 50px;
                bottom: 20px;
                right: 20px;
            }
            
            .whatsapp-float svg {
                width: 24px;
                height: 24px;
            }
        }
        
        /* Extra Small Mobile */
        @media (max-width: 480px) {
            .hero h1 {
                font-size: 1.8rem;
            }
            
            .hero p {
                font-size: 0.95rem;
            }
            
            .hero-showcase {
                height: 280px;
            }
            
            .showcase-item {
                width: 150px;
            }
            
            .showcase-item img,
            .showcase-placeholder {
                height: 100px;
            }
            
            .showcase-label {
                padding: 0.5rem;
                font-size: 0.75rem;
            }
            
            .section-title {
                font-size: 1.75rem;
            }
            
            .service-card,
            .contact-form {
                padding: 1.5rem;
            }
            
            .btn-primary {
                padding: 0.7rem 1rem;
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="container">
            <div class="nav-content">
                <div class="logo">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: inline-block; vertical-align: middle; margin-right: 0.5rem;">
                        <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="#4A90E2"/>
                        <path d="M2 17L12 22L22 17" stroke="#4A90E2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2 12L12 17L22 12" stroke="#4A90E2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Devvidia
                </div>
                <div style="display: flex; gap: 1rem; align-items: center;">
                    <div class="language-switcher">
                        <button onclick="switchLanguage('fr')" class="lang-btn active" data-lang="fr">FR</button>
                        <button onclick="switchLanguage('en')" class="lang-btn" data-lang="en">EN</button>
                    </div>
                    <a href="https://wa.me/{{ $whatsappPhone }}?text=Bonjour%2C%20je%20souhaite%20discuter%20d%27un%20projet" class="btn-primary whatsapp-btn" target="_blank">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        <span class="btn-text" data-fr="Commencer" data-en="Get Started">Commencer</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1 class="hero-title" data-fr="Solutions<br><span class='highlight'>Logicielles</span><br>Sur Mesure pour<br>les Entreprises" data-en="Custom<br><span class='highlight'>Software</span><br>Solutions for<br>Businesses">Solutions<br><span class="highlight">Logicielles</span><br>Sur Mesure pour<br>les Entreprises</h1>
                    <p class="hero-desc" data-fr="Nous construisons des infrastructures technologiques avec des solutions logicielles créatives et d'entreprise, des services web et des outils personnalisés pour vos besoins uniques. Construisez plus intelligemment avec Devvidia." data-en="We build tech infrastructure with creative and enterprise software solutions, web services, and custom tools for your unique needs. Build smarter with Devvidia.">Nous construisons des infrastructures technologiques avec des solutions logicielles créatives et d'entreprise, des services web et des outils personnalisés pour vos besoins uniques. Construisez plus intelligemment avec Devvidia.</p>
                    <div class="hero-buttons">
                        <a href="https://wa.me/{{ $whatsappPhone }}?text=Bonjour%2C%20je%20souhaite%20discuter%20d%27un%20projet" class="btn-primary whatsapp-btn" target="_blank">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            <span class="btn-text" data-fr="Contactez-nous via WhatsApp" data-en="Contact us via WhatsApp">Contactez-nous via WhatsApp</span>
                        </a>
                    </div>
                </div>
                
                <div class="hero-showcase">
                    <div class="showcase-container">
                        @foreach($projects as $index => $project)
                        <div class="showcase-item" data-project-index="{{ $index }}">
                            @if($project->image_path)
                                <img src="{{ asset('storage/' . $project->image_path) }}" alt="{{ $project->name }}">
                            @else
                                <div class="showcase-placeholder">{{ $project->icon }}</div>
                            @endif
                            <div class="showcase-label">{{ $project->name }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services" id="services">
        <div class="container">
            <h2 class="section-title" data-fr="Nos Services" data-en="Our Services">Nos Services</h2>
            <div class="services-grid">
                @foreach($services as $service)
                <div class="service-card">
                    <div class="service-icon">{{ $service->icon }}</div>
                    <h3 class="service-title" data-fr="{{ $service->title_fr }}" data-en="{{ $service->title_en }}">{{ $service->title_fr }}</h3>
                    <p class="service-desc" data-fr="{{ $service->description_fr }}" data-en="{{ $service->description_en }}">{{ $service->description_fr }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section class="projects" id="projects">
        <div class="container">
            <h2 class="section-title" data-fr="Projets Que Nous Avons Construits" data-en="Projects We Built">Projets Que Nous Avons Construits</h2>
            <div class="projects-grid">
                @foreach($projects as $project)
                <div class="project-card">
                    <div class="project-image">
                        @if($project->image_path)
                            <img src="{{ asset('storage/' . $project->image_path) }}" alt="{{ $project->name }}">
                        @else
                            <span class="icon-fallback">{{ $project->icon }}</span>
                        @endif
                    </div>
                    <div class="project-content">
                        <h3>{{ $project->name }}</h3>
                        <p class="project-desc" data-fr="{{ $project->description_fr }}" data-en="{{ $project->description_en }}">{{ $project->description_fr }}</p>
                        <a href="https://wa.me/{{ $whatsappPhone }}?text=Bonjour%2C%20je%20suis%20intéressé%20par%20{{ urlencode($project->name) }}" class="btn-primary whatsapp-btn" target="_blank">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            <span class="btn-text" data-fr="Contactez-nous" data-en="Contact Us">Contactez-nous</span>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" id="contact">
        <div class="container">
            <h2 class="section-title" data-fr="Parlez-nous de Votre Projet" data-en="Tell Us About Your Project">Parlez-nous de Votre Projet</h2>
            <form class="contact-form" id="contactForm">
                <div class="form-group">
                    <label for="name" data-fr="Nom complet" data-en="Full Name">Nom complet</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="phone" data-fr="Numéro de téléphone" data-en="Phone Number">Numéro de téléphone</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="project_idea" data-fr="Décrivez votre idée de projet" data-en="Describe your project idea">Décrivez votre idée de projet</label>
                    <textarea id="project_idea" name="project_idea" required></textarea>
                </div>
                <button type="submit" class="btn-primary form-submit">
                    <span class="btn-text" data-fr="Soumettre" data-en="Submit">Soumettre</span>
                </button>
            </form>
            <div id="form-message" style="margin-top: 1rem; padding: 1rem; border-radius: 5px; display: none;"></div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="logo">Devvidia</div>
            </div>
            <p class="copyright">&copy; {{ date('Y') }} Devvidia. <span data-fr="Tous droits réservés" data-en="All rights reserved">Tous droits réservés</span>.</p>
        </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/{{ $whatsappPhone }}?text=Bonjour%2C%20je%20souhaite%20discuter%20d%27un%20projet" class="whatsapp-float" target="_blank">
        <svg width="30" height="30" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
    </a>

    <script>
        let currentLang = 'fr';

        // Hero Showcase Automatic Carousel
        function initHeroShowcase() {
            const showcaseItems = document.querySelectorAll('.showcase-item');
            const totalProjects = showcaseItems.length;
            
            if (totalProjects <= 3) {
                // If 3 or fewer projects, just show them all
                showcaseItems.forEach((item, index) => {
                    item.classList.add('visible');
                    item.classList.add(`position-${index + 1}`);
                });
                return;
            }
            
            let currentSet = 0; // Which set of 3 projects to show
            const positions = ['position-1', 'position-2', 'position-3'];
            
            function updateShowcase() {
                // Calculate which projects to show
                const startIndex = currentSet * 3;
                
                // Hide all items first
                showcaseItems.forEach(item => {
                    item.classList.remove('visible');
                    positions.forEach(pos => item.classList.remove(pos));
                });
                
                // Show current 3 projects
                for (let i = 0; i < 3; i++) {
                    const projectIndex = (startIndex + i) % totalProjects;
                    const item = showcaseItems[projectIndex];
                    
                    if (item) {
                        // Small delay for staggered animation
                        setTimeout(() => {
                            item.classList.add(positions[i]);
                            item.classList.add('visible');
                        }, i * 150);
                    }
                }
                
                // Move to next set
                currentSet = (currentSet + 1) % Math.ceil(totalProjects / 3);
            }
            
            // Initial display
            updateShowcase();
            
            // Auto-rotate every 5 seconds
            setInterval(updateShowcase, 5000);
        }

        function switchLanguage(lang) {
            currentLang = lang;
            
            // Update active button
            document.querySelectorAll('.lang-btn').forEach(btn => {
                btn.classList.remove('active');
                if (btn.dataset.lang === lang) {
                    btn.classList.add('active');
                }
            });

            // Update all translatable elements
            document.querySelectorAll('[data-fr][data-en]').forEach(element => {
                const isTitleElement = element.classList.contains('hero-title');
                if (isTitleElement) {
                    element.innerHTML = element.dataset[lang];
                } else {
                    element.textContent = element.dataset[lang];
                }
            });

            // Update WhatsApp links
            const frText = 'Bonjour%2C%20je%20souhaite%20discuter%20d%27un%20projet';
            const enText = 'Hello%2C%20I%20would%20like%20to%20discuss%20a%20project';
            const whatsappText = lang === 'fr' ? frText : enText;
            
            document.querySelectorAll('.whatsapp-btn').forEach(btn => {
                const currentHref = btn.getAttribute('href');
                const baseUrl = currentHref.split('?')[0];
                btn.setAttribute('href', baseUrl + '?text=' + whatsappText);
            });

            // Update floating WhatsApp button
            const floatingBtn = document.querySelector('.whatsapp-float');
            if (floatingBtn) {
                const currentHref = floatingBtn.getAttribute('href');
                const baseUrl = currentHref.split('?')[0];
                floatingBtn.setAttribute('href', baseUrl + '?text=' + whatsappText);
            }
        }

        // Handle contact form submission
        document.addEventListener('DOMContentLoaded', function() {
            switchLanguage('fr');
            
            // Initialize Hero Showcase Carousel
            initHeroShowcase();
            
            const contactForm = document.getElementById('contactForm');
            const formMessage = document.getElementById('form-message');
            
            if (contactForm) {
                contactForm.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    
                    const name = document.getElementById('name').value;
                    const phone = document.getElementById('phone').value;
                    const projectIdea = document.getElementById('project_idea').value;
                    
                    // Get CSRF token
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
                    
                    try {
                        const response = await fetch('/contact', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({
                                name: name,
                                phone: phone,
                                project_idea: projectIdea
                            })
                        });
                        
                        const data = await response.json();
                        
                        if (response.ok) {
                            // Show success message
                            formMessage.style.display = 'block';
                            formMessage.style.background = '#d4edda';
                            formMessage.style.color = '#155724';
                            formMessage.style.border = '1px solid #c3e6cb';
                            formMessage.textContent = currentLang === 'fr' 
                                ? 'Merci! Votre message a été envoyé avec succès. Nous vous contactons bientôt.'
                                : 'Thank you! Your message has been sent successfully. We will contact you soon.';
                            
                            // Reset form
                            contactForm.reset();
                            
                            // Hide message after 5 seconds
                            setTimeout(() => {
                                formMessage.style.display = 'none';
                            }, 5000);
                        } else {
                            throw new Error(data.message || 'An error occurred');
                        }
                    } catch (error) {
                        // Show error message
                        formMessage.style.display = 'block';
                        formMessage.style.background = '#f8d7da';
                        formMessage.style.color = '#721c24';
                        formMessage.style.border = '1px solid #f5c6cb';
                        formMessage.textContent = currentLang === 'fr'
                            ? 'Une erreur s\'est produite. Veuillez réessayer.'
                            : 'An error occurred. Please try again.';
                    }
                });
            }
        });
    </script>
</body>
</html>
