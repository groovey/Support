<?php
namespace Pandango\Support;

class Tree
{
    private $datas;

    public function make(array $datas)
    {
        $datas = $this->sort($datas);
        $this->datas = $this->reOrder($datas);

        return $this;
    }

    public function sort(array $datas)
    {
        usort($datas, function ($a, $b) {
            return $a['order'] <=> $b['order'] ;
        });

        return $datas;
    }

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

    public function toArray()
    {
        return $this->datas;
    }

    public function toCollection()
    {
        return collect($this->datas)->recursive();
    }

    public function toObject()
    {
        return json_decode(json_encode($this->datas));
    }

    public function spacer($level)
    {
        return str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", $level - 1);
    }
}