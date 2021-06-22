<?php
namespace Pandango\Support;

class Theme
{
    /**
     * Shows the status in a color coded way
     */
    public function status($value)
    {
        switch (strtolower($value)) {
            case 'active':
            case 'processing':
            case 'close':
                $theme = 'success';
                break;
            case 'inactive':
            case 'delivered':
            case 'open':
                $theme = 'danger';
                break;
                $theme = 'warning';
                break;
            case 'pending':
            case 'packed':
                $theme = 'secondary';
                break;
            case 'shipped':
            default:
                $theme = 'primary';
                break;
        }
        return $theme;
    }

    /**
     * Shows in badge
     */
    public function bar($value, $options = [], $badges = ['primary', 'info', 'warning', 'danger', 'success', 'secondary'])
    {
        $key   = array_search($value, $options);
        $badge = $badges[$key];
        return "<h5><span class='badge badge-outline-$badge rounded-0'>$value</span></h5>";
    }
}