@extends('master.layout')

@section('title')
    My Wishlist
@endsection

@section('content')
    <div class="w-[85%] mx-auto py-20 flex flex-col gap-5">
        <div class="title">My Wishlist</div>
        <!-- Menu -->
        <div class="flex flex-wrap gap-y-10 justify-between p-1">
            @foreach ($wishlist as $index => $m)
                <div id="menu-{{ $m->id }}" class="relative w-[30%] h-fit rounded bg-white shadow-md overflow-hidden cursor-pointer">
                    <a href="/menu/{{ $m->id }}">
                        <img class="w-full aspect-square object-cover" src="{{ Storage::url("profile/menu/".$m->profile_menu) }}"/>
                    </a>
                    <div class="flex flex-col gap-5 p-5">
                        <div class="flex justify-between h-auto">
                            <div class="max-w-[65%] h-14 text-secondary font-semibold text-heading">
                                {{ $m->name }}
                            </div>
                            <div>
                                <i class="fa fa-star" style="color: #E39D36"></i>
                                <?php
                                    $total_rating = 0;
                                    $total_review = 0;
                                ?>
                                @foreach ($m->review as $rw)
                                    <?php
                                        $total_rating = $total_rating + $rw->rating;
                                        $total_review++;
                                    ?>
                                @endforeach
                                <?php
                                    if ($total_review < 1) {
                                        ?>
                                        <span class="text-secondary font-normal text-subname">No Rating</span>
                                        <?php
                                    } else {
                                        $total_rating = $total_rating / $total_review;
                                        ?>
                                        <span class="font-semibold">
                                            {{ number_format((float)$total_rating, 2, '.', '') }}
                                        </span>
                                        <sub>/5</sub>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>

                        <div class="flex flex-col h-10">
                            <div id="" class="text-secondary text-opacity-50 text-subname font-normal">
                                By {{ $m->seller->name }}
                            </div>
                            <div class="text-secondary font-medium text-name">
                                @foreach ($m->menu_category as $index => $mc)
                                    {{ $mc->category->name }}
                                    @if (!$loop->last)
                                        |
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <div>
                                <div class="text-secondary text-opacity-50 text-name font-normal">Price</div>
                                <div id="" class="text-secondary text-subheading font-semibold">
                                    Rp{{ number_format($m->price/1000, 3, '.', ',') }},00
                                </div>
                            </div>
                            <div class="pl-2 border-l-2 border-secondary border-opacity-20">
                                <div class="text-secondary text-opacity-50 text-name font-normal">Ordered</div>
                                <div id="" class="text-secondary text-subheading font-semibold">
                                    {{ $m->order_detail->count() }}
                                </div>
                            </div>
                        </div>
                        @if (Auth::user() && Auth::user()->role == 'customer')
                            <div class="ml-auto">
                                <div class="flex gap-2 items-center justify-center">
                                    @if (Auth::user()->customer->wishlist->where('menu_id', $m->id)->isNotEmpty())
                                        <a href="/wishlist/remove/{{ $m->id }}" class="flex items-center justify-center w-12 h-12 rounded hover:bg-primary hover:bg-opacity-10">
                                            <i class="fas fa-heart fa-2x text-primary"></i>
                                        </a>
                                    @else
                                        <a href="/wishlist/add/{{ $m->id }}" class="flex items-center justify-center w-12 h-12 rounded hover:bg-primary hover:bg-opacity-10">
                                            <i class="far fa-heart fa-2x text-primary"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
            @for ($i = 0; $i < 3; $i++)
                    <div class="w-[30%] bg-transparent h-1"></div>
                @endfor
        </div>
    </div>
@endsection
