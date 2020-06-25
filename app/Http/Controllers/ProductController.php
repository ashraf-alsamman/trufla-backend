<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB ;

class ProductController extends Controller
{
    function filter (Request $request)
    {
      $query = DB::table('products')
            ->Join('products_promotions', 'products_promotions.product_id', '=', 'products.id')
            ->Join('promotions', 'products_promotions.promotion_id', '=', 'promotions.id');

                    if ($request['department']  != null ){
                      $query->where('department_id', '=', (int)$request['department']);
                    }
 
                    if ($request['code']  != null ){
                      $query->where('code', 'LIKE', '%' . $request['code'] . '%');
                    }

                    if ($request['name']  != null ){
                      $query->where('name', 'LIKE', '%' . $request['name'] . '%');
                    }

       return $result = $query->paginate(4);
    }
  
    function departments ()
    {                  
          return $users = DB::table('departments') 
          ->get();
    }
    
    
}
