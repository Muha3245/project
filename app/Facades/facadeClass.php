<?php

namespace App\Facades;

use App\Models\Carousel;
use App\Models\Item;
use App\Models\User;
use App\Models\Category;
use App\Models\Highlight;

class facadeClass
{
     public  function greet()
     {
          return "Hello, Greetings";
     }
     public function index()
     {
        $user=User::get();
        return $user;
     }
     public function category()
     {
        return Category::with('subcategories')->get();
     }
     public function highlights()
     {
         return Highlight::with('highlightImages')->get();
     }
     public function items()
     {
         return item::with('itemImages')->get();
     }
     public function carsoul(){
        return Carousel::get();
     }

}
