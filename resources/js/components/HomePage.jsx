import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import Header from './Header';
import Footer from './Footer';

const HomePage = () => {


    const [latestItem, setLatestItem] = useState(null);
    const [latestWomensItem, setLatestWomensItem] = useState(null);
    const [latestMensItem, setLatestMensItem] = useState(null);
    const [latestFourItems, setLatestFourItems] = useState([]);
    const [typesWithItems, setTypesWithItems] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        fetchLatestItems();
    }, []);

    const fetchLatestItems = async () => {
        try {
            const [latestRes, womensRes, mensRes, fourRes, typesRes] = await Promise.all([
                fetch('/api/items/latest'),
                fetch('/api/items/latest-womens'),
                fetch('/api/items/latest-mens'),
                fetch('/api/items/latest-four'),
                fetch('/api/types/latest-items')
            ]);

            const latestData = await latestRes.json();
            const womensData = await womensRes.json();
            const mensData = await mensRes.json();
            const fourData = await fourRes.json();
            const typesData = await typesRes.json();

            if (latestData.success) setLatestItem(latestData.data);
            if (womensData.success) setLatestWomensItem(womensData.data);
            if (mensData.success) setLatestMensItem(mensData.data);
            if (fourData.success) setLatestFourItems(fourData.data);
            if (typesData.success) setTypesWithItems(typesData.data);
        } catch (error) {
            console.error('Error fetching latest items:', error);
        } finally {
            setLoading(false);
        }
    };



    return (
        <div className="min-h-screen bg-gradient-to-br from-pink-50 via-white to-blue-50">
            <Header />

            {/* Hero Section */}
            <section id="home" className="relative h-[700px] w-full overflow-hidden bg-gradient-to-br from-pink-50 via-white to-blue-50">
                {/* Background Image with Blur Overlay */}
                <div className="absolute inset-0">
                    <img
                        src="/images/hero01.png"
                        alt="Fashion Hero"
                        className="w-full h-full object-cover"
                    />
                    <div className="absolute inset-0 bg-pink-200/25 backdrop-blur-sm"></div>
                </div>

                {/* Content */}
                <div className="relative z-10 h-full flex flex-col items-center justify-center px-4">
                    {/* Heading */}
                    <h1 className="text-white text-4xl md:text-5xl lg:text-6xl font-bold mb-12 tracking-wider text-center">
                        WHAT ARE YOU LOOKING FOR?
                    </h1>

                    {/* Search Bar */}
                    <div className="w-full max-w-3xl mb-16">
                        <div className="relative flex items-center bg-white/90 backdrop-blur-md rounded-full px-6 py-4 shadow-2xl">
                            {/* Search Icon */}
                            <svg
                                className="w-6 h-6 text-gray-400 mr-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    strokeWidth="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                />
                            </svg>

                            {/* Input Field */}
                            <input
                                type="text"
                                placeholder="Trendy elegant fashion"
                                className="flex-1 bg-transparent border-0 outline-none text-gray-700 placeholder-gray-400 text-lg focus:ring-0"
                            />

                            {/* Search Button */}
                            <button className="ml-4 w-12 h-12 rounded-full bg-gradient-to-r from-pink-400 to-blue-400 border-2 border-transparent flex items-center justify-center hover:from-pink-500 hover:to-blue-500 transition-all duration-300 group">
                                <svg
                                    className="w-6 h-6 text-white transition-colors duration-300"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        strokeWidth="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {/* Featured Images */}
                    <div className="w-full max-w-6xl px-4">
                        <div className="flex gap-4 justify-center overflow-x-auto pb-4">
                            <div className="flex-shrink-0 w-48 h-64 rounded-3xl overflow-hidden cursor-pointer hover:scale-105 transition-transform duration-300 shadow-xl">
                                <img
                                    src="/images/1.png"
                                    alt="Featured Look 1"
                                    className="w-full h-full object-cover"
                                />
                            </div>
                            <div className="flex-shrink-0 w-48 h-64 rounded-3xl overflow-hidden cursor-pointer hover:scale-105 transition-transform duration-300 shadow-xl">
                                <img
                                    src="/images/3.png"
                                    alt="Featured Look 2"
                                    className="w-full h-full object-cover"
                                />
                            </div>
                            <div className="flex-shrink-0 w-48 h-64 rounded-3xl overflow-hidden cursor-pointer hover:scale-105 transition-transform duration-300 shadow-xl">
                                <img
                                    src="/images/4.png"
                                    alt="Featured Look 3"
                                    className="w-full h-full object-cover"
                                />
                            </div>
                            <div className="flex-shrink-0 w-48 h-64 rounded-3xl overflow-hidden cursor-pointer hover:scale-105 transition-transform duration-300 shadow-xl">
                                <img
                                    src="/images/2.png"
                                    alt="Featured Look 4"
                                    className="w-full h-full object-cover"
                                />
                            </div>
                            <div className="flex-shrink-0 w-48 h-64 rounded-3xl overflow-hidden cursor-pointer hover:scale-105 transition-transform duration-300 shadow-xl">
                                <img
                                    src="/images/5.png"
                                    alt="Featured Look 5"
                                    className="w-full h-full object-cover"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {/* Reimagine Section */}
            <section className="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-white via-pink-50 to-blue-50">
                <div className="max-w-4xl mx-auto text-center">
                    {/* Logo */}
                    <div className="mb-8 flex justify-center">
                        <img
                            src="/images/Logo.png"
                            alt="Emerald Logo"
                            className="w-24 h-24 object-contain"
                        />
                    </div>

                    {/* Tagline */}
                    <p className="text-gray-400 text-sm font-semibold tracking-widest uppercase mb-6">
                        REIMAGINE Clothing
                    </p>

                    {/* Main Heading */}
                    <h1 className="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-800 mb-6 leading-tight">
                        Each day is a page<br />
                        in your fashion story
                    </h1>

                    {/* Description */}
                    <p className="text-gray-500 text-lg md:text-xl max-w-3xl mx-auto leading-relaxed">
                        Don’t stress about the dress, we’ll dress you to impress. Explore our collection of trendy, elegant fashion and find your perfect look for any occasion.
                    </p>
                </div>
            </section>

            {/* Collection Gallery Section */}
            <section id="collection" className="py-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-pink-50 via-white to-blue-50">
                <div className="max-w-8xl mx-auto">
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {/* Large Left Image - Shop the Latest */}
                        <Link to="/shop?title=Shop the Latest" className="relative overflow-hidden cursor-pointer group">
                            <img
                                src={latestItem?.image || "/images/shop-latest.jpg"}
                                alt={latestItem?.name || "Shop the Latest"}
                                className="w-full h-[850px] object-cover transition-transform duration-500 group-hover:scale-105"
                            />
                            <div className="absolute inset-0 bg-pink-200/0 group-hover:bg-pink-200/20 transition-all duration-300"></div>

                            {/* Text Overlay - Clickable */}
                            <div className="absolute bottom-0 left-0 right-0 bg-gradient-to-r from-pink-500/90 to-blue-500/90 text-white p-6 group-hover:from-pink-500/95 group-hover:to-blue-500/95 transition-all duration-300">
                                <div className="flex items-start justify-between">
                                    <div>
                                        <h3 className="text-3xl font-bold mb-1">Shop the Latest</h3>
                                        <p className="text-sm text-gray-300 uppercase tracking-wide">View Collection</p>
                                    </div>
                                    <div className="text-white transform group-hover:translate-x-1 transition-transform duration-300">
                                        <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </Link>

                        {/* Right Column - Two Images Stacked */}
                        <div className="grid grid-rows-2 gap-8">
                            {/* Women's Collection */}
                            <Link to="/shop?category_id=2&title=Women's Collection" className="relative overflow-hidden cursor-pointer group">
                                <img
                                    src={latestWomensItem?.image || "/images/collection-women.jpg"}
                                    alt={latestWomensItem?.name || "Women's Collection"}
                                    className="w-full h-[410px] object-cover transition-transform duration-500 group-hover:scale-105"
                                />
                                <div className="absolute inset-0 bg-pink-200/0 group-hover:bg-pink-200/20 transition-all duration-300"></div>

                                {/* Text Overlay - Clickable */}
                                <div className="absolute bottom-0 left-0 right-0 bg-gradient-to-r from-pink-500/90 to-blue-500/90 text-white p-6 group-hover:from-pink-500/95 group-hover:to-blue-500/95 transition-all duration-300">
                                    <div className="flex items-start justify-between">
                                        <div>
                                            <h3 className="text-2xl font-bold mb-1">Women's Collection</h3>
                                            <p className="text-sm text-gray-300 uppercase tracking-wide">View Collection</p>
                                        </div>
                                        <div className="text-white transform group-hover:translate-x-1 transition-transform duration-300">
                                            <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </Link>

                            {/* Men's Collection */}
                            <Link to="/shop?category_id=1&title=Men's Collections" className="relative overflow-hidden cursor-pointer group">
                                <img
                                    src={latestMensItem?.image || "/images/collection-men.jpg"}
                                    alt={latestMensItem?.name || "Men's Collections"}
                                    className="w-full h-[410px] object-cover transition-transform duration-500 group-hover:scale-105"
                                />
                                <div className="absolute inset-0 bg-pink-200/0 group-hover:bg-pink-200/20 transition-all duration-300"></div>

                                {/* Text Overlay - Clickable */}
                                <div className="absolute bottom-0 left-0 right-0 bg-gradient-to-r from-pink-500/90 to-blue-500/90 text-white p-6 group-hover:from-pink-500/95 group-hover:to-blue-500/95 transition-all duration-300">
                                    <div className="flex items-start justify-between">
                                        <div>
                                            <h3 className="text-2xl font-bold mb-1">Men's Collections</h3>
                                            <p className="text-sm text-gray-300 uppercase tracking-wide">View Collection</p>
                                        </div>
                                        <div className="text-white transform group-hover:translate-x-1 transition-transform duration-300">
                                            <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </Link>
                        </div>
                    </div>
                </div>
            </section>

            {/* Latest Arrivals Section */}
            <section id="latest-arrivals" className="py-16 px-6 sm:px-10 lg:px-16 bg-gradient-to-br from-white via-blue-50 to-pink-50">
                <div className="max-w-[1600px] mx-auto">
                    <div className="text-center mb-12">
                        <h2 className="text-4xl font-bold text-gray-800 mb-4">
                            Latest Arrivals
                        </h2>
                        <p className="text-gray-600 text-lg">Discover our newest collection</p>
                    </div>

                    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                        {latestFourItems.map((product) => (
                            <div key={product.id} className="bg-white overflow-hidden shadow-sm hover:shadow-lg transition-shadow duration-300">
                                <div className="relative group cursor-pointer">
                                    <img
                                        src={product.image}
                                        alt={product.name}
                                        className="w-full h-[500px] object-cover"
                                    />
                                    {/* Quick Add Button - Appears on Hover */}
                                    <button className="absolute bottom-4 left-4 bg-gradient-to-r from-pink-400 to-blue-400 text-white px-6 py-2 text-sm font-semibold opacity-0 group-hover:opacity-100 transform translate-y-2 group-hover:translate-y-0 transition-all duration-300 hover:from-pink-500 hover:to-blue-500">
                                        + Quick add
                                    </button>
                                </div>
                                <div className="p-5">
                                    <h3 className="text-gray-800 font-medium mb-1">{product.name}</h3>
                                    <p className="text-gray-800 font-bold text-lg mb-3">Rs {product.prize?.toLocaleString()}.00</p>

                                    <div className="flex items-center gap-1.5">
                                        {product.colors && product.colors.length > 0 ? (
                                            product.colors.map((color, idx) => (
                                                <div
                                                    key={idx}
                                                    className="w-3.5 h-3.5 rounded-full border border-gray-200"
                                                    style={{ backgroundColor: color.hex }}
                                                    title={color.name}
                                                ></div>
                                            ))
                                        ) : (
                                            <div className="text-[10px] text-gray-400 italic">No colors</div>
                                        )}
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>

                    {/* View All Button */}
                    <div className="text-center mt-12">
                        <button className="bg-gradient-to-r from-pink-400 to-blue-400 text-white font-semibold py-3 px-10 rounded-lg hover:from-pink-500 hover:to-blue-500 transition-colors duration-300">
                            View All Products
                        </button>
                    </div>
                </div>
            </section>

            {/* Featured Categories */}
            <section id="shop" className="py-16 px-6 sm:px-10 lg:px-16 bg-gray-50">
                <div className="max-w-[1600px] mx-auto">
                    <div className="text-center mb-12">
                        <h2 className="text-4xl font-bold text-gray-800 mb-4">
                            Shop by Category
                        </h2>
                        <p className="text-gray-600 text-lg">Explore our collection</p>
                    </div>

                    <div className="grid grid-cols-2 md:grid-cols-4 gap-6">
                        {typesWithItems.map((type) => (
                            <div key={type.type_id} className="relative group cursor-pointer overflow-hidden">
                                <a href={`/type/${type.type_id}`}>
                                    <img
                                        src={type.item_image || "/images/placeholder-category.jpg"}
                                        alt={type.type_name}
                                        className="w-full h-[350px] object-cover transition-transform duration-500 group-hover:scale-105"
                                    />
                                    <div className="absolute inset-0 bg-pink-200/0 group-hover:bg-pink-200/20 transition-all duration-300"></div>

                                    {/* Category Label */}
                                    <div className="absolute bottom-4 left-4 right-4">
                                        <div className="bg-gradient-to-r from-pink-500/90 to-blue-500/90 text-white px-4 py-2 text-sm font-semibold backdrop-blur-sm flex justify-between items-center group-hover:from-pink-500/95 group-hover:to-blue-500/95 transition-all duration-300">
                                            <span>{type.type_name}</span>
                                            <span className="transform group-hover:translate-x-1 transition-transform duration-300">→</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        ))}
                    </div>

                    <div className="text-center mt-12">
                        <button className="bg-gradient-to-r from-pink-400 to-blue-400 text-white font-semibold py-3 px-10 rounded-lg hover:from-pink-500 hover:to-blue-500 transition-all duration-300 shadow-lg hover:shadow-pink-200/50">
                            View All Categories
                        </button>
                    </div>
                </div>
            </section>

            {/* Store Locations Section */}
            <section className="py-16 px-6 sm:px-10 lg:px-16 bg-gradient-to-br from-pink-50 via-white to-blue-50">
                <div className="max-w-7xl mx-auto">
                    <div className="text-center mb-12">
                        <h2 className="text-4xl font-bold text-gray-800 mb-3">
                            Store Locations
                        </h2>
                        <p className="text-gray-500 text-lg">Find Us Near You: Style Just a Step Away</p>
                    </div>

                    <div className="relative">
                        {/* Navigation Arrows */}
                        <button className="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 z-10 w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-gray-50 transition-colors">
                            <svg className="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>

                        <button className="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 z-10 w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-gray-50 transition-colors">
                            <svg className="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>

                        {/* Store Cards */}
                        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                            {/* Store 1 */}
                            <div className="border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow">
                                <div className="flex items-start mb-3">
                                    <svg className="w-5 h-5 text-gray-400 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <div>
                                        <h3 className="text-lg font-bold text-gray-800 mb-2">KANDY CELLULAR - NUGEGODA</h3>
                                        <p className="text-sm text-gray-600 mb-3">#300, High Level Road, Kirulapone, Nugegoda (00600)</p>
                                    </div>
                                </div>
                                <div className="flex items-center text-sm text-gray-600">
                                    <svg className="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    <span className="underline">+94 112 816 980</span>
                                </div>
                            </div>

                            {/* Store 2 */}
                            <div className="border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow">
                                <div className="flex items-start mb-3">
                                    <svg className="w-5 h-5 text-gray-400 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <div>
                                        <h3 className="text-lg font-bold text-gray-800 mb-2">KANDY SELECTION - KADAWATHA</h3>
                                        <p className="text-sm text-gray-600 mb-3">#43, Colombo-Kandy Road, Kadawatha (11850)</p>
                                    </div>
                                </div>
                                <div className="space-y-2">
                                    <div className="flex items-center text-sm text-gray-600">
                                        <svg className="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        <span className="underline">info@kandyselection.lk</span>
                                    </div>
                                    <div className="flex items-center text-sm text-gray-600">
                                        <svg className="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        <span className="underline">+94 112 925 925</span>
                                    </div>
                                </div>
                            </div>

                            {/* Store 3 */}
                            <div className="border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow">
                                <div className="flex items-start mb-3">
                                    <svg className="w-5 h-5 text-gray-400 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <div>
                                        <h3 className="text-lg font-bold text-gray-800 mb-2">KANDY SELECTION - NUGEGODA</h3>
                                        <p className="text-sm text-gray-600 mb-3">#300, High Level Road, Kirulapone, Nugegoda (00600)</p>
                                    </div>
                                </div>
                                <div className="space-y-2">
                                    <div className="flex items-center text-sm text-gray-600">
                                        <svg className="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        <span className="underline">nugegoda@kandyselection.lk</span>
                                    </div>
                                    <div className="flex items-center text-sm text-gray-600">
                                        <svg className="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        <span className="underline">+94 112 816 980</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {/* Instagram Section */}
            <section className="py-16 px-6 bg-gradient-to-br from-white via-pink-50 to-blue-50">
                <div className="max-w-4xl mx-auto text-center">
                    {/* Instagram Icon */}
                    <div className="mb-6 flex justify-center">
                        <svg className="w-16 h-16" viewBox="0 0 24 24" fill="url(#instagram-gradient)">
                            <defs>
                                <linearGradient id="instagram-gradient" x1="0%" y1="100%" x2="100%" y2="0%">
                                    <stop offset="0%" style={{ stopColor: '#f09433' }} />
                                    <stop offset="25%" style={{ stopColor: '#e6683c' }} />
                                    <stop offset="50%" style={{ stopColor: '#dc2743' }} />
                                    <stop offset="75%" style={{ stopColor: '#cc2366' }} />
                                    <stop offset="100%" style={{ stopColor: '#bc1888' }} />
                                </linearGradient>
                            </defs>
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                    </div>

                    <h2 className="text-4xl font-bold text-gray-800 mb-3">
                        Explore Kandy Selection
                    </h2>
                    <p className="text-gray-600 text-lg">@kandy_selection</p>
                </div>
            </section>

            {/* Features Section */}
            <section className="py-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-pink-50 via-white to-blue-50">
                <div className="max-w-7xl mx-auto">

                    {/* NEW TOP FEATURE STRIP */}
                    <div className="w-full px-4 sm:px-6 lg:px-12 py-12">
                        <div className="grid grid-cols-2 sm:grid-cols-4 gap-4 text-center">
                            <div className="bg-gradient-to-br from-pink-100 to-blue-100 p-4 rounded-lg text-gray-700">
                                ★ Quality Products
                                <p className="text-sm text-gray-500 mt-1">Premium quality clothing</p>
                            </div>
                            <div className="bg-gradient-to-br from-pink-100 to-blue-100 p-4 rounded-lg text-gray-700">
                                ₹ Secure Payments
                                <p className="text-sm text-gray-500 mt-1">Instant secure checkouts</p>
                            </div>
                            <div className="bg-gradient-to-br from-pink-100 to-blue-100 p-4 rounded-lg text-gray-700">
                                ↔ 7 Days Exchange
                                <p className="text-sm text-gray-500 mt-1">Easy exchange policy</p>
                            </div>
                            <div className="bg-gradient-to-br from-pink-100 to-blue-100 p-4 rounded-lg text-gray-700">
                                📦 Fast Delivery
                                <p className="text-sm text-gray-500 mt-1">Quick & reliable shipping</p>
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