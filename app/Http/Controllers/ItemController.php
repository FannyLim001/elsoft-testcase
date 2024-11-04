<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ItemAccount;
use App\Models\Items;
use App\Models\ItemUnit;
use App\Models\MasterItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function index()
    {
        $items = MasterItem::with(['itemGroup', 'itemAccount', 'itemUnit'])->get();

        if ($items->count() > 0) {
            return response()->json([
                'status' => 200,
                'masterItem' => $items,
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No records found',
            ], 404);
        }
    }

    public function itemGroup()
    {
        $items = Items::all();

        if ($items->count() > 0) {
            return response()->json([
                'status' => 200,
                'items' => $items,
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No records found',
            ], 404);
        }
    }

    public function itemAccount()
    {
        $items = ItemAccount::all();

        if ($items->count() > 0) {
            return response()->json([
                'status' => 200,
                'itemAccount' => $items,
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No records found',
            ], 404);
        }
    }

    public function itemUnit()
    {
        $items = ItemUnit::all();

        if ($items->count() > 0) {
            return response()->json([
                'status' => 200,
                'itemUnit' => $items,
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No records found',
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company' => 'required',
            'item_type' => 'required',
            'code' => 'required',
            'title' => 'required',
            'item_group_id' => 'required',
            'item_account_id' => 'required',
            'item_unit_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $items = MasterItem::create([
                'company' => $request->company,
                'item_type' => $request->item_type,
                'code' => $request->code,
                'title' => $request->title,
                'item_group_id' => $request->item_group_id,
                'item_account_id' => $request->item_account_id,
                'item_unit_id' => $request->item_unit_id,
                'isActive' => $request->isActive,
            ]);

            if ($items) {
                return response()->json([
                    'status' => 200,
                    'message' => "Master Item has been created successfully"
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => "Something went wrong"
                ], 500);
            }
        }
    }

    public function show($id)
    {
        $item = MasterItem::with(['itemGroup', 'itemAccount', 'itemUnit'])->find($id);
        if ($item) {
            return response()->json([
                'status' => 200,
                'item' => $item
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No such data found"
            ], 500);
        }
    }

    public function edit(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'company' => 'required',
            'item_type' => 'required',
            'code' => 'required',
            'title' => 'required',
            'item_group_id' => 'required',
            'item_account_id' => 'required',
            'item_unit_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $items = MasterItem::find($id);
            if ($items) {
                $items->update([
                    'company' => $request->company,
                    'item_type' => $request->item_type,
                    'code' => $request->code,
                    'title' => $request->title,
                    'item_group_id' => $request->item_group_id,
                    'item_account_id' => $request->item_account_id,
                    'item_unit_id' => $request->item_unit_id,
                    'isActive' => $request->isActive,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => "Master Item has been updated successfully"
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => "No such Item was found"
                ], 404);
            }
        }
    }

    public function destroy($id)
    {
        $item = MasterItem::find($id);
        if ($item) {
            $item->delete();

            return response()->json([
                'status' => 200,
                'message' => "Master Item has been deleted successfully"
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No such Item was found"
            ], 404);
        }
    }
}
