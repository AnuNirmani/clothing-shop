import './bootstrap';
import React from 'react';
import { createRoot } from 'react-dom/client';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import HomePage from './components/HomePage';
import ShopPage from './components/ShopPage';

console.log('Frontend.jsx loaded');

if (document.getElementById('app')) {
    console.log('App element found, mounting React...');
    const root = createRoot(document.getElementById('app'));
    root.render(
        <React.StrictMode>
            <BrowserRouter>
                <Routes>
                    <Route path="/" element={<HomePage />} />
                    <Route path="/shop" element={<ShopPage />} />
                    {/* Add more routes here as needed */}
                </Routes>
            </BrowserRouter>
        </React.StrictMode>
    );
    console.log('React moved to render queue');
} else {
    console.error('App element NOT found');
}
