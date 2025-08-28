<?php

	namespace App\Interfaces;

	interface DeliveryChargeInterface{
		public function calculate(float $total_before_delivery_charges):float;
	}