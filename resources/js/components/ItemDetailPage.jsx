import React, { useEffect, useState } from 'react';
import { useParams, Link } from 'react-router-dom';
import Header from './Header';
import Footer from './Footer';

const ItemDetailPage = () => {
    const { id } = useParams();
    const [item, setItem] = useState(null);
    const [loading, setLoading] = useState(true);
    const [activePhoto, setActivePhoto] = useState(null);

    useEffect(() => {
        const fetchItem = async () => {
            setLoading(true);
            try {
                const res = await fetch(`/api/items/${id}`);
                const data = await res.json();
                if (data.success) {
                    setItem(data.data);
                    setActivePhoto(data.data.image);
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

    return (
        <div className="min-h-screen bg-slate-50 font-sans text-gray-900">
            <Header />

            <main className="w-full py-12 px-4 sm:px-10 lg:px-16">
                {loading ? (
                    <div className="flex justify-center items-center h-96"></div>
                ) : item ? (
                    <div className="grid grid-cols-1 lg:grid-cols-2">
                        {/* Photo Gallery Column */}
                        <div className="p-4 sm:p-8">
                            <div className="aspect-square rounded-2xl overflow-hidden bg-gray-50 border border-gray-100 mb-4 transition-all duration-300">
                                <img
                                    src={activePhoto || '/images/placeholder.jpg'}
                                    alt={item.name}
                                    className="w-full h-full object-cover"
                                />
                            </div>

                            {/* Thumbnails */}
                            {(item.photos?.length > 0 || item.image) && (
                                <div className="flex gap-3 overflow-x-auto pb-2 custom-scrollbar">
                                    {item.image && (
                                        <button
                                            onClick={() => setActivePhoto(item.image)}
                                            className={`flex-shrink-0 w-20 h-20 rounded-lg border-2 overflow-hidden transition-all ${activePhoto === item.image ? 'border-pink-500 shadow-md' : 'border-transparent opacity-70 hover:opacity-100'
                                                }`}
                                        >
                                            <img src={item.image} alt="Thumbnail main" className="w-full h-full object-cover" />
                                        </button>
                                    )}
                                    {item.photos?.map((photo, idx) => (
                                        <button
                                            key={idx}
                                            onClick={() => setActivePhoto(photo.url)}
                                            className={`flex-shrink-0 w-20 h-20 rounded-lg border-2 overflow-hidden transition-all ${activePhoto === photo.url ? 'border-pink-500 shadow-md' : 'border-transparent opacity-70 hover:opacity-100'
                                                }`}
                                        >
                                            <img src={photo.url} alt={`Thumbnail ${idx}`} className="w-full h-full object-cover" />
                                        </button>
                                    ))}
                                </div>
                            )}
                        </div>

                        {/* Details Column */}
                        <div className="p-8 lg:p-12 flex flex-col">
                            <div className="mb-2">
                                <span className="text-xs font-bold text-pink-600 bg-pink-50 px-3 py-1 rounded-full uppercase tracking-widest">
                                    {item.category} • {item.type}
                                </span>
                            </div>

                            <h1 className="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-4 tracking-tight">
                                {item.name}
                            </h1>

                            <div className="flex items-center gap-4 mb-8">
                                {item.is_on_offer ? (
                                    <>
                                        <span className="text-3xl font-black text-pink-600">
                                            Rs {(item.prize * (1 - item.offer_percentage / 100)).toLocaleString()}.00
                                        </span>
                                        <span className="text-xl text-gray-400 line-through">
                                            Rs {item.prize?.toLocaleString()}
                                        </span>
                                        <span className="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
                                            -{item.offer_percentage}% OFF
                                        </span>
                                    </>
                                ) : (
                                    <span className="text-3xl font-black text-gray-900">
                                        Rs {item.prize?.toLocaleString()}.00
                                    </span>
                                )}
                            </div>

                            {/* Description */}
                            <div className="mb-8 bg-gray-50 p-6 rounded-2xl border border-gray-100">
                                <h3 className="text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">Description</h3>
                                <p className="text-gray-700 leading-relaxed">
                                    {item.description || "The perfect addition to your wardrobe. This item combines style and comfort effortlessly."}
                                </p>
                            </div>

                            <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                                <div>
                                    <h3 className="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Co Name</h3>
                                    <p className="font-medium text-gray-800">{item.co_name || '—'}</p>
                                </div>
                                <div>
                                    <h3 className="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">SKU</h3>
                                    <p className="font-medium text-gray-800">{item.SKU || item.sku || '—'}</p>
                                </div>
                                <div>
                                    <h3 className="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Availability</h3>
                                    <p className="font-medium text-gray-800">{item.availability || '—'}</p>
                                </div>
                                <div>
                                    <h3 className="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Stock</h3>
                                    <p className="font-medium text-gray-800">
                                        {Number.isFinite(item.stock_items) ? `${item.stock_items} units` : '—'}
                                    </p>
                                </div>
                                <div>
                                    <h3 className="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Material</h3>
                                    <p className="font-medium text-gray-800">{item.material || '—'}</p>
                                </div>
                                <div className="sm:col-span-2">
                                    <h3 className="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Classifications</h3>
                                    <p className="font-medium text-gray-800">
                                        {classificationNames.length ? classificationNames.join(', ') : '—'}
                                    </p>
                                </div>
                                <div>
                                    <h3 className="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Size Label</h3>
                                    <p className="font-medium text-gray-800">{item.size_label || '—'}</p>
                                </div>
                                <div>
                                    <h3 className="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Selected Item</h3>
                                    <p className="font-medium text-gray-800">{item.size || '—'}</p>
                                </div>
                            </div>

                            {item.note && (
                                <div className="mb-8 bg-gray-50 p-6 rounded-2xl border border-gray-100">
                                    <h3 className="text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">Note</h3>
                                    <p className="text-gray-700 leading-relaxed">{item.note}</p>
                                </div>
                            )}

                            {(item.is_gift_card || item.is_on_offer) && (
                                <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                                    {item.is_gift_card && (
                                        <div>
                                            <h3 className="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Gift Card</h3>
                                            <p className="font-medium text-gray-800">
                                                Yes{item.gift_card_validity_months ? ` • ${item.gift_card_validity_months} months` : ''}
                                            </p>
                                        </div>
                                    )}
                                    {item.is_on_offer && (
                                        <div>
                                            <h3 className="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Offer Period</h3>
                                            <p className="font-medium text-gray-800">
                                                {formatDate(item.offer_start_date)} — {formatDate(item.offer_end_date)}
                                            </p>
                                        </div>
                                    )}
                                </div>
                            )}

                            {/* Actions */}
                            <div className="mt-auto space-y-4">
                                <button
                                    onClick={buyNow}
                                    className="w-full py-5 bg-gray-900 text-white rounded-2xl font-bold text-lg hover:bg-black transition-all shadow-lg hover:shadow-xl active:scale-[0.98]"
                                >
                                    Buy It Now
                                </button>
                                <button
                                    onClick={addToCart}
                                    className="w-full py-5 border-2 border-gray-200 text-gray-900 rounded-2xl font-bold text-lg hover:bg-gray-50 transition-all active:scale-[0.98]"
                                >
                                    Add to Cart
                                </button>
                            </div>

                            <div className="mt-6 text-center">
                                <Link to="/shop" className="text-sm font-semibold text-gray-500 hover:text-pink-600 transition">
                                    ← Back to the Collection
                                </Link>
                            </div>
                        </div>
                    </div>
                ) : (
                    <div className="text-center py-32 bg-white rounded-3xl shadow-sm border border-gray-100">
                        <div className="text-6xl mb-6">🔍</div>
                        <h2 className="text-3xl font-bold text-gray-900 mb-2">Item Not Found</h2>
                        <p className="text-gray-500 mb-8">The product you are looking for might have been moved or is out of stock.</p>
                        <Link
                            to="/shop"
                            className="inline-block px-10 py-4 rounded-2xl bg-gradient-to-r from-pink-500 to-rose-500 text-white font-bold shadow-lg hover:shadow-pink-200 transition-all"
                        >
                            Back to Shop
                        </Link>
                    </div>
                )}
            </main>

            <Footer />
        </div>
    );
};

export default ItemDetailPage;
