<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5 mb-4">Bill</h1>
        
        <div class="row">
            <div class="col">
                <p><strong>Customer Email:</strong> {{ $data['customerEmail'] }}</p>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col">
                <h4>Items Purchased</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Purchased Price</th>
                            <th>Tax (%)</th>
                            <th>Tax Payable</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['billItems'] as $item)
                            <tr>
                                <td>{{ $item['product_id'] }}</td>
                                <td>{{ $item['unit_price'] }}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>{{ $item['purchased_price'] }}</td>
                                <td>{{ $item['tax_for_item'] }}</td>
                                <td>{{ $item['tax_payable_for_item'] }}</td>
                                <td>{{ $item['total_price_for_item'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col">
                <h4>Summary</h4>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Total Price Without Tax:</th>
                            <td>{{ $data['totalPriceWithoutTax'] }}</td>
                        </tr>
                        <tr>
                            <th>Total Tax Payable:</th>
                            <td>{{ $data['totalTaxPayable'] }}</td>
                        </tr>
                        <tr>
                            <th>Net Price of Purchased Items:</th>
                            <td>{{ $data['netPrice'] }}</td>
                        </tr>
                        <tr>
                            <th>Rounded Net Price:</th>
                            <td>{{ $data['roundedNetPrice'] }}</td>
                        </tr>
                        <tr>
                            <th>Balance Payable:</th>
                            <td>{{ $data['balancePayable'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col">
                <h4>Denomination Breakdown</h4>
                <ul>
                    @foreach ($data['denominationBreakdown'] as $denomination => $count)
                        <li>{{ $count }} x {{ $denomination }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
