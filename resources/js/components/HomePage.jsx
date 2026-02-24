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
        <div className="min-h-screen bg-white">
            <style>{`
                @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap');

                * {
                    font-family: 'Poppins', sans-serif;
                }

                h1, h2, h3, h4, h5, h6 {
                    font-family: 'Playfair Display', serif;
                }

                .gradient-text {
                    background: linear-gradient(135deg, #d4a574 0%, #8b5cf6 50%, #ec4899 100%);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    background-clip: text;
                }

                .smooth-transition {
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                }

                .fade-in {
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

                .hover-lift {
                    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                }

                .hover-lift:hover {
                    transform: translateY(-8px);
                    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
                }

                .glow-on-hover:hover {
                    box-shadow: 0 0 30px rgba(236, 72, 153, 0.3);
                }
            `}</style>

            <Header />

            {/* Hero Section - Luxurious & Bold */}
            <section className="relative h-screen w-full  flex items-center justify-center">
                {/* Background Image with Sophisticated Overlay */}
                <div className="absolute inset-0">
                    <img
                        src="/images/hero01.png"
                        alt="Fashion Hero"
                        className="w-full h-full "
                    />
                        </div>

                {/* Content */}
                <div className="relative z-10 w-full px-4 sm:px-6 lg:px-8">
                    <div className="max-w-6xl mx-auto text-center">
                        {/* Main Heading */}
                        <h1 className="fade-in text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight">
                            Discover Your
                            <br />
                            <span className="gradient-text">Signature Style</span>
                        </h1>

                        {/* Subheading */}
                        <p className="fade-in text-lg md:text-xl text-gray-300 mb-12 max-w-2xl mx-auto opacity-90" style={{ animationDelay: '0.2s' }}>
                            Curated fashion pieces that tell your unique story
                        </p>

                        {/* Search Bar - Refined */}
                        <div className="fade-in w-full max-w-2xl mx-auto mb-12" style={{ animationDelay: '0.4s' }}>
                            <div className="relative flex items-center bg-white/10 backdrop-blur-xl rounded-full px-6 py-4 border border-white/20 hover:border-white/40 smooth-transition shadow-2xl">
                                <svg className="w-5 h-5 text-gray-300 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                <input
                                    type="text"
                                    placeholder="Search elegant fashion..."
                                    className="flex-1 bg-transparent border-0 outline-none text-white placeholder-gray-400 text-lg focus:ring-0"
                                />
                                <button className="ml-4 w-12 h-12 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center hover:from-purple-600 hover:to-pink-600 smooth-transition">
                                    <svg className="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        {/* Featured Images Carousel */}
                        <div className="fade-in" style={{ animationDelay: '0.6s' }}>
                            <div className="flex gap-4 justify-center overflow-x-auto pb-4 scrollbar-hide">
                                {['/images/1.png', '/images/3.png', '/images/4.png', '/images/2.png', '/images/5.png'].map((img, idx) => (
                                    <div key={idx} className="flex-shrink-0 h-64 w-48 rounded-2xl overflow-hidden cursor-pointer hover-lift group">
                                        <img src={img} alt={`Featured ${idx + 1}`} className="w-full h-full object-cover group-hover:scale-110 smooth-transition" />
                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>
                </div>

                {/* Scroll Indicator */}
                <div className="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
                    <svg className="w-6 h-6 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                    </svg>
                </div>
            </section>

            {/* Brand Story Section - Elegant & Spacious */}
            <section className="py-24 px-4 sm:px-6 lg:px-8 bg-white">
                <div className="max-w-4xl mx-auto">
                    <div className="grid md:grid-cols-2 gap-12 items-center">
                        {/* Image */}
                        <div className="fade-in order-2 md:order-1">
                            <img src="/images/Logo.png" alt="Aura Edit" className="w-full max-w-sm mx-auto" />
                        </div>

                        {/* Text */}
                        <div className="fade-in order-1 md:order-2" style={{ animationDelay: '0.2s' }}>
                            <p className="text-sm font-semibold text-purple-600 uppercase tracking-widest mb-4">LOOM & LORE</p>
                            <h2 className="text-5xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                                Your style story
                                <br />
                                <span className="gradient-text">starts here</span>
                            </h2>
                            <p className="text-lg text-gray-600 leading-relaxed mb-8">
                                We believe fashion is more than clothing—it's a form of self-expression. Our curated collection brings together bold textures, iconic silhouettes, and timeless pieces designed for every moment you want to stand out.
                            </p>
                            <Link to="/shop?title=Our Collection" className="inline-block px-8 py-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold rounded-lg hover-lift">
                                Explore Collection →
                            </Link>
                        </div>
                    </div>
                </div>
            </section>

            {/* Collection Gallery - Premium Layout */}
            <section className="py-24 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-gray-50 to-white">
                <div className="max-w-7xl mx-auto">
                    <div className="mb-16 text-center">
                        <h2 className="text-5xl md:text-6xl font-bold text-gray-900 mb-4">Featured Collections</h2>
                        <div className="w-16 h-1 bg-gradient-to-r from-purple-600 to-pink-600 mx-auto"></div>
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                        {/* Large Feature - Latest */}
                        <Link to="/shop?title=Shop the Latest" className="fade-in md:col-span-2 md:row-span-2 group overflow-hidden rounded-2xl relative h-96 md:h-full hover-lift">
                            <img
                                src={latestItem?.image || "/images/shop-latest.jpg"}
                                alt="Shop the Latest"
                                className="w-full h-full object-cover group-hover:scale-110 smooth-transition"
                            />
                            <div className="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-transparent"></div>
                            <div className="absolute bottom-0 left-0 right-0 p-8 text-white">
                                <h3 className="text-4xl font-bold mb-2">Shop the Latest</h3>
                                <p className="text-gray-200">Discover what's new</p>
                            </div>
                        </Link>

                        {/* Women's Collection */}
                        <Link to="/shop?category_id=2&title=Women's Collection" className="fade-in group overflow-hidden rounded-2xl relative h-64 hover-lift" style={{ animationDelay: '0.1s' }}>
                            <img
                                src={latestWomensItem?.image || "/images/collection-women.jpg"}
                                alt="Women's Collection"
                                className="w-full h-full object-cover group-hover:scale-110 smooth-transition"
                            />
                            <div className="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-transparent"></div>
                            <div className="absolute bottom-0 left-0 right-0 p-6 text-white">
                                <h3 className="text-2xl font-bold mb-1">Women's</h3>
                                <p className="text-gray-200 text-sm">Elegance & Style</p>
                            </div>
                        </Link>

                        {/* Men's Collection */}
                        <Link to="/shop?category_id=1&title=Men's Collections" className="fade-in group overflow-hidden rounded-2xl relative h-64 hover-lift" style={{ animationDelay: '0.2s' }}>
                            <img
                                src={latestMensItem?.image || "/images/collection-men.jpg"}
                                alt="Men's Collections"
                                className="w-full h-full object-cover group-hover:scale-110 smooth-transition"
                            />
                            <div className="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-transparent"></div>
                            <div className="absolute bottom-0 left-0 right-0 p-6 text-white">
                                <h3 className="text-2xl font-bold mb-1">Men's</h3>
                                <p className="text-gray-200 text-sm">Bold & Refined</p>
                            </div>
                        </Link>
                    </div>
                </div>
            </section>

            {/* Latest Arrivals - Product Grid */}
            <section className="py-24 px-4 sm:px-6 lg:px-8 bg-white">
                <div className="max-w-7xl mx-auto">
                    <div className="text-center mb-16">
                        <h2 className="text-5xl md:text-6xl font-bold text-gray-900 mb-4">Latest Arrivals</h2>
                        <p className="text-lg text-gray-600">Handpicked for you</p>
                        <div className="w-16 h-1 bg-gradient-to-r from-purple-600 to-pink-600 mx-auto mt-6"></div>
                    </div>

                    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                        {latestFourItems.map((product, idx) => (
                            <div key={product.id} className="fade-in stagger-item group">
                                <Link to={`/item/${product.id}`} className="block relative overflow-hidden rounded-xl mb-4 hover-lift">
                                    <div className="relative aspect-square bg-gray-100 overflow-hidden">
                                        <img
                                            src={product.image}
                                            alt={product.name}
                                            className="w-full h-full object-cover group-hover:scale-110 smooth-transition"
                                        />
                                        <div className="absolute inset-0 bg-black/0 group-hover:bg-black/20 smooth-transition"></div>
                                    </div>
                                </Link>

                                <div className="space-y-3">
                                    <h3 className="text-lg font-semibold text-gray-900 group-hover:text-purple-600 smooth-transition">{product.name}</h3>
                                    <p className="text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                                        Rs {product.prize?.toLocaleString()}.00
                                    </p>

                                    {/* Colors */}
                                    <div className="flex items-center gap-2 flex-wrap">
                                        {product.colors && product.colors.length > 0 ? (
                                            product.colors.map((color, idx) => (
                                                <div
                                                    key={idx}
                                                    className="w-4 h-4 rounded-full border-2 border-gray-200 hover:border-gray-400 smooth-transition cursor-pointer hover-lift"
                                                    style={{ backgroundColor: color.hex }}
                                                    title={color.name}
                                                ></div>
                                            ))
                                        ) : (
                                            <span className="text-xs text-gray-400">No variants</span>
                                        )}
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>

                    {/* CTA Button */}
                    <div className="text-center mt-16">
                        <Link to="/shop?title=Our Collection" className="inline-block px-10 py-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold rounded-lg hover-lift glow-on-hover">
                            View All Products →
                        </Link>
                    </div>
                </div>
            </section>

            {/* Shop by Category */}
            <section className="py-24 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-white via-purple-50 to-white">
                <div className="max-w-7xl mx-auto">
                    <div className="text-center mb-16">
                        <h2 className="text-5xl md:text-6xl font-bold text-gray-900 mb-4">Shop by Category</h2>
                        <p className="text-lg text-gray-600">Find what you love</p>
                        <div className="w-16 h-1 bg-gradient-to-r from-purple-600 to-pink-600 mx-auto mt-6"></div>
                    </div>

                    <div className="grid grid-cols-2 md:grid-cols-4 gap-6">
                        {typesWithItems.map((type, idx) => (
                            <Link key={type.type_id} to={`/shop?type_id=${type.type_id}&title=${type.type_name}`} className="fade-in stagger-item group relative overflow-hidden rounded-2xl h-72 hover-lift">
                                <img
                                    src={type.item_image || "/images/placeholder-category.jpg"}
                                    alt={type.type_name}
                                    className="w-full h-full object-cover group-hover:scale-110 smooth-transition"
                                />
                                <div className="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-transparent group-hover:from-black/70 smooth-transition"></div>
                                <div className="absolute bottom-0 left-0 right-0 p-6 text-white">
                                    <h3 className="text-xl font-semibold">{type.type_name}</h3>
                                    <p className="text-sm text-gray-300 mt-1">Explore collection →</p>
                                </div>
                            </Link>
                        ))}
                    </div>
                </div>
            </section>

            {/* Store Locations */}
            <section className="py-24 px-4 sm:px-6 lg:px-8 bg-white">
                <div className="max-w-7xl mx-auto">
                    <div className="text-center mb-16">
                        <h2 className="text-5xl md:text-6xl font-bold text-gray-900 mb-4">Visit Our Stores</h2>
                        <p className="text-lg text-gray-600">Experience fashion in person</p>
                        <div className="w-16 h-1 bg-gradient-to-r from-purple-600 to-pink-600 mx-auto mt-6"></div>
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                        {[
                            { name: 'Aura Edit - NUGEGODA', address: '350, High Level Road, Kirulapone (00600)' },
                            { name: 'Aura Edit - KADAWATHA', address: '43, Colombo-Kandy Road, Kadawatha (11850)' },
                            { name: 'Aura Edit - NUGEGODA', address: '#300, High Level Road, Kirulapone (00600)' }
                        ].map((store, idx) => (
                            <div key={idx} className="fade-in stagger-item p-8 rounded-2xl bg-gradient-to-br from-purple-50 to-pink-50 hover:shadow-xl smooth-transition group hover-lift border border-purple-100">
                                <div className="flex items-start mb-6">
                                    <div className="w-12 h-12 rounded-full bg-gradient-to-br from-purple-600 to-pink-600 flex items-center justify-center text-white mr-4 flex-shrink-0">
                                        <svg className="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 className="text-xl font-bold text-gray-900 mb-2">{store.name}</h3>
                                        <p className="text-gray-600">{store.address}</p>
                                    </div>
                                </div>
                                <div className="space-y-3 text-sm">
                                    <p className="text-gray-700"><span className="font-semibold">Email:</span> info@auraedit.lk</p>
                                    <p className="text-gray-700"><span className="font-semibold">Phone:</span> +94 777 777 777</p>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

            {/* Features Section */}
            <section className="py-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-slate-100 via-purple-100 to-slate-100">
                <div className="max-w-7xl mx-auto">
                    <div className="grid grid-cols-2 md:grid-cols-4 gap-8">
                        {[
                            { icon: '✨', title: 'Premium Quality', desc: 'Finest materials & craftsmanship' },
                            { icon: '🔒', title: 'Secure Checkout', desc: 'Safe & encrypted payments' },
                            { icon: '↔️', title: '7 Days Exchange', desc: 'Hassle-free exchanges' },
                            { icon: '📦', title: 'Fast Delivery', desc: 'Quick & reliable shipping' }
                        ].map((feature, idx) => (
                            <div key={idx} className="fade-in stagger-item text-center group">
                                <div className="text-5xl mb-4 group-hover:scale-125 smooth-transition">{feature.icon}</div>
                                <h3 className="text-xl font-bold mb-2 text-black">{feature.title}</h3>
                                <p className="text-gray-400 text-sm">{feature.desc}</p>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

            {/* Instagram Section */}
            <section className="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-white to-gray-50">
                <div className="max-w-4xl mx-auto text-center">
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
                    <h2 className="text-5xl md:text-6xl font-bold text-gray-900 mb-3">Explore Aura Edit Selection</h2>
                    <p className="text-xl text-gray-600 mb-6">@auraedit_selection</p>
                    <Link to="https://instagram.com" target="_blank" className="inline-block px-8 py-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold rounded-lg hover-lift">
                        Visit Instagram →
                    </Link>
                </div>
            </section>

            {/* Contact Section */}
            <section className="py-24 px-4 sm:px-6 lg:px-8 bg-white">
                <div className="max-w-3xl mx-auto">
                    <div className="text-center mb-16">
                        <h2 className="text-5xl md:text-6xl font-bold text-gray-900 mb-4">Get in Touch</h2>
                        <p className="text-lg text-gray-600">We'd love to hear from you</p>
                        <div className="w-16 h-1 bg-gradient-to-r from-purple-600 to-pink-600 mx-auto mt-6"></div>
                    </div>

                    <form className="space-y-6 bg-gradient-to-br from-purple-50 to-pink-50 p-8 md:p-12 rounded-2xl border border-purple-100">
                        <div className="grid md:grid-cols-2 gap-6">
                            <div>
                                <label className="block text-gray-800 font-semibold mb-3">Name</label>
                                <input
                                    type="text"
                                    placeholder="Your name"
                                    className="w-full px-6 py-3 bg-white border-2 border-purple-100 rounded-lg focus:outline-none focus:border-purple-500 smooth-transition"
                                />
                            </div>
                            <div>
                                <label className="block text-gray-800 font-semibold mb-3">Email</label>
                                <input
                                    type="email"
                                    placeholder="your@email.com"
                                    className="w-full px-6 py-3 bg-white border-2 border-purple-100 rounded-lg focus:outline-none focus:border-purple-500 smooth-transition"
                                />
                            </div>
                        </div>
                        <div>
                            <label className="block text-gray-800 font-semibold mb-3">Message</label>
                            <textarea
                                rows="6"
                                placeholder="Your message..."
                                className="w-full px-6 py-3 bg-white border-2 border-purple-100 rounded-lg focus:outline-none focus:border-purple-500 smooth-transition resize-none"
                            ></textarea>
                        </div>
                        <div className="text-center pt-4">
                            <button
                                type="submit"
                                className="px-12 py-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold rounded-lg hover-lift glow-on-hover"
                            >
                                Send Message →
                            </button>
                        </div>
                    </form>
                </div>
            </section>

            <Footer />
        </div>
    );
};

export default HomePage;