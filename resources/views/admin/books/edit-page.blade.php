<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container mx-auto">
                        <form action="{{$book->id}}" method="post">
                            @csrf
                            <div class="grid grid-cols-12 content-center gap-7">
                                <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-6 xl:col-span-6 2xl:col-span-6">
                                    <x-label for="title" value="Title" />
                                    <x-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{$book->title}}" required autofocus />

                                    <x-label for="author" value="Author" />
                                    <x-input id="author" class="block mt-1 w-full" type="text" name="author" value="{{$book->author}}" required autofocus />

                                    <x-label for="released_at" value="Released At" />
                                    <x-input id="title" class="block mt-1 w-full" type="date" name="released_at" value="{{$book->released_at}}" required autofocus />

                                    <x-label for="pages" value="Pages" />
                                    <x-input id="pages" class="block mt-1 w-full" type="number" name="pages" value="{{$book->pages}}" required autofocus />

                                    <x-label for="isbn" value="ISBN" />
                                    <x-input id="isbn" class="block mt-1 w-full" pattern="[0-9]*[-| ][0-9]*[-| ][0-9]*[-| ][0-9]*[-| ][0-9]*" type="text" name="isbn" value="{{$book->isbn}}" required autofocus />

                                    <x-label for="description" value="Description" />
                                    <x-textarea id="description" class="block mt-1 w-full" name="description" value="{{$book->description}}" autofocus rows="10" />
                                </div>
                                <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-6 xl:col-span-6 2xl:col-span-6">
                                    <x-label for="language_code" value="Language Code" />
                                    <x-input id="language_code" class="block mt-1 w-full" type="text" name="language_code" value="{{$book->language_code}}" required autofocus />

                                    <x-label for="name" value="Genre" />
                                    <x-select name="genres[]" multiple required>
                                        @foreach ($genres as $genre)
                                        @if(in_array ($genre->id,array_column($book->genres, 'id')))
                                        <option value="{{$genre->id}}" selected>{{$genre->name}}</option>
                                        @else
                                        <option value="{{$genre->id}}">{{$genre->name}}</option>
                                        @endif
                                        @endforeach
                                    </x-select>

                                    <x-label for="in_stock" value="In Stock" />
                                    <x-input id="in_stock" class="block mt-1 w-full" type="text" name="in_stock" value="{{$book->in_stock}}" required autofocus />
                                </div>

                                <x-button class=""> Edit </x-button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>