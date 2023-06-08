<!DOCTYPE html>
<html>
<head>
	<title>Stripe Payment Form</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
    <div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="card">
					<div class="card-header">
						<h2>Stripe Payment Form</h2>
					</div>
					<div class="card-body">
						<form method="POST" action="charge.php">
							<div class="form-group">
								<label for="cardNumber">Card Number:</label>
								<div id="cardNumber" class="form-control"></div>
							</div>
							<div class="form-group">
								<label for="cardExpiry">Expiration Date:</label>
								<div id="cardExpiry" class="form-control"></div>
							</div>
							<div class="form-group">
								<label for="cardCvc">CVC:</label>
								<div id="cardCvc" class="form-control"></div>
							</div>
							<div class="form-group">
								<label for="bidAmount">Bid Amount:</label>
									<input type="text" class="form-control" id="bidAmount" name="bidAmount" value="<?php echo $_GET['bidAmount']; ?>" readonly>
							</div>
							<button type="submit" class="btn btn-primary">Pay Now</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="https://js.stripe.com/v3/"></script>
	<script>
        //please enter your own publish key of stripe
		var stripe = Stripe('pk_test_51N84G1BKJfv0FeeZxzk2odIha2HBdJ09uWDrVNbifaJODaLuKx3yNKZlOtUM48ZivsuOzMmVoxuGBzKNoeKt41Lo00nHU3S8Su'); // Replace with your Stripe public key
		var elements = stripe.elements();
		var cardNumber = elements.create('cardNumber');
		var cardExpiry = elements.create('cardExpiry');
		var cardCvc = elements.create('cardCvc');

		cardNumber.mount('#cardNumber');
		cardExpiry.mount('#cardExpiry');
		cardCvc.mount('#cardCvc');

		var form = document.querySelector('form');
		form.addEventListener('submit', function(event) {
			event.preventDefault();
			stripe.createToken(cardNumber).then(function(result) {
				if (result.error) {
					alert(result.error.message);
				} else {
					var token = result.token.id;
					var bidAmount = document.getElementById('bidAmount').value;
					var xhr = new XMLHttpRequest();
					xhr.open('POST', 'checkout.php', true);
					xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
					xhr.onreadystatechange = function() {
						if (xhr.readyState === 4 && xhr.status === 200) {
							alert(xhr.responseText);
							window.location.href = 'dashboard.php';
						}
					};
					xhr.send('token=' + token + '&bidAmount=' + bidAmount);
				}
			});
		});
	</script>
</body>
</html>
