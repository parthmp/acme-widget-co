<?php

	namespace App\Interfaces;

	interface OfferInterface{

		/**
		* @param list<array<string,int>> $items
		* @return list<array<string,int>>
		*/
		public function applyOffer(array $items):array;
		
	}