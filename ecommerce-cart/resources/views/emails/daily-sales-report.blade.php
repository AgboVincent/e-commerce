<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Daily Sales Report</title>
</head>
<body style="font-family: Arial, sans-serif;">
    <h2>Daily Sales Report</h2>

    <p>Hello Admin,</p>

    <p>Here is the summary of products sold today:</p>

    <table cellpadding="8" cellspacing="0" border="1">
        <tr>
            <th align="left">Product</th>
            <th align="left">Quantity Sold</th>
            <th align="left">Total Revenue</th>
        </tr>

        @foreach ($sales as $sale)
            <tr>
                <td>{{ $sale['product'] }}</td>
                <td align="right">{{ $sale['quantity_sold'] }}</td>
                <td align="right">
                    ₦{{ number_format($sale['revenue'], 2) }}
                </td>
            </tr>
        @endforeach
    </table>

    <p>— E-Commerce System</p>
</body>
</html>
