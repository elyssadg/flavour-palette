@extends('master.layout')

@section('title')
    Order Detail
@endsection

@section('content')
    <div class="flex flex-col items-start w-[85%] h-fit mx-auto py-20 gap-5">
        <div class="title">
            Order Detail
        </div>
        <div class="flex flex-col gap-5">
            <div class="flex flex-col gap-2">
                <div class="text-primary text-name font-normal">Order ID</div>
                <div class="text-secondary text-subheading font-medium">{{$orderHeader->id}}</div>
            </div>
            <div class="flex flex-col gap-2">
                <div class="text-primary text-name font-normal">Order Date</div>
                <div class="text-secondary text-subheading font-medium">{{ date('d/m/Y', strtotime($orderHeader->order_date)) }} {{ date('H:i:s', strtotime($orderHeader->order_date)) }}</div>
            </div>
            @if (Auth::user()->role == "seller")
                <div class="flex flex-col gap-2">
                    <div class="text-primary text-name font-normal">Buyer</div>
                    <div class="text-secondary text-subheading font-medium">
                        {{ $orderHeader->customer->username }}
                    </div>
                </div>
            @endif
        </div>

        <hr class="line">

        <div class="flex flex-col gap-5 w-full">
            <div class="title">
                Items
            </div>
            @foreach ($orderHeader->order_detail as $od)
                <div class="flex justify-between gap-5 items-start w-full">
                    <div class="w-[30%] rounded mb-auto">
                        <img class="w-full h-80 object-cover rounded shadow" src="{{ Storage::url("profile/menu/".$od->menu->profile_menu) }}"/>
                    </div>
                    <div class="flex flex-col gap-3 w-[65%]">
                        <div class="flex flex-col gap-2">
                            <div class="text-primary text-name font-normal">Menu Name</div>
                            <div class="text-secondary text-subheading font-medium">{{ $od->menu->name }}</div>
                        </div>
    
                        @if (Auth::user()->role == 'customer')
                            <div class="flex flex-col gap-2">
                                <div class="text-primary text-name font-normal">Seller</div>
                                <div class="text-secondary text-subheading font-medium">{{ $od->menu->seller->name }}</div>
                            </div>
                        @endif
    
                        <div class="flex flex-col gap-2">
                            <div class="text-primary text-name font-normal">Quantity</div>
                            <div class="text-secondary text-subheading font-medium">{{ $od->quantity }}</div>
                        </div>
    
                        <div class="flex flex-col gap-2">
                            <div class="text-primary text-name font-normal">Subtotal</div>
                            <div class="text-secondary text-subheading font-medium">Rp{{ number_format(($od->quantity * $od->menu->price)/1000, 3, '.', ',') }},00</div>
                        </div>
    
                        <div class="flex flex-col gap-2">
                            <div class="text-primary text-name font-normal">Delivery Date</div>
                            <div class="text-secondary text-subheading font-medium">{{ date('d/m/Y', strtotime($od->arrival_date)) }}</div>
                        </div>
    
                        <div class="flex flex-col gap-2">
                            <div class="text-primary text-name font-normal">Status</div>
                            <div class="w-fit py-1 px-4 border border-secondary text-secondary font-medium rounded flex items-center justify-center">
                                {{ $od->status }}
                            </div>
                        </div>
                        
                        <div class="mt-5 ml-auto flex justify-center">
                            <form action="/order/status" method="POST">
                                {{ @csrf_field() }}
                                <input type="hidden" name="order_id" value="{{ $od->order_id }}">
                                <input type="hidden" name="menu_id" value="{{ $od->menu_id }}">
                                <input type="hidden" name="date" value="{{ $od->arrival_date }}">
                                @if (Auth::user()->role == "seller")
                                    @if ($od->status == "Waiting" && $od->seller->name == Auth::user()->seller->name)
                                            <button class="btn-primary" type="submit" id="accept" name="accept" value="true">Accept Order</button>
                                    @elseif ($od->status == "In Progress" && $od->seller->name == Auth::user()->seller->name)
                                        <button class="btn-primary" type="submit" id="update_status" name="update_status" value="true">Update Status</button>
                                    @endif
                                @elseif ($od->status == "In Delivery")
                                    <button class="btn-primary" type="submit" id="finish" name="finish" value="true">Finish</button>
                                @elseif ($od->status == "Done")
                                    <button class="btn-primary" id="review" name="review"">Review</button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
                @if (!$loop->last)
                    <hr class="line">
                @endif
            @endforeach
        </div>

        <hr class="line">

        <div class="title">
            Delivery
        </div>
        <div class="text-secondary text-subheading font-medium">
            Catering Courier (Included)
        </div>

        <hr class="line">

        <div class="title">
            Payment
        </div>
        <div class="flex flex-col gap-5">
            <div class="flex flex-col gap-2">
                <div class="text-primary text-name font-normal">Total</div>
                <div class="text-secondary text-subheading font-medium">Rp{{ number_format($orderHeader->total_price/1000, 3, '.', ',') }},00</div>
            </div>
            <div class="flex flex-col gap-2">
                <div class="text-primary text-name font-normal">Payment Method</div>
                <div class="text-secondary text-subheading font-medium">COD</div>
            </div>
        </div>
    </div>
@endsection

