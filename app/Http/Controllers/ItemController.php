<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Item as ResourcesItem;
use App\Models\Item;
use App\Http\Requests\ItemRequest;
use Symfony\Component\HttpFoundation\Response;

class ItemController extends Controller
{
    public function index(Request $request)
    {
       $items = [];
       if (isset($request->search)) {
        $items = Item::where('propertyno', 'like', '%' .$request->search . '%');
       }

       $items = isset($request->search) && $request->search ?
       $items->paginate(10) : Item::paginate(10);
       return ResourcesItem::collection($items);
    }

    public function store(ItemRequest $request)
    {
        try {
            $item = new Item();
            $item->propertyno = ucwords($request->propertyno);
            $item->item = $request->item;
            $item->unit = $request->unit;
            $item->descrip = $request->descrip;
            $item->classid = $request->classid;
            $item->yrlife = $request->yrlife;
            $item->reorderpt = $request->reorderpt;
            $item->reorderqty = $request->reorderqty;
            $item->edate = $request->edate;
            $item->itemtypeid = $request->itemtypeid;
            $item->status = $request->status;
            $item->criticalqty  = $request->criticalqty;
            $item->allow = $request->allow ?? false;
            $item->propertycard = $request->propertycard;
            $item->save();

            return response()->json(['message' => 'Item has been successfully saved']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
       try {
            $item = Item::findOrFail($id);
             $item->propertyno   = ucwords($request->propertyno);
            $item->item = $request->item;
            $item->unit = $request->unit;
            $item->descrip = $request->descrip;
            $item->classid = $request->classid;
            $item->yrlife = $request->yrlife;
            $item->reorderpt = $request->reorderpt;
            $item->reorderqty = $request->reorderqty;
            $item->edate = $request->edate;
            $item->itemtypeid = $request->itemtypeid;
            $item->status = $request->status;
            $item->criticalqty = $request->criticalqty;
            $item->allow = $request->allow ?? false;
            $item->propertycard = $request->propertycard;
            $item->update();

            return response(['message' => 'Item has been successfully updated.']);
       } catch (\Exception $e) {
        return response(['message' => $e->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
       }
    }

    public function destroy($id)
    {
        Item::findOrFail($id)->delete();
        return response(['message' => 'Item has been successfully deleted!']);
    }
}
