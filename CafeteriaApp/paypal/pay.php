<?php

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\ExecutePayment;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Exception\PayPalConnectionException;


//var_dump(12);

function chargeCustomer($paymentId, $payerId, $paypal, $orderId, $deliveryTimeId, $selectedMethodId, $conn)
{
	
	// Get payment object by passing paymentId
	$payment = Payment::get($paymentId, $paypal);

	// Execute payment with payer id
	$execution = new PaymentExecution();
	$execution->setPayerId($payerId);

	try
	{
		//var_dump($_SERVER);
		// var_dump(12);
		$sql = "insert into `transaction` (UserId, PaymentId, PayerId) values (?,?,?)";
		$transactionStatment = $conn->prepare($sql);
		$transactionStatment->bind_param("iss", $UserId, $PaymentId, $PayerId);
		$UserId = $_SESSION["userId"];
		$PaymentId = $paymentId;
		$PayerId = $payerId;
		
		if ($transactionStatment->execute() === true)
		{
			//var_dump(12);
			$result = $payment->execute($execution, $paypal); // Execute payment (charge customer here)
			
			if ($result)
			{
				$result = CheckOutOrder($conn, $orderId, $deliveryTimeId, $selectedMethodId);
				if ($result)
				{
					$returnUrl = "http://127.0.0.1/CafeteriaApp/CafeteriaApp/CafeteriaApp.Frontend/Areas/Public/Cafeteria/Views/showing cafeterias.php";
					$_SESSION['notifications'][] = 'Payment Succeeseded !';
					header("Location: " . $returnUrl);
				}
				else
				{
					echo "Error :payment succeeded but order still open !";
				}
			}
			else
			{
				$returnUrl = "http://127.0.0.1/CafeteriaApp/CafeteriaApp/CafeteriaApp.Frontend/Areas/Customer/checkout.php";
				header("Location: " . $returnUrl);
			}
			
		}
		else
		{
			
			echo "error creating transaction : ", $conn->error;
		}
 
	}

	catch (PayPalConnectionException $ex)
	{
	  echo $ex->getCode();
	  echo $ex->getData();
	  die($ex);
	}

}

?>