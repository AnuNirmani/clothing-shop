import React, { useState } from 'react';

const Footer = () => {
  const [email, setEmail] = useState('');
  const [subscribeMessage, setSubscribeMessage] = useState('');

  const handleSubscribe = (e) => {
    e.preventDefault();
    if (email) {
      setSubscribeMessage('Thank you for subscribing!');
      setEmail('');
      setTimeout(() => setSubscribeMessage(''), 3000);
    }
  };

  return (
    <footer className="w-full bg-gradient-to-b from-white via-slate-50 to-slate-900 text-gray-800">
      <style>{`
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap');

        .footer-smooth {
          transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .footer-link {
          position: relative;
          transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
          display: inline-block;
        }

        .footer-link::before {
          content: '';
          position: absolute;
          bottom: -2px;
          left: 0;
          width: 0;
          height: 2px;
          background: linear-gradient(90deg, #ec4899, #8b5cf6);
          transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .footer-link:hover::before {
          width: 100%;
        }

        .footer-link:hover {
          color: #ec4899;
        }

        .social-icon {
          position: relative;
          transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
          overflow: hidden;
        }

        .social-icon:hover {
          transform: translateY(-4px);
          box-shadow: 0 8px 16px rgba(236, 72, 153, 0.3);
        }

        .social-icon::before {
          content: '';
          position: absolute;
          top: 0;
          left: -100%;
          width: 100%;
          height: 100%;
          background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 50%, #d4a574 100%);
          transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
          z-index: -1;
        }

        .social-icon:hover::before {
          left: 0;
        }

        .social-icon:hover {
          color: white;
          border-color: transparent;
        }

        .newsletter-input {
          background: rgba(255, 255, 255, 0.9);
          border: 2px solid rgba(236, 72, 153, 0.2);
          transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
          position: relative;
        }

        .newsletter-input:focus {
          border-color: #ec4899;
          box-shadow: 0 0 20px rgba(236, 72, 153, 0.2);
          outline: none;
        }

        .newsletter-button {
          background: linear-gradient(135deg, #d4a574 0%, #8b5cf6 50%, #ec4899 100%);
          position: relative;
          overflow: hidden;
          transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .newsletter-button::before {
          content: '';
          position: absolute;
          top: 0;
          left: -100%;
          width: 100%;
          height: 100%;
          background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 50%, #d4a574 100%);
          transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
          z-index: -1;
        }

        .newsletter-button:hover::before {
          left: 0;
        }

        .newsletter-button:hover {
          transform: translateY(-2px);
          box-shadow: 0 12px 24px rgba(236, 72, 153, 0.3);
        }

        .payment-badge {
          display: inline-block;
          padding: 6px 12px;
          border-radius: 6px;
          font-size: 12px;
          font-weight: 600;
          letter-spacing: 0.5px;
          transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
          position: relative;
          overflow: hidden;
        }

        .payment-badge:hover {
          transform: scale(1.05);
          box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .fade-in-up {
          animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
          from {
            opacity: 0;
            transform: translateY(20px);
          }
          to {
            opacity: 1;
            transform: translateY(0);
          }
        }

        .stagger-item {
          animation: fadeInUp 0.6s ease-out;
        }

        .stagger-item:nth-child(1) { animation-delay: 0.1s; }
        .stagger-item:nth-child(2) { animation-delay: 0.2s; }
        .stagger-item:nth-child(3) { animation-delay: 0.3s; }
        .stagger-item:nth-child(4) { animation-delay: 0.4s; }
        .stagger-item:nth-child(5) { animation-delay: 0.5s; }

        .divider-gradient {
          background: linear-gradient(90deg, transparent, #ec4899, transparent);
          height: 1px;
        }
      `}</style>

      {/* Newsletter Section - Premium */}
      <div className="relative overflow-hidden bg-gradient-to-r from-purple-200 via-pink-100 to-purple-200 px-4 sm:px-6 lg:px-8 py-20">
        {/* Background Pattern */}
        <div className="absolute inset-0 opacity-10">
          <div className="absolute inset-0" style={{
            backgroundImage: 'radial-gradient(circle at 20% 50%, #fff 1px, transparent 1px)',
            backgroundSize: '50px 50px'
          }}></div>
        </div>

        <div className="relative max-w-4xl mx-auto text-center">
          <h3 className="fade-in-up text-gray-900 text-4xl md:text-5xl font-bold mb-4" style={{ fontFamily: 'Playfair Display' }}>
            Stay Updated with Aura Edit
          </h3>
          <p className="fade-in-up text-gray-700 text-lg mb-10 max-w-2xl mx-auto" style={{ animationDelay: '0.1s' }}>
            Subscribe to get exclusive offers, new arrivals, and fashion tips delivered to your inbox.
          </p>

          {/* Input + Button */}
          <form onSubmit={handleSubscribe} className="fade-in-up flex flex-col sm:flex-row gap-4 max-w-2xl mx-auto" style={{ animationDelay: '0.2s' }}>
            <input
              type="email"
              placeholder="Enter your email address..."
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              className="newsletter-input flex-1 px-6 py-4 rounded-lg text-gray-800 placeholder-gray-500 font-medium"
              required
            />
            <button
              type="submit"
              className="newsletter-button px-8 py-4 text-white font-bold rounded-lg whitespace-nowrap text-lg"
            >
              Subscribe Now
            </button>
          </form>

          {subscribeMessage && (
            <p className="text-white mt-4 font-semibold animate-pulse">{subscribeMessage}</p>
          )}
        </div>
      </div>

      {/* Divider */}
      <div className="divider-gradient"></div>

      {/* Main Footer Content */}
      <div className="px-4 sm:px-6 lg:px-8 py-20 bg-gradient-to-b from-slate-50 to-slate-100">
        <div className="max-w-7xl mx-auto">
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-12 mb-16">
            {/* Brand Section */}
            <div className="lg:col-span-2 stagger-item">
              <div className="mb-6">
                <h3 className="text-3xl md:text-4xl font-bold text-gray-900 mb-2" style={{ fontFamily: 'Playfair Display' }}>
                  AURA EDIT
                </h3>
                <div className="w-12 h-1 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full"></div>
              </div>
              <p className="text-gray-700 leading-relaxed mb-6">
                Welcome to Aura Edit – your destination for curated fashion pieces that celebrate individuality and style. Reserve your signature look today.
              </p>

              {/* Contact Info */}
              <div className="space-y-3 mb-8">
                <div className="flex items-center gap-3">
                  <div className="w-10 h-10 rounded-full bg-gradient-to-br from-purple-600 to-pink-600 flex items-center justify-center text-white flex-shrink-0">
                    <svg className="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.9.33 1.77.62 2.6a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.48-1.19a2 2 0 0 1 2.11-.45c.83.29 1.7.5 2.6.62A2 2 0 0 1 22 16.92z" />
                    </svg>
                  </div>
                  <div>
                    <p className="text-gray-600 text-sm">Phone</p>
                    <a href="tel:+94784467094" className="footer-link text-gray-900 font-semibold">+94 78 446 7094</a>
                  </div>
                </div>
                <div className="flex items-center gap-3">
                  <div className="w-10 h-10 rounded-full bg-gradient-to-br from-pink-600 to-purple-600 flex items-center justify-center text-white flex-shrink-0">
                    <svg className="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                      <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                  </div>
                  <div>
                    <p className="text-gray-600 text-sm">Email</p>
                    <a href="mailto:online@auraedit.lk" className="footer-link text-gray-900 font-semibold">online@auraedit.lk</a>
                  </div>
                </div>
              </div>

              {/* Social Icons */}
              <div className="flex items-center gap-3 flex-wrap">
                <span className="text-sm font-semibold text-gray-700 mr-2">Follow us:</span>
                <a
                  href="https://web.facebook.com/auraedit"
                  target="_blank"
                  rel="noopener noreferrer"
                  className="social-icon inline-flex h-10 w-10 items-center justify-center rounded-full border border-purple-600 bg-white text-purple-600 font-bold"
                  aria-label="Facebook"
                  title="Facebook"
                >
                  <svg className="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5c-.563-.074-1.882-.16-3.7-.16-3.738 0-6.297 2.28-6.297 6.467V8z" />
                  </svg>
                </a>

                <a
                  href="https://www.instagram.com/auraedit_selection"
                  target="_blank"
                  rel="noopener noreferrer"
                  className="social-icon inline-flex h-10 w-10 items-center justify-center rounded-full border border-purple-600 bg-white text-purple-600 font-bold"
                  aria-label="Instagram"
                  title="Instagram"
                >
                  <svg className="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                  </svg>
                </a>

                <a
                  href="https://wa.me/94707788688"
                  target="_blank"
                  rel="noopener noreferrer"
                  className="social-icon inline-flex h-10 w-10 items-center justify-center rounded-full border border-purple-600 bg-white text-purple-600 font-bold"
                  aria-label="WhatsApp"
                  title="WhatsApp"
                >
                  <svg className="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M18.364 5.636A9 9 0 0 0 4.468 16.804L3 21l4.343-1.397A9 9 0 1 0 18.364 5.636zm-6.36 14.364a6.96 6.96 0 0 1-3.551-.969l-.255-.151-2.577.829.842-2.51-.166-.258A6.965 6.965 0 1 1 12.003 20zm3.828-5.237c-.21-.105-1.24-.612-1.432-.682-.192-.07-.332-.105-.472.105-.14.21-.542.682-.665.822-.122.14-.245.157-.455.052-.21-.105-.887-.327-1.69-1.043-.625-.557-1.047-1.246-1.17-1.456-.122-.21-.013-.323.092-.427.095-.095.21-.245.315-.367.105-.123.14-.21.21-.35.07-.14.035-.262-.018-.367-.052-.105-.472-1.14-.647-1.56-.17-.409-.344-.354-.472-.36l-.402-.007a.77.77 0 0 0-.56.262c-.192.21-.735.717-.735 1.748s.752 2.028.857 2.168c.105.14 1.479 2.257 3.583 3.164.5.216.89.345 1.194.441.502.16.958.137 1.319.083.402-.06 1.24-.507 1.415-.997.175-.49.175-.91.122-.997-.052-.088-.192-.14-.402-.245z" />
                  </svg>
                </a>

                <a
                  href="https://www.tiktok.com/@auraedit"
                  target="_blank"
                  rel="noopener noreferrer"
                  className="social-icon inline-flex h-10 w-10 items-center justify-center rounded-full border border-purple-600 bg-white text-purple-600 font-bold"
                  aria-label="TikTok"
                  title="TikTok"
                >
                  <svg className="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M19.589 6.686a4.793 4.793 0 0 1-3.77-4.253V2h-3.45v13.672a2.896 2.896 0 0 1-5.201 1.743 2.893 2.893 0 0 1 2.31-4.642 2.914 2.914 0 0 1 .88.13V9.4a6.834 6.834 0 0 0-1-.072A6.003 6.003 0 0 0 3.36 15.33a6 6 0 1 0 10.86-3.43V8.687a8.258 8.258 0 0 0 4.83 1.56V6.686h-.001z" />
                  </svg>
                </a>
              </div>
            </div>

            {/* Quick Links */}
            <div className="stagger-item">
              <h4 className="text-lg font-bold text-gray-900 mb-6 pb-3 border-b-2 border-pink-600">
                Quick Links
              </h4>
              <ul className="space-y-3">
                <li><a href="#" className="footer-link text-gray-700">New Arrivals</a></li>
                <li><a href="#" className="footer-link text-gray-700">Office Wear</a></li>
                <li><a href="#" className="footer-link text-gray-700">Party Wear</a></li>
                <li><a href="#" className="footer-link text-gray-700">Accessories</a></li>
                <li><a href="#" className="footer-link text-gray-700">Sale Items</a></li>
              </ul>
            </div>

            {/* Policies */}
            <div className="stagger-item">
              <h4 className="text-lg font-bold text-gray-900 mb-6 pb-3 border-b-2 border-purple-600">
                Policies
              </h4>
              <ul className="space-y-3">
                <li><a href="#" className="footer-link text-gray-700">Returns & Exchange</a></li>
                <li><a href="#" className="footer-link text-gray-700">Privacy Policy</a></li>
                <li><a href="#" className="footer-link text-gray-700">Terms & Conditions</a></li>
                <li><a href="#" className="footer-link text-gray-700">Shipping Info</a></li>
                <li><a href="#" className="footer-link text-gray-700">FAQs</a></li>
              </ul>
            </div>

            {/* Account */}
            <div className="stagger-item">
              <h4 className="text-lg font-bold text-gray-900 mb-6 pb-3 border-b-2 border-pink-600">
                Account
              </h4>
              <ul className="space-y-3">
                <li><a href="#" className="footer-link text-gray-700">My Account</a></li>
                <li><a href="#" className="footer-link text-gray-700">Order History</a></li>
                <li><a href="#" className="footer-link text-gray-700">Wishlist</a></li>
                <li><a href="#" className="footer-link text-gray-700">Track Order</a></li>
                <li><a href="#" className="footer-link text-gray-700">Contact Support</a></li>
              </ul>
            </div>
          </div>

          {/* Divider */}
          <div className="divider-gradient mb-8"></div>

          {/* Payment Methods & Bottom Info */}
          <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
            {/* Payment Methods */}
            <div className="stagger-item">
              <h4 className="text-lg font-bold text-gray-900 mb-4">We Accept</h4>
              <div className="flex flex-wrap gap-3">
                <span className="payment-badge bg-green-100 text-green-800">💳 CASH ON DELIVERY</span>
                <span className="payment-badge bg-red-100 text-red-800">🏦 BANK DEPOSIT</span>
                <span className="payment-badge bg-blue-100 text-blue-800">💳 VISA</span>
                <span className="payment-badge bg-amber-100 text-amber-800">💳 MASTERCARD</span>
                <span className="payment-badge bg-purple-100 text-purple-800">💳 KOKO</span>
                <span className="payment-badge bg-indigo-100 text-indigo-800">💳 PAYZY</span>
              </div>
            </div>

            {/* Copyright & Credits */}
            <div className="stagger-item text-right">
              <p className="text-gray-600 mb-2">
                © 2024 <span className="font-bold text-gray-900">auraedit.lk</span>
              </p>
              <p className="text-sm text-gray-500">
                Crafted with 💜 by <span className="font-semibold text-gray-700">LankaOpenSoft</span>
              </p>
              <p className="text-xs text-gray-400 mt-2">0784467094</p>
              <p className="text-xs text-gray-400 mt-2">All Rights Reserved</p>
            </div>
          </div>
        </div>
      </div>

      {/* Bottom Dark Section */}
      <div className="bg-gradient-to-r from-slate-900 via-purple-900 to-slate-900 px-4 sm:px-6 lg:px-8 py-6">
        <div className="max-w-7xl mx-auto text-center">
          <p className="text-gray-400 text-sm">
            Thank you for shopping with <span className="text-pink-400 font-semibold">AURA EDIT</span> - Your destination for signature style
          </p>
        </div>
      </div>
    </footer>
  );
};

export default Footer;