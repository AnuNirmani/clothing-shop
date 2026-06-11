import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import Header from './Header';
import Footer from './Footer';

const HomePage = () => {
    const [latestItem, setLatestItem] = useState(null);
    const [latestWomensItem, setLatestWomensItem] = useState(null);
    const [latestMensItem, setLatestMensItem] = useState(null);
    const [latestFourItems, setLatestFourItems] = useState([]);
    const [offeredItems, setOfferedItems] = useState([]);
    const [typesWithItems, setTypesWithItems] = useState([]);
    const [heroImage, setHeroImage] = useState('/images/hero01.png');
    const [heroVideo, setHeroVideo] = useState(null);
    const [heroButtons, setHeroButtons] = useState([]);
    const [stores, setStores] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        fetchLatestItems();
    }, []);

    const fetchLatestItems = async () => {
        try {
            const [latestRes, womensRes, mensRes, fourRes, offeredRes, typesRes, heroRes, heroButtonsRes, storesRes] = await Promise.all([
                fetch('/api/items/latest'),
                fetch('/api/items/latest-womens'),
                fetch('/api/items/latest-mens'),
                fetch('/api/items/latest-four'),
                fetch('/api/items/offered'),
                fetch('/api/types/latest-items'),
                fetch('/api/home/hero-image'),
                fetch('/api/home/hero-buttons'),
                fetch('/api/home/stores')
            ]);

            const latestData = await latestRes.json();
            const womensData = await womensRes.json();
            const mensData = await mensRes.json();
            const fourData = await fourRes.json();
            const offeredData = await offeredRes.json();
            const typesData = await typesRes.json();
            const heroData = await heroRes.json();
            const heroButtonsData = await heroButtonsRes.json();
            const storesData = await storesRes.json();

            if (latestData.success) setLatestItem(latestData.data);
            if (womensData.success) setLatestWomensItem(womensData.data);
            if (mensData.success) setLatestMensItem(mensData.data);
            if (fourData.success) setLatestFourItems(fourData.data);
            if (offeredData.success) setOfferedItems(offeredData.data);
            if (typesData.success) setTypesWithItems(typesData.data);
            if (heroData.success && heroData.data?.image) setHeroImage(heroData.data.image);
            if (heroData.success && heroData.data?.video) setHeroVideo(heroData.data.video);
            if (heroButtonsData.success && Array.isArray(heroButtonsData.data)) setHeroButtons(heroButtonsData.data);
            if (storesData.success && Array.isArray(storesData.data)) setStores(storesData.data);
        } catch (error) {
            console.error('Error fetching latest items:', error);
        } finally {
            setLoading(false);
        }
    };

    const getDiscountPercent = (item) => {
        const offerPct = Number(item?.offer_percentage || 0);
        if (offerPct > 0) return Math.round(offerPct);

        const original = Number(item?.prize || 0);
        const discounted = Number(item?.discounted_price || 0);
        if (original > 0 && discounted > 0 && discounted < original) {
            return Math.round(((original - discounted) / original) * 100);
        }
        return 0;
    };

    return (
        <div className="min-h-screen bg-white">
            <style>{`
                @import url('https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,700&family=Manrope:wght@400;500;600;700&display=swap');

                :root {
                    --bg: #f8f6f2;
                    --surface: #fffcf7;
                    --ink: #1f1b16;
                    --muted: #6f6357;
                    --accent: #c26838;
                    --accent-deep: #8f3f1f;
                    --line: #e8dfd4;
                }

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
            <section className="relative h-[58vh] w-full sm:h-[65vh] lg:h-[72vh] max-h-[760px] flex items-center justify-center overflow-hidden">
                <div className="absolute inset-0">
                    {heroVideo ? (
                        <video
                            src={heroVideo}
                            className="h-full w-full object-cover"
                            autoPlay
                            muted
                            loop
                            playsInline
                            onError={() => setHeroVideo(null)}
                        />
                    ) : (
                        <img
                            src={heroImage}
                            alt="Fashion Hero"
                            className="h-full w-full object-cover"
                            onError={(e) => {
                                if (e.currentTarget.src.includes('/images/hero01.png')) return;
                                e.currentTarget.src = '/images/hero01.png';
                            }}
                        />
                    )}
                    <div className="absolute inset-0 bg-black/20" />
                </div>

                {/* Hero Buttons - bottom left */}
                {heroButtons.length > 0 && (
                    <div className="absolute bottom-6 left-6 flex flex-wrap gap-3">
                        {heroButtons.map((btn, idx) => (
                            <Link
                                key={idx}
                                to={btn.link}
                                style={{ backgroundColor: btn.bg_color, color: btn.text_color }}
                                className="inline-flex items-center rounded-full px-5 py-2.5 text-sm font-semibold shadow-lg transition-transform hover:scale-105 hover:shadow-xl"
                            >
                                {btn.label}
                            </Link>
                        ))}
                    </div>
                )}
            </section>

            {/* Last Chance / Offered Items */}
            <section className="py-12 px-4 sm:px-6 lg:px-8 bg-white">
                <div className="mx-auto w-full max-w-[1800px]">
                    <div className="mb-5 flex items-center justify-between gap-4">
                        <div>
                            <p className="text-xs font-bold uppercase tracking-[0.18em] text-gray-700">SHOP UP TO 60%</p>
                            <h2 className="mt-1 text-4xl font-black uppercase italic leading-none text-black">LAST CHANCE TO BUY</h2>
                        </div>

                        <div className="flex items-center gap-3">
                            <Link
                                to="/shop?title=Offered%20Items&offered=1"
                                className="text-sm font-bold uppercase tracking-[0.16em] text-black hover:text-purple-600 smooth-transition"
                            >
                                Shop All
                            </Link>
                            <span className="hidden md:inline-flex h-9 w-9 items-center justify-center rounded-full border border-gray-300 text-gray-400">‹</span>
                            <span className="hidden md:inline-flex h-9 w-9 items-center justify-center rounded-full border border-gray-400 text-gray-600">›</span>
                        </div>
                    </div>

                    {loading ? (
                        <p className="text-sm text-gray-500">Loading offered items...</p>
                    ) : offeredItems.length > 0 ? (
                        <div className="grid grid-cols-1 gap-2 md:gap-3 sm:grid-cols-2 lg:grid-cols-4">
                            {offeredItems.map((item) => {
                                const discountPct = getDiscountPercent(item);
                                const originalPrice = Number(item?.prize || 0);
                                const discountedPrice = Number(item?.discounted_price || item?.prize || 0);
                                const hasDiscount = discountedPrice < originalPrice;

                                return (
                                    <Link key={item.id} to={`/item/${item.id}`} className="group block">
                                        <div className="relative overflow-hidden bg-[#f3f4f6]">
                                            <img
                                                src={item.image || '/images/placeholder-category.jpg'}
                                                alt={item.name}
                                                className="h-[460px] w-full object-cover transition duration-500 group-hover:scale-105"
                                            />

                                            {Number(item?.stock_items || 0) <= 0 && (
                                                <span className="absolute right-2 top-2 bg-slate-600 px-3 py-1 text-[10px] font-bold uppercase tracking-wider text-white">
                                                    Sold Out
                                                </span>
                                            )}

                                            {discountPct > 0 && (
                                                <span className="absolute left-2 bottom-2 bg-red-600 px-3 py-1 text-[11px] font-bold uppercase text-white">
                                                    {discountPct}% OFF
                                                </span>
                                            )}
                                        </div>

                                        <div className="pt-2">
                                            <div className="mb-2 flex items-center gap-1.5">
                                                {(item.colors || []).slice(0, 5).map((color, index) => (
                                                    <span
                                                        key={`${item.id}-${index}`}
                                                        className="h-4 w-4 rounded-[2px] border border-gray-300"
                                                        style={{ backgroundColor: color.hex }}
                                                        title={color.name}
                                                    />
                                                ))}
                                            </div>

                                            <h3 className="line-clamp-1 text-[30px] font-semibold leading-tight text-gray-900">{item.name}</h3>
                                            <p className="line-clamp-1 text-sm text-gray-500">{item.type || item.category || 'Collection'}</p>

                                            <div className="mt-1 flex items-center gap-3 text-sm">
                                                <span className={`text-gray-500 ${hasDiscount ? 'line-through' : ''}`}>
                                                    LKR {originalPrice.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}
                                                </span>
                                                {hasDiscount && (
                                                    <span className="font-bold text-rose-600">
                                                        LKR {discountedPrice.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}
                                                    </span>
                                                )}
                                            </div>
                                        </div>
                                    </Link>
                                );
                            })}
                        </div>
                    ) : (
                        <p className="text-sm text-gray-500">No offered items available right now.</p>
                    )}
                </div>
            </section>

            {/* <section className="py-24 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-gray-50 to-white">
                <div className="mx-auto max-w-7xl">
                    <div className="mb-14 text-center">
                        <h2 className="section-line inline-block text-4xl font-bold sm:text-5xl">Featured Collections</h2>
                        <div className="w-16 h-1 bg-gradient-to-r from-purple-600 to-pink-600 mx-auto mt-6"></div>
                    </div>

                    <div className="grid grid-cols-1 gap-6 md:grid-cols-3">
                        <Link to="/shop?title=Shop the Latest" className="group relative overflow-hidden rounded-3xl md:col-span-2 md:row-span-2">
                            <img
                                src={latestItem?.image || '/images/shop-latest.jpg'}
                                alt="Shop the Latest"
                                className="h-full min-h-[420px] w-full object-cover transition duration-700 group-hover:scale-105"
                            />
                            <div className="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent" />
                            <div className="absolute bottom-0 left-0 p-8 text-white">
                                <p className="mb-2 text-xs tracking-[0.2em] text-white/85">JUST IN</p>
                                <h3 className="text-4xl font-bold">Shop the Latest</h3>
                                <p className="mt-1 text-sm text-gray-200">New arrivals ready to elevate your wardrobe.</p>
                            </div>
                        </Link>

                        <Link to="/shop?category_id=2&title=Women's Collection" className="group relative overflow-hidden rounded-3xl">
                            <img
                                src={latestWomensItem?.image || '/images/collection-women.jpg'}
                                alt="Women's Collection"
                                className="h-64 w-full object-cover transition duration-700 group-hover:scale-105"
                            />
                            <div className="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent" />
                            <div className="absolute bottom-0 left-0 p-6 text-white">
                                <h3 className="text-2xl font-bold">Women&apos;s</h3>
                                <p className="text-sm text-gray-200">Elegant and expressive</p>
                            </div>
                        </Link>

                        <Link to="/shop?category_id=1&title=Men's Collections" className="group relative overflow-hidden rounded-3xl">
                            <img
                                src={latestMensItem?.image || '/images/collection-men.jpg'}
                                alt="Men's Collection"
                                className="h-64 w-full object-cover transition duration-700 group-hover:scale-105"
                            />
                            <div className="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent" />
                            <div className="absolute bottom-0 left-0 p-6 text-white">
                                <h3 className="text-2xl font-bold">Men&apos;s</h3>
                                <p className="text-sm text-gray-200">Modern and sharp</p>
                            </div>
                        </Link>
                    </div>
                </div>
            </section> */}

            <section className="py-12 px-4 sm:px-6 lg:px-8 bg-white">
                <div className="mx-auto w-full max-w-[1800px]">
                    <div className="mb-6 flex items-center justify-between gap-4">
                        <div>
                            <h2 className="mt-1 text-4xl font-black uppercase italic leading-none text-black">LATESR ARRIVED</h2>
                        </div>

                        <div className="flex items-center gap-3">
                            <Link
                                to="/shop?title=Our Collection"
                                className="text-sm font-bold uppercase tracking-[0.16em] text-black hover:text-purple-600 smooth-transition"
                            >
                                Shop All
                            </Link>
                            <span className="inline-flex h-9 w-9 items-center justify-center rounded-full border border-gray-200 text-gray-300">‹</span>
                            <span className="inline-flex h-9 w-9 items-center justify-center rounded-full border border-gray-200 text-gray-300">›</span>
                        </div>
                    </div>

                    {loading ? (
                        <p className="text-center text-[var(--muted)]">Loading latest products...</p>
                    ) : (
                        <div className="grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-4">
                            {latestFourItems.map((product) => {
                                const colors = (product.colors || []).slice(0, 5);
                                const price = Number(product.prize || 0);
                                const discounted = Number(product.discounted_price || 0);
                                const hasDiscount = discounted > 0 && discounted < price;

                                return (
                                    <Link key={product.id} to={`/item/${product.id}`} className="group block">
                                        <div className="relative overflow-hidden bg-[#f3f4f6]">
                                            <img
                                                src={product.image || '/images/collection-men.jpg'}
                                                alt={product.name}
                                                onError={(e) => {
                                                    if (e.currentTarget.src.includes('/images/collection-men.jpg')) return;
                                                    e.currentTarget.src = '/images/collection-men.jpg';
                                                }}
                                                className="h-[560px] w-full object-cover transition duration-500 group-hover:scale-105"
                                            />

                                            {Number(product?.stock_items || 0) <= 0 && (
                                                <span className="absolute right-2 top-2 bg-slate-500 px-3 py-1 text-[10px] font-bold uppercase tracking-wider text-white">
                                                    Sold Out
                                                </span>
                                            )}

                                            {hasDiscount && (
                                                <span className="absolute left-2 bottom-2 bg-red-600 px-3 py-1 text-[11px] font-bold uppercase text-white">
                                                    {Math.round(((price - discounted) / price) * 100)}% OFF
                                                </span>
                                            )}
                                        </div>

                                        <div className="space-y-1 pt-2">
                                            <div className="flex items-center gap-1.5">
                                                {colors.length > 0 ? (
                                                    colors.map((color, index) => (
                                                        <span
                                                            key={`${product.id}-${index}`}
                                                            className="h-4 w-4 rounded-[2px] border border-gray-300"
                                                            style={{ backgroundColor: color.hex }}
                                                            title={color.name}
                                                        />
                                                    ))
                                                ) : (
                                                    <span className="text-xs italic text-gray-400">No colors</span>
                                                )}
                                            </div>

                                            <h3 className="line-clamp-1 text-[28px] font-semibold leading-tight text-[var(--ink)]">{product.name}</h3>
                                            <p className="line-clamp-1 text-sm text-gray-500">{product.type || product.category || 'Collection'}</p>

                                            <div className="flex items-center gap-2 text-sm">
                                                <span className={`text-gray-500 ${hasDiscount ? 'line-through' : ''}`}>
                                                    LKR {price.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}
                                                </span>
                                                {hasDiscount && (
                                                    <span className="font-bold text-red-500">
                                                        LKR {discounted.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}
                                                    </span>
                                                )}
                                            </div>
                                        </div>
                                    </Link>
                                );
                            })}
                        </div>
                    )}
                </div>
            </section>

            <section id="shop" className="py-14 px-4 sm:px-6 lg:px-8 bg-white">
                <div className="mx-auto w-full max-w-[1800px]">
                    <div className="mb-8 text-center">
                        <p className="text-xs font-bold uppercase tracking-[0.18em] text-gray-700">Explore by Type</p>
                        <h2 className="mt-2 text-5xl font-black leading-none text-black">Shop by Category</h2>
                        <p className="mt-4 text-[var(--muted)]">Find what fits your mood and moment.</p>
                        <div className="mx-auto mt-5 h-1 w-16 bg-gradient-to-r from-purple-600 to-pink-600"></div>
                    </div>

                    <div className="grid grid-cols-2 gap-2 md:gap-3 md:grid-cols-4">
                        {typesWithItems.map((type) => (
                            <Link
                                key={type.type_id}
                                to={`/shop?type_id=${type.type_id}&title=${type.type_name}`}
                                className="group block"
                            >
                                <div className="relative overflow-hidden rounded-2xl bg-[#f3f4f6]">
                                    <img
                                        src={type.item_image || '/images/collection-men.jpg'}
                                        alt={type.type_name}
                                        onError={(e) => {
                                            if (e.currentTarget.src.includes('/images/collection-men.jpg')) return;
                                            e.currentTarget.src = '/images/collection-men.jpg';
                                        }}
                                        className="h-[380px] w-full object-cover transition duration-500 group-hover:scale-105"
                                    />
                                    <div className="absolute inset-0 bg-gradient-to-t from-black/65 via-black/10 to-transparent" />

                                    <div className="absolute bottom-3 left-3 right-3 flex items-center justify-between rounded-xl bg-white/95 px-4 py-2.5 text-sm font-semibold text-[var(--ink)] transition duration-300 group-hover:bg-gradient-to-r group-hover:from-purple-600 group-hover:to-pink-600 group-hover:text-white">
                                        <span className="line-clamp-1 pr-2">{type.type_name}</span>
                                        <span>→</span>
                                    </div>
                                </div>
                            </Link>
                        ))}
                    </div>
                </div>
            </section>

            {/* Store Locations */}
            <section className="py-24 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-purple-100 via-pink-50 to-purple-100">
                <div className="max-w-7xl mx-auto">
                    <div className="text-center mb-16">
                        <h2 className="section-line inline-block text-4xl font-bold sm:text-5xl">Visit Our Stores</h2>
                        <p className="mt-8 text-[var(--muted)]">Experience fashion in person</p>
                        <div className="w-16 h-1 bg-gradient-to-r from-purple-600 to-pink-600 mx-auto mt-6"></div>
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                        {stores.map((store, idx) => (
                            <div key={idx} className="p-8 rounded-2xl bg-gradient-to-br from-purple-50 to-pink-50 border border-purple-100 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
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
                                    {store.email && <p className="text-gray-700"><span className="font-semibold">Email:</span> {store.email}</p>}
                                    {store.phone && <p className="text-gray-700"><span className="font-semibold">Phone:</span> {store.phone}</p>}
                                </div>
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
                    <h2 className="mb-3 text-4xl font-bold sm:text-5xl">Explore Aura Edit Selection</h2>
                    <p className="text-xl text-gray-600 mb-6">@auraedit_selection</p>
                    <Link to="https://instagram.com" target="_blank" className="inline-block px-8 py-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold rounded-lg hover-lift">
                        Visit Instagram →
                    </Link>
                </div>
            </section>

            <section className="py-24 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-purple-100 via-pink-50 to-purple-100">
                <div className="mx-auto max-w-3xl rounded-3xl border border-[var(--line)] bg-white p-8 shadow-sm sm:p-12">
                    <div className="mb-10 text-center">
                        <h2 className="text-4xl font-bold sm:text-5xl">Get in Touch</h2>
                        <p className="mt-3 text-[var(--muted)]">We would love to hear from you.</p>
                    </div>

                    <form className="space-y-6">
                        <div className="grid gap-6 md:grid-cols-2">
                            <div>
                                <label className="mb-2 block text-sm font-semibold">Name</label>
                                <input
                                    type="text"
                                    placeholder="Your name"
                                    className="w-full rounded-xl border border-[var(--line)] px-4 py-3 outline-none transition focus:border-[var(--accent)]"
                                />
                            </div>
                            <div>
                                <label className="mb-2 block text-sm font-semibold">Email</label>
                                <input
                                    type="email"
                                    placeholder="you@email.com"
                                    className="w-full rounded-xl border border-[var(--line)] px-4 py-3 outline-none transition focus:border-[var(--accent)]"
                                />
                            </div>
                        </div>
                        <div>
                            <label className="mb-2 block text-sm font-semibold">Message</label>
                            <textarea
                                rows="6"
                                placeholder="Your message..."
                                className="w-full resize-none rounded-xl border border-[var(--line)] px-4 py-3 outline-none transition focus:border-[var(--accent)]"
                            />
                        </div>
                        <button
                            type="submit"
                            className="w-full rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 px-6 py-3 font-semibold text-white transition hover-lift"
                        >
                            Send Message
                        </button>
                    </form>
                </div>
            </section>

            {/* Features Section */}
            <section className="py-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-white via-purple-50 to-white">
                <div className="max-w-7xl mx-auto">
                    <div className="grid grid-cols-2 md:grid-cols-4 gap-8">
                        {[
                            { icon: '✨', title: 'Premium Quality', desc: 'Finest materials & craftsmanship' },
                            { icon: '🔒', title: 'Secure Checkout', desc: 'Safe & encrypted payments' },
                            { icon: '↔️', title: '7 Days Exchange', desc: 'Hassle-free exchanges' },
                            { icon: '📦', title: 'Fast Delivery', desc: 'Quick & reliable shipping' }
                        ].map((feature, idx) => (
                            <div key={idx} className="text-center transition-transform duration-300 hover:-translate-y-1">
                                <div className="text-5xl mb-4 transition-transform duration-300 hover:scale-110">{feature.icon}</div>
                                <h3 className="text-xl font-bold mb-2 text-black">{feature.title}</h3>
                                <p className="text-gray-600 text-sm">{feature.desc}</p>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

            <Footer />
        </div>
    );
};

export default HomePage;
