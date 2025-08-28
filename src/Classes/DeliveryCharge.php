<?php

	namespace App\Classes;

	use App\Interfaces\DeliveryChargeInterface;

	class DeliveryCharge implements DeliveryChargeInterface{

		public function calculate(float $total_before_delivery_charges):float{

			
			return 0;

		}
		
	}