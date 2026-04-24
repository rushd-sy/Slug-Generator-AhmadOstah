<?php

namespace App\Actions\ItemAction;
use App\Models\Item;
use App\Http\Controllers\Api\ItemController;
use App\Http\Requests\ItemRequest;
class CreateItemAction
{
    public function handle(array $data)
    {
        $item=Item::create($data);
        return $item;
    }
}
