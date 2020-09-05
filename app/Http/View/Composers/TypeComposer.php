<?php

namespace App\Http\View\Composers;

use App\ProductType;
use Illuminate\View\View;
use App\Repositories\UserRepository;

class TypeComposer
{
   

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('sample', ProductType::all());
    }
}