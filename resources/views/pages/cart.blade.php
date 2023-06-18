@extends('master.layout')

@section('title')
    Cart
@endsection

@section('content')
    <div class="w-[85%] mx-auto py-20 flex justify-between">
        <div class="w-[60%] flex flex-col gap-5">
            <div class="w-full text-title text-primary font-semibold">Cart</div>
            <hr class="line">
            <?php $total_price = 0 ?>
            @foreach ($carts as $index => $c)
                <form action="{{ url('/cart/edit') }}" id="cart-edit-form" method="POST" class="w-full gap-5">
                    <input type="hidden" name="cart_id" value="{{ $c->id }}">
                    {{ csrf_field() }}
                    <div class="flex flex-col gap-3">
                        <?php
                            $date = new DateTime($c->available_date);
                            $formattedDate = $date->format('l, d F Y');
                        ?>
                        <div class="text-subheading text-secondary font-semibold">
                            {{ $formattedDate }}
                        </div>
                        <div class="text-subheading text-primary font-semibold">
                            {{ $c->menu->seller->name }}
                        </div>
                        <div class="flex items-start gap-5">
                            <div class="w-1/5 h-auto">
                                <img class="rounded shadow object-cover w-full h-full" src="{{Storage::url("profile/menu/".$c->menu->profile_menu)}}" alt="">
                            </div>

                            <div class=" h-full w-full flex flex-col gap-5 justify-between">
                                <div>
                                    <div class="text-secondary text-subheading font-medium">
                                        {{$c->menu->name}}
                                    </div>
                                    <div class="text-subname text-primary text-opacity-50">
                                        @foreach ($c->menu->menu_category as $mg)
                                            {{$mg->category->name}}
                                        @endforeach
                                    </div>
                                </div>

                                <div class="flex justify-between w-full">
                                    <div class="text-secondary text-subheading font-semibold">
                                        Rp {{ number_format($c->menu->price, 2, ',', '.'); }}
                                    </div>
                                    <input type="number" id="menu-price-{{ $index }}" value="{{ $c->menu->price }}" hidden>
                                    <?php $total_price += ($c->menu->price*$c->quantity) ?>
                                    <div class="flex items-center justify-center gap-3">
                                        <button type="submit" class="" name="action" value="delete"><img src="{{Storage::url("assets/icon/trash.png")}}" class="w-10 h-auto"></button>
                                        <div class="flex items-center justify-center w-full">
                                            <button type="submit" class="flex items-center justify-center bg-primary text-white rounded-l w-10 h-10" id="decrease-{{ $index }}" name="action" value="decrease">-</button>
                                            <input class="w-10 h-10 text-center outline-none border-y border-primary" type="number" id="quantity-{{ $index }}" name="quantity" value="{{ $c->quantity }}" disabled>
                                            <button type="submit" class="flex items-center justify-center bg-primary text-white rounded-r w-10 h-10" id="increase-{{ $index }}" name="action" value="increase">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @if (!$loop->last)
                    <hr class="line">
                @endif
                <script>
                    document.getElementById('increase-{{ $index }}').onclick = function (e){
                        e.preventDefault();
                        let quantity = parseInt(document.getElementById('quantity-{{ $index }}').value, 10);
                        document.getElementById('quantity-{{ $index }}').value = quantity + 1;
                        updateTotalPrice();
                        return false;
                    }

                    document.getElementById('decrease-{{ $index }}').onclick = function (e){
                        e.preventDefault();
                        let quantity = parseInt(document.getElementById('quantity-{{ $index }}').value, 10);
                        document.getElementById('quantity-{{ $index }}').value = quantity - 1 <= 0 ? 1 : quantity - 1;
                        updateTotalPrice();
                        return false;
                    }
                </script>
            @endforeach
        </div>

    <div class="w-[35%] h-fit flex items-start justify-center bg-white border border-primary border-opacity-20">
        <form action="/checkout" method="POST" class="w-full p-10">
            {{ csrf_field() }}
            <div class="flex flex-col gap-5 w-full" >
                <div class="flex justify-between">
                    <label for="total_price" class="text-heading text-secondary font-medium">Total Price</label>
                    <label for="total_price" id="total_price" class="text-heading text-secondary font-semibold">Rp{{ number_format($total_price/1000, 3, '.', ',') }},00</label>
                    <input type="hidden" name="total_price" value="{{ $total_price }}">
                </div>
                <button type="submit" class="w-full btn-primary" name="action">Checkout</button>
            </div>
        </form>
    </div>

    <script>
        var totalPriceElement = document.getElementById('total_price');
        function updateTotalPrice() {
            let totalPrice = 0;
            const total_menu = {{ $carts->count() }};
            for (let i = 0; i < total_menu; i++) {
                totalPrice += document.getElementById('menu-price-' + i).value * document.getElementById('quantity-' + i).value;
            }
            totalPriceElement.innerHTML = `${totalPrice.toLocaleString("id-ID", {
                                            style: "currency",
                                            currency: "IDR"
                                        })}`;
        }
    </script>
@endsection
