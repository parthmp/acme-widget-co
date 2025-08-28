<?php

	namespace App\Classes;

	use App\Interfaces\DeliveryChargeInterface;
	use App\Interfaces\OfferInterface;

	class Basket{

		private array $products_catalogue = [];
		private DeliveryChargeInterface $delivery_charge;

		private array $offers = [];

		private array $added_items = [];

		public function __construct(array $products_catalogue, DeliveryChargeInterface $delivery_charge, OfferInterface $offer){

			$this->products_catalogue = array_map(
				function (float $price){
					$cents = (int) round($price * 100);
					return $cents;
				},
				$products_catalogue
			);

			$this->delivery_charge = $delivery_charge;
			$this->addOffer($offer);

		}

		public function add(string $item_code):void{
			array_push($this->added_items, [$item_code => $this->products_catalogue[$item_code]]);
		}

		public function total():float{

			$this->applyOffersForItems();
			$total_before_delivery_charges = array_sum(array_map('array_sum', $this->added_items));
			$total = ($this->delivery_charge->calculate($total_before_delivery_charges) + $total_before_delivery_charges);
			return round($total/100, 2);
		}

		public function addOffer(OfferInterface $offer):void{
			$this->offers[] = $offer;
		}

		private function applyOffersForItems() : void{
			
			/* apply offers and modify items costs as needed */
			foreach($this->offers as $offer){
				$this->added_items = $offer->applyOffer($this->added_items);
			}
		}

	}