import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { useCart } from '../context/CartContext';

const CheckoutPage = () => {
    const navigate = useNavigate();
    const { cartItems, getCartTotal, clearCart } = useCart();

    const subtotal = getCartTotal();
    const isFreeDeliveryItem = cartItems.length === 1 && cartItems[0].free_delivery;
    const shipping = (subtotal > 5000 || isFreeDeliveryItem) ? 0 : 450;
    const total = subtotal + shipping;

    const formatPrice = (value) => {
        const n = Number(value);
        if (Number.isNaN(n)) return '0';
        return Math.floor(n).toLocaleString();
    };

    const [contact, setContact] = useState('');
    const [emailOffers, setEmailOffers] = useState(true);
    const [deliveryMethod, setDeliveryMethod] = useState('ship');
    const [country, setCountry] = useState('Sri Lanka');
    const [firstName, setFirstName] = useState('');
    const [lastName, setLastName] = useState('');
    const [address, setAddress] = useState('');
    const [apartment, setApartment] = useState('');
    const [city, setCity] = useState('');
    const [postalCode, setPostalCode] = useState('');
    const [phone, setPhone] = useState('');
    const [saveInfo, setSaveInfo] = useState(false);
    const [discountCode, setDiscountCode] = useState('');
    const [paymentMethod, setPaymentMethod] = useState('card');
    const [billingAddress, setBillingAddress] = useState('same');
    const [isPlacingOrder, setIsPlacingOrder] = useState(false);
    const [orderPlaced, setOrderPlaced] = useState(false);
    const [cardNumber, setCardNumber] = useState('');
    const [cardName, setCardName] = useState('');
    const [cardExpiry, setCardExpiry] = useState('');
    const [cardCvv, setCardCvv] = useState('');
    const [billingFirstName, setBillingFirstName] = useState('');
    const [billingLastName, setBillingLastName] = useState('');
    const [billingAddress_val, setBillingAddress_val] = useState('');
    const [billingApartment, setBillingApartment] = useState('');
    const [billingCity, setBillingCity] = useState('');
    const [billingPostalCode, setBillingPostalCode] = useState('');
    const [errors, setErrors] = useState({});

    const handlePayNow = async (e) => {
        e.preventDefault();

        const newErrors = {};

        // Validation logic
        if (!contact.trim()) {
            newErrors.contact = 'Email is required';
        } else {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(contact)) {
                newErrors.contact = 'Enter a valid email address';
            }
        }

        if (!firstName.trim()) newErrors.firstName = 'First name is required';
        if (!lastName.trim()) newErrors.lastName = 'Last name is required';
        if (!address.trim()) newErrors.address = 'Address is required';
        if (!apartment.trim()) newErrors.apartment = 'Apartment/Suite is required';
        if (!city.trim()) newErrors.city = 'City is required';
        if (!postalCode.trim()) newErrors.postalCode = 'Postal code is required';
        if (!phone.trim()) newErrors.phone = 'Phone number is required';

        if (paymentMethod === 'card') {
            const cleanCard = cardNumber.replace(/\s/g, '');
            if (!cleanCard.match(/^\d{16}$/)) {
                newErrors.cardNumber = 'Enter a valid 16-digit card number';
            }
            if (!cardName.trim()) {
                newErrors.cardName = 'Name on card is required';
            }
            if (!cardExpiry.match(/^(0[1-9]|1[0-2])\s?\/\s?([0-9]{2})$/)) {
                newErrors.cardExpiry = 'Enter a valid expiry (MM/YY)';
            }
            if (!cardCvv.match(/^\d{3,4}$/)) {
                newErrors.cardCvv = 'Enter a valid CVV';
            }
        }

        if (billingAddress === 'different') {
            if (!billingFirstName.trim()) newErrors.billingFirstName = 'First name is required';
            if (!billingLastName.trim()) newErrors.billingLastName = 'Last name is required';
            if (!billingAddress_val.trim()) newErrors.billingAddress_val = 'Address is required';
            if (!billingApartment.trim()) newErrors.billingApartment = 'Apartment/Suite is required';
            if (!billingCity.trim()) newErrors.billingCity = 'City is required';
            if (!billingPostalCode.trim()) newErrors.billingPostalCode = 'Postal code is required';
        }

        if (Object.keys(newErrors).length > 0) {
            setErrors(newErrors);
            // Scroll to the first error
            setTimeout(() => {
                const firstError = document.querySelector('[data-error="true"]');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }, 100);
            return;
        }

        setErrors({});
        setIsPlacingOrder(true);
        await new Promise((res) => setTimeout(res, 2000));
        setIsPlacingOrder(false);
        setOrderPlaced(true);
        clearCart();
    };

    if (orderPlaced) {
        return (
            <>
                <style>{`
                    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600;700&display=swap');
                    * { font-family: 'Poppins', sans-serif; box-sizing: border-box; }
                    @keyframes popIn {
                        0% { transform: scale(0.5); opacity: 0; }
                        70% { transform: scale(1.1); }
                        100% { transform: scale(1); opacity: 1; }
                    }
                    @keyframes fadeUp {
                        from { opacity: 0; transform: translateY(24px); }
                        to { opacity: 1; transform: translateY(0); }
                    }
                    .pop-in { animation: popIn 0.6s cubic-bezier(0.34,1.56,0.64,1) forwards; }
                    .fade-up { animation: fadeUp 0.5s ease-out forwards; }
                `}</style>
                <div style={{
                    minHeight: '100vh',
                    background: 'linear-gradient(135deg, #faf5ff 0%, #fdf2f8 100%)',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    padding: '32px 16px',
                }}>
                    <div style={{
                        background: 'white',
                        borderRadius: '24px',
                        padding: '56px 48px',
                        maxWidth: '480px',
                        width: '100%',
                        textAlign: 'center',
                        boxShadow: '0 24px 80px rgba(139,92,246,0.14)',
                    }}>
                        <div className="pop-in" style={{ marginBottom: '24px' }}>
                            <div style={{
                                width: '88px', height: '88px',
                                background: 'linear-gradient(135deg, #8b5cf6, #ec4899)',
                                borderRadius: '50%',
                                display: 'flex', alignItems: 'center', justifyContent: 'center',
                                margin: '0 auto',
                            }}>
                                <svg width="44" height="44" fill="none" stroke="white" strokeWidth="2.5" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </div>
                        <h2 className="fade-up" style={{ fontFamily: "'Playfair Display', serif", fontSize: '28px', fontWeight: 700, color: '#111827', marginBottom: '12px', animationDelay: '0.1s', opacity: 0 }}>
                            Order Confirmed!
                        </h2>
                        <p className="fade-up" style={{ color: '#6b7280', marginBottom: '32px', lineHeight: 1.6, animationDelay: '0.2s', opacity: 0 }}>
                            Thank you for your purchase. Your order has been placed successfully and will be processed shortly.
                        </p>
                        <button
                            onClick={() => navigate('/')}
                            style={{
                                background: 'linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%)',
                                color: 'white', border: 'none', borderRadius: '12px',
                                padding: '14px 40px', fontSize: '16px', fontWeight: 600,
                                cursor: 'pointer', width: '100%',
                                boxShadow: '0 8px 24px rgba(139,92,246,0.3)',
                                transition: 'transform 0.2s, box-shadow 0.2s',
                            }}
                            onMouseEnter={e => { e.currentTarget.style.transform = 'translateY(-2px)'; e.currentTarget.style.boxShadow = '0 14px 32px rgba(139,92,246,0.4)'; }}
                            onMouseLeave={e => { e.currentTarget.style.transform = 'translateY(0)'; e.currentTarget.style.boxShadow = '0 8px 24px rgba(139,92,246,0.3)'; }}
                        >
                            Continue Shopping
                        </button>
                    </div>
                </div>
            </>
        );
    }

    return (
        <>
            <style>{`
                @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600;700&display=swap');
                * { font-family: 'Poppins', sans-serif; box-sizing: border-box; }
                h1, h2, h3, h4, h5, h6 { font-family: 'Playfair Display', serif; }

                .co-input {
                    width: 100%;
                    padding: 12px 14px;
                    border: 1.5px solid #e5e7eb;
                    border-radius: 10px;
                    font-size: 14px;
                    color: #111827;
                    background: white;
                    outline: none;
                    transition: border-color 0.2s, box-shadow 0.2s;
                    font-family: 'Poppins', sans-serif;
                }
                .co-input:focus {
                    border-color: #8b5cf6;
                    box-shadow: 0 0 0 3px rgba(139,92,246,0.12);
                }
                .co-input::placeholder { color: #9ca3af; }
                .co-input.error {
                    border-color: #ef4444;
                    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.12);
                }
                .error-text {
                    color: #ef4444;
                    font-size: 11px;
                    margin-top: 4px;
                    font-weight: 500;
                    display: block;
                    animation: fadeInUp 0.3s ease-out;
                }

                .co-select {
                    width: 100%;
                    padding: 12px 14px;
                    border: 1.5px solid #e5e7eb;
                    border-radius: 10px;
                    font-size: 14px;
                    color: #111827;
                    background: white;
                    outline: none;
                    appearance: none;
                    -webkit-appearance: none;
                    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
                    background-repeat: no-repeat;
                    background-position: right 12px center;
                    cursor: pointer;
                    transition: border-color 0.2s, box-shadow 0.2s;
                    font-family: 'Poppins', sans-serif;
                }
                .co-select:focus {
                    border-color: #8b5cf6;
                    box-shadow: 0 0 0 3px rgba(139,92,246,0.12);
                }

                .delivery-btn {
                    flex: 1;
                    padding: 12px 16px;
                    border: 1.5px solid #e5e7eb;
                    border-radius: 10px;
                    background: white;
                    font-size: 14px;
                    font-weight: 500;
                    color: #6b7280;
                    cursor: pointer;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: 8px;
                    transition: all 0.2s;
                    font-family: 'Poppins', sans-serif;
                }
                .delivery-btn.active {
                    border-color: #8b5cf6;
                    color: #7c3aed;
                    background: rgba(139,92,246,0.05);
                    font-weight: 600;
                }
                .delivery-btn:hover:not(.active) {
                    border-color: #c4b5fd;
                    background: rgba(139,92,246,0.02);
                }

                .payment-option {
                    width: 100%;
                    padding: 14px 16px;
                    border: 1.5px solid #e5e7eb;
                    border-radius: 10px;
                    background: white;
                    display: flex;
                    align-items: center;
                    gap: 12px;
                    cursor: pointer;
                    transition: all 0.2s;
                    font-family: 'Poppins', sans-serif;
                    text-align: left;
                }
                .payment-option.active {
                    border-color: #8b5cf6;
                    background: rgba(139,92,246,0.04);
                }
                .payment-option:hover:not(.active) { border-color: #c4b5fd; }

                .radio-dot {
                    width: 20px; height: 20px;
                    border-radius: 50%;
                    border: 2px solid #d1d5db;
                    flex-shrink: 0;
                    display: flex; align-items: center; justify-content: center;
                    transition: border-color 0.2s;
                }
                .radio-dot.checked {
                    border-color: #8b5cf6;
                    background: #8b5cf6;
                }
                .radio-dot.checked::after {
                    content: '';
                    width: 8px; height: 8px;
                    border-radius: 50%;
                    background: white;
                }

                .pay-btn {
                    width: 100%;
                    padding: 16px;
                    border: none;
                    border-radius: 12px;
                    background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
                    color: white;
                    font-size: 17px;
                    font-weight: 700;
                    cursor: pointer;
                    display: flex; align-items: center; justify-content: center; gap: 10px;
                    box-shadow: 0 8px 24px rgba(139,92,246,0.3);
                    transition: transform 0.2s, box-shadow 0.2s;
                    font-family: 'Poppins', sans-serif;
                }
                .pay-btn:hover:not(:disabled) {
                    transform: translateY(-2px);
                    box-shadow: 0 14px 36px rgba(139,92,246,0.4);
                }
                .pay-btn:disabled { opacity: 0.8; cursor: not-allowed; }

                @keyframes spin { 0%{transform:rotate(0deg);} 100%{transform:rotate(360deg);} }
                .loader {
                    width: 20px; height: 20px;
                    border: 3px solid rgba(255,255,255,0.4);
                    border-top-color: white;
                    border-radius: 50%;
                    animation: spin 0.8s linear infinite;
                }

                @keyframes fadeInUp {
                    from { opacity: 0; transform: translateY(20px); }
                    to { opacity: 1; transform: translateY(0); }
                }
                .fade-in-up { animation: fadeInUp 0.5s ease-out forwards; }

                .section-card {
                    background: white;
                    border-radius: 16px;
                    padding: 24px;
                    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
                    margin-bottom: 20px;
                }

                .section-title {
                    font-size: 20px;
                    font-weight: 700;
                    color: #111827;
                    margin: 0 0 20px;
                    font-family: 'Playfair Display', serif;
                }

                .order-item {
                    display: flex;
                    align-items: center;
                    gap: 14px;
                    padding: 12px 0;
                    border-bottom: 1px solid #f3f4f6;
                }
                .order-item:last-child { border-bottom: none; }

                .checkout-logo {
                    font-family: 'Playfair Display', serif;
                    font-size: 26px;
                    font-weight: 700;
                    color: #111827;
                    letter-spacing: -0.5px;
                    display: flex;
                    align-items: center;
                    gap: 6px;
                    cursor: pointer;
                    text-decoration: none;
                }

                .back-link {
                    display: inline-flex;
                    align-items: center;
                    gap: 6px;
                    color: #7c3aed;
                    font-size: 14px;
                    font-weight: 500;
                    cursor: pointer;
                    border: none;
                    background: none;
                    padding: 0;
                    margin-bottom: 24px;
                    transition: gap 0.2s;
                    font-family: 'Poppins', sans-serif;
                }
                .back-link:hover { gap: 10px; }

                .discount-row {
                    display: flex;
                    gap: 10px;
                }
                .discount-apply-btn {
                    padding: 12px 22px;
                    border: 1.5px solid #e5e7eb;
                    border-radius: 10px;
                    background: white;
                    font-size: 14px;
                    font-weight: 600;
                    color: #374151;
                    cursor: pointer;
                    white-space: nowrap;
                    transition: all 0.2s;
                    font-family: 'Poppins', sans-serif;
                }
                .discount-apply-btn:hover {
                    border-color: #8b5cf6;
                    color: #7c3aed;
                    background: rgba(139,92,246,0.04);
                }

                .info-note {
                    font-size: 13px;
                    color: #6b7280;
                    background: #f9fafb;
                    border-radius: 8px;
                    padding: 10px 14px;
                    margin-top: 10px;
                    line-height: 1.5;
                }

                .billing-option {
                    width: 100%;
                    padding: 12px 16px;
                    border: 1.5px solid #e5e7eb;
                    border-radius: 10px;
                    background: white;
                    display: flex;
                    align-items: center;
                    gap: 12px;
                    cursor: pointer;
                    transition: all 0.2s;
                    font-family: 'Poppins', sans-serif;
                    text-align: left;
                    margin-bottom: 8px;
                    font-size: 14px;
                    font-weight: 500;
                    color: #374151;
                }
                .billing-option.active { border-color: #8b5cf6; background: rgba(139,92,246,0.04); }
                .billing-option:hover:not(.active) { border-color: #c4b5fd; }

                @media (max-width: 900px) {
                    .checkout-grid { flex-direction: column !important; }
                    .checkout-left { max-width: 100% !important; }
                    .checkout-right { max-width: 100% !important; width: 100% !important; }
                }
            `}</style>

            {/* Top Header */}
            <div style={{
                background: 'white',
                borderBottom: '1px solid #f3f4f6',
                padding: '18px 40px',
                display: 'flex',
                alignItems: 'center',
                justifyContent: 'center',
            }}>
                <span className="checkout-logo" onClick={() => navigate('/')} style={{ display: 'flex', alignItems: 'center', gap: '8px', cursor: 'pointer' }}>
                    <div style={{ position: 'relative' }}>
                        <img
                            src="/images/Logo.png"
                            alt="AuraEdit Logo"
                            style={{ height: '40px', width: '40px', transition: 'all 0.3s ease' }}
                            onMouseOver={(e) => e.currentTarget.style.transform = 'scale(1.1)'}
                            onMouseOut={(e) => e.currentTarget.style.transform = 'scale(1)'}
                        />
                    </div>
                    <span style={{
                        fontSize: '1.5rem',
                        fontWeight: 'bold',
                        fontFamily: "'Playfair Display', serif",
                        letterSpacing: '2px',
                        background: 'linear-gradient(135deg, #d4a574 0%, #8b5cf6 50%, #ec4899 100%)',
                        WebkitBackgroundClip: 'text',
                        WebkitTextFillColor: 'transparent',
                        backgroundClip: 'text',
                        display: 'inline-flex',
                        alignItems: 'baseline'
                    }}>
                        <span className="logo-text text-2xl font-bold hidden sm:inline">
                            AURA EDIT
                        </span>
                    </span>
                </span>
            </div>

            <div style={{
                minHeight: 'calc(100vh - 73px)',
                background: 'linear-gradient(135deg, #fafaf9 0%, #fdf4ff 100%)',
                padding: '32px 20px 60px',
            }}>
                <div className="checkout-grid" style={{
                    display: 'flex',
                    gap: '32px',
                    maxWidth: '1100px',
                    margin: '0 auto',
                    alignItems: 'flex-start',
                }}>
                    {/* ── LEFT COLUMN ── */}
                    <div className="checkout-left fade-in-up" style={{ flex: 1, maxWidth: '620px' }}>
                        <button className="back-link" onClick={() => navigate(-1)}>
                            <svg width="16" height="16" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                            Return to cart
                        </button>

                        <form onSubmit={handlePayNow} noValidate>
                            {/* Contact */}
                            <div className="section-card">
                                <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '16px' }}>
                                    <h3 className="section-title" style={{ margin: 0 }}>Contact</h3>
                                    <a href="#" style={{ color: '#7c3aed', fontSize: '14px', fontWeight: 500, textDecoration: 'none' }}>Sign in</a>
                                </div>
                                <div id="contact-group" data-error={!!errors.contact}>
                                    <input
                                        id="contact-email"
                                        className={`co-input ${errors.contact ? 'error' : ''}`}
                                        type="text"
                                        placeholder="Email or mobile phone number"
                                        value={contact}
                                        onChange={e => {
                                            setContact(e.target.value);
                                            if (errors.contact) setErrors({ ...errors, contact: null });
                                        }}
                                        required
                                    />
                                    {errors.contact && <span className="error-text">{errors.contact}</span>}
                                </div>
                                <label style={{ display: 'flex', alignItems: 'center', gap: '10px', marginTop: '14px', cursor: 'pointer', fontSize: '14px', color: '#374151' }}>
                                    <input
                                        type="checkbox"
                                        checked={emailOffers}
                                        onChange={e => setEmailOffers(e.target.checked)}
                                        style={{ accentColor: '#8b5cf6', width: '16px', height: '16px', cursor: 'pointer' }}
                                    />
                                    Email me with news and offers
                                </label>
                            </div>

                            {/* Delivery */}
                            <div className="section-card">
                                <h3 className="section-title">Delivery</h3>
                                {/* <div style={{ display: 'flex', gap: '10px', marginBottom: '16px' }}>
                                    <button
                                        type="button"
                                        className={`delivery-btn ${deliveryMethod === 'ship' ? 'active' : ''}`}
                                        onClick={() => setDeliveryMethod('ship')}
                                        id="delivery-ship"
                                    >
                                        <svg width="18" height="18" fill="none" stroke="currentColor" strokeWidth="1.8" viewBox="0 0 24 24">
                                            <rect x="1" y="3" width="15" height="13" rx="1" /><path d="M16 8h4l3 6v3h-7V8z" /><circle cx="5.5" cy="18.5" r="2" /><circle cx="18.5" cy="18.5" r="2" />
                                        </svg>
                                        Ship
                                    </button>
                                    <button
                                        type="button"
                                        className={`delivery-btn ${deliveryMethod === 'pickup' ? 'active' : ''}`}
                                        onClick={() => setDeliveryMethod('pickup')}
                                        id="delivery-pickup"
                                    >
                                        <svg width="18" height="18" fill="none" stroke="currentColor" strokeWidth="1.8" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path strokeLinecap="round" strokeLinejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        Pickup
                                    </button>
                                </div> */}

                                <div style={{ display: 'flex', flexDirection: 'column', gap: '12px' }}>
                                    <select id="country" className="co-select" value={country} onChange={e => setCountry(e.target.value)}>
                                        <option>Sri Lanka</option>
                                        <option>India</option>
                                        <option>Maldives</option>
                                        <option>Bangladesh</option>
                                        <option>Pakistan</option>
                                    </select>

                                    <div style={{ display: 'flex', gap: '12px' }}>
                                        <div style={{ flex: 1 }} data-error={!!errors.firstName}>
                                            <input id="first-name" className={`co-input ${errors.firstName ? 'error' : ''}`} type="text" placeholder="First name" value={firstName}
                                                onChange={e => { setFirstName(e.target.value); if (errors.firstName) setErrors({ ...errors, firstName: null }); }} required />
                                            {errors.firstName && <span className="error-text">{errors.firstName}</span>}
                                        </div>
                                        <div style={{ flex: 1 }} data-error={!!errors.lastName}>
                                            <input id="last-name" className={`co-input ${errors.lastName ? 'error' : ''}`} type="text" placeholder="Last name" value={lastName}
                                                onChange={e => { setLastName(e.target.value); if (errors.lastName) setErrors({ ...errors, lastName: null }); }} required />
                                            {errors.lastName && <span className="error-text">{errors.lastName}</span>}
                                        </div>
                                    </div>

                                    <div data-error={!!errors.address}>
                                        <input id="address" className={`co-input ${errors.address ? 'error' : ''}`} type="text" placeholder="Address" value={address}
                                            onChange={e => { setAddress(e.target.value); if (errors.address) setErrors({ ...errors, address: null }); }} required />
                                        {errors.address && <span className="error-text">{errors.address}</span>}
                                    </div>

                                    <div data-error={!!errors.apartment}>
                                        <input id="apartment" className={`co-input ${errors.apartment ? 'error' : ''}`} type="text" placeholder="Apartment, suite, etc." value={apartment}
                                            onChange={e => { setApartment(e.target.value); if (errors.apartment) setErrors({ ...errors, apartment: null }); }} required />
                                        {errors.apartment && <span className="error-text">{errors.apartment}</span>}
                                    </div>

                                    <div style={{ display: 'flex', gap: '12px' }}>
                                        <div style={{ flex: 1 }} data-error={!!errors.city}>
                                            <input id="city" className={`co-input ${errors.city ? 'error' : ''}`} type="text" placeholder="City" value={city}
                                                onChange={e => { setCity(e.target.value); if (errors.city) setErrors({ ...errors, city: null }); }} required />
                                            {errors.city && <span className="error-text">{errors.city}</span>}
                                        </div>
                                        <div style={{ flex: 1 }} data-error={!!errors.postalCode}>
                                            <input id="postal-code" className={`co-input ${errors.postalCode ? 'error' : ''}`} type="text" placeholder="Postal code" value={postalCode}
                                                onChange={e => { setPostalCode(e.target.value); if (errors.postalCode) setErrors({ ...errors, postalCode: null }); }} required />
                                            {errors.postalCode && <span className="error-text">{errors.postalCode}</span>}
                                        </div>
                                    </div>

                                    <div style={{ position: 'relative' }} data-error={!!errors.phone}>
                                        <input id="phone" className={`co-input ${errors.phone ? 'error' : ''}`} type="tel" placeholder="Phone" value={phone}
                                            onChange={e => { setPhone(e.target.value); if (errors.phone) setErrors({ ...errors, phone: null }); }} required style={{ paddingRight: '40px' }} />
                                        <span style={{ position: 'absolute', right: '12px', top: '15px', color: '#9ca3af' }}>
                                            <svg width="16" height="16" fill="none" stroke="currentColor" strokeWidth="1.8" viewBox="0 0 24 24">
                                                <circle cx="12" cy="12" r="10" /><path d="M12 16v-4M12 8h.01" strokeLinecap="round" />
                                            </svg>
                                        </span>
                                        {errors.phone && <span className="error-text">{errors.phone}</span>}
                                    </div>

                                    <label style={{ display: 'flex', alignItems: 'center', gap: '10px', cursor: 'pointer', fontSize: '14px', color: '#374151' }}>
                                        <input
                                            type="checkbox"
                                            checked={saveInfo}
                                            onChange={e => setSaveInfo(e.target.checked)}
                                            style={{ accentColor: '#8b5cf6', width: '16px', height: '16px', cursor: 'pointer' }}
                                        />
                                        Save this information for next time
                                    </label>
                                </div>
                            </div>

                            {/* Shipping Method */}
                            <div className="section-card">
                                <h3 className="section-title">Shipping method</h3>
                                <div style={{
                                    border: '1.5px solid #8b5cf6',
                                    borderRadius: '10px',
                                    padding: '14px 16px',
                                    background: 'rgba(139,92,246,0.04)',
                                    display: 'flex',
                                    alignItems: 'center',
                                    justifyContent: 'space-between',
                                }}>
                                    <div style={{ display: 'flex', alignItems: 'center', gap: '12px' }}>
                                        <div className="radio-dot checked" />
                                        <span style={{ fontSize: '14px', fontWeight: 500, color: '#374151' }}>
                                            {shipping === 0 ? 'Free Shipping' : 'Standard Shipping (3–5 days)'}
                                        </span>
                                    </div>
                                    <span style={{ fontSize: '14px', fontWeight: 700, color: shipping === 0 ? '#059669' : '#111827' }}>
                                        {shipping === 0 ? 'FREE' : `Rs ${shipping}`}
                                    </span>
                                </div>
                                {shipping > 0 && subtotal <= 5000 && (
                                    <p style={{ fontSize: '13px', color: '#6b7280', marginTop: '10px' }}>
                                        🎉 Spend Rs {formatPrice(5000 - subtotal)} more for free shipping!
                                    </p>
                                )}
                            </div>

                            {/* Payment */}
                            <div className="section-card">
                                <h3 className="section-title">Payment</h3>
                                <p style={{ fontSize: '13px', color: '#6b7280', marginTop: '-12px', marginBottom: '16px', display: 'flex', alignItems: 'center', gap: '6px' }}>
                                    <svg width="14" height="14" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" /><path d="M7 11V7a5 5 0 0110 0v4" /></svg>
                                    All transactions are secure and encrypted.
                                </p>

                                <div style={{ display: 'flex', flexDirection: 'column', gap: '8px' }}>
                                    {/* Card payment */}
                                    <button type="button" className={`payment-option ${paymentMethod === 'card' ? 'active' : ''}`} onClick={() => setPaymentMethod('card')} id="pay-card">
                                        <div className={`radio-dot ${paymentMethod === 'card' ? 'checked' : ''}`} />
                                        <span style={{ flex: 1, fontSize: '14px', fontWeight: 500, color: '#374151' }}>Credit / Debit Card</span>
                                        <div style={{ display: 'flex', gap: '6px', alignItems: 'center' }}>
                                            {/* Visa */}
                                            <div style={{ background: '#1a1f71', borderRadius: '4px', padding: '2px 6px', fontSize: '10px', fontWeight: 800, color: 'white', letterSpacing: '0.5px' }}>VISA</div>
                                            {/* Mastercard */}
                                            <div style={{ position: 'relative', width: '28px', height: '18px' }}>
                                                <div style={{ position: 'absolute', left: 0, width: '18px', height: '18px', background: '#EB001B', borderRadius: '50%', opacity: 0.9 }} />
                                                <div style={{ position: 'absolute', right: 0, width: '18px', height: '18px', background: '#F79E1B', borderRadius: '50%', opacity: 0.9 }} />
                                            </div>
                                        </div>
                                    </button>

                                    {paymentMethod === 'card' && (
                                        <div style={{ padding: '16px', background: '#f9fafb', borderRadius: '10px', display: 'flex', flexDirection: 'column', gap: '12px' }}>
                                            <div data-error={!!errors.cardNumber}>
                                                <input id="card-number" className={`co-input ${errors.cardNumber ? 'error' : ''}`} type="text" placeholder="Card number" maxLength={19}
                                                    value={cardNumber}
                                                    onChange={e => {
                                                        const v = e.target.value.replace(/\D/g, '').slice(0, 16);
                                                        setCardNumber(v.replace(/(.{4})/g, '$1 ').trim());
                                                        if (errors.cardNumber) setErrors({ ...errors, cardNumber: null });
                                                    }}
                                                />
                                                {errors.cardNumber && <span className="error-text">{errors.cardNumber}</span>}
                                            </div>

                                            <div data-error={!!errors.cardName}>
                                                <input id="card-name" className={`co-input ${errors.cardName ? 'error' : ''}`} type="text" placeholder="Name on card"
                                                    value={cardName}
                                                    onChange={e => { setCardName(e.target.value); if (errors.cardName) setErrors({ ...errors, cardName: null }); }}
                                                />
                                                {errors.cardName && <span className="error-text">{errors.cardName}</span>}
                                            </div>

                                            <div style={{ display: 'flex', gap: '12px' }}>
                                                <div style={{ flex: 1 }} data-error={!!errors.cardExpiry}>
                                                    <input id="card-expiry" className={`co-input ${errors.cardExpiry ? 'error' : ''}`} type="text" placeholder="MM / YY"
                                                        value={cardExpiry}
                                                        onChange={e => {
                                                            let v = e.target.value.replace(/\D/g, '');
                                                            if (v.length > 2) v = v.slice(0, 2) + ' / ' + v.slice(2, 4);
                                                            setCardExpiry(v);
                                                            if (errors.cardExpiry) setErrors({ ...errors, cardExpiry: null });
                                                        }}
                                                    />
                                                    {errors.cardExpiry && <span className="error-text">{errors.cardExpiry}</span>}
                                                </div>
                                                <div style={{ flex: 1 }} data-error={!!errors.cardCvv}>
                                                    <input id="card-cvv" className={`co-input ${errors.cardCvv ? 'error' : ''}`} type="text" placeholder="CVV" maxLength={4}
                                                        value={cardCvv}
                                                        onChange={e => {
                                                            const v = e.target.value.replace(/\D/g, '').slice(0, 4);
                                                            setCardCvv(v);
                                                            if (errors.cardCvv) setErrors({ ...errors, cardCvv: null });
                                                        }}
                                                    />
                                                    {errors.cardCvv && <span className="error-text">{errors.cardCvv}</span>}
                                                </div>
                                            </div>
                                        </div>
                                    )}

                                    {/* COD */}
                                    <button type="button" className={`payment-option ${paymentMethod === 'cod' ? 'active' : ''}`} onClick={() => setPaymentMethod('cod')} id="pay-cod">
                                        <div className={`radio-dot ${paymentMethod === 'cod' ? 'checked' : ''}`} />
                                        <span style={{ fontSize: '14px', fontWeight: 500, color: '#374151' }}>Cash on Delivery (COD)</span>
                                    </button>

                                    {paymentMethod === 'cod' && (
                                        <div className="info-note">You pay in cash when your package arrives at your doorstep.</div>
                                    )}

                                    {/* Bank Transfer */}
                                    <button type="button" className={`payment-option ${paymentMethod === 'bank' ? 'active' : ''}`} onClick={() => setPaymentMethod('bank')} id="pay-bank">
                                        <div className={`radio-dot ${paymentMethod === 'bank' ? 'checked' : ''}`} />
                                        <span style={{ fontSize: '14px', fontWeight: 500, color: '#374151' }}>Bank Transfer</span>
                                        <svg width="20" height="20" fill="none" stroke="#6b7280" strokeWidth="1.8" viewBox="0 0 24 24">
                                            <path d="M2 7l10-5 10 5M6 10v7M10 10v7M14 10v7M18 10v7M2 17h20M2 21h20" strokeLinecap="round" />
                                        </svg>
                                    </button>

                                    {paymentMethod === 'bank' && (
                                        <div className="info-note">You will receive bank details by email after placing the order. Please make the transfer within 24 hours.</div>
                                    )}
                                </div>
                            </div>

                            {/* Billing Address */}
                            <div className="section-card">
                                <h3 className="section-title">Billing address</h3>
                                <div style={{ display: 'flex', flexDirection: 'column', gap: '8px' }}>
                                    <button type="button" className={`billing-option ${billingAddress === 'same' ? 'active' : ''}`} onClick={() => setBillingAddress('same')} id="billing-same">
                                        <div className={`radio-dot ${billingAddress === 'same' ? 'checked' : ''}`} />
                                        Same as shipping address
                                    </button>
                                    <button type="button" className={`billing-option ${billingAddress === 'different' ? 'active' : ''}`} onClick={() => setBillingAddress('different')} id="billing-diff">
                                        <div className={`radio-dot ${billingAddress === 'different' ? 'checked' : ''}`} />
                                        Use a different billing address
                                    </button>
                                </div>

                                {billingAddress === 'different' && (
                                    <div style={{ marginTop: '16px', display: 'flex', flexDirection: 'column', gap: '12px' }}>
                                        <select className="co-select">
                                            <option>Sri Lanka</option>
                                            <option>India</option>
                                            <option>Maldives</option>
                                        </select>
                                        <div style={{ display: 'flex', gap: '12px' }}>
                                            <div style={{ flex: 1 }} data-error={!!errors.billingFirstName}>
                                                <input className={`co-input ${errors.billingFirstName ? 'error' : ''}`} type="text" placeholder="First name"
                                                    value={billingFirstName} onChange={e => { setBillingFirstName(e.target.value); if (errors.billingFirstName) setErrors({ ...errors, billingFirstName: null }); }} required />
                                                {errors.billingFirstName && <span className="error-text">{errors.billingFirstName}</span>}
                                            </div>
                                            <div style={{ flex: 1 }} data-error={!!errors.billingLastName}>
                                                <input className={`co-input ${errors.billingLastName ? 'error' : ''}`} type="text" placeholder="Last name"
                                                    value={billingLastName} onChange={e => { setBillingLastName(e.target.value); if (errors.billingLastName) setErrors({ ...errors, billingLastName: null }); }} required />
                                                {errors.billingLastName && <span className="error-text">{errors.billingLastName}</span>}
                                            </div>
                                        </div>
                                        <div data-error={!!errors.billingAddress_val}>
                                            <input className={`co-input ${errors.billingAddress_val ? 'error' : ''}`} type="text" placeholder="Address"
                                                value={billingAddress_val} onChange={e => { setBillingAddress_val(e.target.value); if (errors.billingAddress_val) setErrors({ ...errors, billingAddress_val: null }); }} required />
                                            {errors.billingAddress_val && <span className="error-text">{errors.billingAddress_val}</span>}
                                        </div>
                                        <div data-error={!!errors.billingApartment}>
                                            <input className={`co-input ${errors.billingApartment ? 'error' : ''}`} type="text" placeholder="Apartment, suite, etc."
                                                value={billingApartment} onChange={e => { setBillingApartment(e.target.value); if (errors.billingApartment) setErrors({ ...errors, billingApartment: null }); }} required />
                                            {errors.billingApartment && <span className="error-text">{errors.billingApartment}</span>}
                                        </div>
                                        <div style={{ display: 'flex', gap: '12px' }}>
                                            <div style={{ flex: 1 }} data-error={!!errors.billingCity}>
                                                <input className={`co-input ${errors.billingCity ? 'error' : ''}`} type="text" placeholder="City"
                                                    value={billingCity} onChange={e => { setBillingCity(e.target.value); if (errors.billingCity) setErrors({ ...errors, billingCity: null }); }} required />
                                                {errors.billingCity && <span className="error-text">{errors.billingCity}</span>}
                                            </div>
                                            <div style={{ flex: 1 }} data-error={!!errors.billingPostalCode}>
                                                <input className={`co-input ${errors.billingPostalCode ? 'error' : ''}`} type="text" placeholder="Postal code"
                                                    value={billingPostalCode} onChange={e => { setBillingPostalCode(e.target.value); if (errors.billingPostalCode) setErrors({ ...errors, billingPostalCode: null }); }} required />
                                                {errors.billingPostalCode && <span className="error-text">{errors.billingPostalCode}</span>}
                                            </div>
                                        </div>
                                    </div>
                                )}
                            </div>

                            {/* Pay Now Button */}
                            <button type="submit" id="pay-now-btn" className="pay-btn" disabled={isPlacingOrder}>
                                {isPlacingOrder ? (
                                    <>
                                        <div className="loader" />
                                        Processing...
                                    </>
                                ) : (
                                    <>
                                        <svg width="20" height="20" fill="none" stroke="white" strokeWidth="2" viewBox="0 0 24 24">
                                            <rect x="1" y="4" width="22" height="16" rx="2" /><line x1="1" y1="10" x2="23" y2="10" />
                                        </svg>
                                        Pay now
                                    </>
                                )}
                            </button>

                            {/* Footer links */}
                            <div style={{ display: 'flex', gap: '20px', marginTop: '24px', justifyContent: 'center' }}>
                                {['Shipping', 'Privacy policy', 'Terms of service'].map((link) => (
                                    <a key={link} href="#" style={{ color: '#8b5cf6', fontSize: '13px', textDecoration: 'none', fontWeight: 500 }}
                                        onMouseEnter={e => e.currentTarget.style.textDecoration = 'underline'}
                                        onMouseLeave={e => e.currentTarget.style.textDecoration = 'none'}
                                    >{link}</a>
                                ))}
                            </div>
                        </form>
                    </div>

                    {/* ── RIGHT COLUMN – Order Summary ── */}
                    <div className="checkout-right fade-in-up" style={{ width: '100%', maxWidth: '380px', position: 'sticky', top: '24px', animationDelay: '0.15s', opacity: 0 }}>
                        <div className="section-card" style={{ marginBottom: '16px' }}>
                            <h3 className="section-title" style={{ marginBottom: '16px' }}>Order Summary</h3>

                            {/* Items */}
                            <div>
                                {cartItems.length === 0 ? (
                                    <p style={{ color: '#9ca3af', fontSize: '14px', textAlign: 'center', padding: '16px 0' }}>Your cart is empty</p>
                                ) : (
                                    cartItems.map((item) => (
                                        <div key={item.cartItemId} className="order-item">
                                            {/* Item image with badge */}
                                            <div style={{ position: 'relative', flexShrink: 0 }}>
                                                <div style={{
                                                    width: '64px', height: '64px',
                                                    borderRadius: '10px',
                                                    overflow: 'hidden',
                                                    background: '#f3f4f6',
                                                    border: '1.5px solid #e5e7eb',
                                                }}>
                                                    <img
                                                        src={item.image || '/images/placeholder.jpg'}
                                                        alt={item.name}
                                                        style={{ width: '100%', height: '100%', objectFit: 'cover' }}
                                                    />
                                                </div>
                                                <div style={{
                                                    position: 'absolute', top: '-8px', right: '-8px',
                                                    background: '#8b5cf6', color: 'white',
                                                    borderRadius: '50%', width: '20px', height: '20px',
                                                    display: 'flex', alignItems: 'center', justifyContent: 'center',
                                                    fontSize: '11px', fontWeight: 700,
                                                }}>{item.quantity}</div>
                                            </div>
                                            <div style={{ flex: 1, minWidth: 0 }}>
                                                <p style={{ fontSize: '13px', fontWeight: 600, color: '#111827', marginBottom: '2px', lineHeight: 1.4, whiteSpace: 'nowrap', overflow: 'hidden', textOverflow: 'ellipsis' }}>{item.name}</p>
                                                <p style={{ fontSize: '12px', color: '#6b7280' }}>{item.size} · {item.color}</p>
                                                {item.free_delivery && (
                                                    <span style={{
                                                        display: 'inline-flex',
                                                        alignItems: 'center',
                                                        gap: '4px',
                                                        marginTop: '4px',
                                                        padding: '2px 8px',
                                                        background: 'linear-gradient(135deg, #d1fae5, #a7f3d0)',
                                                        border: '1px solid #6ee7b7',
                                                        borderRadius: '99px',
                                                        fontSize: '10px',
                                                        fontWeight: 700,
                                                        color: '#065f46',
                                                        letterSpacing: '0.03em',
                                                    }}>
                                                        <svg width="10" height="10" fill="none" stroke="currentColor" strokeWidth="2.5" viewBox="0 0 24 24">
                                                            <rect x="1" y="3" width="15" height="13" rx="1" /><path d="M16 8h4l3 6v3h-7V8z" /><circle cx="5.5" cy="18.5" r="2" /><circle cx="18.5" cy="18.5" r="2" />
                                                        </svg>
                                                        Free Delivery
                                                    </span>
                                                )}
                                            </div>
                                            <p style={{ fontSize: '14px', fontWeight: 700, color: '#111827', flexShrink: 0 }}>Rs {formatPrice(item.price * item.quantity)}</p>
                                        </div>
                                    ))
                                )}
                            </div>

                            {/* Discount Code */}
                            <div style={{ marginTop: '16px', paddingTop: '16px', borderTop: '1px solid #f3f4f6' }}>
                                <div className="discount-row">
                                    <input
                                        id="discount-code-input"
                                        className="co-input"
                                        type="text"
                                        placeholder="Discount code or gift card"
                                        value={discountCode}
                                        onChange={e => setDiscountCode(e.target.value)}
                                        style={{ flex: 1 }}
                                    />
                                    <button type="button" id="discount-apply-btn" className="discount-apply-btn">Apply</button>
                                </div>
                            </div>
                        </div>

                        {/* Totals */}
                        <div className="section-card">
                            <div style={{ display: 'flex', flexDirection: 'column', gap: '12px' }}>
                                <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
                                    <span style={{ fontSize: '14px', color: '#6b7280' }}>Subtotal</span>
                                    <span style={{ fontSize: '14px', fontWeight: 600, color: '#111827' }}>Rs {formatPrice(subtotal)}</span>
                                </div>
                                <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
                                    <span style={{ fontSize: '14px', color: '#6b7280', display: 'flex', alignItems: 'center', gap: '6px' }}>
                                        Shipping
                                        <span title="Shipping calculated at checkout" style={{ color: '#9ca3af', cursor: 'help' }}>
                                            <svg width="14" height="14" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24">
                                                <circle cx="12" cy="12" r="10" /><path d="M12 8v4M12 16h.01" strokeLinecap="round" />
                                            </svg>
                                        </span>
                                    </span>
                                    <span style={{ fontSize: '14px', fontWeight: 600, color: shipping === 0 ? '#059669' : '#111827' }}>
                                        {shipping === 0 ? 'FREE' : `Rs ${shipping}`}
                                    </span>
                                </div>
                                <div style={{ height: '1px', background: 'linear-gradient(90deg, transparent, rgba(139,92,246,0.25), transparent)' }} />
                                <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
                                    <span style={{ fontSize: '16px', fontWeight: 700, color: '#111827' }}>Total</span>
                                    <div style={{ textAlign: 'right' }}>
                                        <span style={{ fontSize: '11px', color: '#9ca3af', display: 'block' }}>LKR</span>
                                        <span style={{
                                            fontSize: '22px', fontWeight: 800,
                                            background: 'linear-gradient(135deg, #8b5cf6, #ec4899)',
                                            WebkitBackgroundClip: 'text', WebkitTextFillColor: 'transparent',
                                        }}>
                                            Rs {formatPrice(total)}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
};

export default CheckoutPage;
