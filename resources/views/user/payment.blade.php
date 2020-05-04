<!doctype html>
<html lang="{{ app()->getLocale() }}">
@include('partials.successpay')

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Braintree-Demo</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://js.braintreegateway.com/web/dropin/1.8.1/js/dropin.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div id="dropin-container"></div>
                <button id="submit-button">Request payment method</button>
                <input type="hidden" name="flat_id" id="flat_id" value="{{$flat_id}}">
                <input type="hidden" name="promo_id" id="promo_id" value="{{$promo->id}}">
            </div>
        </div>
    </div>
    <script>
        var button = document.querySelector('#submit-button');
        braintree.dropin.create({
            authorization: "{{ \Braintree\ClientToken::generate() }}",
            container: '#dropin-container'
        }, function (createErr, instance) {
            button.addEventListener('click', function () {
                instance.requestPaymentMethod(function (err, payload) {
                    console.log();
                    $.get('{{ route('payment.make', $price)}}', { payload }, function (response) {
                        if (response.success) {
                            $("#exampleModal").modal("show");
                            var flatId = $('#flat_id').val();
                            var promoId = $('#promo_id').val();
                            $.ajax({
                                url: window.location.protocol + '//' + window.location.host + "/api/promo/store",
                                method: "GET",
                                data: {
                                    flat: flatId,
                                    promo: promoId
                                },
                                success: function (data, state) {
                                    console.log(data);
                                setTimeout(function() {
                                    window.location.href = "{{ route('account.index')}}";
                                }, 1500);
                                },
                                error: function (request, state, error) {
                                    console.log(error);
                                }
                            });
                        } else {
                            alert('Payment failed');
                        }
                    }, 'json');
                });
            });
        });
    </script>
</body>

</html>