@extends('master.layout')

@section('title')
    My Orders
@endsection

@section('content')
    <div class="w-[85%] mx-auto py-20 flex flex-col gap-5">
        <div class="title">
            Order History
        </div>
        @foreach ($orderHeader as $oh)
            <a href="/order/{{ $oh->id }}" class="flex flex-col items-center justify-center w-full gap-5">
                <div class=" bg-white rounded shadow w-full h-1/2 p-5 border border-primary border-opacity-50 flex flex-col gap-4">
                    <div class="flex gap-3 items-center text-primary">
                        <div class="text-primary font-normal text-subname">
                            {{ date('j F Y', strtotime($oh->order_date)) }}
                        </div>
                        |
                        <div class="text-primary font-normal text-subname">
                            {{ $oh->id }}
                        </div>
                    </div>

                    <div class="flex justify-between items-center h-full ">
                        @foreach ($oh->order_detail as $od)
                            @if ($loop->first)
                                <div class="w-3/4 h-full flex flex-col gap-2">
                                    <div class="text-heading text-secondary font-semibold">
                                        {{ $od->menu->seller->name }}
                                    </div>
                                    <div class="text-base text-dgray">Preview</div>
                                    <div class="flex w-full items-center gap-2">
                                        <div class="w-16 h-16 rounded">
                                            <img class="w-full h-full object-cover" src="{{ Storage::url("profile/menu/".$od->menu->profile_menu) }}"/>
                                        </div>
                                        <div class="text-heading text-secondary font-medium">
                                            {{$od->menu->name}}
                                        </div>
                                    </div>
                                    <div class="mt-1 text-name text-primary font-normal">+{{ count($oh->order_detail) - 1}} other item</div>
                                </div>
                                @break
                            @endif
                        @endforeach
                        <div class="border-l-2 border-primary border-opacity-20 pl-5">
                            <div class="text-base text-dgray">Total Price</div>
                            <div class="font-semibold text-secondary text-heading">
                                Rp{{ number_format($oh->total_price/1000, 3, '.', ',') }},00
                            </div>
                        </div>
                    </div>
                    <div class="text-right text-primary text-name font-medium">See Detail</div>
                </div>
            </a>
        @endforeach
    </div>
    <script>
        var form = document.getElementById('utility-form');
        var dateInput = document.getElementById('date');
        dateInput.addEventListener('change', function() {
            var selected_date = new Date(this.value);
            form.submit();
        });
    </script>
@endsection