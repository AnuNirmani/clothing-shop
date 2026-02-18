import React, { useEffect, useRef } from 'react';
import { Link } from 'react-router-dom';
import Header from '../components/Header';
import Footer from '../components/Footer';

const LoginPage = () => {
    const bottomRef = useRef(null);

    useEffect(() => {
        const t = setTimeout(() => {
            bottomRef.current?.scrollIntoView({ behavior: 'smooth', block: 'end' });
        }, 800);
        return () => clearTimeout(t);
    }, []);

    return (
        <div className="min-h-screen bg-white font-sans text-gray-800">
            <Header />

            <main className="py-20 px-4 animate-wipe-ltr">
                {/* Header Section */}
                <div className="text-center mb-16 relative">
                    {/* Background Dot Pattern (CSS simulation) */}
                    <div className="absolute inset-x-0 -top-10 h-64 opacity-10 pointer-events-none"
                        style={{ backgroundImage: 'radial-gradient(#000 1px, transparent 1px)', backgroundSize: '20px 20px' }}></div>

                    <h1 className="text-5xl font-bold mb-4 relative z-10">Login</h1>
                    <nav className="text-gray-500 text-lg relative z-10">
                        <Link to="/" className="hover:text-pink-500 transition-colors">Home</Link>
                        <span className="mx-3">/</span>
                        <span className="text-gray-400">Login</span>
                    </nav>
                </div>

                {/* Login Form Section */}
                <div className="max-w-md mx-auto">
                    <div className="mb-8">
                        <h2 className="text-2xl font-bold mb-2">Log in</h2>
                        <p className="text-gray-500 text-lg">Login to the kandy account</p>
                    </div>

                    <form className="space-y-6">
                        <div>
                            <input
                                type="email"
                                placeholder="Enter email address"
                                className="w-full px-6 py-4 border border-gray-200 focus:border-pink-300 focus:outline-none transition-colors text-lg placeholder-gray-400"
                            />
                        </div>
                        <div>
                            <input
                                type="password"
                                placeholder="Password"
                                className="w-full px-6 py-4 border border-gray-200 focus:border-pink-300 focus:outline-none transition-colors text-lg placeholder-gray-400"
                            />
                        </div>
                        <div className="flex justify-end">
                            <button
                                type="submit"
                                className="bg-[#0f172a] text-white px-10 py-4 font-bold text-lg hover:bg-black transition-colors shadow-lg"
                            >
                                Log in
                            </button>
                        </div>
                    </form>
                </div>
                <div ref={bottomRef} className="h-4" />
            </main>

            <Footer />
        </div>
    );
};

export default LoginPage;
