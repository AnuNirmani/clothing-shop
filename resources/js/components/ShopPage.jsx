import React, { useEffect, useState } from 'react';
import { useSearchParams } from 'react-router-dom';
import Header from './Header';
import Footer from './Footer';

const ShopPage = () => {
    const [searchParams] = useSearchParams();
    const categoryId = searchParams.get('category_id');
    const typeId = searchParams.get('type_id');
    const title = searchParams.get('title') || 'Shop Collection';

    const [items, setItems] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        fetchItems();
        window.scrollTo(0, 0);
    }, [categoryId, typeId]);

    const fetchItems = async () => {
        setLoading(true);
        try {
            let url = '/api/items';
            const params = new URLSearchParams();
            if (categoryId) params.append('category_id', categoryId);
            if (typeId) params.append('type_id', typeId);

            if (params.toString()) {
                url += `?${params.toString()}`;
            }

            const response = await fetch(url);
            const data = await response.json();
            if (data.success) {
                setItems(data.data);
            }
        } catch (error) {
            console.error('Error fetching items:', error);
        } finally {
            setLoading(false);
        }
    };

    return (
        <div className="min-h-screen bg-gradient-to-br from-pink-50 via-white to-blue-50">
            <Header />

            <section className="py-20 px-6 sm:px-10 lg:px-16">
                <div className="max-w-[1600px] mx-auto">
                    <div className="text-center mb-16">
                        <h1 className="text-5xl font-bold bg-gradient-to-r from-pink-500 via-blue-500 to-pink-600 bg-clip-text text-transparent mb-4">
                            {title}
                        </h1>
                        <p className="text-gray-600 text-lg">Explore our curated selection of premium fashion</p>
                    </div>

                    {loading ? (
                        <div className="flex justify-center items-center h-64">
                            <div className="animate-spin rounded-full h-16 w-16 border-t-2 border-b-2 border-pink-500"></div>
                        </div>
                    ) : (
                        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
                            {items.length > 0 ? (
                                items.map((product) => (
                                    <div key={product.id} className="bg-white overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-300 group">
                                        <div className="relative cursor-pointer overflow-hidden">
                                            <img
                                                src={product.image || "/images/placeholder.jpg"}
                                                alt={product.name}
                                                className="w-full h-[500px] object-cover transition-transform duration-500 group-hover:scale-110"
                                            />
                                            <div className="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-all duration-300"></div>
                                            <button className="absolute bottom-6 left-1/2 -translate-x-1/2 bg-white text-gray-800 px-8 py-3 rounded-full font-bold shadow-lg opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:bg-pink-500 hover:text-white">
                                                Quick View
                                            </button>
                                        </div>
                                        <div className="p-6">
                                            <div className="flex justify-between items-start mb-2">
                                                <div>
                                                    <p className="text-xs text-pink-500 font-bold uppercase tracking-widest mb-1">{product.category}</p>
                                                    <h3 className="text-gray-800 font-bold text-xl">{product.name}</h3>
                                                </div>
                                            </div>
                                            <p className="text-gray-900 font-black text-2xl">Rs {product.prize?.toLocaleString()}.00</p>

                                            <div className="mt-4 flex items-center gap-2">
                                                {product.colors && product.colors.length > 0 ? (
                                                    product.colors.map((color, idx) => (
                                                        <div
                                                            key={idx}
                                                            className="w-4 h-4 rounded-full border border-gray-200"
                                                            style={{ backgroundColor: color.hex }}
                                                            title={color.name}
                                                        ></div>
                                                    ))
                                                ) : (
                                                    <div className="text-xs text-gray-400 italic">No colors available</div>
                                                )}
                                            </div>
                                        </div>
                                    </div>
                                ))
                            ) : (
                                <div className="col-span-full text-center py-20">
                                    <p className="text-2xl text-gray-400">No products found in this collection.</p>
                                </div>
                            )}
                        </div>
                    )}
                </div>
            </section>

            <Footer />
        </div>
    );
};

export default ShopPage;
