import React, { useState } from 'react';

const HomePage = () => {
    const [menuOpen, setMenuOpen] = useState(false);

    const categories = [
        { name: 'Men', icon: '👔' },
        { name: 'Women', icon: '👗' },
        { name: 'Kids', icon: '👶' },
        { name: 'Accessories', icon: '👜' }
    ];

    const featuredProducts = [
        { id: 1, name: 'Classic T-Shirt', price: 'Rs 2,500', category: 'Men' },
        { id: 2, name: 'Summer Dress', price: 'Rs 4,500', category: 'Women' },
        { id: 3, name: 'Denim Jeans', price: 'Rs 5,500', category: 'Men' },
        { id: 4, name: 'Floral Blouse', price: 'Rs 3,500', category: 'Women' },
        { id: 5, name: 'Kids T-Shirt', price: 'Rs 1,500', category: 'Kids' },
        { id: 6, name: 'Leather Bag', price: 'Rs 8,500', category: 'Accessories' }
    ];

    return (
        <div className="min-h-screen bg-gradient-to-br from-pink-50 via-white to-blue-50">
            {/* Navigation */}
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
                            <a href="#home" className="text-gray-700 hover:text-pink-500 font-medium transition-colors duration-200">
                                Home
                            </a>
                            <a href="#shop" className="text-gray-700 hover:text-pink-500 font-medium transition-colors duration-200">
                                Shop
                            </a>
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
                                <a href="#home" className="text-gray-700 hover:text-pink-500 font-medium transition-colors duration-200 py-2">
                                    Home
                                </a>
                                <a href="#shop" className="text-gray-700 hover:text-pink-500 font-medium transition-colors duration-200 py-2">
                                    Shop
                                </a>
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

            {/* Hero Section */}
            <section id="home" className="py-20 px-4 sm:px-6 lg:px-8">
                <div className="max-w-7xl mx-auto">
                    <div className="bg-gradient-to-br from-pink-400 via-pink-500 to-blue-400 rounded-3xl shadow-2xl overflow-hidden">
                        <div className="grid md:grid-cols-2 gap-8 items-center p-8 md:p-16">
                            <div className="text-white space-y-6">
                                <h1 className="text-5xl md:text-6xl font-bold leading-tight">
                                    Welcome to Our Fashion Store
                                </h1>
                                <p className="text-xl text-pink-100">
                                    Discover the latest trends and styles. Find your perfect outfit today!
                                </p>
                                <div className="flex flex-col sm:flex-row gap-4">
                                    <button className="bg-white text-pink-500 font-bold py-3 px-8 rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 hover:scale-105">
                                        Explore Collection
                                    </button>
                                    <button className="bg-transparent border-2 border-white text-white font-bold py-3 px-8 rounded-lg hover:bg-white hover:text-pink-500 transition-all duration-200">
                                        Learn More
                                    </button>
                                </div>
                            </div>
                            <div className="flex justify-center">
                                <img
                                    src="/images/Logo.png"
                                    alt="Fashion"
                                    className="w-64 h-64 md:w-80 md:h-80 object-contain drop-shadow-2xl animate-pulse"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {/* Categories Section */}
            <section id="categories" className="py-16 px-4 sm:px-6 lg:px-8">
                <div className="max-w-7xl mx-auto">
                    <div className="text-center mb-12">
                        <h2 className="text-4xl font-bold bg-gradient-to-r from-pink-500 via-blue-500 to-pink-600 bg-clip-text text-transparent mb-4">
                            Shop by Category
                        </h2>
                        <p className="text-gray-600 text-lg">Find exactly what you're looking for</p>
                    </div>

                    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        {categories.map((category, index) => (
                            <div
                                key={index}
                                className="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 p-8 text-center border-2 border-pink-100 hover:border-pink-300 cursor-pointer group hover:scale-105"
                            >
                                <div className="text-6xl mb-4 group-hover:scale-110 transition-transform duration-300">
                                    {category.icon}
                                </div>
                                <h3 className="text-2xl font-bold text-gray-800 group-hover:text-pink-500 transition-colors duration-300">
                                    {category.name}
                                </h3>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

            {/* Featured Products */}
            <section id="shop" className="py-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-pink-50 via-blue-50 to-pink-50">
                <div className="max-w-7xl mx-auto">
                    <div className="text-center mb-12">
                        <h2 className="text-4xl font-bold bg-gradient-to-r from-pink-500 via-blue-500 to-pink-600 bg-clip-text text-transparent mb-4">
                            Featured Products
                        </h2>
                        <p className="text-gray-600 text-lg">Check out our most popular items</p>
                    </div>

                    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                        {featuredProducts.map((product) => (
                            <div
                                key={product.id}
                                className="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden border-2 border-pink-100 hover:border-pink-300 group"
                            >
                                <div className="bg-gradient-to-br from-pink-100 to-blue-100 h-64 flex items-center justify-center group-hover:from-pink-200 group-hover:to-blue-200 transition-all duration-300">
                                    <img
                                        src="/images/Logo.png"
                                        alt={product.name}
                                        className="w-40 h-40 object-contain group-hover:scale-110 transition-transform duration-300"
                                    />
                                </div>
                                <div className="p-6">
                                    <div className="mb-2">
                                        <span className="px-3 py-1 bg-gradient-to-r from-pink-100 to-blue-100 text-pink-600 text-xs font-semibold rounded-full">
                                            {product.category}
                                        </span>
                                    </div>
                                    <h3 className="text-xl font-bold text-gray-800 mb-2 group-hover:text-pink-500 transition-colors duration-300">
                                        {product.name}
                                    </h3>
                                    <div className="flex items-center justify-between">
                                        <span className="text-2xl font-bold bg-gradient-to-r from-pink-500 to-blue-500 bg-clip-text text-transparent">
                                            {product.price}
                                        </span>
                                        <button className="bg-gradient-to-r from-pink-400 to-blue-400 hover:from-pink-500 hover:to-blue-500 text-white font-bold py-2 px-6 rounded-lg shadow-md hover:shadow-xl transition-all duration-200 hover:scale-105">
                                            View
                                        </button>
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>

                    <div className="text-center mt-12">
                        <button className="bg-gradient-to-r from-pink-400 via-pink-500 to-blue-400 hover:from-pink-500 hover:to-blue-500 text-white font-bold py-4 px-12 rounded-lg shadow-lg hover:shadow-2xl transition-all duration-200 hover:scale-105">
                            View All Products
                        </button>
                    </div>
                </div>
            </section>

            {/* Features Section */}
            <section className="py-16 px-4 sm:px-6 lg:px-8">
                <div className="max-w-7xl mx-auto">
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div className="text-center p-8 bg-white rounded-2xl shadow-md border-2 border-pink-100 hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <div className="bg-gradient-to-br from-pink-100 to-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 shadow-md">
                                <svg className="w-10 h-10 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <h3 className="text-2xl font-bold text-gray-800 mb-3">Quality Products</h3>
                            <p className="text-gray-600">Premium quality clothing for everyone</p>
                        </div>

                        <div className="text-center p-8 bg-white rounded-2xl shadow-md border-2 border-blue-100 hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <div className="bg-gradient-to-br from-blue-100 to-pink-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 shadow-md">
                                <svg className="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <h3 className="text-2xl font-bold text-gray-800 mb-3">Fast Delivery</h3>
                            <p className="text-gray-600">Quick and reliable shipping</p>
                        </div>

                        <div className="text-center p-8 bg-white rounded-2xl shadow-md border-2 border-pink-100 hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <div className="bg-gradient-to-br from-pink-100 to-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 shadow-md">
                                <svg className="w-10 h-10 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 className="text-2xl font-bold text-gray-800 mb-3">Best Prices</h3>
                            <p className="text-gray-600">Affordable fashion for all budgets</p>
                        </div>
                    </div>
                </div>
            </section>

            {/* About Section */}
            <section id="about" className="py-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-pink-50 via-blue-50 to-pink-50">
                <div className="max-w-7xl mx-auto">
                    <div className="bg-white rounded-3xl shadow-xl p-8 md:p-16 border-2 border-pink-100">
                        <div className="grid md:grid-cols-2 gap-12 items-center">
                            <div>
                                <h2 className="text-4xl font-bold bg-gradient-to-r from-pink-500 via-blue-500 to-pink-600 bg-clip-text text-transparent mb-6">
                                    About Our Store
                                </h2>
                                <p className="text-gray-600 text-lg mb-6">
                                    We are passionate about bringing you the latest fashion trends at affordable prices.
                                    Our collection features carefully curated items for men, women, and children.
                                </p>
                                <p className="text-gray-600 text-lg mb-8">
                                    With years of experience in the fashion industry, we pride ourselves on quality,
                                    style, and customer satisfaction.
                                </p>
                                <button className="bg-gradient-to-r from-pink-400 via-pink-500 to-blue-400 hover:from-pink-500 hover:to-blue-500 text-white font-bold py-3 px-8 rounded-lg shadow-md hover:shadow-xl transition-all duration-200 hover:scale-105">
                                    Read Our Story
                                </button>
                            </div>
                            <div className="flex justify-center">
                                <img
                                    src="/images/Logo.png"
                                    alt="About Us"
                                    className="w-80 h-80 object-contain drop-shadow-2xl"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {/* Contact Section */}
            <section id="contact" className="py-16 px-4 sm:px-6 lg:px-8">
                <div className="max-w-4xl mx-auto">
                    <div className="text-center mb-12">
                        <h2 className="text-4xl font-bold bg-gradient-to-r from-pink-500 via-blue-500 to-pink-600 bg-clip-text text-transparent mb-4">
                            Get in Touch
                        </h2>
                        <p className="text-gray-600 text-lg">We'd love to hear from you</p>
                    </div>

                    <div className="bg-white rounded-2xl shadow-xl p-8 md:p-12 border-2 border-pink-100">
                        <form className="space-y-6">
                            <div className="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label className="block text-gray-700 font-semibold mb-2">Name</label>
                                    <input
                                        type="text"
                                        className="w-full px-4 py-3 border-2 border-pink-100 rounded-lg focus:outline-none focus:border-pink-400 transition-colors duration-200"
                                        placeholder="Your name"
                                    />
                                </div>
                                <div>
                                    <label className="block text-gray-700 font-semibold mb-2">Email</label>
                                    <input
                                        type="email"
                                        className="w-full px-4 py-3 border-2 border-pink-100 rounded-lg focus:outline-none focus:border-pink-400 transition-colors duration-200"
                                        placeholder="your@email.com"
                                    />
                                </div>
                            </div>
                            <div>
                                <label className="block text-gray-700 font-semibold mb-2">Message</label>
                                <textarea
                                    rows="5"
                                    className="w-full px-4 py-3 border-2 border-pink-100 rounded-lg focus:outline-none focus:border-pink-400 transition-colors duration-200"
                                    placeholder="Your message..."
                                ></textarea>
                            </div>
                            <div className="text-center">
                                <button
                                    type="submit"
                                    className="bg-gradient-to-r from-pink-400 via-pink-500 to-blue-400 hover:from-pink-500 hover:to-blue-500 text-white font-bold py-4 px-12 rounded-lg shadow-lg hover:shadow-2xl transition-all duration-200 hover:scale-105"
                                >
                                    Send Message
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            {/* Footer */}
            <footer className="bg-gradient-to-r from-pink-50 via-blue-50 to-pink-50 border-t-2 border-pink-100 py-12 px-4 sm:px-6 lg:px-8">
                <div className="max-w-7xl mx-auto">
                    <div className="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                        <div>
                            <div className="flex items-center space-x-3 mb-4">
                                <img src="/images/Logo.png" alt="Logo" className="h-10 w-10" />
                                <span className="text-xl font-bold bg-gradient-to-r from-pink-500 to-blue-500 bg-clip-text text-transparent">
                                    Clothing Shop
                                </span>
                            </div>
                            <p className="text-gray-600">Your one-stop fashion destination</p>
                        </div>
                        <div>
                            <h4 className="font-bold text-gray-800 mb-4">Quick Links</h4>
                            <ul className="space-y-2">
                                <li><a href="#home" className="text-gray-600 hover:text-pink-500 transition-colors duration-200">Home</a></li>
                                <li><a href="#shop" className="text-gray-600 hover:text-pink-500 transition-colors duration-200">Shop</a></li>
                                <li><a href="#categories" className="text-gray-600 hover:text-pink-500 transition-colors duration-200">Categories</a></li>
                                <li><a href="#about" className="text-gray-600 hover:text-pink-500 transition-colors duration-200">About</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 className="font-bold text-gray-800 mb-4">Customer Service</h4>
                            <ul className="space-y-2">
                                <li><a href="#" className="text-gray-600 hover:text-pink-500 transition-colors duration-200">Contact Us</a></li>
                                <li><a href="#" className="text-gray-600 hover:text-pink-500 transition-colors duration-200">Shipping Info</a></li>
                                <li><a href="#" className="text-gray-600 hover:text-pink-500 transition-colors duration-200">Returns</a></li>
                                <li><a href="#" className="text-gray-600 hover:text-pink-500 transition-colors duration-200">FAQ</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 className="font-bold text-gray-800 mb-4">Follow Us</h4>
                            <div className="flex space-x-4">
                                <a href="#" className="bg-gradient-to-r from-pink-400 to-blue-400 text-white p-3 rounded-full hover:from-pink-500 hover:to-blue-500 transition-all duration-200 hover:scale-110 shadow-md">
                                    <svg className="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                </a>
                                <a href="#" className="bg-gradient-to-r from-pink-400 to-blue-400 text-white p-3 rounded-full hover:from-pink-500 hover:to-blue-500 transition-all duration-200 hover:scale-110 shadow-md">
                                    <svg className="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                    </svg>
                                </a>
                                <a href="#" className="bg-gradient-to-r from-pink-400 to-blue-400 text-white p-3 rounded-full hover:from-pink-500 hover:to-blue-500 transition-all duration-200 hover:scale-110 shadow-md">
                                    <svg className="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div className="border-t border-pink-200 pt-8 text-center">
                        <p className="text-gray-600">
                            &copy; 2024 Clothing Shop. All rights reserved.
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    );
};

export default HomePage;
