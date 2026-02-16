import React, { useEffect, useState } from 'react';
import { useParams, Link } from 'react-router-dom';
import Header from './Header';
import Footer from './Footer';

const ItemDetailPage = () => {
    const { id } = useParams();
    const [item, setItem] = useState(null);
    const [loading, setLoading] = useState(true);
    const [activePhoto, setActivePhoto] = useState(null);
    const [isHovering, setIsHovering] = useState(false);
    const [selectedColor, setSelectedColor] = useState(null);

    useEffect(() => {
        const fetchItem = async () => {
            setLoading(true);
            try {
                const res = await fetch(`/api/items/${id}`);
                const data = await res.json();
                if (data.success) {
                    setItem(data.data);
                    setActivePhoto(data.data.image);
                    // Set default color if available
                    if (data.data.colors?.length > 0) {
                        setSelectedColor(data.data.colors[0].name);
                    }
                } else {
                    setItem(null);
                }
            } catch {
                setItem(null);
            } finally {
                setLoading(false);
                window.scrollTo(0, 0);
            }
        };
        fetchItem();
    }, [id]);

    const addToCart = () => alert('Added to cart!');
    const buyNow = () => alert('Proceeding to checkout...');

    const formatDate = (value) => (value ? new Date(value).toLocaleDateString() : '—');
    const classificationNames = item?.classifications || [];

    // Icon components for specs
    const SpecIcon = ({ path, color = 'bg-pink-50 text-pink-500' }) => (
        <div className={`p-2 rounded-xl ${color} mb-3 inline-flex`}>
            <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d={path} />
            </svg>
        </div>
    );

    return (
        <div className="min-h-screen bg-[#fafafa] font-sans text-gray-900 selection:bg-pink-100 selection:text-pink-600">
            <div className="sticky top-0 z-50">
                <Header />
            </div>

            <main className="max-w-7.5xl mx-auto py-8 sm:py-16 px-4 sm:px-6 lg:px-8">
                {loading ? (
                    <div className="flex justify-center items-center h-[60vh]">
                        <div className="w-12 h-12 border-4 border-pink-200 border-t-pink-500 rounded-full animate-spin"></div>
                    </div>
                ) : item ? (
                    <div className="flex flex-col lg:flex-row gap-12 lg:gap-20">
                        {/* Photo Gallery Column */}
                        <div className="w-full lg:w-1/2 space-y-6">
                            <div
                                className="relative group aspect-[4/5] rounded-[2rem] overflow-hidden bg-white shadow-2xl shadow-gray-200/50 border border-white/40"
                                onMouseEnter={() => setIsHovering(true)}
                                onMouseLeave={() => setIsHovering(false)}
                            >
                                <img
                                    src={activePhoto || '/images/placeholder.jpg'}
                                    alt={item.name}
                                    className={`w-full h-full object-cover transition-transform duration-1000 ease-out ${isHovering ? 'scale-110' : 'scale-100'}`}
                                />
                                <div className="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500" />
                            </div>

                            {/* Thumbnails */}
                            {(item.photos?.length > 0 || item.image) && (
                                <div className="flex gap-4 overflow-x-auto py-2 px-1 no-scrollbar items-center">
                                    {item.image && (
                                        <button
                                            onClick={() => setActivePhoto(item.image)}
                                            className={`relative flex-shrink-0 w-24 h-24 rounded-2xl border-2 transition-all duration-300 overflow-hidden ${activePhoto === item.image
                                                ? 'border-pink-500 ring-4 ring-pink-50 scale-105 shadow-lg'
                                                : 'border-transparent grayscale hover:grayscale-0 hover:scale-105'
                                                }`}
                                        >
                                            <img src={item.image} alt="Thumbnail main" className="w-full h-full object-cover" />
                                        </button>
                                    )}
                                    {item.photos?.map((photo, idx) => (
                                        <button
                                            key={idx}
                                            onClick={() => setActivePhoto(photo.url)}
                                            className={`relative flex-shrink-0 w-24 h-24 rounded-2xl border-2 transition-all duration-300 overflow-hidden ${activePhoto === photo.url
                                                ? 'border-pink-500 ring-4 ring-pink-50 scale-105 shadow-lg'
                                                : 'border-transparent grayscale hover:grayscale-0 hover:scale-105'
                                                }`}
                                        >
                                            <img src={photo.url} alt={`Thumbnail ${idx}`} className="w-full h-full object-cover" />
                                        </button>
                                    ))}
                                </div>
                            )}
                        </div>

                        {/* Details Column */}
                        <div className="w-full lg:w-1/2 flex flex-col pt-4">
                            <div className="space-y-6">
                                <div className="inline-flex items-center gap-2 mb-2">
                                    <span className="text-[10px] font-black text-pink-600 bg-pink-50 px-3 py-1.5 rounded-full uppercase tracking-[0.2em]">
                                        {item.category}
                                    </span>
                                    <span className="text-black-300">,</span>
                                    <span className="text-[10px] font-black text-blue-600 bg-blue-50 px-3 py-1.5 rounded-full uppercase tracking-[0.2em]">
                                        {item.type}
                                    </span>
                                </div>

                                <h1 className="text-4xl sm:text-6xl font-black text-gray-900 leading-tight tracking-tight">
                                    {item.name}
                                </h1>

                                <div className="flex items-end gap-5 py-4">
                                    {item.is_on_offer ? (
                                        <div className="flex flex-col">
                                            <div className="flex items-center gap-3">
                                                <span className="text-4xl font-black text-pink-600">
                                                    Rs {(item.prize * (1 - item.offer_percentage / 100)).toLocaleString()}.00
                                                </span>
                                                <span className="bg-red-500 text-white text-[10px] font-black px-2.5 py-1 rounded-lg uppercase tracking-wider">
                                                    {item.offer_percentage}% OFF
                                                </span>
                                            </div>
                                            <span className="text-lg text-gray-400 line-through mt-1">
                                                Regular Price: Rs {item.prize?.toLocaleString()}
                                            </span>
                                        </div>
                                    ) : (
                                        <span className="text-5xl font-black text-gray-900">
                                            Rs {item.prize?.toLocaleString()}.00
                                        </span>
                                    )}
                                </div>

                                {/* Premium Description Reveal */}
                                <div className="pt-8 border-t border-gray-100">
                                    <h3 className="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-4">The Story</h3>
                                    <p className="text-lg text-gray-600 leading-relaxed font-light">
                                        {item.description || "Designed with precision and crafted for the modern individual, this piece embodies a perfect balance of heritage and contemporary style."}
                                    </p>
                                </div>

                                {/* Tech Specs Grid - Styled as Premium Cards */}
                                <div className="grid grid-cols-2 md:grid-cols-3 gap-4 py-8">
                                    <div className="p-5 rounded-3xl bg-white border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300">
                                        <SpecIcon path="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" color="bg-blue-50 text-blue-500" />
                                        <h4 className="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">CO Name</h4>
                                        <p className="font-bold text-gray-900 truncate">{item.co_name || '—'}</p>
                                    </div>
                                    <div className="p-5 rounded-3xl bg-white border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300">
                                        <SpecIcon path="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" color="bg-purple-50 text-purple-500" />
                                        <h4 className="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">SKU ID</h4>
                                        <p className="font-bold text-gray-900 truncate">{item.SKU || '—'}</p>
                                    </div>
                                    <div className="p-5 rounded-3xl bg-white border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300">
                                        <SpecIcon path="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" color="bg-green-50 text-green-500" />
                                        <h4 className="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Stock Status</h4>
                                        <p className="font-bold text-gray-900 px-2 py-0.5 rounded-full bg-green-50 text-green-700 inline-block text-xs">
                                            {item.stock_items > 0 ? `${item.stock_items} in stock` : 'Out of Stock'}
                                        </p>
                                    </div>
                                    <div className="p-5 rounded-3xl bg-white border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300">
                                        <SpecIcon path="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" color="bg-orange-50 text-orange-500" />
                                        <h4 className="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Material</h4>
                                        <p className="font-bold text-gray-900">{item.material || 'Linen Blend'}</p>
                                    </div>
                                    <div className="p-5 rounded-3xl bg-white border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 col-span-2">
                                        <SpecIcon path="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" color="bg-pink-50 text-pink-500" />
                                        <h4 className="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Classifications</h4>
                                        <div className="flex flex-wrap gap-2">
                                            {classificationNames.length ? classificationNames.map((c, i) => (
                                                <span key={i} className="text-xs font-bold text-gray-700 bg-gray-100 px-2 py-1 rounded-md">{c}</span>
                                            )) : <p className="font-bold text-gray-900">—</p>}
                                        </div>
                                    </div>
                                </div>

                                {/* Premium Color Selection */}
                                {item.colors?.length > 0 && (
                                    <div className="space-y-4 py-4 border-t border-gray-100">
                                        <div className="flex items-center justify-between">
                                            <h3 className="text-sm font-black text-gray-800 uppercase tracking-widest">Available Colors</h3>
                                            <span className="text-[10px] font-bold text-pink-500 uppercase tracking-widest">{selectedColor}</span>
                                        </div>
                                        <div className="flex flex-wrap gap-4">
                                            {item.colors.map((color, idx) => (
                                                <button
                                                    key={idx}
                                                    onClick={() => setSelectedColor(color.name)}
                                                    className={`group relative w-10 h-10 rounded-full transition-all duration-300 ${selectedColor === color.name
                                                        ? 'ring-offset-2 ring-2 ring-gray-900 scale-110 shadow-lg'
                                                        : 'hover:scale-110 hover:shadow-md'
                                                        }`}
                                                    title={color.name}
                                                >
                                                    <span
                                                        className="block w-full h-full rounded-full border border-gray-200"
                                                        style={{ backgroundColor: color.hex || '#ccc' }}
                                                    />
                                                    <span className={`absolute -bottom-8 left-1/2 -translate-x-1/2 text-[10px] font-bold text-gray-900 opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none ${selectedColor === color.name ? 'opacity-100' : ''}`}>
                                                        {color.name}
                                                    </span>
                                                </button>
                                            ))}
                                        </div>
                                    </div>
                                )}

                                {/* Sizes Selection Visuals */}
                                <div className="space-y-4 py-6">
                                    <div className="flex items-center justify-between">
                                        <h3 className="text-sm font-black text-gray-800 uppercase tracking-widest">Select Fitment</h3>
                                        <button className="text-xs font-bold text-pink-500 hover:text-pink-600 underline">Size Guide</button>
                                    </div>
                                    <div className="flex flex-wrap gap-3">
                                        {['S', 'M', 'L', 'XL', 'XXL'].map(sz => (
                                            <button
                                                key={sz}
                                                className={`w-14 h-14 rounded-2xl font-black text-sm transition-all duration-300 border-2 ${item.size_label === sz
                                                    ? 'bg-gray-900 border-gray-900 text-white shadow-xl scale-110'
                                                    : 'bg-white border-gray-100 text-gray-400 hover:border-pink-200 hover:text-pink-500'
                                                    }`}
                                            >
                                                {sz}
                                            </button>
                                        ))}
                                    </div>
                                    {item.size && (
                                        <p className="text-xs font-bold text-gray-400">
                                            Selected Variant: <span className="text-gray-900 ml-1">{item.size}</span>
                                        </p>
                                    )}
                                </div>

                                {item.note && (
                                    <div className="p-6 rounded-[2rem] bg-amber-50/50 border border-amber-100/50 backdrop-blur-sm">
                                        <div className="flex items-center gap-2 mb-2">
                                            <svg className="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"></path></svg>
                                            <h3 className="text-[10px] font-black text-amber-600 uppercase tracking-widest">A Note from the Team</h3>
                                        </div>
                                        <p className="text-sm text-amber-800/80 leading-relaxed italic">"{item.note}"</p>
                                    </div>
                                )}

                                {/* Sticky Actions Card on Desktop */}
                                <div className="flex flex-col sm:flex-row gap-4 pt-10">
                                    <button
                                        onClick={buyNow}
                                        className="flex-1 py-6 bg-gradient-to-r from-gray-900 to-black text-white rounded-3xl font-black text-lg hover:shadow-[0_20px_40px_-15px_rgba(0,0,0,0.3)] hover:-translate-y-1 transition-all duration-300 active:scale-95"
                                    >
                                        Buy It Now
                                    </button>
                                    <button
                                        onClick={addToCart}
                                        className="flex-1 py-6 bg-white border-2 border-gray-900 text-gray-900 rounded-3xl font-black text-lg hover:bg-gray-900 hover:text-white transition-all duration-300 active:scale-95 group"
                                    >
                                        Add to Cart
                                        <span className="inline-block ml-2 transition-transform group-hover:translate-x-1">→</span>
                                    </button>
                                </div>

                                <div className="pt-10 flex justify-center">
                                    <Link to="/shop" className="group flex items-center gap-3 text-xs font-black text-gray-400 hover:text-pink-600 transition-colors uppercase tracking-[0.2em]">
                                        <span className="p-2 rounded-full border border-gray-100 group-hover:bg-pink-50 group-hover:border-pink-100 transition-all">
                                            <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                                        </span>
                                        Back to the Collection
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                ) : (
                    <div className="max-w-xl mx-auto text-center py-20 px-8 bg-white rounded-[3rem] shadow-2xl shadow-gray-200/50 border border-white">
                        <div className="w-24 h-24 bg-pink-50 rounded-full flex items-center justify-center mx-auto mb-8">
                            <svg className="w-10 h-10 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </div>
                        <h2 className="text-4xl font-black text-gray-900 mb-4 tracking-tight">Item Not Found</h2>
                        <p className="text-gray-500 mb-10 font-medium">The product you are looking for might have been moved or is currently out of stock.</p>
                        <Link
                            to="/shop"
                            className="inline-block px-12 py-5 rounded-2xl bg-gray-900 text-white font-black hover:bg-black shadow-xl transition-all hover:-translate-y-1 active:scale-95"
                        >
                            Return to Shop
                        </Link>
                    </div>
                )}
            </main>

            <Footer />

            {/* Custom Styles for hidden scrollbars */}
            <style dangerouslySetInnerHTML={{
                __html: `
                .no-scrollbar::-webkit-scrollbar { display: none; }
                .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
            `}} />
        </div>
    );
};

export default ItemDetailPage;
