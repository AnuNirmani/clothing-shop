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
    const [quantity, setQuantity] = useState(1);

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

            <main className="max-w-8xl mx-auto py-4 sm:py-8 px-4 sm:px-6 lg:px-8">
                {loading ? (
                    <div className="flex justify-center items-center h-[60vh]">
                        <div className="w-12 h-12 border-4 border-pink-200 border-t-pink-500 rounded-full animate-spin"></div>
                    </div>
                ) : item ? (
                    <div className="flex flex-col lg:flex-row gap-6 items-start">
                        {/* Main Image Column */}
                        <div className="w-full lg:flex-1">
                            <div
                                className="relative group aspect-[4/5] rounded-[0.5rem] overflow-hidden bg-white shadow-sm border border-gray-100"
                                onMouseEnter={() => setIsHovering(true)}
                                onMouseLeave={() => setIsHovering(false)}
                            >
                                <img
                                    src={activePhoto || '/images/placeholder.jpg'}
                                    alt={item.name}
                                    className={`w-full h-full object-cover transition-all duration-700 ${isHovering ? 'scale-105' : 'scale-100'}`}
                                />
                            </div>
                        </div>

                        {/* Thumbnails Column - Vertical Strip */}
                        {(item.photos?.length > 0 || item.image) && (
                            <div className="flex flex-row lg:flex-col gap-2 w-full lg:w-20 overflow-x-auto lg:overflow-x-visible no-scrollbar">
                                {item.image && (
                                    <button
                                        onClick={() => setActivePhoto(item.image)}
                                        className={`relative flex-shrink-0 w-16 h-20 rounded-lg border-2 transition-all duration-300 overflow-hidden ${activePhoto === item.image
                                            ? 'border-gray-900 shadow-sm'
                                            : 'border-transparent hover:border-gray-200'
                                            }`}
                                    >
                                        <img src={item.image} alt="Thumbnail main" className="w-full h-full object-cover" />
                                    </button>
                                )}
                                {item.photos?.map((photo, idx) => (
                                    <button
                                        key={idx}
                                        onClick={() => setActivePhoto(photo.url)}
                                        className={`relative flex-shrink-0 w-16 h-20 rounded-lg border-2 transition-all duration-300 overflow-hidden ${activePhoto === photo.url
                                            ? 'border-gray-900 shadow-sm'
                                            : 'border-transparent hover:border-gray-200'
                                            }`}
                                    >
                                        <img src={photo.url} alt={`Thumbnail ${idx}`} className="w-full h-full object-cover" />
                                    </button>
                                ))}
                            </div>
                        )}

                        {/* Details Column */}
                        <div className="w-full lg:w-[450px] flex flex-col pt-0">
                            <div className="space-y-4">
                                <div className="flex flex-wrap items-center gap-1.5 tracking-tight">
                                    <span className="text-[11px] font-bold text-pink-600 bg-pink-50 px-2 py-1 rounded uppercase">
                                        {item.category}
                                    </span>
                                    <span className="text-gray-300">/</span>
                                    <span className="text-[11px] font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded uppercase">
                                        {item.type}
                                    </span>
                                </div>

                                <h1 className="text-2xl font-bold text-gray-900 tracking-tight">
                                    {item.name}
                                </h1>

                                <div className="space-y-1">
                                    <div className="flex items-center gap-2">
                                        <span className="text-xl font-bold text-gray-900">
                                            Rs {item.prize?.toLocaleString()}.00
                                        </span>
                                        {item.is_on_offer && (
                                            <span className="text-xs font-bold text-pink-500 bg-pink-50 px-2 py-0.5 rounded">
                                                -{item.offer_percentage}%
                                            </span>
                                        )}
                                    </div>
                                    {item.is_on_offer && (
                                        <p className="text-xs text-gray-400 line-through">
                                            Regular: Rs {item.prize?.toLocaleString()}.00
                                        </p>
                                    )}
                                </div>

                                {/* Promo items like reference */}
                                <div className="flex items-center gap-4 py-2 border-b border-gray-100">
                                    <div className="flex items-center gap-1.5">
                                        <span className="text-[10px] text-gray-500">or 3 installments with</span>
                                        <span className="text-xs font-black text-purple-600">KOKO</span>
                                    </div>
                                    <div className="flex items-center gap-1.5">
                                        <span className="text-[10px] text-gray-500">or 4 installments with</span>
                                        <span className="text-xs font-black text-blue-500 italic">PayZy</span>
                                    </div>
                                </div>

                                <p className="text-sm text-gray-600 leading-relaxed font-light">
                                    {item.description || "Designed with precision and crafted for the modern individual, this piece embodies a perfect balance of heritage and contemporary style."}
                                </p>

                                {item.note && (
                                    <p className="text-[11px] text-gray-400 italic">
                                        Note: {item.note}
                                    </p>
                                )}

                                {/* Color Selection - Simplified like reference */}
                                {item.colors?.length > 0 && (
                                    <div className="space-y-2 py-2">
                                        <p className="text-[10px] font-bold text-gray-900 uppercase tracking-wider">
                                            COLOUR: <span className="text-gray-500 font-medium ml-1">{selectedColor}</span>
                                        </p>
                                        <div className="flex flex-wrap gap-2">
                                            {item.colors.map((color, idx) => (
                                                <button
                                                    key={idx}
                                                    onClick={() => setSelectedColor(color.name)}
                                                    className={`w-8 h-8 rounded border-2 transition-all ${selectedColor === color.name
                                                        ? 'border-gray-900 ring-1 ring-gray-900'
                                                        : 'border-transparent'
                                                        }`}
                                                    style={{ backgroundColor: color.hex || '#ccc' }}
                                                    title={color.name}
                                                />
                                            ))}
                                        </div>
                                    </div>
                                )}

                                {/* Size Selection - Boxes like reference */}
                                <div className="space-y-2 py-2">
                                    <div className="flex items-center justify-between">
                                        <p className="text-[10px] font-bold text-gray-900 uppercase tracking-wider">
                                            SIZE: <span className="text-gray-500 font-medium ml-1">{item.size_label || item.size || 'N/A'}</span>
                                        </p>
                                        <button className="text-[10px] font-bold text-blue-600 flex items-center gap-1 group">
                                            <svg className="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101" /></svg>
                                            <span className="border-b border-transparent group-hover:border-blue-600 transition-all">Size Chart</span>
                                        </button>
                                    </div>
                                    <div className="flex flex-wrap gap-2">
                                        {/* Mocking a few sizes to match reference look */}
                                        {['UK-08', 'UK-10', 'UK-12', 'UK-14'].map((s) => (
                                            <button
                                                key={s}
                                                className={`px-4 py-2 border text-[11px] font-bold transition-all ${s === (item.size_label || 'UK-08')
                                                    ? 'border-gray-900 bg-gray-50'
                                                    : 'border-gray-200 text-gray-400 hover:border-gray-400'
                                                    }`}
                                            >
                                                {s}
                                            </button>
                                        ))}
                                    </div>
                                </div>

                                <div className="space-y-1 py-1">
                                    <p className="text-[10px] text-gray-400">SKU: {item.SKU || 'KS3389'}</p>
                                    <p className="text-[10px] text-green-600 font-bold">Stock Items: {item.stock_items || 2}</p>
                                </div>

                                {/* Actions - Quantity + Add to Cart */}
                                <div className="flex items-center gap-3 py-4 border-t border-gray-100">
                                    <div className="flex items-center border border-gray-200 rounded overflow-hidden">
                                        <button
                                            onClick={() => setQuantity(q => Math.max(1, q - 1))}
                                            className="px-3 py-2 hover:bg-gray-50 text-gray-500 transition-colors"
                                        >
                                            -
                                        </button>
                                        <span className="w-10 text-center text-sm font-bold border-x border-gray-200 py-2">
                                            {quantity}
                                        </span>
                                        <button
                                            onClick={() => setQuantity(q => q + 1)}
                                            className="px-3 py-2 hover:bg-gray-50 text-gray-500 transition-colors"
                                        >
                                            +
                                        </button>
                                    </div>
                                    <button
                                        onClick={addToCart}
                                        className="flex-1 bg-[#1a1a1a] text-white py-2.5 rounded text-sm font-bold hover:bg-black transition-all flex items-center justify-center gap-2"
                                    >
                                        <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                        Add To Cart
                                    </button>
                                </div>

                                {/* Simplified Specs */}
                                <ul className="space-y-1.5 py-4 border-t border-gray-100">
                                    <li className="flex items-center gap-2 text-xs font-medium text-gray-700">
                                        <span className="w-1 h-1 bg-gray-900 rounded-full" />
                                        Material: {item.material || 'Rib'}
                                    </li>
                                    <li className="flex items-center gap-2 text-[10px] text-gray-400">
                                        Availability: <span className="text-green-600 font-bold">In Stock</span>
                                    </li>
                                    <li className="flex items-center gap-2 text-[10px] text-gray-400">
                                        Categories: {item.category}, {item.type}, {item.co_name}
                                    </li>
                                </ul>

                                {/* Social Share */}
                                <div className="pt-4 border-t border-gray-100">
                                    <p className="text-[11px] font-bold text-gray-900 mb-3">Share on</p>
                                    <div className="flex gap-4">
                                        <button className="text-gray-400 hover:text-blue-600 transition-colors">
                                            <svg className="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" /></svg>
                                        </button>
                                        <button className="text-gray-400 hover:text-green-500 transition-colors">
                                            <svg className="w-5 h-5 fill-current" viewBox="0 0 448 512"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-5.5-2.8-23.2-8.5-44.2-27.1-16.4-14.6-27.4-32.7-30.6-38.2-3.2-5.6-.3-8.6 2.5-11.3 2.5-2.5 5.6-6.5 8.3-9.7 2.8-3.3 3.7-5.6 5.6-9.3 1.9-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 13.2 5.8 23.5 9.2 31.5 11.8 13.3 4.2 25.4 3.6 35 2.2 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" /></svg>
                                        </button>
                                    </div>
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
