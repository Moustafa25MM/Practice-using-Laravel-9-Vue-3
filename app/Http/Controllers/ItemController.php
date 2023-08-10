<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->query('userId');
        $user = User::find($userId);

        if ($user) {
            $items = $user->items()->orderBy('created_at', 'DESC')->get();
            return $items;
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function store(Request $request)
    {
        try {
            $userId = $request->input('userId');

            if (!is_array($request->item) || !isset($request->item['name'])) {
                return response()->json([
                    'error' => 'The request data is invalid.'
                ], 400);
            }

            $item = new Item([
                'name' => $request->item['name'],
                'user_id' => $userId
            ]);
            $item->save();

            return response()->json([
                'item' => $item
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function update(Request $request, $id)
    {
        $existingItem = Item::find($id);
        if ($existingItem) {
            if ($existingItem->completed) {
                // Item was previously completed, so mark it as uncompleted
                $existingItem->completed = false;
                $existingItem->completed_at = null;
            } else {
                // Item was previously uncompleted, so mark it as completed
                $existingItem->completed = true;
                $existingItem->completed_at = Carbon::now();
            }

            $existingItem->save();
            return $existingItem;
        }

        return response()->json(['error' => 'Item not found'], 404);
    }
    public function updateName(Request $request, $id)
{
    $existingItem = Item::find($id);
    if ($existingItem) {
        $existingItem->name = $request->item['name'];
        $existingItem->save();
        return $existingItem;
    }

    return response()->json(['error' => 'Item not found'], 404);
}

    public function destroy($id)
    {
        $existingItem = Item::find($id);
        if($existingItem){
            $existingItem->delete();
            return response()->json(['success' => 'Item successfully deleted']);
        }

        return response()->json(['error' => 'Item not found'], 404);
    }
}
