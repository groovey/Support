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
     * Rearrange datas base on parent_id
     */
    private function reOrder(array $array, int $parent = null, string $indent = '')
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
    public function toNestedArray(bool $withKey = false)
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

                // With key is for formatting
                if ($withKey == true) {
                    $categories[$data['parent_id']]['subcategories'][$data['slug']] = &$data;
                } else {
                    $categories[$data['parent_id']]['subcategories'][] = &$data;
                }
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
     * Search category via slug and returns the nested array
     */
    public function find(string $slug, array $datas)
    {
        foreach ($datas as $data) {
            $subcategories = $data['subcategories'] ?? [];

            if ($slug == $data['slug']) {
                return $data;
            } elseif (count($subcategories) > 1) {
                $found = $this->find($slug, $data['subcategories']);
                if ($found) {
                    return $found;
                }
            }
        }

        return null;
    }

    /**
     * Adds spacer base on level
     */
    public function spacer(int $level)
    {
        return str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", $level - 1);
    }
}