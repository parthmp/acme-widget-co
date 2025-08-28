<?php

	namespace App\Classes;

	use App\Interfaces\OfferInterface;

	class SpecialOffer implements OfferInterface{
		
		/**
		* @var string The item code the offer applies to.
		*/
		private string $item_code;

		/**
		* Constructor
		*
		* @param string $item_code The item code for which the special offer applies.
		*/
		public function __construct(string $item_code){
			$this->item_code = $item_code;
		}

		/**
		* @param list<array<string,int>> $items
		* @return list<array<string,int>>
		*/
		public function applyOffer(array $items):array{
			$found_count = 0;

			foreach($items as $index => $item){
				
				foreach($item as $item_code => $item_price){
					
					if($item_code === $this->item_code){
						$found_count++;
					}

					if($found_count === 2){
						$items[$index][$item_code] =  intdiv($item_price, 2);
						break;
					}

				}

				

			}
			
			return $items;
		}

	}