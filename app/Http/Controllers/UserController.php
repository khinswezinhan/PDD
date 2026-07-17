<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('role');

        if ($request->has('search') && ! empty($request->search)) {
            $searchTerm = $request->search;
            $query->where('name', 'LIKE', '%'.$searchTerm.'%');
        }

        if ($request->filled('role_id')) {
            $query->where('role_id', $request->role_id);
        }

        $users = $query->paginate(4)->appends($request->query());

        $roles = Role::all();

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        // ဖြည့်စွက်ချက် - Form မှာပါတဲ့ field အကုန်လုံးဝင်အောင် တိုးချဲ့ပေးထားပါတယ်
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required|exists:roles,id',
            'password' => 'required|string|min:8', // password သီးသန့်စစ်ဆေးခြင်း
            'status' => 'required|in:active,inactive',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role_id' => $validated['role_id'],
            'password' => Hash::make($validated['password']), // ရိုက်ထည့်လိုက်တဲ့ password ကို Hash လုပ်ပြီးသိမ်းခြင်း
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    // internal server error ဖြစ်စေတဲ့ အပိုင်းကို အောက်ပါအတိုင်း ပြင်ဆင်လိုက်ပါပြီ
    public function update(Request $request, User $user): RedirectResponse
    {
        // $request->validated() အစား တိုက်ရိုက် $request->validate() ပြောင်းလဲပေးထားပါတယ်
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role_id' => 'required|exists:roles,id',
            // လက်ရှိ edit လုပ်နေတဲ့ user ရဲ့ email ကို unique စစ်ဆေးရာကနေ ချန်လှပ် (Ignore) ထားပေးပါတယ်
            'email' => 'required|email|unique:users,email,'.$user->id,
            // password မပြင်ရင် blank ထားနိုင်အောင် nullable လုပ်ထားပြီး blade က 'password_confirmation' နဲ့ ချိတ်ပေးထားပါတယ်
            'password' => 'nullable|string|min:8|confirmed',
            'status' => 'required|in:active,inactive',
        ]);

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role_id' => $validated['role_id'],
            'status' => $validated['status'],
        ];

        // အကယ်၍ Edit Form မှာ Password အသစ် ရိုက်ထည့်ခဲ့ရင် Hash လုပ်ပြီး ထည့်ပေးမှာပါ
        if (! empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $user->update($updateData);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
