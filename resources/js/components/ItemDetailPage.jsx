import React, { useEffect, useState } from 'react';
import { useParams, Link } from 'react-router-dom';
import Header from './Header';
import Footer from './Footer';

const ItemDetailPage = () => {
    const { id } = useParams();
    const [item, setItem] = useState(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const fetchItem = async () => {
            setLoading(true);
            try {
                const res = await fetch(`/api/items/${id}`);
                const data = await res.json();
                setItem(data.success ? data.data : null);
            } catch {
                setItem(null);
            } finally {
                setLoading(false);
                window.scrollTo(0, 0);
            }
        };
        fetchItem();
    }, [id]);

    return (
        <div className="min-h-screen bg-gradient-to-br from-pink-50 via-white to-blue-50">
            <Header />

            <section className="py-16 px-6 sm:px-10 lg:px-16">
                <div className="max-w-6xl mx-auto">
                    {loading ? (
                        <div className="flex justify-center items-center h-64">
                            <div className="animate-spin rounded-full h-16 w-16 border-t-2 border-b-2 border-pink-500"></div>
                        </div>
                    ) : item ? (
                        <div className="grid grid-cols-1 lg:grid-cols-2 gap-10 bg-white rounded-2xl shadow-xl overflow-hidden">
                            <div className="bg-gray-50">
                                <img
                                    src={item.image || '/images/placeholder.jpg'}
                                    alt={item.name}
                                    className="w-full h-[600px] object-cover"
                                />
                            </div>
                            <div className="p-8 lg:p-12">
                                <p className="text-sm text-pink-500 font-bold uppercase tracking-widest mb-2">
                                    {item.category}
                                </p>
                                <h1 className="text-4xl font-bold text-gray-800 mb-4">{item.name}</h1>
                                <p className="text-2xl font-black text-gray-900 mb-6">
                                    Rs {item.prize?.toLocaleString()}.00
                                </p>

                                <div className="mb-6">
                                    <p className="text-sm font-semibold text-gray-600 mb-2">Available colors</p>
                                    <div className="flex items-center gap-2">
                                        {item.colors?.length ? (
                                            item.colors.map((color, idx) => (
                                                <div
                                                    key={idx}
                                                    className="w-5 h-5 rounded-full border border-gray-200"
                                                    style={{ backgroundColor: color.hex }}
                                                    title={color.name}
                                                ></div>
                                            ))
                                        ) : (
                                            <div className="text-xs text-gray-400 italic">No colors available</div>
                                        )}
                                    </div>
                                </div>

                                <Link
                                    to="/shop"
                                    className="px-6 py-3 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition"
                                >
                                    Back to Shop
                                </Link>
                            </div>
                        </div>
                    ) : (
                        <div className="text-center py-20">
                            <p className="text-2xl text-gray-400 mb-6">Item not found.</p>
                            <Link
                                to="/shop"
                                className="inline-block px-6 py-3 rounded-lg bg-gradient-to-r from-pink-400 to-blue-400 text-white font-semibold"
                            >
                                Back to Shop
                            </Link>
                        </div>
                    )}
                </div>
            </section>

            <Footer />
        </div>
    );
};

export default ItemDetailPage;
