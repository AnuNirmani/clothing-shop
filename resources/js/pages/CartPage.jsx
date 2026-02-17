import React, { useState, useEffect } from 'react';
import { useCart } from '../context/CartContext';

const CartPage = ({ isOpen, onClose }) => {
    const { cartItems, removeFromCart, updateQuantity, getCartTotal } = useCart();

    const handleQuantityChange = (cartItemId, newQuantity) => {
        updateQuantity(cartItemId, newQuantity);
    };

    const handleRemoveItem = (cartItemId) => {
        removeFromCart(cartItemId);
    };

    const formatPrice = (value) => {
        const n = Number(value);
        if (Number.isNaN(n)) return '0';
        return Math.floor(n).toLocaleString();
    };

    return (
        <>
            {/* Backdrop */}
            {isOpen && (
                <div
                    className="fixed inset-0 bg-black bg-opacity-50 z-40 transition-opacity duration-300"
                    onClick={onClose}
                />
            )}

            {/* Cart Sidebar */}
            <div
                className={`fixed top-0 right-0 h-full w-full sm:w-96 bg-white shadow-2xl z-50 transform transition-transform duration-300 ease-in-out ${isOpen ? 'translate-x-0' : 'translate-x-full'
                    }`}
            >
                {/* Header */}
                <div className="flex items-center justify-between p-6 border-b border-gray-200">
                    <h2 className="text-xl font-bold text-gray-800">Shopping Cart</h2>
                    <button
                        onClick={onClose}
                        className="text-gray-500 hover:text-gray-700 transition-colors"
                        aria-label="Close cart"
                    >
                        <svg className="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {/* Cart Content */}
                <div className="flex flex-col h-full">
                    {cartItems.length === 0 ? (
                        /* Empty Cart State (Animated) */
                        <div className="flex-1 flex flex-col items-center justify-center p-8 relative overflow-hidden">
                            {/* soft animated background blobs */}
                            <div className="absolute -top-16 -left-16 w-56 h-56 bg-pink-200 rounded-full blur-3xl opacity-50 animate-pulse" />
                            <div className="absolute -bottom-16 -right-16 w-56 h-56 bg-blue-200 rounded-full blur-3xl opacity-50 animate-pulse" />

                            {/* particles */}
                            <div className="absolute inset-0 pointer-events-none">
                                {[...Array(10)].map((_, i) => (
                                    <span
                                        key={i}
                                        className="particle absolute rounded-full opacity-60"
                                        style={{
                                            left: `${10 + (i * 8)}%`,
                                            top: `${20 + (i % 5) * 12}%`,
                                            width: `${6 + (i % 3) * 2}px`,
                                            height: `${6 + (i % 3) * 2}px`,
                                            animationDelay: `${i * 0.15}s`,
                                        }}
                                    />
                                ))}
                            </div>

                            {/* animated icon wrapper */}
                            <div className="relative mb-6">
                                {/* pulsing ring */}
                                <div className="absolute inset-0 rounded-full ringPulse" />

                                {/* icon card */}
                                <div className="relative w-36 h-36 rounded-3xl bg-white shadow-xl flex items-center justify-center bounceFloat">
                                    <svg
                                        className="w-20 h-20 text-gray-400"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            strokeLinecap="round"
                                            strokeLinejoin="round"
                                            strokeWidth="1.6"
                                            d="M3 3h2l.6 3M7 13h10l4-8H6.2M7 13l-1.2 6H19M7 13h12M9 21a1 1 0 100-2 1 1 0 000 2zm9 0a1 1 0 100-2 1 1 0 000 2z"
                                        />
                                    </svg>

                                    {/* tiny "empty" badge wiggle */}
                                    <div className="absolute -top-3 -right-3 px-3 py-1 text-xs font-bold text-white rounded-full bg-gradient-to-r from-pink-400 via-pink-500 to-blue-400 wiggle">
                                        Empty
                                    </div>
                                </div>
                            </div>

                            <h3 className="text-xl font-semibold text-gray-800 mb-2">Your cart is empty</h3>
                            <p className="text-gray-500 text-center mb-6 max-w-xs">
                                Add something you love — we’ll keep it safe here.
                            </p>

                            <button
                                onClick={onClose}
                                className="bg-gradient-to-r from-pink-400 via-pink-500 to-blue-400 hover:from-pink-500 hover:to-blue-500 text-white font-bold py-3 px-8 rounded-lg shadow-md hover:shadow-xl transition-all duration-200 active:scale-95"
                            >
                                Start Shopping
                            </button>

                            {/* local CSS (Tailwind-friendly) */}
                            <style>{`
    .bounceFloat {
      animation: bounceFloat 1.8s ease-in-out infinite;
    }
    @keyframes bounceFloat {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }

    .ringPulse {
      width: 144px;
      height: 144px;
      border-radius: 24px;
      background: conic-gradient(from 180deg, rgba(236,72,153,.35), rgba(59,130,246,.35), rgba(236,72,153,.35));
      filter: blur(8px);
      animation: ringPulse 2.2s ease-in-out infinite;
      transform: scale(1.06);
      opacity: .9;
    }
    @keyframes ringPulse {
      0%, 100% { transform: scale(1.05); opacity: .7; }
      50% { transform: scale(1.14); opacity: 1; }
    }

    .wiggle {
      animation: wiggle 2.4s ease-in-out infinite;
      transform-origin: bottom left;
    }
    @keyframes wiggle {
      0%, 100% { transform: rotate(0deg) translateY(0); }
      20% { transform: rotate(-6deg) translateY(-1px); }
      40% { transform: rotate(6deg) translateY(-1px); }
      60% { transform: rotate(-4deg) translateY(0); }
      80% { transform: rotate(4deg) translateY(0); }
    }

    .particle {
      background: linear-gradient(135deg, rgba(236,72,153,.55), rgba(59,130,246,.55));
      animation: particleFloat 2.8s ease-in-out infinite;
      filter: blur(0.2px);
    }
    @keyframes particleFloat {
      0%, 100% { transform: translateY(0) translateX(0); opacity: .35; }
      50% { transform: translateY(-16px) translateX(6px); opacity: .8; }
    }
  `}</style>
                        </div>
                    ) : (
                        /* Cart Items List */
                        <>
                            <div className="flex-1 overflow-y-auto p-6">
                                {cartItems.map((item) => (
                                    <div key={item.cartItemId} className="flex items-center gap-4 mb-4 pb-4 border-b border-gray-200">
                                        <img
                                            src={item.image || '/images/placeholder.jpg'}
                                            alt={item.name}
                                            className="w-20 h-20 object-cover rounded-lg"
                                        />
                                        <div className="flex-1">
                                            <h4 className="font-semibold text-gray-800">{item.name}</h4>
                                            <p className="text-sm text-gray-500">Size: {item.size}</p>
                                            <p className="text-sm text-gray-500">Color: {item.color}</p>
                                            <div className="flex items-center gap-2 mt-2">
                                                <button
                                                    onClick={() => handleQuantityChange(item.cartItemId, item.quantity - 1)}
                                                    disabled={item.quantity <= 1}
                                                    className={`w-6 h-6 flex items-center justify-center border border-gray-300 rounded transition-colors ${item.quantity <= 1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-100'
                                                        }`}
                                                >
                                                    -
                                                </button>
                                                <span className="text-sm font-medium">{item.quantity}</span>
                                                <button
                                                    onClick={() => handleQuantityChange(item.cartItemId, item.quantity + 1)}
                                                    disabled={item.quantity >= (item.stock || 99)}
                                                    className={`w-6 h-6 flex items-center justify-center border border-gray-300 rounded transition-colors ${item.quantity >= (item.stock || 99) ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-100'
                                                        }`}
                                                >
                                                    +
                                                </button>
                                            </div>
                                        </div>
                                        <div className="text-right">
                                            <p className="font-bold text-gray-800">Rs {formatPrice(item.price * item.quantity)}</p>
                                            <button
                                                onClick={() => handleRemoveItem(item.cartItemId)}
                                                className="text-red-500 hover:text-red-700 text-sm mt-2 transition-colors"
                                            >
                                                Remove
                                            </button>
                                        </div>
                                    </div>
                                ))}
                            </div>

                            {/* Cart Footer */}
                            <div className="border-t border-gray-200 p-6 bg-gray-50">
                                <div className="flex justify-between mb-4">
                                    <span className="text-gray-600">Subtotal:</span>
                                    <span className="font-bold text-gray-800">Rs {formatPrice(getCartTotal())}</span>
                                </div>
                                <div className="flex justify-between mb-4">
                                    <span className="text-gray-600">Shipping:</span>
                                    <span className="font-bold text-gray-800">Free</span>
                                </div>
                                <div className="flex justify-between mb-6 text-lg">
                                    <span className="font-bold text-gray-800">Total:</span>
                                    <span className="font-bold text-pink-500">Rs {formatPrice(getCartTotal())}</span>
                                </div>
                                <button className="w-full bg-gradient-to-r from-pink-400 via-pink-500 to-blue-400 hover:from-pink-500 hover:to-blue-500 text-white font-bold py-3 px-6 rounded-lg shadow-md hover:shadow-xl transition-all duration-200">
                                    Checkout
                                </button>
                            </div>
                        </>
                    )}
                </div>
            </div>
        </>
    );
};

export default CartPage;
