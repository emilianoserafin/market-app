<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\User;
use App\Models\Team;
use Illuminate\Support\Facades\DB;



class RegisterStoreController extends Controller
{

    public function create()
    {
        if (auth()->user()) {
            return Inertia::render('Auth/RegisterStoreStep2');
        }
        return Inertia::render('Auth/RegisterStore');
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
        $data = User::find($user->id);

        if ($user->has_store === null) {
            $data->has_store = "yes";
            $data->save();
        }

        Store::create($farm);

        if ($user->role !== 'storefront') {
            $data->role = "storefront";
            $data->save();
        }

        $farm_name = $farm['farm_name'];

        $this->createTeam($user, $farm_name);

        return redirect('dashboard');
    }

    protected function createTeam(User $user, $farm_name)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => $farm_name . " Team",
            'personal_team' => true,
        ]));
    }
}
