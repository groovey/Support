<?php
namespace Pandango\Support;

class Tree
{
    private $datas;

    /**
     * Process on making the tree
     */
    public function make(array $datas)
    {
        $datas = $this->sort($datas);
        $this->datas = $this->reOrder($datas);

        return $this;
    }

    /**
     * Sort base on order
     */
    private function sort(array $datas)
    {
        usort($datas, function ($a, $b) {
            return $a['order'] <=> $b['order'] ;
        });

        return $datas;
    }

    /**
     * rearrange datas base on parent_id
     */
    private function reOrder($array, $parent=null, $indent='')
    {
        $return = [];
        foreach ($array as $key => $val) {
            if ($val['parent_id'] == $parent) {
                $return[] = $val;
                $return = array_merge($return, $this->reOrder($array, $val['id'], $indent));
            }
        }
        return $return;
    }

    /**
     * Returns data in collection
     *
     * @return void
     */
    public function toCollection()
    {
        return collect($this->datas)->recursive();
    }

    /**
     * To json objects
     */
    public function toObject()
    {
        return json_decode(json_encode($this->datas));
    }

    /**
     * Returns data in array form
     */
    public function toArray()
    {
        return $this->datas;
    }

    /**
     * To a multi dimensional array
     */
    public function toNestedArray()
    {
        $datas      = $this->datas;
        $categories = [];

        // make associative array of $category with respective id as key
        foreach ($datas as $data) {
            $categories[$data['id']]= $data;
        }

        // fill in 'subcategories' while maintaining the references using '&' operator
        foreach ($categories as $key => &$data) {
            if ($data['parent_id'] != null) {
                $categories[$data['parent_id']]['subcategories'][$data['slug']] = &$data;
            }
        }

        // Cleanup duplicate occurences
        foreach ($categories as $category) {

            // Removed unwanted duplicates
            if ($category['parent_id'] != null) {
                unset($categories[$category['id']]);

            // Replace the array key to the slug name instead of the id
            } else {
                $categories[$category['slug']] = $categories[$category['id']];
                unset($categories[$category['id']]);
            }
        }

        return $categories;
    }

    /**
     * Adds spacer base on level
     */
    public function spacer($level)
    {
        return str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", $level - 1);
    }
}