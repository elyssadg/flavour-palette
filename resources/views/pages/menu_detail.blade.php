@extends('master.layout')

@section('title')
    {{ $menu->name }}
@endsection

@section('content')
    <div class="py-20 w-[85%] mx-auto">
        <div class="flex justify-between w-full">
            <img class="{{ (Auth::user() && Auth::user()->role == 'customer') ? 'w-[25%]' : 'w-[30%]' }} h-fit rounded object-cover" src="{{Storage::url("profile/menu/".$menu->profile_menu)}}"/>
            <div class="{{ (Auth::user() && Auth::user()->role == 'customer') ? 'w-[40%]' : 'w-[65%]' }} flex flex-col items-start gap-5">
                <div class="text-primary text-name font-medium text-justify">
                    {{ $menu->available_date }}
                </div>
                <div class="text-secondary font-semibold text-title">
                    {{ $menu->name }}
                </div>
                <div class="flex items-center gap-5">
                    <div class="flex flex-col gap-2">
                        <div class="text-dgray font-normal text-subname text-justify">Ordered</div>
                        <div class="text-primary font-semibold text-heading">
                            {{ $menu->order_detail->count() }}
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 px-5 border-x-2 border-primary border-opacity-20">
                        <?php $totalRatingSum = 0;
                        $countReview = 0 ?>
                        @foreach ($menu->review as $rw)
                            <?php
                                $totalRatingSum = $totalRatingSum + $rw->rating;
                                $countReview++
                            ?>
                            <?php $totalRatingSum = $totalRatingSum/$countReview?>
                        @endforeach
                        <div class="text-dgray font-normal text-subname text-justify">Rating ({{$countReview}} ratings)</div>
                        <div class="text-primary font-semibold text-heading">
                            @if ($totalRatingSum > 0)
                                <span>{{ number_format((float)$menu->seller->store_rating, 2, '.', '') }}</span>
                            @else
                                <span>No Rating</span>
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="text-dgray font-normal text-subname text-justify">Category</div>
                        <div class="text-primary font-semibold text-heading">
                            @foreach ($menu->menu_category as $mc)
                                @if ($loop->last)
                                    {{ $mc->category->name }}
                                @else
                                    {{ $mc->category->name }},
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="text-secondary font-semibold text-title">
                    Rp{{ number_format($menu->price/1000, 3, '.', ',') }},00
                </div>
                <div class="w-full">
                    <div class="text-dgray font-normal text-subname text-justify">Description</div>
                    <div class="font-normal text-name text-secondary"id="">
                        {{ $menu->description }}
                    </div>
                </div>

                <div class="w-full flex gap-5 py-5 border-y-4 border-primary border-opacity-20">
                    <div class="w-16 h-16 rounded-full overflow-hidden">
                        <img class="object-cover w-full h-full" src="{{Storage::url("profile/user/".$menu->seller->user->profile_picture)}}" alt="Profile Image">
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="text-primary font-semibold text-xl" id="">
                            {{ $menu->seller->name }}
                        </div>
                        <div class="text-primary font-semibold text-name text-justify flex gap-2 items-center" >
                            <i class="far fa-star"></i>
                            @if ($menu->seller->store_rating > 0)
                                <span>{{ number_format((float)$menu->seller->store_rating, 2, '.', '') }}</span>
                                <span class="font-normal">average rating</span>
                            @else
                                <span class="font-normal">No Rating</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="flex gap-10 w-full" id="">
                    <div class="flex gap-5 items-start w-full">
                        @if ($totalRatingSum > 0)
                            <div class="flex flex-col gap-2 items-start">
                                <i class="mt-6 fa fa-star fa-lg" style="color: orange;"></i>
                                <div class="font-semibold text-5xl text-secondary">{{ number_format((float)$totalRatingSum, 2, '.', '') }}<sub class="font-light text-sm">/5.0</sub></div>
                                <div class="text-dgray font-medium text-base text-justify">{{$countReview}} rating</span>
                            </div>
                        @else
                            <div class="font-semibold text-name text-secondary">No Reviews Yet</div>
                        @endif
                    </div>
                    @if ($totalRatingSum > 0)
                        <div class="flex flex-col gap-5 ml-10 w-full">
                            <div class="font-normal text-secondary text-subname">Showing {{ $countReview }} out of 10 reviews</div>
                            @foreach ($menu->review as $rw)
                                <div class="flex flex-col gap-3 items-start border-b-2 border-primary border-opacity-20 pb-5 w-full">
                                    <div class="flex gap-3 items-center">
                                        <i class="fa fa-star fa-lg" style="color: orange;"></i>
                                        <div>
                                            <span class="font-semibold text-heading text-secondary">
                                                {{ $rw->rating }}
                                            </span>
                                            <sub class="font-light text-sm text-dgray">/ 5</sub>
                                        </div>
                                    </div>
                                    <div class="flex gap-3 items-center">
                                        <div class="w-10 h-10 rounded-full overflow-hidden">
                                            <img src="{{Storage::url("profile/user/".$rw->customer->user->profile_picture)}}" class="object-cover w-full h-full" alt="Profile Image">
                                        </div>
                                        <div>{{ $rw->customer->username }}</div>
                                    </div>
                                    <div>
                                        {{$rw->review_message}}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @if (Auth::user() && Auth::user()->role == 'customer')
            <div class="w-[25%] rounded shadow bg-white border border-primary border-opacity-20 h-fit">
                <form action="{{ url('/cart/add') }}" method="POST" class="flex flex-col gap-5 p-5">
                    {{ @csrf_field() }}
                    <input type="hidden" id="available_date" name="available_date" value="{{ $menu->available_date }}">
                    <input type="hidden" id="menu_id" name="menu_id" value="{{ $menu->id }}"/>
                    <input type="hidden" id="quantity-submit" name="quantity" value="1">
                    <div class="text-secondary text-heading font-semibold">Add to Cart</div>
                    <div class="flex gap-2 items-center">
                        <img class="w-10 h-10 object-cover rounded" src="{{ Storage::url("profile/menu/".$menu->profile_menu )}}"/>
                        <div class="text-secondary text-subheading font-medium">
                            {{$menu->name}}
                        </div>
                    </div>
                    <hr class="line">
                    <div class="flex items-center justify-center w-full">
                        <label class="flex items-center justify-center bg-primary text-white rounded-l w-10 h-10" id="decrease">-</label>
                        <input class="w-10 h-10 text-center outline-none border-y border-primary" type="number" id="quantity" value="1" disabled>
                        <label class="flex items-center justify-center bg-primary text-white rounded-r w-10 h-10" id="increase">+</label>
                    </div>
                    <div class="flex justify-between items-center w-full">
                        <label class="text-secondary text-subheading font-medium">Subtotal</label>
                        <span id="total_price" value="{{ $menu->price }}" class="text-secondary text-subheading font-medium">Rp{{ number_format($menu->price/1000, 3, '.', ',') }},00</span>
                    </div>
                    <div class="flex flex-col gap-2 items-center justify-center">
                        <button type="submit" class="w-full btn-primary">+ Cart</button>
                        <div class="flex gap-2 items-center justify-center">
                            @if (Auth::user()->customer->wishlist->where('menu_id', $menu->id)->isNotEmpty())
                                <a href="/wishlist/remove/{{ $menu->id }}" class="flex items-center justify-center gap-2 p-2 rounded hover:bg-primary hover:bg-opacity-10">
                                    <i class="fas fa-heart text-primary"></i>
                                    <p class="text-primary text-subname font-normal">Remove from Wishlist</p>
                                </a>
                            @else
                                <a href="/wishlist/add/{{ $menu->id }}" class="flex items-center justify-center gap-2 p-2 rounded hover:bg-primary hover:bg-opacity-10">
                                    <i class="far fa-heart text-primary"></i>
                                    <p class="text-primary text-subname font-normal">Add to Wishlist</p>
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        @endif
    </div>
    <script>
        var quantityInput = document.getElementById('quantity');
        var quantitySubmit = document.getElementById('quantity-submit');
        var totalPriceElement = document.getElementById('total_price');
        var minusButton = document.getElementById('minusButton');
        var plusButton = document.getElementById('plusButton');
        var price = {{ $menu->price }};

        document.getElementById('increase').onclick = function (e){
            e.preventDefault();
            let quantity = parseInt(quantityInput.value, 10);
            quantityInput.value = quantity + 1;
            quantitySubmit.value = quantityInput.value;
            updateTotalPrice();
            return false;
        }

        document.getElementById('decrease').onclick = function (e){
            e.preventDefault();
            let quantity = parseInt(quantityInput.value, 10);
            quantityInput.value = quantity - 1 <= 0 ? 1 : quantity - 1;
            quantitySubmit.value = quantityInput.value;
            updateTotalPrice();
            return false;
        }

        function updateTotalPrice() {
            var quantity = parseInt(quantityInput.value);
            var totalPrice = quantity * price;
            totalPriceElement.innerHTML = `${totalPrice.toLocaleString("id-ID", {
                                            style: "currency",
                                            currency: "IDR"
                                        })}`;
        }
    </script>
@endsection
