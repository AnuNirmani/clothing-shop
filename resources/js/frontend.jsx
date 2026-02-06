import './bootstrap';
import React from 'react';
import { createRoot } from 'react-dom/client';
import HomePage from './components/HomePage';

console.log('Frontend.jsx loaded');

if (document.getElementById('app')) {
    console.log('App element found, mounting React...');
    const root = createRoot(document.getElementById('app'));
    root.render(
        <React.StrictMode>
            <HomePage />
        </React.StrictMode>
    );
    console.log('React moved to render queue');
} else {
    console.error('App element NOT found');
}
