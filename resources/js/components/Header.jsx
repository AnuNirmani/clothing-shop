import React, { useState, useEffect } from 'react';
import { Link, useLocation } from 'react-router-dom';
import { useCart } from '../context/CartContext';
import CartPage from '../pages/CartPage';

const Header = () => {
    const { getCartItemCount } = useCart();
    const location = useLocation();
    const [menuOpen, setMenuOpen] = useState(false);
    const [cartOpen, setCartOpen] = useState(false);
    const [isScrolled, setIsScrolled] = useState(false);

    const handleProfileClick = (e) => {
        if (window.location.pathname === '/login') {
            window.scrollTo({
                top: document.documentElement.scrollHeight,
                behavior: 'smooth'
            });
        }
    };

    // Helper function to check if a link is active
    const isActive = (path) => {
        if (path === '/' && location.pathname === '/') return true;
        if (path !== '/' && location.pathname.startsWith('/')) {
            // For shop links with category_id
            if (path.includes('category_id')) {
                const pathParams = new URLSearchParams(path.split('?')[1]);
                const currentParams = new URLSearchParams(location.search);
                const categoryId = pathParams.get('category_id');
                const currentCategoryId = currentParams.get('category_id');
                return categoryId === currentCategoryId;
            }
            // For shop page
            if (location.pathname === '/shop') return true;
        }
        return false;
    };

    useEffect(() => {
        const handleScroll = () => {
            setIsScrolled(window.scrollY > 20);
        };

        const handleCartOpen = () => setCartOpen(true);
        window.addEventListener('scroll', handleScroll);
        window.addEventListener('cart:open', handleCartOpen);

        return () => {
            window.removeEventListener('scroll', handleScroll);
            window.removeEventListener('cart:open', handleCartOpen);
        };
    }, []);

    const navLinks = [
        { label: 'Home', path: '/' },
        { label: 'Men', path: '/shop?category_id=1&title=Men\'s Wear' },
        { label: 'Women', path: '/shop?category_id=2&title=Women\'s Wear' },
        { label: 'Kids', path: '/shop?category_id=3&title=Kids Wear' },
        { label: 'Accessories', path: '/shop?category_id=4&title=Accessories' },
        { label: 'Shoes', path: '/shop?category_id=5&title=Footwear' },
        { label: 'Gift Cards', path: '/shop?category_id=6&title=Gift Cards' },
    ];

    return (
        <>
            <style>{`
                @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap');

                .nav-link-hover {
                    position: relative;
                    transition: color 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                }

                .nav-link-hover::after {
                    content: '';
                    position: absolute;
                    bottom: -4px;
                    left: 0;
                    width: 0;
                    height: 2px;
                    background: linear-gradient(90deg, #d4a574, #8b5cf6, #ec4899);
                    transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                }

                .nav-link-hover:hover::after {
                    width: 100%;
                }

                .smooth-transition {
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                }

                .glass-effect {
                    background: rgba(255, 255, 255, 0.7);
                    backdrop-filter: blur(10px);
                    border-bottom: 1px solid rgba(236, 72, 153, 0.1);
                }

                .glass-effect.scrolled {
                    background: rgba(255, 255, 255, 0.85);
                    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
                }

                .logo-text {
                    background: linear-gradient(135deg, #d4a574 0%, #8b5cf6 50%, #ec4899 100%);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    background-clip: text;
                    font-family: 'Playfair Display', serif;
                    letter-spacing: 2px;
                }

                .icon-hover {
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    position: relative;
                }

                .icon-hover:hover {
                    transform: scale(1.1);
                    filter: drop-shadow(0 0 8px rgba(236, 72, 153, 0.3));
                }

                .shop-btn {
                    background: linear-gradient(135deg, #d4a574 0%, #8b5cf6 50%, #ec4899 100%);
                    position: relative;
                    overflow: hidden;
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                }

                .shop-btn::before {
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

                .shop-btn:hover::before {
                    left: 0;
                }

                .shop-btn:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 12px 24px rgba(236, 72, 153, 0.3);
                }

                .mobile-menu-smooth {
                    animation: slideDown 0.3s ease-out;
                }

                @keyframes slideDown {
                    from {
                        opacity: 0;
                        transform: translateY(-10px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                .cart-badge {
                    animation: pulse 2s infinite;
                }

                @keyframes pulse {
                    0%, 100% {
                        opacity: 1;
                    }
                    50% {
                        opacity: 0.8;
                    }
                }
            `}</style>

            <nav className={`header-smooth glass-effect ${isScrolled ? 'scrolled' : ''} sticky top-0 z-50`}>
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="flex justify-between items-center h-20">
                        {/* Logo Section */}
                        <Link to="/" className="flex items-center space-x-2 group">
                            <div className="relative">
                                <img
                                    src="/images/Logo.png"
                                    alt="Logo"
                                    className="h-12 w-12 smooth-transition group-hover:scale-110"
                                />
                                <div className="absolute inset-0 bg-gradient-to-r from-purple-600/20 to-pink-600/20 rounded-full blur-lg opacity-0 group-hover:opacity-100 smooth-transition"></div>
                            </div>
                            <span className="logo-text text-2xl font-bold hidden sm:inline">
                                AURA
                                <span className="block text-sm tracking-widest text-gray-700">EDIT</span>
                            </span>
                        </Link>

                        {/* Desktop Navigation Links */}
                        <div className="hidden lg:flex items-center space-x-1">
                            {navLinks.map((link, idx) => (
                                <Link
                                    key={idx}
                                    to={link.path}
                                    className={`nav-link-hover px-4 py-2 font-medium text-sm smooth-transition ${isActive(link.path)
                                            ? 'text-pink-600 bg-pink-50/40 rounded-lg'
                                            : 'text-gray-700 hover:text-pink-500'
                                        }`}
                                >
                                    {link.label}
                                    {isActive(link.path) && (
                                        <span className="block h-0.5 bg-gradient-to-r from-pink-500 to-purple-600 rounded-full mt-1"></span>
                                    )}
                                </Link>
                            ))}
                        </div>

                        {/* Right Section - Icons and CTA */}
                        <div className="flex items-center space-x-4">
                            {/* Shop Now Button - Desktop */}
                            <Link
                                to="/shop?title=Our Collection"
                                className="hidden md:inline-block shop-btn text-white font-bold py-2.5 px-6 rounded-lg text-sm transition-all"
                            >
                                Shop Now
                            </Link>

                            {/* Profile Icon */}
                            <Link
                                to="/login"
                                onClick={handleProfileClick}
                                className="icon-hover text-gray-700 hover:text-pink-500 p-2"
                                aria-label="Profile"
                            >
                                <svg className="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 12a4 4 0 100-8 4 4 0 000 8z" />
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 20a6 6 0 0112 0" />
                                </svg>
                            </Link>

                            {/* Cart Icon */}
                            <button
                                onClick={() => setCartOpen(true)}
                                className="icon-hover text-gray-700 hover:text-pink-500 p-2 relative"
                                aria-label="Cart"
                            >
                                <svg className="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                                {getCartItemCount() > 0 && (
                                    <span className="cart-badge absolute -top-2 -right-2 bg-gradient-to-r from-pink-500 to-purple-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                                        {getCartItemCount()}
                                    </span>
                                )}
                            </button>

                            {/* Mobile Menu Button */}
                            <button
                                onClick={() => setMenuOpen(!menuOpen)}
                                className="lg:hidden icon-hover text-gray-700 hover:text-pink-500 p-2"
                                aria-label="Menu"
                            >
                                <svg className="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    {menuOpen ? (
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12" />
                                    ) : (
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 6h16M4 12h16M4 18h16" />
                                    )}
                                </svg>
                            </button>
                        </div>
                    </div>

                    {/* Mobile Menu */}
                    {menuOpen && (
                        <div className="mobile-menu-smooth lg:hidden pb-4 border-t border-pink-100">
                            <div className="flex flex-col space-y-2 pt-4">
                                {navLinks.map((link, idx) => (
                                    <Link
                                        key={idx}
                                        to={link.path}
                                        onClick={() => setMenuOpen(false)}
                                        className={`text-gray-700 font-medium px-4 py-2.5 rounded-lg smooth-transition ${isActive(link.path)
                                                ? 'bg-gradient-to-r from-pink-100 to-purple-100 text-pink-600 border-l-4 border-pink-500 pl-3'
                                                : 'hover:text-pink-500 hover:bg-pink-50/50'
                                            }`}
                                    >
                                        {link.label}
                                    </Link>
                                ))}
                                <div className="pt-2 border-t border-pink-100">
                                    <Link
                                        to="/shop?title=Our Collection"
                                        onClick={() => setMenuOpen(false)}
                                        className="shop-btn block text-center text-white font-bold py-3 px-6 rounded-lg text-sm w-full"
                                    >
                                        Shop Now
                                    </Link>
                                </div>
                            </div>
                        </div>
                    )}
                </div>
            </nav>

            {/* Cart Sidebar */}
            <CartPage isOpen={cartOpen} onClose={() => setCartOpen(false)} />
        </>
    );
};

export default Header;