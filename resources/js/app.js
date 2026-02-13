import './bootstrap';
import Alpine from 'alpinejs';
import React from 'react';
import { createRoot } from 'react-dom/client';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import HomePage from './components/HomePage';
import ShopPage from './components/ShopPage';
import ItemDetailPage from './components/ItemDetailPage';

window.Alpine = Alpine;
Alpine.start();

const rootEl = document.getElementById('app');
if (rootEl) {
	const root = createRoot(rootEl);
	root.render(
		<React.StrictMode>
			<BrowserRouter>
				<Routes>
					<Route path="/" element={<HomePage />} />
					<Route path="/shop" element={<ShopPage />} />
					<Route path="/item/:id" element={<ItemDetailPage />} />
				</Routes>
			</BrowserRouter>
		</React.StrictMode>
	);
}
