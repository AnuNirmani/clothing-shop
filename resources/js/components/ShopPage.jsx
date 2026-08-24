import React, { useEffect, useMemo, useState } from 'react';
import { Link, useSearchParams } from 'react-router-dom';
import Header from './Header';
import Footer from './Footer';

const ShopPage = () => {
    const [searchParams] = useSearchParams();
    const categoryId = searchParams.get('category_id');
    const typeId = searchParams.get('type_id');
    const offerCategoryId = searchParams.get('offer_category_id');
    const offeredOnly = searchParams.get('offered') === '1';
    const title = searchParams.get('title') || 'Shop Collection';

    const [items, setItems] = useState([]);
    const [types, setTypes] = useState([]);
    const [categoriesWithTypes, setCategoriesWithTypes] = useState([]);
    const [loading, setLoading] = useState(true);

    const subtitle = useMemo(() => {
        if (offerCategoryId) return 'Discover all items from this offer category';
        if (offeredOnly) return 'Discover active offer pieces curated just for you';
        if (typeId) return 'Refined picks for your selected style';
        if (categoryId) return 'Explore every piece in this curated category';
        return 'Discover signature pieces crafted for confident everyday wear';
    }, [categoryId, typeId, offerCategoryId, offeredOnly]);

    useEffect(() => {
        fetchItems();
        if (categoryId) {
            fetchTypes();
            setCategoriesWithTypes([]);
        } else {
            setTypes([]);
            fetchCategoriesWithTypes();
        }
        window.scrollTo(0, 0);
    }, [categoryId, typeId, offerCategoryId, offeredOnly]);

    const fetchTypes = async () => {
        try {
            const response = await fetch(`/api/categories/${categoryId}/types`);
            const data = await response.json();
            if (data.success) {
                setTypes(data.data);
            }
        } catch (error) {
            console.error('Error fetching types:', error);
        }
    };

    const fetchItems = async () => {
        setLoading(true);
        try {
            let url = '/api/items';
            const params = new URLSearchParams();
            if (categoryId) params.append('category_id', categoryId);
            if (typeId) params.append('type_id', typeId);
            if (offerCategoryId) params.append('offer_category_id', offerCategoryId);
            if (offeredOnly) params.append('offered', '1');

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

    const fetchCategoriesWithTypes = async () => {
        try {
            const response = await fetch('/api/categories-with-types');
            const data = await response.json();
            if (data.success) {
                setCategoriesWithTypes(data.data);
            }
        } catch (error) {
            console.error('Error fetching categories with types:', error);
        }
    };

    const buildFilterUrl = (nextCategoryId = categoryId, nextTypeId = null) => {
        const params = new URLSearchParams();
        if (nextCategoryId) params.set('category_id', nextCategoryId);
        if (nextTypeId) params.set('type_id', nextTypeId);
        if (offeredOnly) params.set('offered', '1');
        if (title) params.set('title', title);
        return `/shop?${params.toString()}`;
    };

    const formatPrice = (value) => {
        const n = Number(value);
        if (Number.isNaN(n)) return '0';
        return Math.floor(n).toLocaleString();
    };

    return (
        <div className="shop-page min-h-screen">
            <style>{`
                @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap');

                .shop-page {
                    --bg: #f7f2f9;
                    --paper: #fffefb;
                    --ink: #1d2733;
                    --muted: #5f6b78;
                    --line: #eee7dc;
                    --brand: #ec4899;
                    --brand-deep: #06073d;
                    background:
                        radial-gradient(circle at 8% 8%, rgba(236, 72, 153, 0.18), transparent 3%),
                        radial-gradient(circle at 92% 4%, rgba(99, 102, 241, 0.14), transparent 3%),
                        linear-gradient(180deg, #fcf8fd 0%, var(--bg) 45%, #f4ecf8 100%);
                    color: var(--ink);
                    font-family: 'Manrope', sans-serif;
                }

                .hero-title {
                    font-family: 'Cormorant Garamond', serif;
                    font-size: clamp(2.35rem, 5vw, 4.6rem);
                    font-weight: 700;
                    line-height: 0.95;
                    margin-top: 18px;
                    text-wrap: balance;
                    animation: rise 0.7s ease-out;
                }

                .hero-title .accent {
                    color: var(--brand);
                }

                .hero-subtitle {
                    margin-top: 16px;
                    font-size: clamp(0.95rem, 1.2vw, 1.1rem);
                    color: var(--muted);
                    max-width: 60ch;
                    animation: rise 0.8s ease-out;
                }

                .shop-layout {
                    display: grid;
                    grid-template-columns: 280px minmax(0, 1fr);
                    gap: 32px;
                    align-items: start;
                    margin-top: 34px;
                }

                .filter-panel {
                    position: sticky;
                    top: 108px;
                    border-radius: 20px;
                    padding: 18px;
                    border: 1px solid var(--line);
                    background: rgba(255, 248, 255, 0.88);
                    box-shadow: 0 14px 26px rgba(34, 42, 54, 0.08);
                    backdrop-filter: blur(8px);
                }

                .filter-title {
                    font-size: 11px;
                    font-weight: 800;
                    letter-spacing: 0.14em;
                    text-transform: uppercase;
                    color: #000000;
                    margin-bottom: 14px;
                }

                .filter-link {
                    display: block;
                    padding: 10px 12px;
                    border-radius: 11px;
                    color: #42505d;
                    font-size: 14px;
                    font-weight: 600;
                    transition: all 0.2s ease;
                }

                .filter-link:hover {
                    background: #f3dced;
                    color: var(--brand-deep);
                    transform: translateX(3px);
                }

                .filter-link.active {
                    background: linear-gradient(135deg, #efc6de 0%, #f9e7f3 100%);
                    color: var(--brand-deep);
                    box-shadow: inset 0 0 0 1px rgba(200, 68, 160, 0.24);
                }

                .products-head {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin-bottom: 18px;
                    gap: 10px;
                }

                .products-count {
                    font-size: 12px;
                    letter-spacing: 0.14em;
                    text-transform: uppercase;
                    font-weight: 800;
                    color: #5c6976;
                }

                .products-grid {
                    display: grid;
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                    gap: 24px;
                }

                .product-card {
                    position: relative;
                    overflow: hidden;
                    border-radius: 20px;
                    background: var(--paper);
                    border: 1px solid var(--line);
                    box-shadow: 0 10px 24px rgba(34, 42, 54, 0.09);
                    transition: transform 0.35s ease, box-shadow 0.35s ease;
                    animation: rise 0.65s ease both;
                }

                .product-card:hover {
                    transform: translateY(-8px);
                    box-shadow: 0 26px 38px rgba(34, 42, 54, 0.14);
                }

                .product-image-wrap {
                    position: relative;
                    aspect-ratio: 3 / 4;
                    overflow: hidden;
                    background: linear-gradient(180deg, #f8eaf1, #ecd7e3);
                }

                .product-image-wrap img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    transition: transform 0.7s ease;
                }

                .product-card:hover .product-image-wrap img {
                    transform: scale(1.08);
                }

                .image-overlay {
                    position: absolute;
                    inset: 0;
                    background: linear-gradient(to top, rgba(16, 24, 34, 0.42), transparent 52%);
                    opacity: 0;
                    transition: opacity 0.35s ease;
                }

                .product-card:hover .image-overlay {
                    opacity: 1;
                }

                .quick-view {
                    position: absolute;
                    left: 50%;
                    bottom: 14px;
                    transform: translateX(-50%) translateY(16px);
                    opacity: 0;
                    border-radius: 999px;
                    padding: 10px 18px;
                    font-size: 12px;
                    letter-spacing: 0.08em;
                    text-transform: uppercase;
                    font-weight: 800;
                    border: 1px solid rgba(255, 255, 255, 0.44);
                    color: white;
                    background: rgba(15, 22, 31, 0.55);
                    backdrop-filter: blur(4px);
                    transition: all 0.35s ease;
                }

                .product-card:hover .quick-view {
                    opacity: 1;
                    transform: translateX(-50%) translateY(0);
                }

                .quick-view:hover {
                    background: var(--brand);
                    border-color: var(--brand);
                    color: white;
                }

                .product-content {
                    padding: 16px 16px 18px;
                }

                .product-cat {
                    color: #ec4899;
                    font-size: 11px;
                    font-weight: 800;
                    letter-spacing: 0.12em;
                    text-transform: uppercase;
                    margin-bottom: 6px;
                }

                .product-name {
                    font-size: 18px;
                    font-weight: 700;
                    line-height: 1.2;
                    color: #182330;
                }

                .swatch {
                    width: 14px;
                    height: 14px;
                    border-radius: 999px;
                    border: 1px solid rgba(52, 31, 57, 0.16);
                }

                .loading-shell {
                    display: grid;
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                    gap: 24px;
                }

                .loading-card {
                    height: 420px;
                    border-radius: 20px;
                    border: 1px solid var(--line);
                    background: linear-gradient(100deg, #f5eee3 30%, #fbf8f1 45%, #f5eee3 60%);
                    background-size: 180% 100%;
                    animation: shimmer 1.2s linear infinite;
                }

                .empty-state {
                    border: 1px dashed #cca5c0;
                    border-radius: 18px;
                    padding: 70px 22px;
                    text-align: center;
                    background: rgba(255, 248, 253, 0.75);
                }

                .empty-title {
                    font-family: 'Cormorant Garamond', serif;
                    font-size: 36px;
                    color: #223040;
                    margin-bottom: 10px;
                }

                @keyframes shimmer {
                    from { background-position: 100% 0; }
                    to { background-position: -100% 0; }
                }

                @keyframes rise {
                    from {
                        opacity: 0;
                        transform: translateY(14px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                @media (max-width: 1200px) {
                    .products-grid,
                    .loading-shell {
                        grid-template-columns: repeat(2, minmax(0, 1fr));
                    }
                }

                @media (max-width: 980px) {
                    .shop-layout {
                        grid-template-columns: 1fr;
                    }

                    .filter-panel {
                        position: relative;
                        top: 0;
                    }
                }

                @media (max-width: 640px) {
                    .products-grid,
                    .loading-shell {
                        grid-template-columns: 1fr;
                    }

                    .product-name {
                        font-size: 17px;
                    }

                    .product-price {
                        font-size: 20px;
                    }
                }
            `}</style>

            <Header />

            <section className="px-4 pb-20 pt-12 sm:px-8 lg:px-14">
                <div className="mx-auto w-full max-w-[1500px]">
                    <h1 className="hero-title">
                        {title}
                    </h1>
                    <p className="hero-subtitle">{subtitle}</p>

                    <div className="shop-layout">
                        {(types.length > 0 || categoriesWithTypes.length > 0) && (
                            <aside className="filter-panel">
                                <p className="filter-title">
                                    {categoryId ? 'Browse by Type' : 'Browse by Category & Type'}
                                </p>
                                {categoryId ? (
                                    <>
                                        <Link
                                            to={buildFilterUrl(categoryId)}
                                            className={`filter-link ${!typeId ? 'active' : ''}`}
                                        >
                                            All Styles
                                        </Link>
                                        {types.map((type) => (
                                            <Link
                                                key={type.id}
                                                to={buildFilterUrl(categoryId, type.id)}
                                                className={`filter-link ${String(typeId) === String(type.id) ? 'active' : ''}`}
                                            >
                                                {type.name}
                                            </Link>
                                        ))}
                                    </>
                                ) : (
                                    <div className="space-y-3">
                                        {categoriesWithTypes.map((category) => (
                                            <div key={category.id}>
                                                <Link
                                                    to={buildFilterUrl(category.id)}
                                                    className={`filter-link ${String(categoryId) === String(category.id) && !typeId ? 'active' : ''}`}
                                                >
                                                    {category.name}
                                                </Link>
                                                <div className="ml-2 space-y-1">
                                                    {category.types.map((type) => (
                                                        <Link
                                                            key={type.id}
                                                            to={buildFilterUrl(category.id, type.id)}
                                                            className={`filter-link ${String(typeId) === String(type.id) ? 'active' : ''}`}
                                                        >
                                                            {type.name}
                                                        </Link>
                                                    ))}
                                                </div>
                                            </div>
                                        ))}
                                    </div>
                                )}
                            </aside>
                        )}

                        <div>
                            <div className="products-head">
                                <p className="products-count">
                                    {loading ? 'Loading pieces...' : `${items.length} pieces available`}
                                </p>
                            </div>

                            {loading ? (
                                <div className="loading-shell">
                                    {Array.from({ length: 6 }).map((_, idx) => (
                                        <div key={idx} className="loading-card" />
                                    ))}
                                </div>
                            ) : items.length > 0 ? (
                                <div className="products-grid">
                                    {items.map((product, idx) => (
                                        <article
                                            key={product.id}
                                            className="product-card"
                                            style={{ animationDelay: `${Math.min(idx * 0.06, 0.32)}s` }}
                                        >
                                            <div className="product-image-wrap">
                                                <img
                                                    src={product.image || '/images/placeholder.jpg'}
                                                    alt={product.name}
                                                />
                                                <div className="image-overlay" />
                                                <Link to={`/item/${product.id}`} className="quick-view">
                                                    Quick View
                                                </Link>
                                            </div>

                                            <div className="product-content">
                                                <p className="product-cat">{product.category}</p>
                                                <h3 className="product-name">{product.name}</h3>
                                                <p className="text-lg font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">Rs {formatPrice(product.prize)}.00</p>

                                                <div className="mt-4 flex items-center gap-2">
                                                    {product.colors?.length > 0 ? (
                                                        product.colors.slice(0, 5).map((color, colorIdx) => (
                                                            <span
                                                                key={`${product.id}-${colorIdx}`}
                                                                className="swatch"
                                                                style={{ backgroundColor: color.hex || '#ddd' }}
                                                                title={color.name}
                                                            />
                                                        ))
                                                    ) : (
                                                        <span className="text-xs text-[#7a8491]">No color options</span>
                                                    )}
                                                </div>
                                            </div>
                                        </article>
                                    ))}
                                </div>
                            ) : (
                                <div className="empty-state">
                                    <h2 className="empty-title">Nothing Found Yet</h2>
                                    <p className="text-sm text-[#6b7784]">
                                        No products matched this selection. Try another filter or browse all styles.
                                    </p>
                                    {(types.length > 0 || categoriesWithTypes.length > 0) && (
                                        <Link
                                            to={buildFilterUrl()}
                                            className="mt-5 inline-flex rounded-full border border-[#cca5c0] px-5 py-2 text-sm font-semibold text-[#000000] transition hover:bg-[#e2aacdff]"
                                        >
                                            Show All Styles
                                        </Link>
                                    )}
                                </div>
                            )}
                        </div>
                    </div>
                </div>
            </section>

            <Footer />
        </div>
    );
};

export default ShopPage;
