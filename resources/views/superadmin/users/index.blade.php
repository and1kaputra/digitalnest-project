<x-app-layout>
    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
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
                <h3 class="text-indigo-950 font-bold text-2xl">Users</h3>
            </div>
                @forelse ($users as $user)
                <div class="item-card flex flex-row justify-between items-center w-full">
                    <div class="flex flex-row items-center gap-x-5 w-1/3">
                        <img src='{{ Storage::url($user->avatar) }}' alt="icons" class="rounded-2xl object-cover w-[90px] h-[90px]">
                        <div class="flex flex-col">
                            <h3 class="text-indigo-950 text-xl font-bold">{{ $user->name }}</h3>
                        </div>
                    </div>
                    <div  class="hidden md:flex flex-col w-1/3">
                        <p class="text-slate-500 text-sm">Date</p>
                        <h3 class="text-indigo-950 text-xl font-bold">{{ $user->created_at->format("M d, y") }}</h3>
                    </div>
                    <div class="hidden md:flex flex-row items-center gap-x-3 w-1/3">
                        @if($user->suspanded) 
                            <a href="{{ route('superadmin.users.recovery', $user) }}" class="font-bold py-4 px-6 bg-emerald-500 text-white rounded-full">
                                 Recovery
                            </a>
                        @else
                            <a href="{{ route('superadmin.users.suspend', $user) }}" class="font-bold py-4 px-6 bg-red-500 text-white rounded-full">
                                Suspend
                            </a>
                        @endif
                        <form action="{{ route('superadmin.users.destroy', $user) }}" method="POST">
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
