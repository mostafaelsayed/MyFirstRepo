<?php

require_once('CafeteriaApp.Backend/Controllers/Order.php');

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\ExecutePayment;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Exception\PayPalConnectionException;

function chargeCustomer($paymentId,$payerId,$paypal,$categoryId,$orderId,$deliveryTimeId,$deliveryPlace,$selectedMethodId,$conn)
{
	// Get payment object by passing paymentId
	$payment = Payment::get($paymentId, $paypal);

	// Execute payment with payer id
	$execution = new PaymentExecution();
	$execution->setPayerId($payerId);

	try
	{
		$sql = "insert into `transaction` values (?,?)";
		$transactionStatment = $conn->prepare($sql);
		$transactionStatment->bind_param("ii",$PaymentId,$PayerId);
		$PaymentId = $paymentId;
		$PayerId = $payerId;
		
		if ($transactionStatment->execute() === true)
		{
			$result = $payment->execute($execution, $paypal); // Execute payment (charge customer here)
			
			if ($result)
			{
				$result=CheckOutOrder($conn,$orderId,$deliveryTimeId,$deliveryPlace,$selectedMethodId);
				if ($result)
				{
					$returnUrl = "http://127.0.0.1/CafeteriaApp.Frontend/Areas/Customer/Category/Views/showing menuitems of a category and customer order.php?categoryId=" . $categoryId;
					$_SESSION['notifications'] = array('order payment' => 'Payment Succeeseded !' );
					header("Location: " . $returnUrl);
				}
				else{
					echo "Error :payment succeeded but order still open !";
				}
			}
			else
			{
				$returnUrl = "http://127.0.0.1/CafeteriaApp.Frontend/Areas/Customer/checkout.php?categoryId=" . $categoryId;
				header("Location: " . $returnUrl);
			}
			
		}
		else
		{
			"error creating transaction : " . $conn->error;
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