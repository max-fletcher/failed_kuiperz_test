<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Account;
use App\Models\AccountType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    public function index()
    {
        // OPTIMIZE FURTHUR ??
        $accounts = Account::with('account_type', 'branch')->get();

        return response()->json(
            $accounts,
        );

        // return response()->json([
        //     'status' => 'success',
        //     'data'   => $accounts,
        // ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'balance'           => ['required', 'numeric', 'integer', 'min:0', 'max:18446744073709551615'],
            'status'            => ['required', Rule::in(['pending', 'deposit', 'withdrawal', 'restricted', 'frozen', 'inactive', 'active'])],
            'branch_id'         => ['required', 'numeric', 'integer', 'exists:branches,id'],
            'account_type_id'   => ['required', 'numeric', 'integer', 'exists:account_types,id'],
        ]);

        do {
            $account_number = rand(1000000000, 9999999999);
            $account = Account::where('account_number', $account_number)->first();
        } while ($account);

        $validated['account_number'] = $account_number;

        Account::create($validated);

        return response()->json([
            'status'    => 'success',
            'message'   => 'Account created successfully !',
        ]);
    }

    // public function show(string $id)
    // {
    //     //
    // }

    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
