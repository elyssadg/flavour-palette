@extends('master.layout')

@section('title')
    Checkout
@endsection

@section('content')
    <div class="w-[85%] mx-auto py-20">
        <form action="/order/create" method="POST">
            <div class="bg-primary flex flex-col px-5 py-3 rounded">
                <label class="text-white font-medium">Location</label>
                <div class="flex items-center gap-2">
                    <img src="{{ Storage::url("assets/icon/location.png") }}" style="width: 20px">
                    <input class="w-full outline-none border-0 bg-transparent text-white text-subheading font-medium placeholder:text-white placeholder:font-normal" type="text" name="address" id="address" placeholder="Input Your Address">
                </div>
            </div>

            <div class="mt-10 w-full flex justify-between">
                <div class="w-[60%] flex flex-col gap-5">
                    <?php $total_price = 0 ?>
                    @foreach ($carts as $index => $c)
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
                                    <img class="rounded shadow object-cover w-full aspect-square" src="{{Storage::url("profile/menu/".$c->menu->profile_menu)}}" alt="">
                                </div>

                                <div class=" h-full w-full flex flex-col gap-5 justify-between">
                                    <div>
                                        <div class="text-secondary text-subheading font-medium">
                                            {{$c->menu->name}}
                                        </div>
                                        <div class="text-name text-primary">
                                            {{ $c->quantity }} pax
                                        </div>
                                    </div>

                                    <div class="text-secondary text-subheading font-semibold">
                                        Rp {{ number_format($c->menu->price, 2, ',', '.'); }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (!$loop->last)
                            <hr class="line">
                        @endif
                    @endforeach
                </div>
                <div class="w-[35%] h-fit flex items-start justify-center rounded bg-white border border-primary border-opacity-20">
                    {{ @csrf_field() }}
                    <div class="flex flex-col gap-5 w-full p-10" >
                        <div class="flex justify-between">
                            <label for="total_price" class="text-heading text-secondary font-medium">Total Price</label>
                            <label for="total_price" id="total_price" class="text-heading text-secondary font-semibold">Rp{{ number_format($totalPrice/1000, 3, '.', ',') }},00</label>
                            <input type="hidden" name="total_price" value="{{ $totalPrice }}">
                        </div>
                        <button type="submit" class="w-full btn-primary">Pay</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
