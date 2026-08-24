import React, { useEffect, useMemo, useRef, useState } from 'react';
import Header from '../components/Header';
import Footer from '../components/Footer';

const ProfilePage = () => {
	const bottomRef = useRef(null);
	const [profile, setProfile] = useState(null);
	const [profileError, setProfileError] = useState('');
	const [recentOrders, setRecentOrders] = useState([]);
	const [ordersLoading, setOrdersLoading] = useState(false);

	useEffect(() => {
		// Smooth scroll to the bottom after the component mounts
		const t = setTimeout(() => {
			bottomRef.current?.scrollIntoView({ behavior: 'smooth', block: 'end' });
		}, 800); // Slight delay for visual effect
		return () => clearTimeout(t);
	}, []);

	useEffect(() => {
		const customerId = localStorage.getItem('currentCustomerId');
		const customerEmail = localStorage.getItem('currentCustomerEmail');

		if (!customerId && !customerEmail) {
			setProfileError('No customer found. Please create an account first.');
			return;
		}

		const loadProfile = async () => {
			try {
				setProfileError('');

				let response;
				if (customerId) {
					response = await fetch(`/api/customers/${customerId}`, {
						headers: {
							Accept: 'application/json',
						},
					});
				}

				if ((!response || !response.ok) && customerEmail) {
					response = await fetch(`/api/customers/by-email?email=${encodeURIComponent(customerEmail)}`, {
						headers: {
							Accept: 'application/json',
						},
					});
				}

				if (!response) {
					throw new Error('Unable to load profile');
				}

				const data = await response.json();

				if (!response.ok || !data?.data) {
					throw new Error(data?.message || 'Unable to load profile');
				}

				localStorage.setItem('currentCustomerId', String(data.data.id));
				localStorage.setItem('currentCustomerEmail', data.data.email || '');
				localStorage.setItem('currentCustomerName', data.data.name || '');

				setProfile(data.data);
			} catch (error) {
				setProfileError('Unable to load customer details from database.');
			}
		};

		loadProfile();
	}, []);

	useEffect(() => {
		const customerEmail = localStorage.getItem('currentCustomerEmail');

		if (!customerEmail) {
			return;
		}

		const loadOrders = async () => {
			try {
				setOrdersLoading(true);
				const response = await fetch(`/api/orders/by-email?email=${encodeURIComponent(customerEmail)}`, {
					headers: {
						Accept: 'application/json',
					},
				});

				if (!response.ok) {
					throw new Error('Unable to load orders');
				}

				const data = await response.json();
				setRecentOrders(data.data || []);
			} catch (error) {
				console.error('Error loading orders:', error);
				setRecentOrders([]);
			} finally {
				setOrdersLoading(false);
			}
		};

		loadOrders();
	}, []);

	const userProfile = useMemo(() => {
		const fallbackName = localStorage.getItem('currentCustomerName') || 'Customer';
		const fallbackEmail = localStorage.getItem('currentCustomerEmail') || 'customer@example.com';
		const name = profile?.name || fallbackName;
		const email = profile?.email || fallbackEmail;
		const createdAt = profile?.created_at ? new Date(profile.created_at) : null;

		return {
			name,
			email,
			memberSince: createdAt ? createdAt.toLocaleString('en-US', { month: 'long', year: 'numeric' }) : 'Member',
			avatar: `https://ui-avatars.com/api/?name=${encodeURIComponent(name)}&background=ff0080&color=fff&size=128`,
		};
	}, [profile]);

	const statusBgColor = (status) => {
		if (status.toLowerCase() === 'delivered') return 'bg-green-100 text-green-600';
		if (status.toLowerCase() === 'shipped') return 'bg-blue-100 text-blue-600';
		if (status.toLowerCase() === 'confirmed') return 'bg-yellow-100 text-yellow-600';
		return 'bg-gray-100 text-gray-600';
	};

	return (
		<div className="min-h-screen bg-gradient-to-br from-pink-50 via-white to-blue-50">
			<Header />

			{/* Profile Header */}
			<section className="relative py-20 px-6 animate-wipe-ltr">
				<div className="max-w-6xl mx-auto">
					{profileError && (
						<div className="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700">
							{profileError}
						</div>
					)}

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

						
					</div>
				</div>
			</section>

			{/* Main Content Grid */}
			<section className="max-w-6xl mx-auto px-6 py-10 animate-wipe-ltr">
				<div className="space-y-8">

					{/* Recent Orders */}
					<div className="bg-white p-8 rounded-3xl border border-pink-100 shadow-xl overflow-hidden">
						<div className="flex items-center justify-between mb-8">
							<h3 className="text-xl font-bold text-gray-800 flex items-center gap-2">
								<span className="w-2 h-8 bg-pink-500 rounded-full"></span>
								Recent Orders
							</h3>
							
						</div>
						<div className="space-y-4">
							{ordersLoading ? (
								<div className="text-center py-8 text-gray-500">Loading orders...</div>
							) : recentOrders.length > 0 ? (
								recentOrders.map((order) => (
									<div key={order.id} className="group flex flex-col md:flex-row md:items-center justify-between p-6 rounded-2xl border border-gray-100 hover:border-pink-200 hover:bg-pink-50/30 transition-all duration-300">
										<div>
											<p className="font-black text-gray-800 text-lg group-hover:text-pink-600 transition-colors">{order.order_number}</p>
											<p className="text-sm text-gray-500 font-medium">{order.date}</p>
										</div>
										<div className="mt-4 md:mt-0 flex items-center gap-6">
											<span className={`px-4 py-1 rounded-full text-xs font-black uppercase tracking-widest ${statusBgColor(order.status)}`}>
												{order.status}
											</span>
											<p className="font-bold text-gray-800">{order.total}</p>
										</div>
									</div>
								))
							) : (
								<div className="text-center py-8 text-gray-500">
									<p>No orders yet.</p>
									<a href="/shop" className="text-pink-500 font-bold hover:text-blue-600 transition-colors">Start shopping →</a>
								</div>
							)}
						</div>
					</div>

					
				</div>
			</section>
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
