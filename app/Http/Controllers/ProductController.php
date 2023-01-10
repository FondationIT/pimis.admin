<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function createCat(Request $data)
    {
        return Categorie::create([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);
    }

    public function createProd(Request $data)
    {
        return Product::create([
            'categorie' => $data['categorie'],
            'designation' => $data['designation'],
            'model' => $data['model'],
            'unite' => $data['unite'],
            'prix' => $data['prix'],
            'description' => $data['description'],
        ]);
    }
}
