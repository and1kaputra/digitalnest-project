<x-app-layout>
    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">

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

            <div class="flex flex-row justify-between items-center mb-5">
                <h3 class="text-indigo-950 font-bold text-2xl">Categories</h3>
                <a href="{{ route("superadmin.categories.create") }}" class="rounded-full w-fit py-3 px-5 bg-indigo-500 text-white">
                    Add New Category
                </a>
            </div>
                @forelse ($categories as $category)
                <div class="item-card flex flex-row justify-between items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src='{{ Storage::url($category->icon) }}' alt="icons" class="rounded-2xl object-cover w-[90px] h-[90px]">
                        <div class="flex flex-col">
                            <h3 class="text-indigo-950 text-xl font-bold">{{ $category->name }}</h3>
                        </div>
                    </div>
                    <div  class="hidden md:flex flex-col">
                        <p class="text-slate-500 text-sm">Date</p>
                        <h3 class="text-indigo-950 text-xl font-bold">{{ $category->created_at->format("M d, y") }}</h3>
                    </div>
                    <div class="hidden md:flex flex-row items-center gap-x-3">
                        <a href="{{ route('superadmin.categories.edit', $category) }}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Edit
                        </a>
                        <form action="{{ route('superadmin.categories.destroy', $category) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-bold py-4 px-6 bg-red-700 text-white rounded-full">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                    <p>Belum ada data kategori</p>
                @endforelse



            </div>
        </div>
    </div>
</x-app-layout>
