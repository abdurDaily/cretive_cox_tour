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
        <span>Total Amount Provided by the Company: <b>{{ $totalAdd }}</b> /-</span> <br>
        <span>Total expence : <b>{{ $totalCost }}</b> /-</span> <br> 
        <span>Payment Status : <b style="color: {{ $costStatus < 0 ? 'red' : 'green' }}" >{{ $costStatus  }}  /-</b></span> <br> <br>

    </div>

    
    <table border="1" cellspacing="0" cellpadding="0" style="width:100%; text-align:center; ">
        <tr >
            <th>Sn</th>
            <th>User  Name</th>
            <th>Add Amount</th>
            <th>Cost Amount</th>
            <th>T. Add </th>
            <th>T. Cost </th>
        </tr>

        @foreach ($auth_user_transaction as $key => $auth_transaction)
        <tr>
            <td style="padding: 10px;">{{ ++$key }}</td>
            <td>{{ $auth_transaction->users->name }}</td>
            <td>{{ $auth_transaction->add_amount }} /-</td>
            <td>{{ $auth_transaction->cost_amount }} /-</td>
            <td>{{ $userTotals[$auth_transaction->user_id]['total_add_amount'] }} /-</td>
            <td>{{ $userTotals[$auth_transaction->user_id]['total_cost_amount'] }} /-</td>
        </tr>
        @endforeach
    </table>

    <br>

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
