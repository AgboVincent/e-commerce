<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Low Stock Alert</title>
</head>
<body style="font-family: Arial, sans-serif;">
    <h2>Low Stock Notification</h2>

    <p>Hello Admin,</p>

    <p>The following product is running low on stock:</p>

    <table cellpadding="8" cellspacing="0" border="1">
        <tr>
            <th align="left">Product</th>
            <th align="left">Remaining Stock</th>
            <th align="left">Price</th>
        </tr>
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->stock_quantity }}</td>
            <td>₦{{ number_format($product->price, 2) }}</td>
        </tr>
    </table>

    <p>Please consider restocking this product.</p>

    <p>— E-Commerce System</p>
</body>
</html>
