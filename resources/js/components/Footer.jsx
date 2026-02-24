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
                      <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773c.058.3.24.645.477.935.237.29.645.6.864.6.123 0 .12-.078.22 1.682.1 1.76.102 1.76.225 1.882.113.122.43.545.97 1.088.54.544 1.229 1.229 1.352 1.352.122.113.545.43 1.088.97.544.54 1.229 1.229 1.352 1.352.113.122.545.43 1.088.97.544.54 1.229 1.229 1.352 1.352l1.682.22c1.76.1 1.76.102 1.882.225.122.113.545.43 1.088.97.544.54 1.229 1.229 1.352 1.352.113.122.545.43 1.088.97.544.54 1.229 1.229 1.352 1.352.122.113.545.43 1.088.97.544.54 1.229 1.229 1.352 1.352l.22 1.682c.1 1.76.102 1.76.225 1.882.122.113.545.43 1.088.97.544.54 1.229 1.229 1.352 1.352m0 0" />
                    </svg>
                  </div>
                  <div>
                    <p className="text-gray-600 text-sm">Phone</p>
                    <a href="tel:+94707788688" className="footer-link text-gray-900 font-semibold">+94 70 778 8688</a>
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
                  <svg className="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.67-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.076 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421-7.403h-.004a9.87 9.87 0 00-4.819 1.222c-1.493.82-2.759 2.028-3.606 3.42-1.666 2.839-1.951 6.112-.524 9.093.737 1.513 1.988 2.797 3.468 3.604 1.487.81 3.18 1.225 4.91 1.225h.005c2.834 0 5.484-.875 7.701-2.533 2.216-1.658 3.854-4.02 4.508-6.792.32-1.365.384-2.814.194-4.237-.357-2.776-1.63-5.215-3.594-7.052-1.965-1.837-4.554-2.981-7.274-3.06zm0-1.481c2.984 0 5.779 1.051 7.971 2.964 2.193 1.913 3.598 4.504 3.931 7.355.23 1.683.168 3.386-.178 5.04-.814 3.595-2.796 6.759-5.596 8.755-2.8 1.996-6.262 3.061-9.973 3.061-1.898 0-3.74-.384-5.475-1.154-1.734-.77-3.279-1.923-4.515-3.325-2.434-2.869-3.539-6.645-2.975-10.358.564-3.714 2.689-6.963 5.561-8.881 2.872-1.918 6.424-2.857 10.256-2.857z" />
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
                  <svg className="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.88 2.88 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.07 6.00 6.00 0 1 0 10.86 3.43z" />
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
                Crafted with 💜 by <span className="font-semibold text-gray-700">Aurora 365 Pvt Ltd</span>
              </p>
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