@extends('master.layout')

@section('title')
    {{ $menu->name }}
@endsection

@section('content')
    <div class="py-20 w-[85%] mx-auto">
        <form action="{{ url('/cart/add') }}" method="POST" class="w-full">
            {{ csrf_field() }}
            <input type="hidden" id="menu_id" name="menu_id" value="{{ $menu->id }}"/>
            <div class="flex justify-between w-full">
                <img class="{{ (Auth::user() && Auth::user()->role == 'customer') ? 'w-[25%]' : 'w-[30%]' }} h-fit rounded object-cover" src="{{Storage::url("profile/menu/".$menu->profile_menu)}}"/>
                <div class="{{ (Auth::user() && Auth::user()->role == 'customer') ? 'w-[40%]' : 'w-[65%]' }} flex flex-col items-start gap-5">
                    <div class="text-primary text-name font-medium text-justify">
                        {{ $menu->available_date }}
                        <input type="hidden" id="available_date" name="available_date" value="{{ $menu->available_date }}">
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
                                <span>
                                    {{ number_format((float)$totalRatingSum, 2, '.', '') }}
                                </span>
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
                            <img class="object-cover w-full h-full" src="{{Storage::url("profile/menu/".$menu->profile_menu)}}" alt="Profile Image">
                        </div>
                        <div class="flex flex-col gap-2">
                            <div class="text-primary font-semibold text-xl" id="">
                                {{ $menu->seller->name }}
                            </div>
                            <div class="text-primary font-semibold text-name text-justify flex gap-2 items-center" >
                                <i class="far fa-star"></i>
                                <span>{{ number_format((float)$totalRatingSum, 2, '.', '') }}</span>
                                <span class="font-normal">average rating</span>
                            </div>
                        </div>
                    </div>
    
                    <div class="flex gap-10 w-full" id="">
                        <div class="flex gap-5 items-start w-full" >
                            <i class="mt-6 fa fa-star fa-lg" style="color: orange;"></i>
                            <div class="flex flex-col gap-2 items-start">
                                <div class="font-semibold text-5xl text-secondary">{{ number_format((float)$totalRatingSum, 2, '.', '') }}<sub class="font-light text-sm">/5.0</sub></div>
                                <div class="text-dgray font-medium text-base text-justify">{{$countReview}} rating</span>
                            </div>
                        </div>
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
                                            <img src="{{Storage::url("profile/menu/".$menu->profile_menu)}}" class="object-cover w-full h-full" alt="Profile Image">
                                        </div>
                                        <div>{{ $rw->customer->username }}</div>
                                    </div>
                                    <div>
                                        {{$rw->review_message}}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @if (Auth::user() && Auth::user()->role == "customer")
                    <div class="w-[15%] flex flex-col items-start">
                        <div class="flex flex-col gap-4 bg-white rounded shadow h-auto p-6">
                            <div class="text-lg font-semibold">Add to cart</div>
                            <div class="flex gap-2 items-center border-b-2 border-gray-100 pb-4 w-max">
                                <img class="w-20 h-20 object-cover" src="{{Storage::url("profile/menu/".$menu->profile_menu)}}"/>
                                <div class="">
                                    {{$menu->name}}
                                </div>
    
                            </div>
    
                            <div class="flex items-center justify-center w-full">
                                <button class="border rounded-left bg-transparent" style="color: black; width: 25%; outline: none;" id="decrease">-</button>
                                <input class="border" style="text-align: center; color: black !important; max-width: 40%;" type="number" id="quantity" name="quantity" value="1" onchange="return false">
                                <button class="border rounded-right bg-transparent" style="color: black; width: 25%; outline: none;" id="increase">+</button>
                            </div>
                            <?php
                                $total_price = 0;
                                $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;
                                $total_price = $quantity * $menu->price;
                            ?>
                            <div class="flex justify-between items-center w-full">
                                <label>Subtotal</label>
                                <span id="total_price" value="{{$menu->price}}">Rp{{ number_format($total_price/1000, 3, '.', ',') }},00</span>
                            </div>
                            <div class="">
                                <button type="submit" class="flex w-full justify-center rounded bg-secondary px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:scale-105 hover:shadow-md transition-all duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary" name="action">+ Cart</button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </form>
    </div>
    <script>
        var quantityInput = document.getElementById('quantity');
        var totalPriceElement = document.getElementById('total_price');
        var minusButton = document.getElementById('minusButton');
        var plusButton = document.getElementById('plusButton');
        var price = {{$menu->price}};

        document.getElementById('increase').onclick = function (e){
            e.preventDefault();
            let quantity = parseInt(document.getElementById('quantity').value, 10);
            document.getElementById('quantity').value = quantity + 1;
            return false;
        }

        document.getElementById('decrease').onclick = function (e){
            e.preventDefault();
            let quantity = parseInt(document.getElementById('quantity').value, 10);
            document.getElementById('quantity').value = quantity - 1 < 0 ? 0 : quantity - 1;
            return false;
        }

        function updateTotalPrice() {
            var quantity = parseInt(quantityInput.value);
            var total_price = quantity * price;
            totalPriceElement.innerHTML = total_price;
        }

        quantityInput.addEventListener('change', updateTotalPrice);
    </script>
@endsection
