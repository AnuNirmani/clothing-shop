import './bootstrap';
import React from 'react';
import { createRoot } from 'react-dom/client';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import { CartProvider } from './context/CartContext';
import HomePage from './components/HomePage';
import ShopPage from './components/ShopPage';
import ItemDetailPage from './components/ItemDetailPage';
import ProfilePage from './pages/ProfilePage';
import LoginPage from './pages/LoginPage';

console.log('Frontend.jsx loaded');

if (document.getElementById('app')) {
    console.log('App element found, mounting React...');
    const root = createRoot(document.getElementById('app'));
    root.render(
        <React.StrictMode>
            <CartProvider>
                <BrowserRouter>
                    <Routes>
                        <Route path="/" element={<HomePage />} />
                        <Route path="/shop" element={<ShopPage />} />
                        <Route path="/item/:id" element={<ItemDetailPage />} />
                        <Route path="/profile" element={<ProfilePage />} />
                        <Route path="/login" element={<LoginPage />} />
                        {/* Add more routes here as needed */}
                    </Routes>
                </BrowserRouter>
            </CartProvider>
        </React.StrictMode>
    );
    console.log('React moved to render queue');
} else {
    console.error('App element NOT found');
}
