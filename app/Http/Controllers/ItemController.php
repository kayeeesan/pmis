<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Item as ResourcesItem;
use App\Models\Item;
use Symfony\Component\HttpFoundation\Response;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        try {
            $items = Item::paginate(10);
            
            return response()->json([
                'success' => true,
                'data' => ResourcesItem::collection($items),
                'meta' => [
                    'current_page' => $items->currentPage(),
                    'last_page' => $items->lastPage(),
                    'per_page' => $items->perPage(),
                    'total' => $items->total(),
                    'from' => $items->firstItem(),
                    'to' => $items->lastItem(),
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error connecting to legacy DB: ' . $e->getMessage(),
            ], 500);
        }
    }
}
