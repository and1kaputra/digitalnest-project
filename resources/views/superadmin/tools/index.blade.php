<x-app-layout>
    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tools') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
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

            <div class="flex flex-row justify-between items-center mb-5">
                <h3 class="text-indigo-950 font-bold text-2xl">Tools</h3>
                <a href="{{ route("superadmin.tools.create") }}" class="rounded-full w-fit py-3 px-5 bg-indigo-500 text-white">
                    Add New Tools
                </a>
            </div>
                @forelse ($tools as $tool)
           
                <div class="item-product flex flex-row justify-between items-center w-full">
                    <div class="flex flex-row items-center gap-x-5 w-1/3">
                        <img src='{{ Storage::url($tool->icon) }}' alt="icons" class="rounded-2xl object-cover w-[90px] h-[90px]">
                        <div class="flex flex-col">
                            <h3 class="text-indigo-950 text-xl font-bold">{{ $tool->name }}</h3>
                        </div>
                    </div>
                    <div  class="hidden md:flex flex-col w-1/3">
                        <p class="text-slate-500 text-sm">Date</p>
                        <h3 class="text-indigo-950 text-xl font-bold">{{ $tool->created_at->format("M d, y") }}</h3>
                    </div>
                    <div class="hidden md:flex flex-row items-center gap-x-3 w-1/3">
                        <a href="{{ route('superadmin.tools.edit', $tool) }}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Edit
                        </a>
                        <form action="{{ route('superadmin.tools.destroy', $tool) }}" method="POST">
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
