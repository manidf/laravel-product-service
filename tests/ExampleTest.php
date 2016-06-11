<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{

  // include DBTransactions trait
  use DatabaseTransactions;

  /**
   * A basic functional test example.
   *
   * @return void
   */
  public function testBasicExample()
  {
    $this->visit('/')
      ->see('Laravel 5');
  }

  public function testProductsList()
  {
    // generate 3 records of a product
    $products = factory(App\Product::class, 3)->create();

    $this->get(route('api.products.index'))
      ->assertResponseOk();

    // loop through the list of items
    array_map(function ($product) {
      // look for serialised version of the product
      $this->seeJson($product->jsonSerialize());
    }, $products->all());
  }

  public function testProductDescriptionList()
  {
    $product = factory(\App\Product::class)->create();

    // create(): in memory
    // make(): stores in database

    // generate 3 records of a product
    // descriptions method returns a relationship object
    $product->descriptions()->saveMany(factory(\App\Description::class, 3)->make());

    // perform get request to database
    $this->get(route('api.products.descriptions.index', ['products' => $product->id]))
      ->assertResponseOk();

    // loop through list
    array_map(function ($description) {
      $this->seeJson($description->jsonSerialize());
    }, $product->descriptions->all());
  }
  public function testUpdateProduct()
  {
    $product = factory(Product::class)->create(['name' => 'beats']);
    $this->put(route('api.products.update', ['productId' => $product->id]), ['name' => 'Huawie'], $this->jsonHeaders)
      ->seeInDatabase('products', ['name' => 'Huawie'])
      ->assertResponseOk();
  }
}
