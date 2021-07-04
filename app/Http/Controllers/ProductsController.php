<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use App\Helper\Weather;

class ProductsController extends Controller
{
    protected $weather;

    public function __construct(Weather $weather)
    {
    	$this->weather = $weather;
    }

    public function index()
    {
    	return $this->weather->all();

    }

    public function show($city)
    {
        return $this->weather->recByCity($city);
    }
}
