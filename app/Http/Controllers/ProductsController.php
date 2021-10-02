<?php

declare(strict_types=1);

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

    public function show($city)
    {
        try {
            return $this->weather->recByCity($city);
        } catch (\Exception $e) {
            return response()->json(['message' => 'City ' . $city . ' not found'], 404);
        }
    }
}
