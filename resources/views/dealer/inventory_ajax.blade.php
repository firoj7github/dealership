<div class="container-fluid">
    <div class="row">
        @forelse($inventories as $inventory)

        <div class="col-md-3 mb-4">
            <div class="card h-100 ">
                <div class="card-header">
                    <a title="" href="{{ route('inventory.edit',$inventory->id) }}"><img alt="Local Cars"
                            src="{{ $inventory->image }}" class="card-image" width="100%"></a>
                    @php
                    $title_info_data = substr($inventory->title, 0, 35);

                    $fuel_data = str_replace('Fuel', '', $inventory->fuel);
                    @endphp
                    <a title="" href="{{ route('inventory.edit',$inventory->id) }}">
                        <h3 class="card-title mt-2 mb-2">{{ $title_info_data }}</h3>
                    </a>
                    <h3 style="color: red"> {{ $inventory->price_formate }}
                        <small style="color: black; font-size:13px">$ {{ $inventory->invoice_formate }}/invoice*</small>
                    </h3>
                </div>
                <div class="card-body" style="padding: 0px;margin:0px">
                    <table class="table" style="margin-bottom: 0px">
                        <tr style="height: 20px">
                            <td>Stock #</td>
                            <td class="text-right">{{$inventory->stock}}</td>
                        </tr>
                        <tr>
                            <td>Miles</td>
                            <td class="text-right">{{$inventory->miles}}</td>
                        </tr>
                        <tr>
                            <td>Leads</td>
                            <td class="text-right">0</td>
                        </tr>
                        <tr>
                            <?php
                                $dato_formate = \Carbon\Carbon::parse($inventory->date_in_stock);
                                $dato_formate = $dato_formate->diffInDays(now())
                              ?>
                            <td>Days on Market</td>
                            {{-- <td><strong style="background-color: red;color:white;padding:5px">{{ $dato_formate->diffForHumans() }}</strong>
                            </td> --}}
                            <td class="text-right"><strong
                                    style="background-color: red;color:white;padding:5px;border-radius:50px">{{  $dato_formate }}</strong>
                            </td>
                        </tr>

                    </table>
                    <hr />
                    <div class="text-center">
                        <p>Posting Options</p>
                        <ul class="social_block text-center">
                            <li class="text-center"><a href="#" title="facebook"><i class="fa-brands fa-facebook"
                                        style="color: #3772d7;"></i></a></li>
                            <li class="text-center"><a href="#" title="youtube"> <i class="fa-brands fa-youtube"
                                        style="color: #cf3726;"></i></a></li>
                            <li class="text-center"><a href="#" title="ebay"><i class="fa-brands fa-ebay"
                                        style="color: #d1109d;"></i></a></li>
                            <li class="text-center"><a href="#"><small>More</small></a></li>

                        </ul>

                    </div>

                </div>
                <div class="card-footer" style="padding: 5px 5px">
                    <a href="{{ route('inventory.edit',$inventory->id)}}"
                        class="btn btn-success btn-small float-right text-white"><i class="fa fa-edit"></i>Edit /
                        View</a>
                </div>
            </div>
        </div>


        @empty
        <div class="card text-center" style="width: 100%;">
            <strong>Heres no data please insert!</strong>
        </div>
        @endforelse
    </div>
</div>

<div class="custom-pagination" style="display: flex; justify-content: flex-end">
    <ul class="pagination">
        @if ($inventories->onFirstPage())
        <li class="page-item disabled"><span class="page-link">Previous</span></li>
        @else
        <li class="page-item"><a class="page-link" href="{{ $inventories->previousPageUrl() }}">Previous</a>
        </li>
        @endif

        @php
        $currentPage = $inventories->currentPage();
        $lastPage = $inventories->lastPage();
        $maxPagesToShow = 5; // Adjust this number to determine how many page links to display
        $startPage = max($currentPage - floor($maxPagesToShow / 2), 1);
        $endPage = min($startPage + $maxPagesToShow - 1, $lastPage);
        @endphp

        @if ($startPage > 1)
        <li class="page-item"><a class="page-link" href="{{ $inventories->url(1) }}">1</a></li>
        @if ($startPage > 2)
        <li class="page-item disabled"><span class="page-link">...</span></li>
        @endif
        @endif

        @for ($page = $startPage; $page <= $endPage; $page++) @if ($page==$currentPage) <li
            class="page-item active"><span class="page-link">{{ $page }}</span></li>
            @else
            <li class="page-item"><a class="page-link" href="{{ $inventories->url($page) }}">{{ $page }}</a></li>
            @endif
            @endfor

            @if ($endPage < $lastPage) @if ($endPage < $lastPage - 1) <li class="page-item disabled"><span
                    class="page-link">...</span></li>
                @endif
                <li class="page-item"><a class="page-link"
                        href="{{ $inventories->url($lastPage) }}">{{ $lastPage }}</a>
                </li>
                @endif

                @if ($inventories->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $inventories->nextPageUrl() }}">Next</a></li>
                @else
                <li class="page-item disabled"><span class="page-link">Next</span></li>
                @endif
    </ul>
</div>
