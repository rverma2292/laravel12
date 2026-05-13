@extends('layouts.main')

@section('title', 'Blog Lists')
@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Latest Updates from Punjab</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($posts as $post)
            {{-- The entire card is now one clean link --}}
            <a href="{{ route('posts.show', $post->slug) }}" class="group block bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">

                {{-- Post Image Section --}}
                <div class="aspect-video w-full overflow-hidden bg-gray-200">
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                             alt="{{ $post->title }}">
                    @else
                        {{-- Fixed: Added classes to the placeholder to ensure it fills the space --}}
                        <img src="{{ asset('placeholder/placeholder_1200_630.png') }}"
                             class="w-full h-full object-cover opacity-80"
                             alt="No image available">
                    @endif
                </div>

                <div class="p-5">
                    {{-- Category & Date --}}
                    <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-bold px-2.5 py-1 bg-blue-50 text-blue-600 rounded-lg uppercase tracking-wider">
                        {{ $post->category?->name ?? 'Uncategorized' }}
                    </span>
                        <span class="text-xs text-gray-400">
                        {{ $post->created_at->format('M d, Y') }}
                    </span>
                    </div>

                    {{-- Title - No <a> tag needed here because the parent is an <a> --}}
                    <h2 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-2">
                        {{ $post->title }}
                    </h2>

                    {{-- Content Snippet --}}
                    <p class="text-gray-500 text-sm mt-3 line-clamp-3 leading-relaxed">
                        {{ Str::limit(strip_tags($post->content), 100) }}
                    </p>

                    <div class="mt-5 pt-4 border-t border-gray-50 flex items-center justify-between">
                        <span class="text-sm font-semibold text-blue-600">Read More →</span>

                        {{-- Likes Count --}}
                        <div class="flex items-center gap-1.5 text-gray-500 bg-gray-50 px-2 py-1 rounded-md">
                            <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" />
                            </svg>
                            <span class="text-xs font-medium">{{ $post->likes->count() }}</span>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $posts->links() }}
    </div>
</div>
@endsection
