<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function create()
    {
    return view('tenant.create');
    }

    public function store(Request $request)
    {
        // dd($request->getHttpHost());
        // dd($request);
        $request->validate([
            'tenant' => 'required|string',
            'email' => 'required|email',
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        // create tenant
        $tenant = Tenant::create([
            'id' => $request->tenant
        ]);
        // create domain
        $tenant->domains()->create([
            'domain' => $request->tenant .'.localhost'
        ]);
        // create user in home
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'email_verified_at' => date('Y-m-d H:i:s')
        ]);

        $tenant->run(function () use ($request) {
            // create user in tenant
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'email_verified_at' => date('Y-m-d H:i:s')
            ]);
        });

        return back()->with('success','Tenant baru berhasil dibuat.');
    }
}
