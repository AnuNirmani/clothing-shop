import React, { useState } from 'react';
import { Link } from 'react-router-dom';

const Header = () => {
    const [menuOpen, setMenuOpen] = useState(false);

    const handleProfileClick = (e) => {
        if (window.location.pathname === '/login') {
            window.scrollTo({
                top: document.documentElement.scrollHeight,
                behavior: 'smooth'
            });
        }
    };


    return (
        <nav className="bg-white shadow-lg border-b border-pink-100">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div className="flex justify-between items-center h-20">
                    {/* Logo */}
                    <div className="flex items-center space-x-3">
                        <img src="/images/Logo.png" alt="Logo" className="h-12 w-12" />
                        <span className="text-2xl font-bold bg-gradient-to-r from-pink-500 via-blue-500 to-pink-600 bg-clip-text text-transparent">
                            Clothing Shop
                        </span>
                    </div>

                    {/* Desktop Navigation Links */}
                    <div className="hidden md:flex items-center space-x-8">
                        <Link to="/" className="text-gray-700 hover:text-pink-500 font-medium transition-colors duration-200">
                            Home
                        </Link>
                        <Link to="/shop?title=Our Collection" className="text-gray-700 hover:text-pink-500 font-medium transition-colors duration-200">
                            Shop
                        </Link>
                        <Link to="/shop?category_id=1&title=Men's Wear" className="text-gray-700 hover:text-pink-500 font-medium transition-colors duration-200">
                            Men
                        </Link>
                        <Link to="/shop?category_id=2&title=Women's Wear" className="text-gray-700 hover:text-pink-500 font-medium transition-colors duration-200">
                            Women
                        </Link>
                        <Link to="/shop?category_id=3&title=Kids Wear" className="text-gray-700 hover:text-pink-500 font-medium transition-colors duration-200">
                            Kids
                        </Link>
                        <Link to="/shop?category_id=4&title=Accessories" className="text-gray-700 hover:text-pink-500 font-medium transition-colors duration-200">
                            Accessories
                        </Link>
                        <Link to="/shop?category_id=5&title=Footwear" className="text-gray-700 hover:text-pink-500 font-medium transition-colors duration-200">
                            Shoes
                        </Link>
                        <Link to="/shop?category_id=9&title=Gift Cards" className="text-gray-700 hover:text-pink-500 font-medium transition-colors duration-200">
                            Gift Cards
                        </Link>
                        {/* <Link to="/login" className="text-gray-700 hover:text-pink-500 font-medium transition-colors duration-200">
                            Login
                        </Link> */}

                        <button className="bg-gradient-to-r from-pink-400 via-pink-500 to-blue-400 hover:from-pink-500 hover:to-blue-500 text-white font-bold py-2 px-6 rounded-lg shadow-md hover:shadow-xl transition-all duration-200">
                            Shop Now
                        </button>
                    </div>

                    {/* Profile and Cart Icons - Right Aligned */}
                    <div className="hidden md:flex items-center space-x-3">
                        <Link
                            to="/login"
                            onClick={handleProfileClick}
                            className="text-gray-700 hover:text-pink-500 transition-colors duration-200"
                            aria-label="Profile"
                        >
                            <svg className="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 12a4 4 0 100-8 4 4 0 000 8z" />
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 20a6 6 0 0112 0" />
                            </svg>
                        </Link>

                        <button className="text-gray-700 hover:text-pink-500 transition-colors duration-200" aria-label="Cart">
                            <svg className="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </button>
                    </div>

                    {/* Mobile menu button */}
                    <div className="md:hidden">
                        <button
                            onClick={() => setMenuOpen(!menuOpen)}
                            className="text-gray-700 hover:text-pink-500 focus:outline-none"
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
                    <div className="md:hidden pb-4">
                        <div className="flex flex-col space-y-3">
                            <Link to="/" className="text-gray-700 hover:text-pink-500 font-medium transition-colors duration-200 py-2">
                                Home
                            </Link>
                            <Link to="/shop?title=Our Collection" className="text-gray-700 hover:text-pink-500 font-medium transition-colors duration-200 py-2">
                                Shop
                            </Link>
                            <Link to="/shop?category_id=1&title=Men's Wear" className="text-gray-700 hover:text-pink-500 font-medium transition-colors duration-200 py-2">
                                Men
                            </Link>
                            <Link to="/shop?category_id=2&title=Women's Wear" className="text-gray-700 hover:text-pink-500 font-medium transition-colors duration-200 py-2">
                                Women
                            </Link>
                            <Link to="/shop?category_id=3&title=Kids Wear" className="text-gray-700 hover:text-pink-500 font-medium transition-colors duration-200 py-2">
                                Kids
                            </Link>
                            <Link to="/shop?category_id=4&title=Accessories" className="text-gray-700 hover:text-pink-500 font-medium transition-colors duration-200 py-2">
                                Accessories
                            </Link>
                            <Link to="/shop?category_id=5&title=Footwear" className="text-gray-700 hover:text-pink-500 font-medium transition-colors duration-200 py-2">
                                Shoes
                            </Link>
                            <Link to="/shop?title=Gift Cards" className="text-gray-700 hover:text-pink-500 font-medium transition-colors duration-200 py-2">
                                Gift Cards
                            </Link>
                            <button className="bg-gradient-to-r from-pink-400 via-pink-500 to-blue-400 text-white font-bold py-2 px-6 rounded-lg shadow-md w-full">
                                Shop Now
                            </button>
                            <div className="flex items-center space-x-4 pt-2">
                                <Link
                                    to="/profile"
                                    onClick={() => setMenuOpen(false)}
                                    className="text-gray-700 hover:text-pink-500 transition-colors duration-200"
                                    aria-label="Profile"
                                >
                                    <svg className="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 12a4 4 0 100-8 4 4 0 000 8z" />
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 20a6 6 0 0112 0" />
                                    </svg>
                                </Link>
                                <button className="text-gray-700 hover:text-pink-500 transition-colors duration-200" aria-label="Cart">
                                    <svg className="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                )}
            </div>
        </nav>
    );
};

export default Header;