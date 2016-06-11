<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{

  // whitelist property to be able to be edited en mass
  public $fillable = ['body'];

  public function product()
  {
    $this->belongsTo(Product::class);
  }

  public function scopeOfProduct($query, $productId)
  {
    return $query->where('product_id', $productId);
  }

}
