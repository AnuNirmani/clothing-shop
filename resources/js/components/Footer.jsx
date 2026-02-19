import React from 'react';

const Footer = () => {
  return (
    <footer className="w-full bg-gradient-to-br from-pink-50 via-white to-blue-50 text-gray-800 border-t border-pink-100">

      {/* Newsletter Section */}
      <div className="w-full bg-gradient-to-r from-pink-100 via-white to-blue-100 px-4 sm:px-6 lg:px-12 py-16">
        <div className="max-w-5xl mx-auto text-center">
          <h3 className="text-lg font-semibold tracking-widest mb-3">
            SUBSCRIBE TO OUR NEWSLETTER
          </h3>
          <p className="text-gray-600 mb-8">
            Stay up to date on the latest product launches and exclusive offers.
          </p>

          {/* Input + Button */}
          <div className="flex flex-col sm:flex-row items-center justify-center gap-4">
            <input
              type="email"
              placeholder="Enter your Email Address"
              className="w-full sm:w-[420px] bg-transparent border-b border-gray-300 py-3 text-gray-700 focus:outline-none focus:border-pink-400"
            />
            <button className="bg-gradient-to-r from-pink-400 to-blue-400 text-white px-10 py-3 font-semibold tracking-widest hover:from-pink-500 hover:to-blue-500 transition">
              SUBSCRIBE
            </button>
          </div>
        </div>
      </div>

      <div className="w-full px-4 sm:px-6 lg:px-12 py-12">
      </div>

      {/* Main Footer */}
      <div className="w-full px-4 sm:px-6 lg:px-12 pb-12">
        <div className="max-w-6xl mx-auto">
          <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-8 lg:gap-10">
            <div className="md:col-span-2">
              <h3 className="text-3xl font-bold mb-4">AURA EDIT</h3>
              <p className="text-gray-600 mb-4">
                Welcome to www.auraedit.lk. Reserve your dress now before it's too late.
              </p>
              <p className="text-gray-600">
                Phone: +94 70 778 8688<br />
                Email: online@auraedit.lk
              </p>

              {/* Social Icons */}
              <div className="flex items-center gap-3 mt-5">
                {/* Facebook */}
                <a
                  href="https://web.facebook.com/"
                  target="_blank"
                  rel="noopener noreferrer"
                  aria-label="Facebook"
                  className="inline-flex h-9 w-9 items-center justify-center rounded-full border border-pink-200 bg-white text-pink-500 transition hover:bg-gradient-to-r hover:from-pink-400 hover:to-blue-400 hover:text-white"
                >
                  <svg className="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M13 9h3V6h-3c-2.76 0-5 2.24-5 5v2H6v3h2v6h3v-6h3l1-3h-4v-2c0-.55.45-1 1-1z" />
                  </svg>
                </a>

                {/* Instagram */}
                <a
                  href="https://www.instagram.com/"
                  target="_blank"
                  rel="noopener noreferrer"
                  aria-label="Instagram"
                  className="inline-flex h-9 w-9 items-center justify-center rounded-full border border-pink-200 bg-white text-pink-500 transition hover:bg-gradient-to-r hover:from-pink-400 hover:to-blue-400 hover:text-white"
                >
                  <svg className="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M7 3h10a4 4 0 0 1 4 4v10a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V7a4 4 0 0 1 4-4zm10 2H7a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2zm-5 3.5A4.5 4.5 0 1 1 7.5 13 4.5 4.5 0 0 1 12 8.5zm0 2A2.5 2.5 0 1 0 14.5 13 2.5 2.5 0 0 0 12 10.5zm5-2.75a1 1 0 1 1-1 1 1 1 0 0 1 1-1z" />
                  </svg>
                </a>

                {/* WhatsApp */}
                <a
                  href="https://web.whatsapp.com/"
                  target="_blank"
                  rel="noopener noreferrer"
                  aria-label="WhatsApp"
                  className="inline-flex h-9 w-9 items-center justify-center rounded-full border border-pink-200 bg-white text-pink-500 transition hover:bg-gradient-to-r hover:from-pink-400 hover:to-blue-400 hover:text-white"
                >
                  <svg className="h-4 w-4" viewBox="0 0 32 32" fill="currentColor" aria-hidden="true">
                    <path d="M16 3c7.2 0 13 5.8 13 13s-5.8 13-13 13c-2.2 0-4.2-.5-6-1.5L3 29l1.5-6A12.9 12.9 0 0 1 3 16C3 8.8 8.8 3 16 3zm0 2.6A10.4 10.4 0 0 0 6.1 20.3l.4.7-.9 3.7 3.7-1 .7.4A10.4 10.4 0 1 0 16 5.6zm5.7 14.1c-.2-.1-1.3-.6-1.5-.7-.2-.1-.4-.1-.6.2-.2.2-.7.7-.8.9-.2.2-.3.2-.6.1-1.5-.6-2.7-1.5-3.7-2.8-.3-.3-.1-.5.1-.7l.4-.4c.1-.1.1-.3.2-.4.1-.2 0-.3 0-.5-.1-.2-.6-1.4-.8-1.9-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.5.1-.7.3-.3.3-1 1-1 2.4s1 2.8 1.2 3c.2.2 2 3.1 5 4.3.7.3 1.2.4 1.7.5.7.1 1.3.1 1.8-.1.6-.2 1.3-.8 1.5-1.5.2-.7.2-1.3.1-1.4 0-.1-.2-.2-.4-.3z" />
                  </svg>
                </a>

                {/* TikTok */}
                <a
                  href="https://www.tiktok.com/"
                  target="_blank"
                  rel="noopener noreferrer"
                  aria-label="TikTok"
                  className="inline-flex h-9 w-9 items-center justify-center rounded-full border border-pink-200 bg-white text-pink-500 transition hover:bg-gradient-to-r hover:from-pink-400 hover:to-blue-400 hover:text-white"
                >
                  <svg className="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M16.5 3c.4 2.2 1.9 3.7 4.1 4.1V10c-1.6 0-3-.5-4.1-1.4v5.6a5.2 5.2 0 1 1-4.6-5.2v3a2.2 2.2 0 1 0 1.6 2.1V3h3z" />
                  </svg>
                </a>
              </div>
            </div>

            <div>
              <h4 className="font-bold mb-4">IMPORTANT LINKS</h4>
              <ul className="space-y-3 text-gray-600">
                <li><a href="#" className="hover:text-pink-400">Returns & Exchange Policy</a></li>
                <li><a href="#" className="hover:text-pink-400">Privacy Policy</a></li>
                <li><a href="#" className="hover:text-pink-400">Terms & Conditions</a></li>
              </ul>
            </div>

            <div>
              <h4 className="font-bold mb-4">QUICK CATEGORIES</h4>
              <ul className="space-y-3 text-gray-600">
                <li><a href="#" className="hover:text-pink-400">New Arrivals</a></li>
                <li><a href="#" className="hover:text-pink-400">Office Wear</a></li>
                <li><a href="#" className="hover:text-pink-400">Party Wear</a></li>
                <li><a href="#" className="hover:text-pink-400">Jewellery</a></li>
              </ul>
            </div>

            <div>
              <h4 className="font-bold mb-4">ACCOUNT</h4>
              <ul className="space-y-3 text-gray-600">
                <li><a href="#" className="hover:text-pink-400">My Account</a></li>
                <li><a href="#" className="hover:text-pink-400">Order History</a></li>
              </ul>
            </div>
          </div>

          {/* Bottom */}
          <div className="mt-12 pt-8 border-t border-pink-200 text-center text-gray-500 text-sm">
            <p>© auraedit.lk | Website by Aurora 365 Pvt Ltd</p>
            <div className="flex justify-center flex-wrap gap-4 mt-4">
              <span className="text-green-400">CASH ON DELIVERY</span>
              <span className="text-red-400">BANK DEPOSIT</span>
              <span className="text-blue-400">VISA</span>
              <span className="text-amber-400">Mastercard</span>
              <span className="text-purple-400">KOKO</span>
              <span className="text-blue-800">Payzy</span>
            </div>
          </div>
        </div>
      </div>

    </footer>
  );
};

export default Footer;