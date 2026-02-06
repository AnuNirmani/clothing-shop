import React from 'react';
import Header from './Header';
import Footer from './Footer';

const HomePage = () => {
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
            <Header />

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

            <Footer />
        </div>
    );
};

export default HomePage;


