<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthFormRequest;
use App\Repositories\Auth\AuthRepository;
use App\Repositories\Dashboard\DashboardRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    protected $repository;

    public function __construct(DashboardRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return view('dashboard.home');
    }

    public function showChangePassword($guard)
    {
        if (!in_array($guard, ['admin', 'manager', 'customer'])) {
            abort(404);
        }
        return response()->view('dashboard.change-password', ['guard' => $guard]);
    }
    public function changePassword(Request $request, $guard) {
        return $this->repository->changePassword($request,$guard);
    }

}
