<?php
namespace Pandango\Support;

class Paginate
{
    private $display = 25;

    /**
     * Display data in paginated way
     */
    public function paginate($model, int $displayPerPage = null)
    {
        if (!$displayPerPage) {
            $displayPerPage = $this->display;
        }

        $model = $model->paginate($displayPerPage);

        // Fix last page no. if more than the total no of pages.
        if (request()->get('page') > $model->lastPage()) {
            $url = request()->fullUrlWithQuery(['page' =>  $model->lastPage()]);
            redirect_to($url);
        }

        return $model;
    }
}