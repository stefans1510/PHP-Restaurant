<?php
ob_start();
include_once 'navbar.php';
include_once 'notifications.php';
?>
<!DOCTYPE html>
<html lang="en">

<?php if (isset($_SESSION['id']) && !empty($_SESSION['cart'])) { ?>

    <head>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>

    <body>
        <div class="container py-3 mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-6 mx-auto">
                    <?php notification('card-error') ?>
                    <div id="pay-invoice" class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h2 class="text-center">Credit card payment</h2>
                            </div>
                            <hr>
                            <form action="" method="POST">
                                <div class="form-group text-center">
                                    <ul class="list-inline">
                                        <li class="list-inline-item enabled-card"><i class="fa-brands fa-cc-visa"></i>
                                        <li class="list-inline-item enabled-card"><i class="fa-brands fa-cc-mastercard"></i></li>
                                    </ul>
                                </div>
                                <div class="form-group has-success">
                                    <label for="cc-name" class="control-label">Name on card</label>
                                    <input id="cc-name" name="cc-name" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error" required>
                                    <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                </div>
                                <div class="form-group">
                                    <label for="cc-number" class="control-label">Card number</label>
                                    <input id="cc-number" name="card_number" type="tel" class="form-control cc-number" value="" data-val="true" data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number" autocomplete="cc-number" required>
                                    <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="cc-exp" class="control-label">Expiration date</label>
                                            <input id="cc-exp" name="cc-exp" type="tel" class="form-control cc-exp" pattern="/^(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})$/" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="MM / YY" autocomplete="cc-exp" required>
                                            <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="x_card_code" class="control-label">CVV</label>
                                        <div class="input-group">
                                            <input id="x_card_code" name="x_card_code" type="tel" class="form-control cc-cvc" pattern="[0-9]{3}" data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" autocomplete="off" required>
                                            <div class="input-group-addon">
                                                <span class="fa fa-question-circle fa-lg" data-toggle="popover" data-container="body" data-html="true" data-title="Security Code" data-content="<div class='text-center one-card'>The 3 digit code on the back of the card...</div>" data-trigger="hover"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button id="payment-button" type="submit" name="order" class="btn btn-lg btn-success btn-block" style="background-color: lightseagreen;">
                                        <i class="fa fa-lock fa-lg"></i>&nbsp;
                                        <span id="payment-button-amount">Pay <?= $_SESSION['total_price'] ?></span>
                                        <span id="payment-button-sending" style="display:none;">Sending…</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(function() {
                $('[data-toggle="popover"]').popover()
            })
        </script>
    </body>
<?php
    if (isset($_POST['order'])) {
        $cardNumber = $_POST['card_number'];
        if ($qb->validate_cc($cardNumber)) {
            $qb->create_order();
        } else {
            notification('card-error', 'Unrecognized credit card. Visa or Mastercard only!');
            redirect("card-validation.php");
        }
    }
} else {
    redirect("index.php");
}
?>

</html>