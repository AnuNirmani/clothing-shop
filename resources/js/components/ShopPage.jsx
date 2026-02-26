import React, { useEffect, useState } from 'react';
import { useSearchParams, Link } from 'react-router-dom';
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
        <div className="min-h-screen bg-gradient-to-br from-white via-purple-50/20 to-white">

                       <style>{`
                @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap');

                * {
                    font-family: 'Poppins', sans-serif;
                }

                h1, h2, h3, h4, h5, h6 {
                    font-family: 'Playfair Display', serif;
                }


                .gradient-text {
                    background: linear-gradient(135deg, #d4a574 25%, #8b5cf6 25%, #ec4899 75%);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    background-clip: text;
                }

                .product-card {
                    position: relative;
                    overflow: hidden;
                    border-radius: 20px;
                    background: white;
                    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                    border: 1px solid rgba(236, 72, 153, 0.1);
                    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
                }

                .product-card:hover {
                    box-shadow: 0 20px 50px rgba(236, 72, 153, 0.15);
                    transform: translateY(-8px);
                    border-color: rgba(236, 72, 153, 0.2);
                }

                .product-image {
                    position: relative;
                    overflow: hidden;
                    width: 100%;
                    aspect-ratio: 3/4;
                    background: linear-gradient(135deg, #f5f7fa 0%, #f0f0f0 100%);
                }

                .product-image img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
                }

                .product-card:hover .product-image img {
                    transform: scale(1.12);
                }

                .product-overlay {
                    position: absolute;
                    inset: 0;
                    background: rgba(0, 0, 0, 0);
                    transition: background 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                }

                .product-card:hover .product-overlay {
                    background: rgba(0, 0, 0, 0.15);
                }

                .quick-view-btn {
                    position: absolute;
                    bottom: 24px;
                    left: 50%;
                    transform: translateX(-50%) translateY(20px);
                    opacity: 0;
                    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                    z-index: 20;
                }

                .product-card:hover .quick-view-btn {
                    opacity: 1;
                    transform: translateX(-50%) translateY(0);
                }

                .price-badge {
                    position: absolute;
                    top: 16px;
                    right: 16px;
                    background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 100%);
                    color: white;
                    padding: 10px 16px;
                    border-radius: 50px;
                    font-weight: 700;
                    font-size: 14px;
                    box-shadow: 0 8px 20px rgba(236, 72, 153, 0.3);
                    opacity: 0;
                    transform: translateY(-10px);
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                }

                .product-card:hover .price-badge {
                    opacity: 1;
                    transform: translateY(0);
                }

                .wishlist-btn {
                    position: absolute;
                    top: 16px;
                    left: 16px;
                    width: 44px;
                    height: 44px;
                    border-radius: 50%;
                    background: white;
                    border: 2px solid rgba(236, 72, 153, 0.2);
                    display: flex;
                    align-items: center;
                    justify-center;
                    cursor: pointer;
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                    opacity: 0;
                    transform: translateX(-10px);
                }

                .product-card:hover .wishlist-btn {
                    opacity: 1;
                    transform: translateX(0);
                }

                .wishlist-btn:hover {
                    background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 100%);
                    border-color: transparent;
                    color: white;
                    transform: scale(1.1);
                    box-shadow: 0 8px 20px rgba(236, 72, 153, 0.3);
                }

                .product-content {
                    padding: 24px 20px;
                }

                .product-card:hover .product-name {
                    color: transparent;
                    background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
                    background-clip: text;
                    -webkit-background-clip: text;
                }

                .color-swatch {
                    display: inline-block;
                    width: 20px;
                    height: 20px;
                    border-radius: 50%;
                    border: 2px solid rgba(0, 0, 0, 0.1);
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    cursor: pointer;
                }

                .color-swatch:hover {
                    transform: scale(1.2);
                    border-color: #8b5cf6;
                    box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
                }

                .loading-skeleton {
                    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
                    background-size: 200% 100%;
                    animation: shimmer 2s infinite;
                    border-radius: 20px;
                }

                .filter-btn {
                    padding: 10px 20px;
                    border-radius: 20px;
                    border: 2px solid rgba(139, 92, 246, 0.2);
                    background: white;
                    color: #6b7280;
                    font-weight: 600;
                    cursor: pointer;
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    font-size: 14px;
                }

                .filter-btn.active {
                    background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
                    color: white;
                    border-color: transparent;
                    box-shadow: 0 8px 20px rgba(139, 92, 246, 0.3);
                }

                .filter-btn:hover {
                    border-color: #8b5cf6;
                    color: #8b5cf6;
                }

                .section-subtitle {
                    font-size: 14px;
                    font-weight: 600;
                    letter-spacing: 1px;
                    text-transform: uppercase;
                    color: #8b5cf6;
                    margin-bottom: 12px;
                }

                .page-title {
                    font-size: 56px;
                    font-weight: 700;
                    margin-bottom: 16px;
                    line-height: 1.2;
                }

                @media (max-width: 768px) {
                    .page-title {
                        font-size: 36px;
                    }

                    .product-card {
                        border-radius: 16px;
                    }

                    .product-content {
                        padding: 16px;
                    }
                }
            `}</style>
            <Header />

            <section className="py-20 px-6 sm:px-10 lg:px-16">
                <div className="max-w-[1600px] mx-auto">
                    <div className="text-center mb-16">
                        <h1 className="page-title gradient-text">
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
                                            <Link
                                                to={`/item/${product.id}`}
                                                className="absolute bottom-4 left-1/2 -translate-x-1/2 rounded-full bg-white px-6 py-2 text-sm font-semibold text-[var(--ink)] opacity-0 translate-y-2 transition duration-300 group-hover:opacity-100 group-hover:translate-y-0 hover:bg-gradient-to-r hover:from-purple-600 hover:to-pink-600 hover:text-white"
                                            >
                                                Quick View
                                            </Link>
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
