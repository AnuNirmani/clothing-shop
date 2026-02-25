import React, { useEffect, useRef, useState } from 'react';
import { Link } from 'react-router-dom';
import Header from '../components/Header';
import Footer from '../components/Footer';

const LoginPage = () => {
    const bottomRef = useRef(null);
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [showPassword, setShowPassword] = useState(false);
    const [focusedField, setFocusedField] = useState(null);
    const [isLoading, setIsLoading] = useState(false);

    useEffect(() => {
        const t = setTimeout(() => {
            bottomRef.current?.scrollIntoView({ behavior: 'smooth', block: 'end' });
        }, 800);
        return () => clearTimeout(t);
    }, []);

    const handleSubmit = async (e) => {
        e.preventDefault();
        setIsLoading(true);
        // Simulate API call
        setTimeout(() => {
            setIsLoading(false);
            alert('Login functionality would be implemented here');
        }, 1500);
    };

    return (
        <div className="min-h-screen bg-gradient-to-br from-white via-purple-50/10 to-white font-sans text-gray-800 overflow-hidden">
            <style>{`
                @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap');

                * {
                    font-family: 'Poppins', sans-serif;
                }

                h1, h2, h3, h4, h5, h6 {
                    font-family: 'Playfair Display', serif;
                }

                .fade-in {
                    animation: fadeInUp 0.6s ease-out forwards;
                    opacity: 0;
                }

                @keyframes fadeInUp {
                    from {
                        opacity: 0;
                        transform: translateY(30px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                @keyframes slideInDown {
                    from {
                        opacity: 0;
                        transform: translateY(-30px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                @keyframes float {
                    0%, 100% { transform: translateY(0px); }
                    50% { transform: translateY(-20px); }
                }

                @keyframes pulse-glow {
                    0%, 100% {
                        box-shadow: 0 0 20px rgba(139, 92, 246, 0.1);
                    }
                    50% {
                        box-shadow: 0 0 40px rgba(139, 92, 246, 0.3);
                    }
                }

                .smooth-transition {
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                }

                .gradient-text {
                    background: linear-gradient(135deg, #d4a574 0%, #8b5cf6 50%, #ec4899 100%);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    background-clip: text;
                }

                .form-input {
                    width: 100%;
                    padding: 16px 20px;
                    border: 2px solid rgba(139, 92, 246, 0.1);
                    border-radius: 12px;
                    font-size: 16px;
                    background: white;
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    position: relative;
                    z-index: 1;
                }

                .form-input:focus {
                    outline: none;
                    border-color: #8b5cf6;
                    box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
                    background: rgba(255, 255, 255, 0.95);
                }

                .form-input::placeholder {
                    color: #d1d5db;
                }

                .form-group {
                    position: relative;
                    animation: fadeInUp 0.6s ease-out forwards;
                    opacity: 0;
                }

                .form-group:nth-child(1) { animation-delay: 0.3s; }
                .form-group:nth-child(2) { animation-delay: 0.4s; }

                .input-icon {
                    position: absolute;
                    right: 16px;
                    top: 50%;
                    transform: translateY(-50%);
                    color: #9ca3af;
                    pointer-events: none;
                    z-index: 0;
                }

                .input-icon.clickable {
                    cursor: pointer;
                    pointer-events: all;
                    color: #8b5cf6;
                    transition: all 0.3s ease;
                }

                .input-icon.clickable:hover {
                    color: #ec4899;
                    transform: translateY(-50%) scale(1.1);
                }

                .premium-btn {
                    background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
                    position: relative;
                    overflow: hidden;
                    border: none;
                    padding: 16px 32px;
                    border-radius: 12px;
                    color: white;
                    font-weight: 700;
                    cursor: pointer;
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    font-size: 16px;
                    box-shadow: 0 8px 20px rgba(139, 92, 246, 0.3);
                }

                .premium-btn::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: -100%;
                    width: 100%;
                    height: 100%;
                    background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 100%);
                    transition: left 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                    z-index: -1;
                }

                .premium-btn:hover::before {
                    left: 0;
                }

                .premium-btn:hover {
                    transform: translateY(-3px);
                    box-shadow: 0 15px 40px rgba(139, 92, 246, 0.4);
                }

                .premium-btn:active {
                    transform: translateY(-1px);
                }

                .premium-btn.loading {
                    opacity: 0.8;
                    pointer-events: none;
                }

                .loader {
                    border: 3px solid rgba(255, 255, 255, 0.3);
                    border-top: 3px solid white;
                    border-radius: 50%;
                    width: 20px;
                    height: 20px;
                    animation: spin 1s linear infinite;
                    display: inline-block;
                    margin-right: 8px;
                }

                @keyframes spin {
                    0% { transform: rotate(0deg); }
                    100% { transform: rotate(360deg); }
                }

                .background-orb {
                    position: absolute;
                    border-radius: 50%;
                    mix-blend-mode: screen;
                    filter: blur(60px);
                    opacity: 0.3;
                    animation: float 6s ease-in-out infinite;
                }

                .background-orb.pink {
                    width: 400px;
                    height: 400px;
                    background: radial-gradient(circle, #ec4899, transparent);
                    top: -100px;
                    right: -100px;
                }

                .background-orb.purple {
                    width: 500px;
                    height: 500px;
                    background: radial-gradient(circle, #8b5cf6, transparent);
                    bottom: -200px;
                    left: -100px;
                    animation-delay: 2s;
                }

                .divider-line {
                    height: 1px;
                    background: linear-gradient(90deg, transparent, rgba(139, 92, 246, 0.3), transparent);
                    margin: 32px 0;
                    animation: fadeInUp 0.8s ease-out;
                }

                .signup-link {
                    color: #8b5cf6;
                    font-weight: 600;
                    transition: all 0.3s ease;
                    position: relative;
                    text-decoration: none;
                }

                .signup-link::after {
                    content: '';
                    position: absolute;
                    bottom: -2px;
                    left: 0;
                    width: 0;
                    height: 2px;
                    background: linear-gradient(90deg, #8b5cf6, #ec4899);
                    transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                }

                .signup-link:hover {
                    color: #ec4899;
                }

                .signup-link:hover::after {
                    width: 100%;
                }

                .breadcrumb-link {
                    color: #8b5cf6;
                    transition: all 0.3s ease;
                    text-decoration: none;
                    position: relative;
                }

                .breadcrumb-link::after {
                    content: '';
                    position: absolute;
                    bottom: -2px;
                    left: 0;
                    width: 0;
                    height: 1px;
                    background: #8b5cf6;
                    transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                }

                .breadcrumb-link:hover::after {
                    width: 100%;
                }

                .heading-underline {
                    width: 60px;
                    height: 4px;
                    background: linear-gradient(90deg, #8b5cf6, #ec4899, #d4a574);
                    border-radius: 2px;
                    margin-top: 12px;
                    animation: fadeInUp 0.8s ease-out;
                }

                .form-container {
                    background: white;
                    border-radius: 20px;
                    padding: 48px 40px;
                    border: 1px solid rgba(139, 92, 246, 0.1);
                    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.06);
                    animation: fadeInUp 0.6s ease-out;
                    animation-delay: 0.2s;
                    backdrop-filter: blur(10px);
                }

                .form-container:hover {
                    border-color: rgba(139, 92, 246, 0.2);
                    box-shadow: 0 15px 50px rgba(139, 92, 246, 0.1);
                    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                }

                .forgot-password {
                    display: flex;
                    justify-content: flex-end;
                    margin-bottom: 24px;
                }

                .forgot-password-link {
                    color: #6b7280;
                    text-decoration: none;
                    font-size: 14px;
                    font-weight: 500;
                    transition: all 0.3s ease;
                    position: relative;
                }

                .forgot-password-link::after {
                    content: '';
                    position: absolute;
                    bottom: -2px;
                    left: 0;
                    width: 0;
                    height: 1px;
                    background: #8b5cf6;
                    transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                }

                .forgot-password-link:hover {
                    color: #8b5cf6;
                }

                .forgot-password-link:hover::after {
                    width: 100%;
                }

                .no-scrollbar::-webkit-scrollbar { display: none; }
                .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
            `}</style>

            <Header />

            <main className="py-16">

                {/* Login Form Section */}
                <div className="max-w-md mx-auto">
                    {/* Subheading */}
                    <div className="mb-12 fade-in" style={{animationDelay: '0.15s'}}>
                        <h2 className="text-3xl font-bold mb-3 text-center gradient-text">Sign In</h2>
                        <p className="text-gray-600 text-lg">Access your personalized shopping experience</p>
                    </div>

                    {/* Form Container */}
                    <form className="form-container" onSubmit={handleSubmit}>
                        {/* Email Field */}
                        <div className="form-group">
                            <label className="block text-sm font-semibold text-gray-700 mb-3 uppercase tracking-wider">Email Address</label>
                            <div className="relative">
                                <input
                                    type="email"
                                    placeholder="you@example.com"
                                    value={email}
                                    onChange={(e) => setEmail(e.target.value)}
                                    onFocus={() => setFocusedField('email')}
                                    onBlur={() => setFocusedField(null)}
                                    className="form-input"
                                    required
                                />
                                <div className={`input-icon ${focusedField === 'email' ? 'text-purple-600' : ''}`}>
                                    <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        {/* Password Field */}
                        <div className="form-group mt-6">
                            <label className="block text-sm font-semibold text-gray-700 mb-3 uppercase tracking-wider">Password</label>
                            <div className="relative">
                                <input
                                    type={showPassword ? "text" : "password"}
                                    placeholder="••••••••"
                                    value={password}
                                    onChange={(e) => setPassword(e.target.value)}
                                    onFocus={() => setFocusedField('password')}
                                    onBlur={() => setFocusedField(null)}
                                    className="form-input"
                                    required
                                />
                                <button
                                    type="button"
                                    onClick={() => setShowPassword(!showPassword)}
                                    className="input-icon clickable pr-4"
                                >
                                    {showPassword ? (
                                        <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-4.803m5.596-3.856a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    ) : (
                                        <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    )}
                                </button>
                            </div>
                        </div>

                        {/* Forgot Password & Remember */}
                        <div className="forgot-password mt-6">
                            <a href="#" className="forgot-password-link">Forgot password?</a>
                        </div>

                        {/* Submit Button */}
                        <button
                            type="submit"
                            disabled={isLoading}
                            className={`premium-btn w-full flex items-center justify-center font-bold text-lg mt-8 ${isLoading ? 'loading' : ''}`}
                        >
                            {isLoading && <div className="loader"></div>}
                            {isLoading ? 'Signing in...' : 'Create Account'}
                        </button>
                    </form>

                    {/* Divider */}
                    <div className="divider-line"></div>

                    {/* Additional Info */}
                    <div className="mt-12 p-6 bg-gradient-to-br from-purple-50 to-pink-50 rounded-16px border border-purple-100 fade-in" style={{animationDelay: '0.6s'}}>
                        <div className="flex gap-4">
                            <div className="flex-shrink-0">
                                <svg className="w-6 h-6 text-purple-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 className="font-semibold text-gray-900 mb-1">Secure Login</h3>
                                <p className="text-sm text-gray-600">Your account is protected with industry-standard encryption</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div ref={bottomRef} className="h-4" />
            </main>

            <Footer />
        </div>
    );
};

export default LoginPage;