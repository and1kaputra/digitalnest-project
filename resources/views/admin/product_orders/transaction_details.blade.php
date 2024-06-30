<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
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

                @if(Session::has('errorReview'))
                    <p class="py-5 bg-red-500 text-white font-bold">{{ Session::get('errorReview') }}</p>
                @endif
                <div class="item-product flex flex-col gap-y-10">
                    <img src="{{Storage::url($order->product->cover)}}" class="h-auto w-[300px]" alt="">
                    <div>
                        <h3 class="text-xl text-indigo-950 font-bold">{{$order->product->name}}</h3>
                        <p class="text-sm text-slate-500 font-bold">{{$order->product->category->name}}</p>
                        <p class="text-sm text-slate-500 font-bold">{{$order->product->creator->name}}</p>
                    </div>
                    <div class="flex flext-row gap-x-5 items-center">
                        <p class="mb-2">Rp {{number_format($order->total_price)}}</p>
                        @if($order->is_paid == "success")
                            <span class="py-2 px-5 rounded-full bg-green-500 text-white font-bold text-sm">
                                PAID
                            </span>
                        @elseif($order->is_paid == "declined")
                        <span class="py-2 px-5 rounded-full bg-red-500 text-white font-bold text-sm">
                            Declined
                        </span>
                        @else
                            <span class="py-2 px-5 rounded-full bg-orange-500 text-white font-bold text-sm">
                                PENDING
                            </span>
                        @endif

                    </div>
                    <img src="{{Storage::url($order->proof)}}" class="h-auto w-[300px]" alt="">
                    <div class="flex flex-row gap-x-3">
                        @if($order->is_paid == "success")
                            <a href="{{route('creator.product_orders.download', $order)}}" class="py-3 px-5 bg-indigo-500 text-white rounded-xl">
                                Download Product
                            </a>

                                                <button type="submit" class="py-3 px-5 bg-indigo-500 text-white w-fit rounded-xl" onclick="openModal()">
                                                    Rating
                                                </button>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <!-- Modal content goes here -->
            <div class="flex justify-between">
                <h2 class="text-sm text-slate-500 font-bold mb-2">Rate this product</h2>
                <i  class='bx  bx-x' class="text-black"> </i>
            </div>
            <form method="post" action="{{route('creator.review.rating', $order->product)}}">
                @csrf
                <div class="flex justify-center">
                    <div class="rating">
                        <label>
                          <input type="radio" name="stars" value="1"  id="stars"/>
                          <span class="icon">★</span>
                        </label>
                        <label>
                          <input type="radio" name="stars" value="2" id="stars"/>
                          <span class="icon">★</span>
                          <span class="icon">★</span>
                        </label>
                        <label>
                          <input type="radio" name="stars" value="3" id="stars"/>
                          <span class="icon">★</span>
                          <span class="icon">★</span>
                          <span class="icon">★</span>
                        </label>
                        <label>
                          <input type="radio" name="stars" value="4" id="stars"/>
                          <span class="icon">★</span>
                          <span class="icon">★</span>
                          <span class="icon">★</span>
                          <span class="icon">★</span>
                        </label>
                        <label>
                          <input type="radio" name="stars" value="5" id="stars"/>
                          <span class="icon">★</span>
                          <span class="icon">★</span>
                          <span class="icon">★</span>
                          <span class="icon">★</span>
                          <span class="icon">★</span>
                        </label>
                    </div>
                </div>
                <div class="mt-4">
                    <x-input-label for="review" :value="__('Review')" />
                    <textarea name="review" id="review" class="w-full py-3 pl-5 border"></textarea>
                    <x-input-error :messages="$errors->get('review')" class="mt-2" />
                </div>

                <button type="submit" class="py-3 px-5 bg-indigo-500 text-white mt-4 rounded-lg">
                    Submit
                </button>
            </form>
        </div>
    </div>
    @push('after-script')
    <script>

                    var modal = document.getElementById('myModal');

                // Get the close button

                // Function to open the modal
                function openModal() {
                    modal.style.display = 'block';
                }

                // Function to close the modal
                function closeModal() {
                    modal.style.display = 'none';
                }
        window.onload = () => {
        console.log("hello");
        // Close the modal if the close button is clicked
        // closeButton.addEventListener('click', closeModal);
        // Close the modal if the user clicks outside the modal
        window.addEventListener('click', function(event) {
            if (event.target == modal) {
                closeModal();
                console.log('check');
            }
        });

        }
        </script>
    @endpush
</x-app-layout>
