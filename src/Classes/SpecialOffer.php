<?php

	namespace App\Classes;

	use App\Interfaces\OfferInterface;

	class SpecialOffer implements OfferInterface{
		
		private string $item_code;

		public function __construct(string $item_code){
			$this->item_code = $item_code;
		}

		public function applyOffer(array $items):array{

			
			return [];
		}

	}