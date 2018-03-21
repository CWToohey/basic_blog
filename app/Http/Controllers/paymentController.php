<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class paymentController extends Controller
{
    public function create(Request $request)
    {
        $data = json_decode(
            '{
  "intent": "sale",
  "redirect_urls":
  {
    "return_url": "https://example.com",
    "cancel_url": "https://example.com"
  },
  "payer":
  {
    "payment_method": "paypal"
  },
  "transactions": [
  {
    "amount":
    {
      "total": "4.00",
      "currency": "USD",
      "details":
      {
        "subtotal": "2.00",
        "shipping": "0.00",
        "tax": "2.00",
        "shipping_discount": "0.00"
      }
    },
    "item_list":
    {
      "items": [
      {
        "quantity": "1",
        "name": "item 1",
        "price": "1",
        "currency": "USD",
        "description": "item 1 description",
        "tax": "1"
      },
      {
        "quantity": "1",
        "name": "item 2",
        "price": "1",
        "currency": "USD",
        "description": "item 2 description",
        "tax": "1"
      }]
    },
    "description": "The payment transaction description.",
    "invoice_number": "merchant invoice",
    "custom": "merchant custom data"
  }]
}'
        );
        file_put_contents("paypal.txt",print_r($data,1));

    }

    public function execute(Request $request)
    {

    }
}
