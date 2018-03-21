paypal.Button.render({

    env: 'sandbox', // sandbox | production

    // PayPal Client IDs - replace with your own
    // Create a PayPal app: https://developer.paypal.com/developer/applications/create
    client: {
        //sandbox:    'AVxojh21GaEm-ayxn.nRWNuiTNRuAQul6bCY12b4V9mw48Qk048aW0PP',
        sandbox: 'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
        production: '<insert production client id>'
    },

    /*
     * toohey_christopher-facilitator_api1.yahoo.com
     * ZSBKZ28R8RAN2YMW
     * AVxojh21GaEm-ayxn.nRWNuiTNRuAQul6bCY12b4V9mw48Qk048aW0PP
     *
     * toohey_christopher-buyer@yahoo.com
     * 12345678
     * */


    // Show the buyer a 'Pay Now' button in the checkout flow
    commit: true,

    // payment() is called when the button is clicked
    payment: function (data, actions) {

        // Make a call to the REST api to create the payment
        return actions.payment.create({
            payment: {
                transactions: [
                    {
                        amount: {total: paymentInfo.amount, currency: 'USD'}
                    }
                ]
            }
        });
    },

    // onAuthorize() is called when the buyer approves the payment
    onAuthorize: function (data, actions) {


        // Make a call to the REST api to execute the payment
        return actions.payment.execute().then(function () {
            $.ajax({
                type: "POST",
                url: postUrl,
                dataType: 'json',
                data: paymentInfo,
                success: success,
                fail: failed
            });

        });
    }

}, '#paypal-button-container');

function success() {
    document.getElementById('thankYou').innerHTML = "Thank you for your donation.";
}

function failed() {
    document.getElementById('thankYou').innerHTML = "Oops! Something happened. Please try again.";
}