<?php
namespace App\Actions\ItemAction;
use App\Models\Item;
use App\Http\Controllers\Api\ItemController;
use App\Http\Requests\ItemRequest; 

class UpdateItemAction
{
    public function handle(array $data, Item $item)
    {
        $item->update($data);
        return $item;
    }
}