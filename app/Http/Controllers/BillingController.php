<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Mail\SendBillEmail;
use Illuminate\Http\Request;
use App\Jobs\SendBillEmailJob;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

class BillingController extends Controller
{
    public function generateBill(Request $request){
        $customerEmail = $request->input('email');
        $productIds = $request->input('product_id');
        $quantities = $request->input('qty');

        $products = Products::whereIn('product_id', $productIds)->get();

        $billItems = [];
        $totalPriceWithoutTax = 0;
        $totalTaxPayable = 0;

        foreach ($products as $index => $product) {
            
            $purchasedPrice = $product->price * $quantities[$index];

           
            $taxPayable = ($purchasedPrice * $product->tax_percentage) / 100;

            
            $totalPrice = $purchasedPrice + $taxPayable;

            
            $billItems[] = [
                'product_id' => $product->product_id,
                'unit_price' => $product->price,
                'quantity' => $quantities[$index],
                'purchased_price' => $purchasedPrice,
                'tax_for_item' => $product->tax_percentage,
                'tax_payable_for_item' => $taxPayable,
                'total_price_for_item' => $totalPrice,
            ];

         
            $totalPriceWithoutTax += $purchasedPrice;
            $totalTaxPayable += $taxPayable;
        }

        $netPrice = $totalPriceWithoutTax + $totalTaxPayable;

        $roundedNetPrice = round($netPrice);

        $amountPaid = array_sum($request->except('_token', 'email', 'product_id', 'qty'));
        $balancePayable = $roundedNetPrice - $amountPaid;

        $denominationBreakdown = $this->calculateDenominations($balancePayable);
        
          $data = [
                    'customerEmail' => $customerEmail,
                    'billItems' => $billItems,
                    'totalPriceWithoutTax' => $totalPriceWithoutTax,
                    'totalTaxPayable' => $totalTaxPayable,
                    'netPrice' => $netPrice,
                    'roundedNetPrice' => $roundedNetPrice,
                    'balancePayable' => $balancePayable,
                    'denominationBreakdown' => $denominationBreakdown,
          ];

      
        SendBillEmailJob::dispatch($data);

        // Mail::to($data['customerEmail'])->send(new SendBillEmail($data));

        return view('bill', [
            'customerEmail' => $customerEmail,
            'billItems' => $billItems,
            'totalPriceWithoutTax' => $totalPriceWithoutTax,
            'totalTaxPayable' => $totalTaxPayable,
            'netPrice' => $netPrice,
            'roundedNetPrice' => $roundedNetPrice,
            'balancePayable' => $balancePayable,
            'denominationBreakdown' => $denominationBreakdown,
        ]);
    }


    private function calculateDenominations($balance)
    {
        $denominations = [500, 50, 20, 10, 5, 2,1];
        $denominationBreakdown = [];

        foreach ($denominations as $denomination) {
            $count = intval($balance / $denomination);

            $balance -= $count * $denomination;

            if ($count > 0) {
                $denominationBreakdown[$denomination] = $count;
            }
        }

        return $denominationBreakdown;
    }

}
