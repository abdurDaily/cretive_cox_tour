<!DOCTYPE html>
<html lang="en">

<head>
    <title>transaction PDF</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: "Poppins", serif;
        }
    </style>
</head>

<body>

    <div class="heading">

        <h4 style="font-size: 20px; text-align:center;">Creative IT Tour' 25 Cost</h4>
        {{-- <span>Total Amount Provided by the Company: <b>{{ $totalAdd }}</b> /-</span> <br>
        <span>Total expence : <b>{{ $totalCost }}</b> /-</span> <br> 
        <span>Payment Status : <b style="color: {{ $costStatus < 0 ? 'red' : 'green' }}" >{{ $costStatus  }}  /-</b></span> <br> <br>
         --}}
    </div>

    <h4>Category wise costs:</h4>
    <table border="1" cellspacing="0" cellpadding="0" style="width:100%; text-align:center;">
        <thead>
            <tr>
                <th style="padding: 10px;">Title</th>
                <th>Total Add Amount</th>
                <th>Total Cost Amount</th>
            </tr>
        </thead>
        <tbody>
            <!-- Static Row for T-Shirt -->
            <tr>
                <td style="padding: 10px;">T-Shirt</td>
                <td>{{ $totalTshirt }} * price = amount</td>
                <td>{{ number_format($totalTshirt * $price = 1, 2) }}</td> <!-- Assuming $price is defined -->
            </tr>
    
            <!-- Dynamic Rows for Transaction Categories -->
            @foreach($transactionSums as $category)
                <tr>
                    <td style="padding: 10px;">{{ $category->transaction_category }}</td>
                    <td>{{ number_format($category->total_add_amount, 2) }}</td>
                    <td>{{ number_format($category->total_cost_amount, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td style="padding: 10px;"><b>Total</b></td>
                <td><b>{{ number_format($transactionSums->sum('total_add_amount') + ($totalTshirt * $price), 2) }}</b></td>
                <td><b>{{ number_format($transactionSums->sum('total_cost_amount') + ($totalTshirt * $price), 2) }}</b></td>
            </tr>
        </tfoot>
    </table>
    <br> <br>


    <h4>Author Total Expence :</h4>
    <table border="1" cellspacing="0" cellpadding="0" style="width:100%; text-align:center; ">
        <tr >
            <th>Sn</th>
            <th>User  Name</th>
            <th>Add Amount</th>
            <th>Cost Amount</th>
            <th>T. Add </th>
            <th>T. Cost </th>
        </tr>

        @foreach ($userTotals as $user_id => $totals)
        @php
            $user = $auth_user_transaction->firstWhere('user_id', $user_id)->users;
        @endphp
        <tr>
            <td style="padding: 10px;">{{ ++$loop->index }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $totals['total_add_amount'] }} /-</td>
            <td>{{ $totals['total_cost_amount'] }} /-</td>
            <td>{{ $totals['total_add_amount'] }} /-</td>
            <td>{{ $totals['total_cost_amount'] }} /-</td>
        </tr>
        @endforeach
    </table>



    <br> <br>
    <h4>Expence Details :</h4>
    <table border="1" cellspacing="0" cellpadding="0" style="width:100%; ">
        <tr>
            <th style="padding: 10px;">Sn.</th>
            <th>user</th>
            <th>date</th>
            <th>category</th>
            <th>add</th>
            <th>expence</th>
        </tr>

        @foreach ($transactions as $key => $transaction)
            <tr align="center">
                <td style="padding: 10px;">{{ ++$key }}</td>
                <td>{{ $transaction->auth_user }}</td>
                <td>
                    {{ $transaction->created_at ? $transaction->created_at->format('d/m/Y') : 'N/A' }} |
                    {{ $transaction->created_at ? $transaction->created_at->format('h:i A') : 'N/A' }}
                </td>
                <td>{{ $transaction->transaction_category }}</td>
                <td>{{ $transaction->add_amount > 0 ? $transaction->add_amount : 0 }} /-</td>
                <td>{{ $transaction->cost_amount > 0 ? $transaction->cost_amount : 0 }} /-</td>
            </tr>
        @endforeach
    </table>

</body>

</html>
