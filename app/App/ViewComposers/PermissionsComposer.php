<?php
/**
 * Created by PhpStorm.
 * User: CreatyDev
 * Date: 2/18/2018
 * Time: 2:29 PM
 */

namespace CreatyDev\App\ViewComposers;

use CreatyDev\Domain\Users\Models\Permission;
use Illuminate\View\View;

class PermissionsComposer
{
    private $permitables;

    /**
     * Share list of roles.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        if (!$this->permitables) {
            $this->permitables = Permission::where('usable', true)->get();
        }

        $view->with('permitables', $this->permitables);
    }
}