<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm p-10 sm:rounded-lg">

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li class="py-5 bg-red-500 text-white font-bold">
                                    {{$error}}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('creator.products.store') }}" enctype="multipart/form-data">
                    @csrf

                    <h1 class="text-indigo-950 text-3xl font-bold">Add New Product</h1>

                    <div class="mt-4">
                        <x-input-label for="cover" :value="__('cover')" />
                        <img id="cover-preview" class="h-[100px] w-auto" style="display: none;">
                        <x-text-input id="cover" class="block mt-1 w-full" type="file" name="cover" required />
                        <x-input-error :messages="$errors->get('cover')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="path_file" :value="__('path_file')" />
                        <x-text-input id="path_file" class="block mt-1 w-full" type="file" name="path_file" required />
                        <x-input-error :messages="$errors->get('path_file')" class="mt-2" />
                    </div>

                    <!-- Name -->
                    <div class="mt-4">
                        <x-input-label for="name" :value="__('name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="price" :value="__('price')" />
                        <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price')" required autofocus autocomplete="price" />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="type" :value="__('type file')" />
                        <x-text-input id="type" class="block mt-1 w-full" type="text" name="type" :value="old('type')" required autofocus autocomplete="type" />
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="category" :value="__('category')" />
                        <select name="category_id" id="category" class="w-full py-3 pl-5 border">
                            <option value="">Select category</option>
                            // perulangan data category dari database
                            @forelse($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @empty
                            @endforelse
                        </select>
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="about" :value="__('about')" />
                        <textarea name="about" id="about" class="w-full py-3 pl-5 border" :value="old('about')" required autofocus autocomplete="about"></textarea>
                        <x-input-error :messages="$errors->get('about')" class="mt-2"  />
                    </div>

                    <div class="flex items-center justify-end mt-4">

                        <x-primary-button class="ms-4">
                            {{ __('Add Product') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('cover').addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file && file.type.startsWith('image/')) {
                document.getElementById('cover-preview').src = URL.createObjectURL(file);
                document.getElementById('cover-preview').style.display = 'block';
            } else {
                alert('Please select a valid image.');
                event.target.value = ''; // Clear the input
                document.getElementById('cover-preview').style.display = 'none';
            }
        });

    </script>
</x-app-layout>
