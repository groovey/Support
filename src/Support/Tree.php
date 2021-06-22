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
    public function sort(array $datas)
    {
        usort($datas, function ($a, $b) {
            return $a['order'] <=> $b['order'] ;
        });

        return $datas;
    }

    /**
     * reOrder base on parent_id
     */
    public function reOrder($array, $parent=null, $indent='')
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
     * Returns data in array form
     */
    public function toArray()
    {
        return $this->datas;
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
     * Adds spacer base on level
     */
    public function spacer($level)
    {
        return str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", $level - 1);
    }
}