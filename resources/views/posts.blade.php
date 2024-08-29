<x-layout>
  <x-slot:title> {{ $title }} </x-slot:title>

  <section class="py-12 bg-gray-100">
      <div class="container mx-auto px-4">
        <form action="/search" method="GET" class="flex items-center mb-6 bg-white rounded-lg shadow p-2">
          <input 
              type="text" 
              name="search" 
              placeholder="Search posts..."
              class="flex-grow px-4 py-2 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
              value="{{ request('search') }}"
          >
      
          @if(request('author_id'))
              <input type="hidden" name="author_id" value="{{ request('author_id') }}">
          @endif
      
          @if(request('category_id'))
              <input type="hidden" name="category_id" value="{{ request('category_id') }}">
          @endif
      
          <button 
              type="submit" 
              class="ml-2 flex items-center px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition-colors duration-200"
          >
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 1114-14 7 7 0 01-14 14z"></path>
              </svg>
              Search
          </button>
      </form>
      
      
      
      
      
      

          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
              @foreach ($posts as $post)
                  <article class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                      <a href="/posts/{{ $post['slug'] }}" class="hover:underline">
                          <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $post['title'] }}</h2>
                      </a>
                      <div class="flex justify-between items-center text-sm text-gray-500 mb-4">
                          <div>
                              <p>
                                  <span class="font-semibold text-gray-900">By</span>
                                  <a href="/authors/{{ $post->author->username }}" class="hover:underline font-semibold text-gray-900">{{ $post->author->name }}</a>
                              </p>
                              <p>{{ $post->created_at->diffForHumans() }}</p>
                          </div>
                          <div>
                              <a href="/categories/{{ $post->category->slug }}" class="hover:underline inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $post->category->name }}</a>
                          </div>
                      </div>
                      <p class="text-gray-700 mb-4">{{ Str::limit($post['body'], 100) }}</p>
                      <a href="/posts/{{ $post['slug'] }}" class="text-blue-500 hover:underline">Read more &raquo;</a>
                  </article>
              @endforeach
          </div>
      </div>
  </section>

</x-layout>
