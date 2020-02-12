<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Set page size (grid rows count)
    /**
     * @var int
     */
    public const C_PAGINATE_SIZE = 12;
    public const  C_PAGINATION_LIMIT = 5;
    protected $C_PAGE_SIZE = Controller::C_PAGINATE_SIZE;
    

    /**
     * Constructor (Auth middleware)
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
}
