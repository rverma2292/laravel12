@extends('layouts.main')

@section('title', $post->title)

@section('content')
    <div class="w-full mx-auto py-10 px-4">
        {{-- Navigation / Back Button --}}
        <div class="mb-8">
            <a href="{{ route('posts.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center gap-2 font-medium transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Back to All Posts
            </a>
        </div>

        <article class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            {{-- Hero Image --}}
            <div class="w-full aspect-video bg-gray-100">
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}"
                         class="w-full h-full object-cover"
                         alt="{{ $post->title }}">
                @else
                    <img src="{{ asset('placeholder/placeholder_1200_630.png') }}"
                         class="w-full h-full object-cover opacity-50"
                         alt="No image available">
                @endif
            </div>

            <div class="p-8 md:p-12">
                {{-- Category & Meta --}}
                <div class="flex items-center gap-4 mb-6">
                <span class="px-3 py-1 bg-blue-50 text-blue-600 text-xs font-bold uppercase rounded-full">
                    {{ $post->category?->name ?? 'Uncategorized' }}
                </span>
                    <span class="text-gray-400 text-sm italic">
                    Published on {{ $post->created_at->format('M d, Y') }}
                </span>
                </div>

                {{-- Title --}}
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-8 leading-tight">
                    {{ $post->title }}
                </h1>

                {{-- Post Body --}}
                <div class="prose prose-lg prose-blue max-w-none text-gray-700 leading-relaxed space-y-6">
                    {!! nl2br(e($post->content)) !!}
                </div>

                {{-- Footer / Likes --}}
                <div class="mt-12 pt-8 border-t border-gray-100 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <button id="{{(auth()->id()) ? 'like-btn' : 'guest-like-btn'}}"
                                data-slug="{{ $post->slug }}"
                                class="flex items-center gap-2 px-6 py-3 bg-gray-50 text-gray-500 rounded-2xl hover:bg-red-50 hover:text-red-600 transition active:scale-95 border border-transparent">

                            <svg id="like-icon" class="w-6 h-6 fill-none stroke-current transition-colors"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                            <span id="like-count" class="font-bold text-lg">
                                {{ $post->likes_count ?? $post->likes->count() }}
                            </span>
                        </button>
                    </div>

                    <div class="flex items-center gap-2 text-gray-400">
                        <span class="text-sm">Share this:</span>
                    </div>
                </div>
            </div>
        </article>
    </div>

    {{-- Inline AJAX Script --}}
    <script>
        document.getElementById('like-btn').addEventListener('click', function() {
            const btn = this;
            const slug = btn.getAttribute('data-slug');
            const countSpan = document.getElementById('like-count');
            const icon = document.getElementById('like-icon');

            fetch(`/posts/${slug}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    // Update the number
                    countSpan.innerText = data.count;

                    // Visual Feedback: Turn it red and filled
                    btn.classList.remove('bg-gray-50', 'text-gray-500');
                    btn.classList.add('bg-red-50', 'text-red-600');
                    icon.classList.remove('fill-none');
                    icon.classList.add('fill-current');
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
@endsection
