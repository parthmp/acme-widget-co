<?php

	namespace App\Classes;

	use App\Interfaces\DeliveryChargeInterface;
	
	class DeliveryCharge implements DeliveryChargeInterface{

		/**
		* Calculate the delivery charge based on the total before delivery charges.
		*
		* @param int $total_before_delivery_charges Basket total in cents.
		* @return int Delivery charge in cents.
		*/
		public function calculate(int $total_before_delivery_charges):int{

			if($total_before_delivery_charges >= 9000){ /* in cents */
				return 0;
			}
			if($total_before_delivery_charges >= 5000){ /* in cents */
				return 295;
			}

			return 495; /* in cents */

		}
		
	}