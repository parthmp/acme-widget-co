<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use \App\Classes\Basket;
use \App\Classes\DeliveryCharge;
use \App\Classes\SpecialOffer;

class BasketTest extends TestCase{

	protected $products = [
							'R01' => 32.95,
							'G01' => 24.95,
							'B01' => 7.95,
						];

    public function test_basket_total_for_r01_second_half_price(){
		
        $basket = new Basket($this->products, new DeliveryCharge(), new SpecialOffer('R01'));

        $basket->add('R01');
        $basket->add('R01');

        
        $this->assertEquals(54.37, $basket->total());

    }
}
