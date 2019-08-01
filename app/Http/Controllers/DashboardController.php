<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    private $repository;
    private $validator;

    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    public function index()
    {
        echo "Estamos na index(dashboard)";
    }

    public function auth(Request $request)
    {
        $data = [
            'email'     => $request->get('username'),
            'password'  => $request->get('password')
        ];

        try
        {
            if (env('PASSWORD_HASH'))
            {
                Auth::attempt($data, true);
            }
            else
            {

            }

            return redirect()->route('user.dashboard');
        }
        catch (Exception $e)
        {
            return $e->getMessage();
        }
    }
}
