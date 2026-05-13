@extends('layouts.main')

@section('title', 'Premium Course Access')

@section('content')
    <div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
            <div class="flex flex-col md:flex-row">

                {{-- Product Image Section --}}
                <div class="md:w-1/2 bg-gray-100 relative">
                    <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=80"
                         alt="Product Image"
                         class="w-full h-full object-cover min-h-[400px]">
                    <div class="absolute top-4 left-4">
                    <span class="bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-widest">
                        Best Seller
                    </span>
                    </div>
                </div>

                {{-- Product Details Section --}}
                <div class="md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
                    <nav class="mb-4">
                        <span class="text-blue-600 font-semibold text-sm uppercase tracking-wide">Digital Products</span>
                    </nav>

                    <h1 class="text-4xl font-extrabold text-gray-900 mb-4 leading-tight">
                        Advanced Laravel & Magento Integration Guide
                    </h1>

                    <div class="flex items-center mb-6">
                        <div class="flex text-yellow-400">
                            @for($i = 0; $i < 5; $i++)
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        <span class="ml-2 text-gray-500 text-sm">(124 Reviews)</span>
                    </div>

                    <p class="text-gray-600 mb-8 leading-relaxed">
                        Master the art of building scalable e-commerce solutions. This guide covers payment gateways, polymorphic databases, and high-performance PHP optimization.
                    </p>

                    <div class="flex items-baseline mb-8">
                        <span class="text-4xl font-bold text-gray-900">₹499.00</span>
                        <span class="ml-2 text-gray-400 line-through text-lg">₹1,200.00</span>
                    </div>

                    {{-- The Stripe Initiation Form --}}
                    <form action="{{ route('payment.initiate') }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-8 rounded-2xl transition-all transform active:scale-95 shadow-lg shadow-blue-200 flex items-center justify-center gap-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                            Buy Now & Get Access
                        </button>
                    </form>

                    <div class="mt-6 flex items-center justify-center gap-6 text-gray-400 text-xs">
                        <div class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04default 0a12.02 12.02 0 003 9c2.391 1.21 4.619 2.111 6.618 3.056 2-.945 4.227-1.845 6.618-3.056a12.02 12.02 0 003-9 11.963 11.963 0 01-8.618-3.04z"></path></svg>
                            Secure Payment
                        </div>
                        <div class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            Instant Delivery
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
