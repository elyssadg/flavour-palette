@extends('master.layout')

@section('title')
    Manage Orders
@endsection

@section('content')
    <div class="w-[85%] mx-auto py-20 flex flex-col gap-5">
        <div class="title">
            Manage Order
        </div>
        <div class="flex flex-col items-start justify-center gap-5 w-full bg-white rounded shadow p-10 border border-primary border-opacity-50">
            <div class="title text-secondary">
                Orders
            </div>
            <div class="flex justify-between w-full">
                <div class="w-1/2 text-heading font-semibold text-primary ">
                    Order ID
                </div>
                <div class="w-2/12 text-heading font-semibold text-primary">
                    Status
                </div>
                <div class="w-2/12 text-heading font-semibold text-primary">
                    Date
                </div>
                <div class="w-2/12 text-heading font-semibold text-primary">
                    Buyer
                </div>
                <div class="w-2/12 text-heading font-semibold text-primary">
                    Total
                </div>
            </div>
            <div class="flex flex-col gap-5 w-full">
                @foreach ($orders as $o)
                    <a href="/order/{{ $o->order_id }}" class="flex justify-between w-full">
                        <div class="w-1/2">
                            <div class="text-name text-secondary font-medium">
                                {{ $o->order_id }}
                            </div>
                            <div>
                                <div class="text-base text-dgray">Preview</div>
                                <div class="flex w-full items-center gap-2">
                                    <div class="w-16 h-16 rounded">
                                        <img class="w-full h-full object-cover" src="{{ Storage::url("profile/menu/".$o->menu->profile_menu) }}"/>
                                    </div>
                                    <div class="text-base text-black font-medium">
                                        {{ $o->menu->name }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="w-2/12 flex items-center">
                            <div class="w-max py-1 px-2 border border-secondary text-secondary font-medium rounded flex items-center justify-center">
                                {{ $o->status }}
                            </div>
                        </div>

                        <div class="font-medium w-2/12 flex items-center">
                            {{ date('d/m/Y', strtotime($o->arrival_date)) }}
                        </div>

                        <div class="flex gap-3 items-center w-2/12">
                            <div class="w-9 h-9 rounded-full overflow-hidden">
                                <img class="object-cover w-full h-full" src="{{ Storage::url("profile/user/".$o->order_header->customer->user->profile_picture) }}" alt="Profile Image">
                            </div>
                            <div class="font-medium">
                                {{ $o->order_header->customer->username }}
                            </div>
                        </div>
                        <div class="font-semibold w-2/12 flex items-center">
                            Rp{{ number_format($o->order_header->total_price/1000, 3, '.', ',') }},00
                        </div>
                    </a>
                    @if (!$loop->last)
                        <hr class="line">
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection