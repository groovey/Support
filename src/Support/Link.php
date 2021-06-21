<?php
namespace Pandango\Support;

use App\Models\Customer;

class Link
{

    /**
     * Overides route function. The $params accespts string and object.
     *
     * Ex. $this->route('address.edit', ['customer_id', $address])
     */
    public function route(string $name, array $params = [])
    {
        $arr = [];
        foreach ($params as $param) {
            if (is_object($param)) {
                $class = strtolower(class_basename($param));
                $arr[$class] = $param;
            } elseif (is_string($param)) {
                $arr[$param] = request()->input($param);
            }
        }

        return route($name, $arr);
    }
}