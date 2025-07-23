<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Service Order</title>
    <link rel="icon" href="{{asset('images/logo.png')}}" type="image/png">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            font-weight: bold;
        }
        .section {
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        td {
            padding: 2px 0;
        }

        .total-line {
            font-weight: bold;
        }

        .footer {
            text-align: right;
        }

    </style>
</head>
<body>
    <div style="width:100%;font-size:0.8em">
        <table>
            <tr>
                <td style="text-align: right;max-width:30%">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" widht="60" height="60" >
                </td>
                <td class="header">
                    <div style="font-size:0.9em">ရွှေယမုံအထူးကုဆေးခန်း</div>
                    <div style="font-size:0.8em">အမှတ်(၇)ရပ်ကွက်၊အင်ပု(၄)လမ်းထိပ်</div>
                    <div>လယ်ဝေးမြို့၊ နေပြည်တော်</div>
                    <div>Ph: 09 768335156</div>
                </td>
                 <td style="text-align: left;max-width:30%">
                    <img src="{{ asset('images/pharmacy.png') }}" alt="Logo" widht="40" height="40" >
                </td>
            </tr>
        </table>
        
        <div class="section">
            <table>
                <tr>
                    <td style="padding:8px">Voucher No: {{$order->voucher_no }}</td>
                    <td style="padding:8px">Date: {{ date('d-m-Y',strtotime($order->date)) }}</td>
                </tr>
                <tr>
                    <td style="padding:8px">Customer: {{ $order->patient }}</td>
                    <td style="padding:8px">Payment: Cash</td>
                </tr>
            </table>
        </div>
        <div class="section">
            <table  class="table table-striped">
                <tr>
                    <th style="border-bottom:1px solid #000;border-top:1px solid #000;padding:8px;font-weight:bold;text-align:left">Description</th>
                    <th style="border-bottom:1px solid #000;border-top:1px solid #000;padding:8px;font-weight:bold;text-align:left">Qty</th>
                    <th style="border-bottom:1px solid #000;border-top:1px solid #000;padding:8px;font-weight:bold;text-align:center">Price</th>
                    <th style="border-bottom:1px solid #000;border-top:1px solid #000;padding:8px;font-weight:bold;text-align:center">Amount</th>
                </tr>
                @foreach ($items as $item)
                   @php  $totalArr[] = ($item['quantity'] *  $item['price']); @endphp
                    <tr>
                        <td style="padding:8px;width:50%;max-width:50%;">{{ $type == "medical"? $item->medical->name: $item->service->name}}</td>
                        <td style="padding:8px">{{ $item['quantity'] }}</td>
                        <td style="padding:8px;text-align:right">{{ number_format($item['price']) }}</td>
                        <td style="padding:8px;text-align:right">{{ ($item['quantity'] *  $item['price']) }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        <div class="section">
            <table>
                <tr class="total-line">
                    <td colspan="3" style="border-bottom:1px solid #000;border-top:1px solid #000;padding:8px">Total</td>
                    <td style="border-bottom:1px solid #000;border-top:1px solid #000;padding:8px;text-align:right">{{array_sum($totalArr)}}</td>
                </tr>
                <tr>
                    <td colspan="3" style="padding:8px">Discount</td>
                    <td style="padding:8px;text-align:right">{{$order->discount}}</td>
                </tr>
                <tr>
                    <td colspan="3" style="padding:8px">FOC</td>
                    <td style="padding:8px;text-align:right">{{$order->foc}}</td>
                </tr>
                <tr class="total-line">
                    <td colspan="3" style="border-bottom:1px solid #000;border-top:1px solid #000;padding:8px">Total Amount</td>
                    <td style="border-bottom:1px solid #000;border-top:1px solid #000;padding:8px;text-align:right">{{ (array_sum($totalArr) - ($order->discount + $order->foc))}}</td>
                </tr>
            </table>
        </div>
    </div>
<script>
    window.print();
</script>
</body>
</html>
