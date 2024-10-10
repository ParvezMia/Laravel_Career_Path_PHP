@extends('master')
@section('content')
    <main class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">


        <!-- Newsfeed -->
        <section id="newsfeed" class="space-y-6">
            <!-- Barta Card -->
            <article
                class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6 hover:bg-gray-50 transition duration-300">
                <!-- Barta Card Top -->
                <header>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <!-- User Info -->
                            <div class="text-gray-900 flex flex-col min-w-0 flex-1">
                                <span class="font-semibold line-clamp-1">
                                    {{ $post->first_name }} {{ $post->last_name }}
                                </span>
                                <span class="text-sm text-gray-500 line-clamp-1">
                                    {{ '@' . $post->username }}
                                </span>
                            </div>
                            <!-- /User Info -->
                        </div>
                        @if (auth()->user()->uuid == $post->user_post_user_uuid)
                            <!-- Card Action Dropdown -->
                            <div class="flex flex-shrink-0 self-center" x-data="{ open: false }">
                                <div class="relative inline-block text-left">
                                    <div>
                                        <button @click.stop="open = !open" type="button"
                                            class="-m-2 flex items-center rounded-full p-2 text-gray-400 hover:text-gray-600"
                                            id="menu-0-button">
                                            <span class="sr-only">Open options</span>
                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                    <!-- Dropdown menu -->
                                    <div x-show="open" @click.away="open = false"
                                        class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                        tabindex="-1" style="display: none;">
                                        <a href="{{ route('post.edit', ['id' => $post->uuid_post]) }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                                            tabindex="-1" id="user-menu-item-1">Edit</a>
                                        <form id="delete-form-{{ $post->uuid_post }}"
                                            action="{{ route('post.delete', ['id' => $post->uuid_post]) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" @click.stop="confirmDelete('{{ $post->uuid_post }}')"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left"
                                                role="menuitem" tabindex="-1">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /Card Action Dropdown -->
                        @endif
                    </div>
                </header>

                <a href="{{ route('post.show', ['id' => $post->uuid_post]) }}" class="block">
                    <!-- Content -->
                    <div class="py-4 text-gray-700 font-normal">
                        <p>
                            {{ $post->user_post_description }}
                        </p>
                    </div>

                    <!-- Date Created & View Stat -->
                    <div class="flex items-center gap-2 text-gray-500 text-xs my-2">
                        <span class="">
                            {{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}
                        </span>
                        @if ($post->updated_at)
                            <span class="">•</span>
                            <span class="text-xs text-gray-400">(Edited
                                {{ \Carbon\Carbon::parse($post->updated_at)->diffForHumans() }})</span>
                        @endif
                        <span class="">•</span>
                        <span>4,450 views</span>
                    </div>
            </article>
            <div class="flex gap-6 justify-end">
                <a href="{{ route('home') }}"
                    class="-m-2 flex gap-2 text-xs items-center rounded-full px-4 py-2 font-semibold bg-gray-800 hover:bg-black text-white">Back</a>
            </div>
        </section>
        <!-- /Newsfeed -->
    </main>
@endsection
<script>
    function confirmDelete(postId) {
        if (confirm('Are you sure you want to delete this post?')) {
            document.getElementById('delete-form-' + postId).submit();
        }
    }
</script>
