<?php
namespace App\Service;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminHelper
{
    protected $menu_name;


    /**
     * Get URI name for admin panel
     *
     * @return string
     */
    public function getAdminMenuName()
    {
        $this->menu_name = $this->menu_name??str_ireplace('admin/','',Request::capture()->path());

        return $this->menu_name;
    }
    public function getFrontMenuName()
    {
        $this->menu_name =Request::capture()->path();

        return $this->menu_name;
    }
    
}