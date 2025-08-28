<?php

	namespace App\Classes;

	use App\Interfaces\OfferInterface;

	class SpecialOffer implements OfferInterface{
		
		private string $item_code;

		public function __construct(string $item_code){
			$this->item_code = $item_code;
		}

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