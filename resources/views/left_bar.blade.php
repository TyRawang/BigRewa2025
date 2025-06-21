<style>
    .sidebar-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        border: none;
        margin-bottom: 30px;
        min-height: calc(100vh - 140px);
        position: sticky;
        top: 20px;
        overflow: hidden;
    }
    
    .sidebar-header {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        padding: 25px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .sidebar-title {
        color: white;
        font-size: 1.4rem;
        font-weight: 700;
        margin: 0;
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 1px;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }
    
    .sidebar-nav {
        padding: 20px 0;
    }
    
    .nav-item {
        margin-bottom: 8px;
        padding: 0 15px;
    }
    
    .nav-link {
        display: flex;
        align-items: center;
        padding: 15px 20px;
        text-decoration: none;
        color: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        transition: all 0.3s ease;
        font-weight: 500;
        font-size: 14px;
        letter-spacing: 0.5px;
        position: relative;
        overflow: hidden;
        border: 1px solid transparent;
    }
    
    .nav-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        transition: left 0.5s ease;
    }
    
    .nav-link:hover::before {
        left: 100%;
    }
    
    .nav-link:hover {
        background: rgba(255, 255, 255, 0.15);
        color: white;
        text-decoration: none;
        transform: translateX(5px);
        border-color: rgba(255, 255, 255, 0.3);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    
    .nav-link.active {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border-color: rgba(255, 255, 255, 0.4);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }
    
    .nav-icon {
        width: 20px;
        height: 20px;
        margin-right: 15px;
        flex-shrink: 0;
        fill: currentColor;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        transition: all 0.3s ease;
    }
    
    .nav-link:hover .nav-icon {
        transform: scale(1.1);
        filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.2));
    }
    
    .nav-text {
        font-weight: 600;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }
    
    .sidebar-footer {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 20px;
        background: rgba(0, 0, 0, 0.1);
        border-top: 1px solid rgba(255, 255, 255, 0.2);
        text-align: center;
    }
    
    .sidebar-footer-text {
        color: rgba(255, 255, 255, 0.7);
        font-size: 12px;
        margin: 0;
        font-weight: 500;
    }
    
    @media (max-width: 768px) {
        .sidebar-container {
            margin-bottom: 20px;
            min-height: auto;
            position: relative;
            top: 0;
        }
        
        .sidebar-nav {
            padding: 15px 0;
        }
        
        .nav-item {
            margin-bottom: 5px;
            padding: 0 10px;
        }
        
        .nav-link {
            padding: 12px 15px;
            font-size: 13px;
        }
        
        .nav-icon {
            width: 18px;
            height: 18px;
            margin-right: 12px;
        }
        
        .sidebar-header {
            padding: 20px 15px;
        }
        
        .sidebar-title {
            font-size: 1.2rem;
        }
    }
    
    /* Smooth scrollbar for sidebar */
    .sidebar-container {
        scrollbar-width: thin;
        scrollbar-color: rgba(255, 255, 255, 0.3) transparent;
    }
    
    .sidebar-container::-webkit-scrollbar {
        width: 6px;
    }
    
    .sidebar-container::-webkit-scrollbar-track {
        background: transparent;
    }
    
    .sidebar-container::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.3);
        border-radius: 3px;
    }
    
    .sidebar-container::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.5);
    }
</style>

<div class="col-md-3">
    <div class="sidebar-container">
        <div class="sidebar-header">
            <h3 class="sidebar-title">⚙️ Settings</h3>
        </div>
        
        <nav class="sidebar-nav">
            <div class="nav-section">
                <!-- <h3 class="sidebar-title">⚙️ Settings</h3> -->
                
                <!-- Profile Settings -->
                <!-- <a class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.edit') }}">
                    <div class="nav-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M20.5899 22C20.5899 18.13 16.7399 15 11.9999 15C7.25991 15 3.40991 18.13 3.40991 22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <span class="nav-text">Profile</span>
                </a> -->
                
                <!-- Security Settings -->
                <a class="nav-link {{ request()->routeIs('password.*') ? 'active' : '' }}" href="{{ route('password.edit') }}">
                    <div class="nav-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2" stroke="currentColor" stroke-width="2"/>
                            <circle cx="12" cy="16" r="1" fill="currentColor"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </div>
                    <span class="nav-text">Security</span>
                </a>
                
                <!-- SMTP Settings -->
                <a class="nav-link {{ request()->is('smtp-configure') ? 'active' : '' }}" href="{{ url('smtp-configure') }}">
                    <div class="nav-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" stroke="currentColor" stroke-width="2"/>
                            <polyline points="22,6 12,13 2,6" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </div>
                    <span class="nav-text">SMTP Settings</span>
                </a>
                
                <!-- Company Info -->
                <a class="nav-link {{ request()->is('company-info') ? 'active' : '' }}" href="{{ url('company-info') }}">
                    <div class="nav-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 21V5a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </div>
                    <span class="nav-text">Company Info</span>
                </a>
                
                <!-- Extra Fields -->
                <a class="nav-link {{ request()->is('extra-mail-field') ? 'active' : '' }}" href="{{ url('extra-mail-field') }}">
                    <div class="nav-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2" stroke="currentColor" stroke-width="2"/>
                            <line x1="9" y1="9" x2="15" y2="9" stroke="currentColor" stroke-width="2"/>
                            <line x1="9" y1="15" x2="15" y2="15" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </div>
                    <span class="nav-text">Extra Fields</span>
                </a>
                
                <!-- Email Templates -->
                <!-- <a class="nav-link {{ request()->is('email-template') ? 'active' : '' }}" href="{{ url('email-template') }}">
                    <div class="nav-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" stroke="currentColor" stroke-width="2"/>
                            <polyline points="14,2 14,8 20,8" stroke="currentColor" stroke-width="2"/>
                            <line x1="16" y1="13" x2="8" y2="13" stroke="currentColor" stroke-width="2"/>
                            <line x1="16" y1="17" x2="8" y2="17" stroke="currentColor" stroke-width="2"/>
                            <polyline points="10,9 9,9 8,9" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </div>
                    <span class="nav-text">Email Templates</span>
                </a> -->
            </div>
        </nav>
        
        <div class="sidebar-footer">
            <p class="sidebar-footer-text">BigRewa Settings Panel</p>
        </div>
    </div>
</div>