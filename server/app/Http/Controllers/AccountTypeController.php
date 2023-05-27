<?php

namespace App\Http\Controllers;

use App\Models\AccountType;
use Illuminate\Http\Request;

class AccountTypeController extends Controller
{
    public function index()
    {
        $account_types = AccountType::all();

        return response()->json(
            $account_types,
        );

        // return response()->json([
        //     'status' => 'success',
        //     'data'   => $account_types,
        // ]);
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name'          => ['required', 'string', 'max:255'],
    //         'description'   => ['required', 'string', 'max:65500'],
    //     ]);

    //     AccountType::create($request->only('name', 'description'));

    //     return response()->json([
    //         'status'  => 'success',
    //         'message' => 'Account Type Created Successfully',
    //     ], 201);
    // }

    // public function update(Request $request, string $id)
    // {
    //     $account_type = AccountType::findOrFail();

    //     $request->validate([
    //         'name'          => ['required', 'string', 'max:255'],
    //         'description'   => ['required', 'string', 'max:65500'],
    //     ]);

    //     return response()->json([
    //         'status'  => 'success',
    //         'message' => 'Account Type Updated Successfully',
    //     ], 201);
    // }

    // public function destroy(string $id)
    // {
    //     //
    // }
}
