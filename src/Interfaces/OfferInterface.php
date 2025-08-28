<?php

	namespace App\Interfaces;

	interface OfferInterface{
		public function applyOffer(array $items):array;
	}