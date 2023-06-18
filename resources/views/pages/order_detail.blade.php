@extends('master.layout')

@section('title')
    Order Detail
@endsection

@section('content')
<div class="flex flex-col items-center justify-center w-full p-12">
    <div class=" bg-white rounded shadow w-2/4 h-1/2 p-6 border-2 border-lgray">
        <form action="/orderdetail/{{ $order_header->id }}" class="flex flex-col w-full gap-7 p-12">

            <div class="font-semibold text-xl">
                Order Detail
            </div>
            <div class="flex flex-col gap-5">
                <div class="flex flex-col gap-2">
                    <div class="text-secondary text-base">Order ID</div>
                    <div class="text-black text-lg">{{$order_header->id}}</div>
                </div>
                <div class="flex flex-col gap-2">
                    <div class="text-secondary text-base">Order Date</div>
                    <div class="text-black text-lg">{{ date('d/m/Y', strtotime($order_header->order_date)) }}{{ date('H:i:s', strtotime($order_header->order_date)) }}</div>
                </div>
                @foreach ($order_header->order_detail as $od)
                    @if ($loop->first)
                        <div class="flex flex-col gap-2">
                            <div class="text-secondary text-base">Status</div>
                            <div class="w-[90px] py-1 px-4 border-[3px] border-secondary text-secondary font-medium rounded flex items-center justify-center">
                                {{$od->status}}
                            </div>
                        </div>
                        @if (Auth::user()->role == "seller")
                        <div class="flex flex-col gap-2">
                            <div class="text-secondary text-base">Buyer</div>
                            <div class="text-black text-lg">
                                {{$od->order_header->user->username}}
                            </div>
                        </div>
                        @endif
                        @break
                    @endif
                @endforeach



            </div>

            @foreach ($order_header->order_detail as $od)
                <div class="flex gap-5 items-start">
                    <div class="w-[35%] h-52 rounded mb-auto">
                        <img class="w-full h-full object-cover" src="{{ Storage::url("profile/menu/".$od->menu->profile_menu) }}"/>
                    </div>
                    <div class="flex flex-col gap-3 w-[60%]">
                        <div class="flex flex-col gap-2">
                            <div class="text-secondary text-base">Menu Name</div>
                            <div class="text-black text-xl font-medium">{{$od->menu->name}}</div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <div class="text-secondary text-base">Quantity</div>
                            <div class="text-black text-xl font-medium">{{$od->quantity}}</div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <div class="text-secondary text-base">MDelivery Date</div>
                            <div class="text-black text-xl font-medium">{{$od->arrival_date}}</div>
                        </div>



                        @if (Auth::user()->role == "seller")
                            <div class="flex flex-col gap-2">
                                <div class="text-secondary text-base">Status</div>
                                <div class="w-fit py-1 px-4 border-[3px] border-secondary text-secondary font-medium rounded flex items-center justify-center">
                                    {{$od->status}}
                                </div>
                            </div>
                            @if ($od->status == "In Progress")
                            <div class="mt-5 ml-auto flex justify-center">
                                <button class="flex w-full justify-center rounded bg-secondary px-10 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:scale-105 hover:shadow-md transition-all duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary" type="submit" id="updatestatus" name="updatestatus" value="{{$od->arrival_date}}">Update Status</button>
                            </div>
                            @endif
                        @else
                            <div class="mt-5 ml-auto flex justify-center">
                                <button class="flex w-full justify-center rounded bg-secondary px-10 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:scale-105 hover:shadow-md transition-all duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary" type="" id="review" name="review" value="">Review</button>
                            </div>
                        @endif
                    </div>
                </div>
                @if (!$loop->last)
                    <hr class="bg-dgray bg-opacity-80 h-[2px]">
                @endif
            @endforeach

            <div class="flex flex-col gap-2">
                <div class="font-semibold text-xl">
                    Delivery
                </div>

                <div class="font-semibold text-lg text-secondary">
                    Free
                </div>
            </div>

            <div class="font-semibold text-xl">
                Payment
            </div>

            <div class="flex flex-col gap-5">
                <div class="flex flex-col gap-2">
                    <div class="text-secondary text-base">Subtotal</div>
                    <div class="text-black text-lg">Rp{{ number_format($order_header->total_price/1000, 3, '.', ',') }},00</div>
                </div>
                <div class="flex flex-col gap-2">
                    <div class="text-secondary text-base">Delivery Fee</div>
                    <div class="text-black text-lg">Rp0,00</div>
                </div>
                <div class="flex flex-col gap-2">
                    <div class="text-secondary text-base">Total</div>
                    <div class="text-black text-lg">Rp{{ number_format($order_header->total_price/1000, 3, '.', ',') }},00</div>
                </div>
                <div class="flex flex-col gap-2">
                    <div class="text-secondary text-base">Payment Method</div>
                    <div class="text-black text-lg">COD</div>
                </div>
            </div>

            Payment Method
            Cod

            @if (Auth::user()->role == "seller")
            @foreach ($order_header->order_detail as $od)
            @if ($loop->first)
                @if($od->status == "Waiting")
                <div class="mt-5 flex justify-center w-full">
                    <button class="flex w-full justify-center rounded bg-secondary px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:scale-105 hover:shadow-md transition-all duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary"type="submit" id="accept" name="accept" value="accept">Accept Order</button>
                </div>
                @endif
                @break
            @endif
            @endforeach
            @endif

        </form>
    </div>
</div>



@endsection

