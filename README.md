# fawaterk-sdk
Fawaterk API Integration made easy.

# How to use?
It's quite simple;

First we need to require the SDK via composer.

`composer require fawaterk/fawaterk-sdk`

Then, in your PHP code, you need to create an object of the class \Fawaterk\Fawaterk then you can call
several methods to set the correct data required by the API.

## what are the required data? how to format them?
We have several required pieces of information for us to create an invoice for you and your customer:

1. vendorKey => for you to have one, you'll need to create an account on https://app.fawaterk.com it's absolutely free!
2. customer => this is some information about the customer that is trying to pay for his order.

- The customer is an array that has 4 keys:

-- name

-- email

-- phone

-- address

3. currency => it is the currency which the invoice is going to be in ( the currency your customer will pay in ).

-- currently we support 3 currencies which are EGP, SAR and EUR. More to be added in the future.

4. cartItems => An array of order items. each item is an array that has 3 keys:

-- name

-- quantity

-- price

5. shipping => a float of the shipping value

6. cartTotal => a float of the total amount of the cart that the customer should pay ( with taxes and shipping applied )

7. redirectUrl => a string of the url that the customer should be redirected to after a successful invoice payment.
---

# Working Example
Below is a fully-working example with actual code.

```
<?php

use \Fawaterk\Fawaterk;
...

// prepare the data in the correct format.
$cartItems = [
    [ 'name' => 'Item 1', 'price' => 5, 'quantity' => 1],
    [ 'name' => 'Item 2', 'price' => 10, 'quantity' => 2]
];
$customer = [
    'name'    => 'John Smith',
    'email'   => 'john.smith@example.com',
    'phone'   => '1234567890',
    'address' => '21st South Park Avenue'
];
$shipping = 2;
$cartTotal = 27;
$redirectUrl = "https://fawaterk.com";
$currency = 'EGP';

$fawaterk = new Fawaterk;

// fill the object with the correct data
$fawaterk->setVendorKey('YOUR_VENDOR_KEY_HERE')
         ->setCartItems($cartItems)
         ->setCustomer($customer)
         ->setShipping($shipping)
         ->setCartTotal($cartTotal)
         ->setRedirectUrl($redirectUrl)
         ->setCurrency($currency);

// send the request and receive the invoice url
$invoiceUrl = $fawaterk->getInvoiceUrl();

// redirect the user to the invoice url
header("Location: {$invoiceUrl}");
```

---

# Upcoming features ( soon )

- More Currencies
- Taxes
