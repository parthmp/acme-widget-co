<?php

	namespace App\Classes;

	use App\Interfaces\OfferInterface;

	class BuyTwoThirdFreeOffer implements OfferInterface{

		/**
		* @param list<array<string,int>> $items
		* @return list<array<string,int>>
		*/
		public function applyOffer(array $items):array{

			foreach($items as $index => $item){
				
				foreach($item as $item_code => $item_price){
					if($index === 3){
						$items[$index][$item_code] =  0;
						break;
					}

				}
			}
			
			return $items;
		}

	}