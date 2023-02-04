<!doctype html>
<html>
<head>
<script src="https://js.stripe.com/v3/"></script>
</head>
<body>
<form id="card-form" method="post" action="thanks.php">
    <table>
        <tbody>
            <tr>
                <th>カード番号</th>
                <td>
                    <label for="card-number"></label>
                    <div id="card-number"></div>
                </td>
            </tr>
            <tr>
                <th>有効期限</th>
                <td>
                    <label for="card-expiry"></label>
                    <div id="card-expiry"></div>
                    <input type="hidden" name="cardExpMonth" data-stripe="exp_month">
                    <input type="hidden" name="cardExpYear" data-stripe="exp_year">
                </td>
            </tr>
            <tr>
                <th>セキュリティコード</th>
                <td>
                    <label for="card-cvc"></label>
                    <div id="card-cvc"></div>
                </td>
            </tr>
        </tbody>
    </table>
    <div id="card-errors"></div>
    <button>支払いをする</button>
</form>
<script>
    var stripe = Stripe('pk_test_51MWpIFJQMznoqScDBNjDogH8lDM0Guf7k2UHjQso19icxIXiC3CPddtS1NfHGwZMKl2UDUBCaR7HV9eobbYSUa7a00u5uHAjoK');
    var elements = stripe.elements();

    //カード番号
    var cardNumber = elements.create('cardNumber');
    cardNumber.mount('#card-number');
    cardNumber.on('change', function (event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    //有効期限
    var cardExpiry = elements.create('cardExpiry');
    cardExpiry.mount('#card-expiry');
    cardExpiry.on('change', function (event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    //セキュリティコード
    var cardCvc = elements.create('cardCvc');
    cardCvc.mount('#card-cvc');
    cardCvc.on('change', function (event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    var form = document.getElementById('card-form');
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        var errorElement = document.getElementById('card-errors');
        if (event.error) {
            errorElement.textContent = event.error.message;
        } else {
            errorElement.textContent = '';
        }

        stripe.createToken(cardNumber).then(function (result) {
            if (result.error) {
                errorElement.textContent = result.error.message;
            } else {
                stripeTokenHandler(result.token);
            }
        });
    });

    function stripeTokenHandler(token) {
        var form = document.getElementById('card-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);
        form.submit();
    }
</script>
</body>
</html>