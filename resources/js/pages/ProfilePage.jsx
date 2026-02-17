import React, { useEffect, useRef } from 'react';
import Header from '../components/Header';
import Footer from '../components/Footer';

const ProfilePage = () => {
	const bottomRef = useRef(null);

	useEffect(() => {
		// Smooth scroll to the bottom after the component mounts
		const t = setTimeout(() => {
			bottomRef.current?.scrollIntoView({ behavior: 'smooth', block: 'end' });
		}, 800); // Slight delay for visual effect
		return () => clearTimeout(t);
	}, []);

	const userProfile = {
		name: "Alex Doe",
		email: "alex.doe@example.com",
		memberSince: "February 2024",
		avatar: "https://ui-avatars.com/api/?name=Alex+Doe&background=ff0080&color=fff&size=128"
	};

	const recentOrders = [
		{ id: "#ORD-7721", date: "Feb 10, 2026", status: "Delivered", total: "Rs 12,500.00" },
		{ id: "#ORD-6544", date: "Jan 15, 2026", status: "Shipped", total: "Rs 8,900.00" },
	];

	return (
		<div className="min-h-screen bg-gradient-to-br from-pink-50 via-white to-blue-50">
			<Header />

			{/* Profile Header */}
			<section className="relative py-20 px-6 animate-wipe-ltr">
				<div className="max-w-6xl mx-auto">
					<div className="flex flex-col md:flex-row items-center gap-8 bg-white/80 backdrop-blur-md p-10 rounded-[2rem] border-2 border-pink-100 shadow-2xl relative overflow-hidden">
						{/* Decorative Background Element */}
						<div className="absolute -top-24 -right-24 w-64 h-64 bg-pink-100/50 rounded-full blur-3xl"></div>
						<div className="absolute -bottom-24 -left-24 w-64 h-64 bg-blue-100/50 rounded-full blur-3xl"></div>

						<div className="relative group">
							<img
								src={userProfile.avatar}
								alt="Profile Avatar"
								className="w-32 h-32 rounded-full border-4 border-white shadow-xl group-hover:scale-105 transition-transform duration-300"
							/>
							<div className="absolute inset-0 rounded-full border-2 border-pink-200 animate-pulse"></div>
						</div>

						<div className="text-center md:text-left z-10">
							<h1 className="text-4xl font-extrabold bg-gradient-to-r from-pink-500 via-blue-600 to-pink-600 bg-clip-text text-transparent">
								{userProfile.name}
							</h1>
							<p className="text-gray-500 font-medium text-lg mt-1">{userProfile.email}</p>
							<div className="flex flex-wrap justify-center md:justify-start gap-3 mt-4">
								<span className="bg-pink-50 text-pink-600 px-4 py-1 rounded-full text-sm font-bold border border-pink-100">
									Gold Member
								</span>
								<span className="bg-blue-50 text-blue-600 px-4 py-1 rounded-full text-sm font-bold border border-blue-100">
									{userProfile.memberSince}
								</span>
							</div>
						</div>

						<div className="md:ml-auto flex flex-col gap-3 w-full md:w-auto">
							<button className="bg-gradient-to-r from-pink-500 to-blue-500 hover:from-pink-600 hover:to-blue-600 text-white font-bold py-3 px-8 rounded-xl shadow-lg transition-all duration-300 hover:scale-105">
								Edit Profile
							</button>
							<button className="bg-white border-2 border-pink-100 text-pink-500 hover:bg-pink-50 font-bold py-3 px-8 rounded-xl transition-all duration-300">
								Manage Subscription
							</button>
						</div>
					</div>
				</div>
			</section>

			{/* Main Content Grid */}
			<section className="max-w-6xl mx-auto px-6 py-10 animate-wipe-ltr">
				<div className="grid grid-cols-1 lg:grid-cols-3 gap-8">

					{/* Left Column - Stats and Preferences */}
					<div className="space-y-8">
						{/* Stats Card */}
						<div className="bg-white p-8 rounded-3xl border border-pink-100 shadow-xl">
							<h3 className="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
								<span className="w-2 h-8 bg-pink-500 rounded-full"></span>
								Style Overview
							</h3>
							<div className="space-y-6">
								<div>
									<div className="flex justify-between text-sm font-bold text-gray-600 mb-2">
										<span>Fashion Score</span>
										<span className="text-pink-500">85%</span>
									</div>
									<div className="w-full bg-gray-100 h-3 rounded-full overflow-hidden">
										<div className="bg-gradient-to-r from-pink-400 to-pink-600 h-full w-[85%] rounded-full shadow-[0_0_10px_rgba(255,105,180,0.5)]"></div>
									</div>
								</div>
								<div className="grid grid-cols-2 gap-4">
									<div className="bg-pink-50 p-4 rounded-2xl text-center">
										<p className="text-xs text-pink-400 font-bold uppercase tracking-wider">Favorites</p>
										<p className="text-2xl font-black text-pink-600">24</p>
									</div>
									<div className="bg-blue-50 p-4 rounded-2xl text-center">
										<p className="text-xs text-blue-400 font-bold uppercase tracking-wider">Wishlist</p>
										<p className="text-2xl font-black text-blue-600">12</p>
									</div>
								</div>
							</div>
						</div>

						{/* Preferred Colors */}
						<div className="bg-white p-8 rounded-3xl border border-pink-100 shadow-xl">
							<h3 className="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
								<span className="w-2 h-8 bg-blue-500 rounded-full"></span>
								Your Palette
							</h3>
							<div className="flex flex-wrap gap-4">
								{['#FFC0CB', '#87CEEB', '#FFFFFF', '#000000', '#F0EAD6'].map((color, i) => (
									<div
										key={i}
										className="w-12 h-12 rounded-2xl border-2 border-white shadow-md hover:scale-110 transition-transform cursor-pointer"
										style={{ backgroundColor: color }}
									></div>
								))}
								<button className="w-12 h-12 rounded-2xl border-2 border-dashed border-gray-300 flex items-center justify-center text-gray-400 hover:text-pink-500 hover:border-pink-300 transition-colors">
									+
								</button>
							</div>
						</div>
					</div>

					{/* Right Column - Orders and Recent Activity */}
					<div className="lg:col-span-2 space-y-8">
						{/* Recent Orders */}
						<div className="bg-white p-8 rounded-3xl border border-pink-100 shadow-xl overflow-hidden">
							<div className="flex items-center justify-between mb-8">
								<h3 className="text-xl font-bold text-gray-800 flex items-center gap-2">
									<span className="w-2 h-8 bg-pink-500 rounded-full"></span>
									Recent Orders
								</h3>
								<button className="text-pink-500 font-bold hover:text-blue-600 transition-colors">
									View All →
								</button>
							</div>
							<div className="space-y-4">
								{recentOrders.map((order) => (
									<div key={order.id} className="group flex flex-col md:flex-row md:items-center justify-between p-6 rounded-2xl border border-gray-100 hover:border-pink-200 hover:bg-pink-50/30 transition-all duration-300">
										<div>
											<p className="font-black text-gray-800 text-lg group-hover:text-pink-600 transition-colors">{order.id}</p>
											<p className="text-sm text-gray-500 font-medium">{order.date}</p>
										</div>
										<div className="mt-4 md:mt-0 flex items-center gap-6">
											<span className={`px-4 py-1 rounded-full text-xs font-black uppercase tracking-widest ${order.status === 'Delivered' ? 'bg-green-100 text-green-600' : 'bg-blue-100 text-blue-600'
												}`}>
												{order.status}
											</span>
											<p className="font-bold text-gray-800">{order.total}</p>
										</div>
									</div>
								))}
							</div>
						</div>

						{/* Exclusive Perks Banner */}
						<div className="relative rounded-3xl bg-gradient-to-r from-pink-500 via-pink-400 to-blue-500 p-10 text-white shadow-2xl overflow-hidden group">
							<div className="absolute top-0 right-0 p-8 transform group-hover:rotate-12 transition-transform duration-500 opacity-20">
								<svg className="w-32 h-32" fill="currentColor" viewBox="0 0 24 24">
									<path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
								</svg>
							</div>
							<div className="relative z-10">
								<h2 className="text-3xl font-black mb-4">You've Unlocked VIP Perks!</h2>
								<p className="text-white/90 text-lg font-medium max-w-md leading-relaxed">
									Get early access to our Summer '26 drops and exclusive 20% discount on personalized styles.
								</p>
								<button className="mt-8 bg-white text-pink-600 font-black py-3 px-10 rounded-xl hover:bg-gray-100 transition-all transform hover:-translate-y-1 shadow-lg">
									Claim Now
								</button>
							</div>
						</div>
					</div>
				</div>
			</section>

			{/* Support Section - Bottom of page */}
			<section className="max-w-6xl mx-auto px-6 pb-20 pt-10 animate-wipe-ltr">
				<div className="bg-white/50 backdrop-blur-sm p-12 rounded-[2rem] border-2 border-dashed border-pink-200 text-center hover:border-pink-400 transition-colors group">
					<h3 className="text-2xl font-black text-gray-800 mb-4 group-hover:text-pink-600 transition-colors">Need Styling Advice?</h3>
					<p className="text-gray-600 text-lg mb-8 max-w-2xl mx-auto italic font-medium">
						"Fashion is what you're offered four times a year by designers. Style is what you choose."
					</p>
					<div className="flex flex-wrap justify-center gap-6">
						<button className="flex items-center gap-2 text-gray-700 font-bold hover:text-pink-500 transition-colors">
							<span className="w-10 h-10 rounded-full border border-pink-100 flex items-center justify-center">💬</span>
							Live Style Agent
						</button>
						<button className="flex items-center gap-2 text-gray-700 font-bold hover:text-pink-500 transition-colors">
							<span className="w-10 h-10 rounded-full border border-pink-100 flex items-center justify-center">📧</span>
							Email Concierge
						</button>
					</div>
				</div>
				{/* Scroll Target */}
				<div ref={bottomRef} className="h-4" />
			</section>

			<Footer />
		</div>
	);
};

export default ProfilePage;
