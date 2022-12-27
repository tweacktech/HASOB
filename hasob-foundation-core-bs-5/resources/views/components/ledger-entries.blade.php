
@if (isset($ledger) && $ledger!=null)
    <table class="table table-hover table-condensed small">
        @if ($ledger->item_count()==0)
        <tr>
            <td class="text-center">No entries in account</td>
        </tr>
        @else
        <tbody>
            <thead>
                <tr>
                    <th width="5%" class="pa-10 text-center">#</th>
                    <th width="10%" class="pa-10 text-center">Date</th>
                    <th width="45%" class="pa-10">Description</th>
                    <th width="10%" class="pa-10 text-center">Type</th>
                    <th width="15%" class="pa-10 text-right">Amount</th>
                    <th width="15%" class="pa-10 text-right">Balance</th>
                </tr>
            </thead>
            @php
                $balance = 0;
            @endphp
            @foreach($ledger->items as $idx=>$item)
            @php
                
                $multiplier = 1;
                if (strtolower($item->entry_type)=="debit"){
                    $multiplier = -1;
                }

                $balance += ($item->entry_amount * $multiplier);

            @endphp
            <tr>
                <td class="pa-5 text-center">{{$idx+1}}</td>
                <td class="pa-5 text-center">
                    {{ $item->created_at->format('d M Y') }}
                </td>
                <td class="pa-5">
                    {{$item->name}}
                    @if (empty($item->description) == false)
                        <br/>
                        {{$item->description}}
                    @endif
                    @if (empty($item->referenced_item_route_name) == false)
                        <br/>
                        <a href="{{$item->referenced_item_route_name}}" class"small">View</a>
                    @endif
                </td>
                <td class="pa-5 text-center">
                    {{ ucwords($item->entry_type) }}
                </td>
                <td class="pa-5 text-right">
                    @if (strtolower($item->entry_type)=="debit")
                    <span style="color:red"> - 
                    @else
                    <span style="color:blue"> + 
                    @endif
                        {{number_format($item->entry_amount,2)}}
                    </span>
                </td>
                <td class="pa-5 text-right">
                    {{number_format($balance,2)}}
                </td>
            </tr>
            @endforeach
        </tbody>
        @endif
    </table>
@endif