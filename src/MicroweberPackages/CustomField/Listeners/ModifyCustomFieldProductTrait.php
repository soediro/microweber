<?php

namespace MicroweberPackages\CustomField\Listeners;

trait ModifyCustomFieldProductTrait
{
    public function handle($event)
    {
        $request = $event->getRequest();
        $product = $event->getModel();

        if (isset($request['price'])) {
            $product->setCustomField(
                [
                    'type' => 'price',
                    'name' => 'Price',
                    'value' => [$request['price']]
                ]
            );
            $product->save();
        }
    }
}