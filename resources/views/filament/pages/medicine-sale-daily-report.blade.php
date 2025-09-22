<x-filament-panels::page>
    <table class="table-auto w-full text-sm">
        <thead>
            <tr>
                <th class="p-2 text-left">Date</th>
                <th class="p-2 text-left">Total Quantity</th>
                <th class="p-2 text-right">Discount + Foc</th>
                <th class="p-2 text-right"> Amount</th>
                 <th class="p-2 text-right">Total Amount</th>
            </tr>
        </thead>
        <tbody>
            @if(count($this->getDailySales()) > 0)
                @foreach ($this->getDailySales() as $report)
                    @php $disFocArr[] = $report->total_discount_foc; @endphp
                    @php $totalAmountArr[] = $report->total_amount; @endphp
                    <tr class="border-b">
                        <td class="p-2">{{ $report->date }}</td>
                        <td class="p-2">{{ $report->total_quantity }}</td>
                        <td class="p-2" style="text-align: right;">{{ $report->total_discount_foc }}</td>
                        <td class="p-2" style="text-align: right;">{{ number_format($report->total_amount, 0) }} </td>
                        <td class="p-2" style="text-align: right;">{{ number_format(( $report->total_amount - $report->total_discount_foc), 0) }} </td>
                    </tr>
                @endforeach
                <tr>
                    <td class="p-2" colspan="2"></td>
                    <td class="p-2 text-right">{{number_format(array_sum($disFocArr),0)}}</td>
                    <td class="p-2 text-right">{{number_format(array_sum($totalAmountArr),0)}}</td>
                    <td class="p-2 text-right">{{number_format(array_sum($totalAmountArr) - array_sum($disFocArr),0)}}</td>
                </tr>
            @endif
        </tbody>
    </table>
     <div class="mt-4">
        {{ $this->getDailySales()->links() }}
    </div>
</x-filament-panels::page>
