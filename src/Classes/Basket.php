<?php

	namespace App\Classes;

	use App\Interfaces\DeliveryChargeInterface;
	use App\Interfaces\OfferInterface;

	class Basket{

		/** @var array<string, float> */
		private array $products_catalogue = [];

		/** @var DeliveryChargeInterface */
		private DeliveryChargeInterface $delivery_charge;

		/** @var OfferInterface[] */
		private array $offers = [];

		/** @var list<array<string,int>> */
		private array $added_items = [];


		/**
		* @param array<string, float> $products_catalogue
		* @param DeliveryChargeInterface $delivery_charge
		* @param OfferInterface $offer
		* @return void
		*/
		public function __construct(array $products_catalogue, DeliveryChargeInterface $delivery_charge, OfferInterface $offer){

			$this->products_catalogue = array_map(
				function (float $price){
					$cents = (int) round($price * 100); /* using cents to avoid 0.1 mismatch */
					return $cents;
				},
				$products_catalogue
			);

			$this->delivery_charge = $delivery_charge;
			$this->addOffer($offer);

		}

		/**
		* Add an item to the basket.
		*
		* @param string $item_code The code of the item to add.
		* @return void
		*/
		public function add(string $item_code):void{
			array_push($this->added_items, [$item_code => $this->products_catalogue[$item_code]]);
		}

		/**
		* Calculate the total basket cost including delivery charges.
		*
		* @return float The total cost, rounded to 2 decimal places.
		*/
		public function total():float{

			$this->applyOffersForItems();

			$total_before_delivery_charges = array_sum(array_map('array_sum', $this->added_items));
			
			$total = ($this->delivery_charge->calculate($total_before_delivery_charges) + $total_before_delivery_charges);
			
			return round($total/100, 2);

		}

		/**
		* Add an offer to the basket.
		*
		* @param OfferInterface $offer The offer to apply.
		*
		* @return void
		*/
		public function addOffer(OfferInterface $offer):void{
			$this->offers[] = $offer;
		}

		/**
		* Apply all offers to the current list of added items.
		*
		* @return void
		*/
		private function applyOffersForItems() : void{
			
			/* apply offers and modify items costs as needed */
			foreach($this->offers as $offer){
				$this->added_items = $offer->applyOffer($this->added_items);
			}
		}

	}