<?php

	namespace App\Interfaces;

	interface DeliveryChargeInterface{
		/**
		* @param int $total_before_delivery_charges Basket total in cents.
		* @return int Delivery charge in cents.
		*/
		public function calculate(int $total_before_delivery_charges):int;
	}