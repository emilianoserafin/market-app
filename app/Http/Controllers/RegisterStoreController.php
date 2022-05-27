<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\DB;



class RegisterStoreController extends Controller
{

    public function create()
    {
        return Inertia::render('Auth/RegisterStoreStep2');
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $farm = $request->validate([
            'user_id' => '',
            'farm_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'business_id' => ['required', 'string', 'max:255'],
            'street_address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'farm_description' => ['string', 'max:255'],
        ]);

        $farm['user_id'] = $user->id;

        if ($user->has_store === null) {
            $data = User::find($user->id);
            $data->has_store = "yes";
            $data->save();
        }

        Store::create($farm);

        return redirect('dashboard');
    }
}
