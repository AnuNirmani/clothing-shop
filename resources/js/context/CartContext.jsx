import React, { createContext, useContext, useState, useEffect } from 'react';

const CartContext = createContext();

export const useCart = () => {
    const context = useContext(CartContext);
    if (!context) {
        throw new Error('useCart must be used within a CartProvider');
    }
    return context;
};

export const CartProvider = ({ children }) => {
    const [cartItems, setCartItems] = useState([]);

    // Load cart from localStorage on mount
    useEffect(() => {
        const savedCart = localStorage.getItem('shopping_cart');
        if (savedCart) {
            try {
                setCartItems(JSON.parse(savedCart));
            } catch (error) {
                console.error('Error loading cart from localStorage:', error);
            }
        }
    }, []);

    // Save cart to localStorage whenever it changes
    useEffect(() => {
        localStorage.setItem('shopping_cart', JSON.stringify(cartItems));
    }, [cartItems]);

    // Add item to cart
    const addToCart = (item) => {
        setCartItems((prevItems) => {
            // Check if item already exists in cart (same id, color, and size)
            const existingItemIndex = prevItems.findIndex(
                (cartItem) =>
                    cartItem.id === item.id &&
                    cartItem.color === item.color &&
                    cartItem.size === item.size
            );

            if (existingItemIndex > -1) {
                // Item exists, update quantity with stock limit check
                const updatedItems = [...prevItems];
                const newQuantity = updatedItems[existingItemIndex].quantity + item.quantity;
                const stockLimit = item.stock || 99;

                // Don't exceed stock limit
                updatedItems[existingItemIndex].quantity = Math.min(newQuantity, stockLimit);
                return updatedItems;
            } else {
                // New item, add to cart with stock limit check
                const stockLimit = item.stock || 99;
                const validatedItem = {
                    ...item,
                    quantity: Math.min(item.quantity, stockLimit),
                    cartItemId: Date.now()
                };
                return [...prevItems, validatedItem];
            }
        });
    };

    // Remove item from cart
    const removeFromCart = (cartItemId) => {
        setCartItems((prevItems) => prevItems.filter((item) => item.cartItemId !== cartItemId));
    };

    // Update item quantity
    const updateQuantity = (cartItemId, newQuantity) => {
        if (newQuantity < 1) return;

        setCartItems((prevItems) =>
            prevItems.map((item) => {
                if (item.cartItemId === cartItemId) {
                    const stockLimit = item.stock || 99;
                    // Don't exceed stock limit
                    return { ...item, quantity: Math.min(newQuantity, stockLimit) };
                }
                return item;
            })
        );
    };

    // Clear entire cart
    const clearCart = () => {
        setCartItems([]);
    };

    // Calculate cart totals
    const getCartTotal = () => {
        return cartItems.reduce((total, item) => total + item.price * item.quantity, 0);
    };

    const getCartItemCount = () => {
        return cartItems.reduce((count, item) => count + item.quantity, 0);
    };

    const value = {
        cartItems,
        addToCart,
        removeFromCart,
        updateQuantity,
        clearCart,
        getCartTotal,
        getCartItemCount,
    };

    return <CartContext.Provider value={value}>{children}</CartContext.Provider>;
};
