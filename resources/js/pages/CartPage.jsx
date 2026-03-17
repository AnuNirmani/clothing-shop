import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { useCart } from '../context/CartContext';

const CartPage = ({ isOpen, onClose }) => {
    const { cartItems, removeFromCart, updateQuantity, getCartTotal } = useCart();
    const [isCheckingOut, setIsCheckingOut] = useState(false);
    const [hoveredItem, setHoveredItem] = useState(null);
    const navigate = useNavigate();

    const handleQuantityChange = (cartItemId, newQuantity) => {
        if (newQuantity >= 1) {
            updateQuantity(cartItemId, newQuantity);
        }
    };

    const handleRemoveItem = (cartItemId) => {
        removeFromCart(cartItemId);
    };

    const handleCheckout = () => {
        setIsCheckingOut(true);
        setTimeout(() => {
            setIsCheckingOut(false);
            onClose();
            navigate('/checkout');
        }, 800);
    };

    const formatPrice = (value) => {
        const n = Number(value);
        if (Number.isNaN(n)) return '0';
        return Math.floor(n).toLocaleString();
    };

    const subtotal = getCartTotal();
    const shipping = subtotal > 5000 ? 0 : 450;
    const total = subtotal + shipping;

    return (
        <>
            <style>{`
                @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap');

                * {
                    font-family: 'Poppins', sans-serif;
                }

                h1, h2, h3, h4, h5, h6 {
                    font-family: 'Playfair Display', serif;
                }

                .fade-in {
                    animation: fadeInUp 0.6s ease-out forwards;
                    opacity: 0;
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

                @keyframes slideInRight {
                    from {
                        opacity: 0;
                        transform: translateX(50px);
                    }
                    to {
                        opacity: 1;
                        transform: translateX(0);
                    }
                }

                @keyframes float {
                    0%, 100% { transform: translateY(0); }
                    50% { transform: translateY(-10px); }
                }

                @keyframes pulse-glow {
                    0%, 100% {
                        box-shadow: 0 0 20px rgba(139, 92, 246, 0.1);
                    }
                    50% {
                        box-shadow: 0 0 40px rgba(139, 92, 246, 0.3);
                    }
                }

                @keyframes particleFloat {
                    0%, 100% { 
                        transform: translateY(0) translateX(0);
                        opacity: 0.3;
                    }
                    50% { 
                        transform: translateY(-20px) translateX(10px);
                        opacity: 0.8;
                    }
                }

                @keyframes ringPulse {
                    0%, 100% { 
                        transform: scale(1.05);
                        opacity: 0.6;
                    }
                    50% { 
                        transform: scale(1.15);
                        opacity: 1;
                    }
                }

                @keyframes bounceFloat {
                    0%, 100% { transform: translateY(0); }
                    50% { transform: translateY(-15px); }
                }

                @keyframes wiggle {
                    0%, 100% { transform: rotate(0deg); }
                    20% { transform: rotate(-6deg); }
                    40% { transform: rotate(6deg); }
                    60% { transform: rotate(-4deg); }
                    80% { transform: rotate(4deg); }
                }

                .smooth-transition {
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                }

                .backdrop {
                    animation: fadeIn 0.3s ease-out;
                }

                @keyframes fadeIn {
                    from { opacity: 0; }
                    to { opacity: 1; }
                }

                .cart-sidebar {
                    animation: slideInRight 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                }

                .cart-item {
                    animation: fadeInUp 0.6s ease-out forwards;
                    opacity: 0;
                    border-radius: 16px;
                    background: white;
                    border: 1px solid rgba(139, 92, 246, 0.1);
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                }

                .cart-item:hover {
                    border-color: rgba(139, 92, 246, 0.3);
                    box-shadow: 0 8px 24px rgba(139, 92, 246, 0.12);
                    transform: translateY(-2px);
                }

                .cart-item:nth-child(1) { animation-delay: 0.1s; }
                .cart-item:nth-child(2) { animation-delay: 0.2s; }
                .cart-item:nth-child(3) { animation-delay: 0.3s; }
                .cart-item:nth-child(4) { animation-delay: 0.4s; }
                .cart-item:nth-child(5) { animation-delay: 0.5s; }

                .quantity-btn {
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    border: 2px solid rgba(139, 92, 246, 0.2);
                    border-radius: 8px;
                }

                .quantity-btn:hover:not(:disabled) {
                    border-color: #8b5cf6;
                    background: rgba(139, 92, 246, 0.05);
                    color: #8b5cf6;
                    font-weight: 600;
                }

                .quantity-btn:disabled {
                    opacity: 0.4;
                    cursor: not-allowed;
                }

                .remove-btn {
                    transition: all 0.3s ease;
                    color: #ef4444;
                }

                .remove-btn:hover {
                    color: #dc2626;
                    transform: scale(1.05);
                }

                .premium-btn {
                    background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
                    position: relative;
                    overflow: hidden;
                    border: none;
                    color: white;
                    font-weight: 700;
                    cursor: pointer;
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    box-shadow: 0 8px 20px rgba(139, 92, 246, 0.3);
                }

                .premium-btn::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: -100%;
                    width: 100%;
                    height: 100%;
                    background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 100%);
                    transition: left 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                    z-index: -1;
                }

                .premium-btn:hover::before {
                    left: 0;
                }

                .premium-btn:hover {
                    transform: translateY(-3px);
                    box-shadow: 0 15px 40px rgba(139, 92, 246, 0.4);
                }

                .premium-btn:disabled {
                    opacity: 0.8;
                    pointer-events: none;
                }

                .cart-empty-icon {
                    animation: bounceFloat 2s ease-in-out infinite;
                }

                .cart-empty-badge {
                    animation: wiggle 2.4s ease-in-out infinite;
                    transform-origin: bottom left;
                }

                .particle {
                    background: linear-gradient(135deg, rgba(236, 72, 153, 0.6), rgba(59, 130, 246, 0.6));
                    animation: particleFloat 3s ease-in-out infinite;
                    filter: blur(0.5px);
                }

                .ring-pulse {
                    border: 3px solid;
                    border-image: linear-gradient(135deg, rgba(236, 72, 153, 0.4), rgba(59, 130, 246, 0.4)) 1;
                    animation: ringPulse 2.2s ease-in-out infinite;
                }

                .loader {
                    border: 3px solid rgba(255, 255, 255, 0.3);
                    border-top: 3px solid white;
                    border-radius: 50%;
                    width: 20px;
                    height: 20px;
                    animation: spin 1s linear infinite;
                    display: inline-block;
                    margin-right: 8px;
                }

                @keyframes spin {
                    0% { transform: rotate(0deg); }
                    100% { transform: rotate(360deg); }
                }

                .product-image {
                    overflow: hidden;
                    border-radius: 12px;
                    transition: all 0.3s ease;
                }

                .product-image img {
                    transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                }

                .cart-item:hover .product-image img {
                    transform: scale(1.08);
                }

                .divider-gradient {
                    height: 1px;
                    background: linear-gradient(90deg, transparent, rgba(139, 92, 246, 0.3), transparent);
                }

                .discount-badge {
                    animation: pulse-glow 2s ease-in-out infinite;
                }

                .shipping-info {
                    background: linear-gradient(135deg, rgba(16, 185, 129, 0.05) 0%, rgba(59, 130, 246, 0.05) 100%);
                    border: 1px solid rgba(16, 185, 129, 0.2);
                    border-radius: 12px;
                    padding: 12px;
                    font-size: 13px;
                    color: #047857;
                    font-weight: 600;
                    margin-top: 12px;
                }

                .no-scrollbar::-webkit-scrollbar { display: none; }
                .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

                .gradient-text {
                    background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    background-clip: text;
                }
            `}</style>

            {/* Backdrop */}
            {isOpen && (
                <div
                    className="fixed inset-0 bg-black bg-opacity-50 z-40 transition-opacity duration-300 backdrop"
                    onClick={onClose}
                />
            )}

            {/* Cart Sidebar */}
            <div
                className={`fixed top-0 right-0 h-full w-full sm:w-96 bg-white shadow-2xl z-50 transform transition-transform duration-300 ease-in-out flex flex-col ${isOpen ? 'translate-x-0' : 'translate-x-full'
                    } ${isOpen ? 'cart-sidebar' : ''}`}
            >
                {/* Header */}
                <div className="flex items-center justify-between p-6 border-b border-gray-200 bg-gradient-to-r from-purple-50 to-pink-50">
                    <div>
                        <h2 className="text-2xl font-bold text-gray-900">Shopping Cart</h2>
                        <p className="text-sm text-gray-600 mt-1">{cartItems.length} item{cartItems.length !== 1 ? 's' : ''}</p>
                    </div>
                    <button
                        onClick={onClose}
                        className="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg smooth-transition"
                        aria-label="Close cart"
                    >
                        <svg className="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {/* Cart Content */}
                {cartItems.length === 0 ? (
                    /* Empty Cart State */
                    <div className="flex-1 flex flex-col items-center justify-center p-8 relative overflow-hidden">
                        {/* Animated background orbs */}
                        <div className="absolute -top-32 -left-32 w-64 h-64 bg-pink-200 rounded-full blur-3xl opacity-40 animate-pulse"></div>
                        <div className="absolute -bottom-32 -right-32 w-64 h-64 bg-purple-200 rounded-full blur-3xl opacity-40 animate-pulse" style={{ animationDelay: '1s' }}></div>

                        {/* Animated particles */}
                        <div className="absolute inset-0 pointer-events-none">
                            {[...Array(8)].map((_, i) => (
                                <span
                                    key={i}
                                    className="particle absolute rounded-full"
                                    style={{
                                        left: `${15 + (i * 10)}%`,
                                        top: `${20 + (i % 4) * 15}%`,
                                        width: `${8 + (i % 3) * 2}px`,
                                        height: `${8 + (i % 3) * 2}px`,
                                        animationDelay: `${i * 0.2}s`,
                                    }}
                                />
                            ))}
                        </div>

                        {/* Animated icon wrapper */}
                        <div className="relative mb-8 fade-in">
                            {/* Pulsing ring */}
                            <div className="absolute inset-0 rounded-3xl ring-pulse"></div>

                            {/* Icon card */}
                            <div className="relative w-40 h-40 rounded-3xl bg-gradient-to-br from-white to-gray-50 shadow-2xl flex items-center justify-center cart-empty-icon border border-purple-100">
                                <svg
                                    className="w-24 h-24 gradient-text"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        strokeWidth="1.5"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"
                                    />
                                </svg>

                                {/* Badge */}
                                <div className="absolute -top-3 -right-3 px-3 py-1 text-xs font-bold text-white rounded-full bg-gradient-to-r from-pink-500 to-purple-600 cart-empty-badge shadow-lg">
                                    Empty
                                </div>
                            </div>
                        </div>

                        <h3 className="text-2xl font-bold text-gray-900 mb-3 fade-in" style={{ animationDelay: '0.1s' }}>Your cart is empty</h3>
                        <p className="text-gray-600 text-center mb-8 max-w-xs fade-in" style={{ animationDelay: '0.2s' }}>
                            Explore our collection and add something you love to your cart.
                        </p>

                        <button
                            onClick={onClose}
                            className="premium-btn py-3 px-8 rounded-lg text-lg fade-in"
                            style={{ animationDelay: '0.3s' }}
                        >
                            Start Shopping
                        </button>
                    </div>
                ) : (
                    /* Cart Items List */
                    <>
                        <div className="flex-1 overflow-y-auto no-scrollbar p-4">
                            {cartItems.map((item, idx) => (
                                <div
                                    key={item.cartItemId}
                                    className="cart-item p-4 mb-3"
                                    style={{ animationDelay: `${idx * 0.1}s` }}
                                    onMouseEnter={() => setHoveredItem(item.cartItemId)}
                                    onMouseLeave={() => setHoveredItem(null)}
                                >
                                    <div className="flex gap-4">
                                        {/* Product Image */}
                                        <div className="product-image w-24 h-24 flex-shrink-0 bg-gray-100">
                                            <img
                                                src={item.image || '/images/placeholder.jpg'}
                                                alt={item.name}
                                                className="w-full h-full object-cover"
                                            />
                                        </div>

                                        {/* Product Info */}
                                        <div className="flex-1 min-w-0">
                                            <h4 className="font-bold text-gray-900 line-clamp-2 mb-2">{item.name}</h4>
                                            <div className="space-y-1 text-xs text-gray-600 mb-3">
                                                <p><span className="font-semibold">Size:</span> {item.size}</p>
                                                <p><span className="font-semibold">Color:</span> {item.color}</p>
                                            </div>

                                            {/* Quantity Control */}
                                            <div className="flex items-center gap-2">
                                                <button
                                                    onClick={() => handleQuantityChange(item.cartItemId, item.quantity - 1)}
                                                    disabled={item.quantity <= 1}
                                                    className="quantity-btn w-7 h-7 flex items-center justify-center text-sm font-bold"
                                                    aria-label="Decrease quantity"
                                                >
                                                    −
                                                </button>
                                                <span className="text-sm font-bold w-6 text-center">{item.quantity}</span>
                                                <button
                                                    onClick={() => handleQuantityChange(item.cartItemId, item.quantity + 1)}
                                                    disabled={item.quantity >= (item.stock || 99)}
                                                    className="quantity-btn w-7 h-7 flex items-center justify-center text-sm font-bold"
                                                    aria-label="Increase quantity"
                                                >
                                                    +
                                                </button>
                                            </div>
                                        </div>

                                        {/* Price & Remove */}
                                        <div className="text-right">
                                            <p className="font-bold text-gray-900 mb-3">Rs {formatPrice(item.price * item.quantity)}</p>
                                            <button
                                                onClick={() => handleRemoveItem(item.cartItemId)}
                                                className="remove-btn text-sm font-semibold"
                                            >
                                                Remove
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>

                        {/* Divider */}
                        <div className="divider-gradient mx-4"></div>

                        {/* Cart Footer */}
                        <div className="p-4 bg-gray-50 space-y-4">
                            {/* Pricing Breakdown */}
                            <div className="space-y-2">
                                <div className="flex justify-between text-sm">
                                    <span className="text-gray-600">Subtotal</span>
                                    <span className="font-semibold text-gray-900">Rs {formatPrice(subtotal)}</span>
                                </div>
                                <div className="flex justify-between text-sm">
                                    <span className="text-gray-600">Shipping</span>
                                    <span className={`font-semibold ${shipping === 0 ? 'text-green-600' : 'text-gray-900'}`}>
                                        {shipping === 0 ? 'Free' : `Rs ${shipping}`}
                                    </span>
                                </div>

                                {/* Free Shipping Info */}
                                {shipping > 0 && (
                                    <div className="shipping-info">
                                        <svg className="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fillRule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clipRule="evenodd" />
                                        </svg>
                                        Spend Rs {formatPrice(5000 - subtotal)} more for free shipping
                                    </div>
                                )}
                            </div>

                            {/* Divider */}
                            <div className="divider-gradient"></div>

                            {/* Total */}
                            <div className="flex justify-between items-center">
                                <span className="text-lg font-bold text-gray-900">Total</span>
                                <span className="text-2xl font-bold gradient-text">Rs {formatPrice(total)}</span>
                            </div>

                            {/* Checkout Button */}
                            <button
                                onClick={handleCheckout}
                                disabled={isCheckingOut}
                                className="premium-btn w-full py-3 px-6 rounded-lg text-lg font-bold flex items-center justify-center"
                            >
                                {isCheckingOut && <div className="loader"></div>}
                                {isCheckingOut ? 'Processing...' : 'Proceed to Checkout'}
                            </button>

                            {/* Continue Shopping */}
                            <button
                                onClick={onClose}
                                className="w-full py-3 px-6 rounded-lg border-2 border-purple-200 text-purple-600 font-bold hover:bg-purple-50 smooth-transition"
                            >
                                Continue Shopping
                            </button>
                        </div>
                    </>
                )}
            </div>
        </>
    );
};

export default CartPage;