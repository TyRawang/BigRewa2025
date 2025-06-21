<footer class="page-footer">
    <div class="footer-main">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-6 footer-brand-section">
                    <div class="footer-brand">
                        <a class="brand-link" href="{{ route('home') }}">
                            <img src="{{ url('images/logo/logo2.png') }}" alt="Big Rewa Logo" class="footer-logo">
                        </a>
                        <p class="brand-description">
                            Empowering businesses with innovative email solutions and seamless communication tools.
                        </p>
                        <div class="social-links">
                            <a href="#" class="social-link">
                                <i class="fa fa-facebook"></i>
                            </a>
                            <a href="#" class="social-link">
                                <i class="fa fa-twitter"></i>
                            </a>
                            <a href="#" class="social-link">
                                <i class="fa fa-linkedin"></i>
                            </a>
                            <a href="#" class="social-link">
                                <i class="fa fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 col-lg-3 footer-links-section">
                    <h5 class="footer-title">Quick Links</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('about_us') }}">About Us</a></li>
                        <li><a href="{{ route('testimonial') }}">Testimonial</a></li>
                        <li><a href="{{ route('faq') }}">FAQ</a></li>
                    </ul>
                </div>
                
                <div class="col-md-3 col-lg-3 footer-links-section">
                    <h5 class="footer-title">Support</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('privacy_policy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('contact_us') }}">Contact Us</a></li>
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Help Center</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="copyright-text">
                        © 2025 <a href="{{ route('home') }}" class="brand-link-inline">BigRewa.com</a> - All rights reserved
                    </p>
                </div>
                <div class="col-md-6 text-md-right">
                    <p class="powered-by">
                        <!-- Made with <span class="heart">❤️</span> for better communication -->
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
/* Ensure the body and html take full height */
html, body {
    height: 100%;
    margin: 0;
    padding: 0;
}

/* Main wrapper to push footer down */
.main-wrapper {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

/* Content area should grow to fill available space */
.content-wrapper {
    flex: 1;
}

.page-footer {
    background: linear-gradient(135deg, #2c3e50 0%, #3498db 50%, #9b59b6 100%);
    color: white;
    position: relative;
    overflow: hidden;
    margin-top: auto; /* This pushes footer to bottom */
}

.page-footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
    pointer-events: none;
}

.footer-main {
    padding: 60px 0 40px;
    position: relative;
    z-index: 1;
}

.footer-brand-section {
    margin-bottom: 30px;
}

.footer-brand {
    max-width: 400px;
}

.brand-link {
    display: inline-block;
    margin-bottom: 20px;
    transition: transform 0.3s ease;
}

.brand-link:hover {
    transform: scale(1.05);
}

.footer-logo {
    max-height: 60px;
    width: auto;
    filter: brightness(1.1) drop-shadow(0 2px 8px rgba(0, 0, 0, 0.3));
}

.brand-description {
    color: rgba(255, 255, 255, 0.9);
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 25px;
    font-weight: 400;
}

.social-links {
    display: flex;
    gap: 15px;
}

.social-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    color: white;
    text-decoration: none;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.social-link:hover {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    text-decoration: none;
}

.footer-links-section {
    margin-bottom: 30px;
}

.footer-title {
    color: white;
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 25px;
    text-transform: uppercase;
    letter-spacing: 1px;
    position: relative;
    padding-bottom: 10px;
}

.footer-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 40px;
    height: 3px;
    background: linear-gradient(135deg, #fff 0%, rgba(255, 255, 255, 0.6) 100%);
    border-radius: 2px;
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 12px;
}

.footer-links a {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.3s ease;
    position: relative;
    padding-left: 0;
}

.footer-links a::before {
    content: '→';
    position: absolute;
    left: -20px;
    opacity: 0;
    transition: all 0.3s ease;
    color: #3498db;
}

.footer-links a:hover {
    color: white;
    text-decoration: none;
    padding-left: 25px;
    transform: translateX(5px);
}

.footer-links a:hover::before {
    opacity: 1;
    left: 0;
}

.footer-bottom {
    background: rgba(0, 0, 0, 0.2);
    padding: 25px 0;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    position: relative;
    z-index: 1;
}

.copyright-text {
    margin: 0;
    color: rgba(255, 255, 255, 0.8);
    font-size: 14px;
    font-weight: 400;
}

.brand-link-inline {
    color: white;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.brand-link-inline:hover {
    color: #3498db;
    text-decoration: none;
}

.powered-by {
    margin: 0;
    color: rgba(255, 255, 255, 0.8);
    font-size: 14px;
    font-weight: 400;
}

.heart {
    color: #e74c3c;
    animation: heartbeat 1.5s ease-in-out infinite;
    display: inline-block;
}

@keyframes heartbeat {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

/* Responsive Design */
@media (max-width: 768px) {
    .footer-main {
        padding: 40px 0 30px;
    }
    
    .footer-brand-section,
    .footer-links-section {
        text-align: center;
        margin-bottom: 40px;
    }
    
    .footer-brand {
        max-width: 100%;
    }
    
    .social-links {
        justify-content: center;
    }
    
    .footer-bottom .col-md-6 {
        text-align: center !important;
        margin-bottom: 15px;
    }
    
    .footer-bottom .col-md-6:last-child {
        margin-bottom: 0;
    }
    
    .footer-links a:hover {
        padding-left: 0;
        transform: none;
    }
    
    .footer-links a::before {
        display: none;
    }
}

@media (max-width: 576px) {
    .footer-main {
        padding: 30px 0 20px;
    }
    
    .footer-title {
        font-size: 16px;
        margin-bottom: 20px;
    }
    
    .brand-description {
        font-size: 13px;
    }
    
    .social-link {
        width: 35px;
        height: 35px;
        font-size: 14px;
    }
    
    .footer-bottom {
        padding: 20px 0;
    }
    
    .copyright-text,
    .powered-by {
        font-size: 13px;
    }
}

/* Smooth animations */
* {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

.page-footer * {
    transition: all 0.3s ease;
}
</style>