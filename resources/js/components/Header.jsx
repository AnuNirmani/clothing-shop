import React, { useState } from 'react';
import { Link } from 'react-router-dom';

const Header = () => {
    const [menuOpen, setMenuOpen] = useState(false);

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

                    {/* Desktop Menu */}
                    <div className="hidden md:flex items-center space-x-8">
                        <Link to="/" className="text-gray-700 hover:text-pink-500 font-medium transition-colors duration-200">
                            Home
                        </Link>
                        <Link to="/shop?title=Our Collection" className="text-gray-700 hover:text-pink-500 font-medium transition-colors duration-200">
                            Shop
                        </Link>
                        <a href="#categories" className="text-gray-700 hover:text-pink-500 font-medium transition-colors duration-200">
                            Categories
                        </a>
                        <a href="#about" className="text-gray-700 hover:text-pink-500 font-medium transition-colors duration-200">
                            About
                        </a>
                        <a href="#contact" className="text-gray-700 hover:text-pink-500 font-medium transition-colors duration-200">
                            Contact
                        </a>
                        <button className="bg-gradient-to-r from-pink-400 via-pink-500 to-blue-400 hover:from-pink-500 hover:to-blue-500 text-white font-bold py-2 px-6 rounded-lg shadow-md hover:shadow-xl transition-all duration-200">
                            Shop Now
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
                            <a href="#categories" className="text-gray-700 hover:text-pink-500 font-medium transition-colors duration-200 py-2">
                                Categories
                            </a>
                            <a href="#about" className="text-gray-700 hover:text-pink-500 font-medium transition-colors duration-200 py-2">
                                About
                            </a>
                            <a href="#contact" className="text-gray-700 hover:text-pink-500 font-medium transition-colors duration-200 py-2">
                                Contact
                            </a>
                            <button className="bg-gradient-to-r from-pink-400 via-pink-500 to-blue-400 text-white font-bold py-2 px-6 rounded-lg shadow-md w-full">
                                Shop Now
                            </button>
                        </div>
                    </div>
                )}
            </div>
        </nav>
    );
};

export default Header;
