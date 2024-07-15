<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg flex flex-col gap-y-5">

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
                    <h3 class="text-indigo-950 font-bold text-2xl">My Orders</h3>
                </div>
                @forelse($my_orders as $order)
                    <div class="item-product flex flex-row justify-between items-center w-full">
                        <div class="flex flex-row items-center gap-x-3 w-1/3">
                            <img src="{{Storage::url($order->product->cover)}}" class="rounded-2xl h-[100px] w-auto" alt="">
                            <div>
                                <h3 class="text-indigo-950 font-bold text-xl">{{$order->product->name}}</h3>
                                <p class="text-slate-500 text-sm">{{$order->product->category->name}}</p>
                            </div>
                        </div>
                        <div>
                            <p class="text-slate-500 text-sm">Total Price:</p>
                            <p class="text-indigo-950 font-bold text-xl">Rp {{number_format($order->total_price)}}</p>
                        </div>
                        <div>
                            <p class="text-slate-500 text-sm mb-2">Status:</p>
                            @if($order->is_paid == "success")
                            <span class="py-2 px-5 rounded-full bg-green-500 text-white font-bold text-sm">
                                PAID
                            </span>
                        @elseif($order->is_paid == "declined")
                        <span class="py-2 px-5 rounded-full bg-red-500 text-white font-bold text-sm">
                            DECLINED
                        </span>
                        @else
                            <span class="py-2 px-5 rounded-full bg-orange-500 text-white font-bold text-sm">
                                PENDING
                            </span>
                        @endif

                        </div>
                        <div class="flex flex-row gap-x-3">
                            <a href="{{route('creator.product_orders.show', $order)}}" class="rounded-full font-bold py-3 px-5 bg-indigo-500 text-white">
                                View Details
                            </a>

                        </div>
                    </div>
                @empty
                <p>You haven't made a purchase</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
