<?php

	namespace App\Classes;

	use App\Interfaces\DeliveryChargeInterface;

	class DeliveryCharge implements DeliveryChargeInterface{

		public function calculate(float $total_before_delivery_charges):float{

			if($total_before_delivery_charges >= 9000){
				return 0;
			}
			if($total_before_delivery_charges >= 5000){
				return 295;
			}

			return 495;

		}
		
	}