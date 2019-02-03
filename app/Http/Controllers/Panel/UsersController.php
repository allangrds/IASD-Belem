<?php
namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::where('is_admin', false)
            ->get(['id', 'name', 'email', 'is_active']);

        return view('panel.users.index')
            ->with('users', $users);
    }

    public function create()
    {
        return view('panel.users.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|unique:users|email|min:6|max:255',
            'password' => 'required|min:8|max:25',
        ]);

        try {
            User::create([
               'name' => $request->name,
               'email' => $request->email,
               'password' => $request->password,
            ]);

            DB::commit();

            return redirect()
                ->route('panel_users')
                ->with('message', 'Usuário cadastrado');
        } catch(\Exception $e) {
            DB::rollBack();

            return back()
                ->withErrors(['page' => 'Não foi possível concluir esta ação']);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        $user = User::where('id', $id)->get(['id', 'is_active'])->first();

        try {
            $user->is_active = $user->is_active == true ? false : true;
            $user->save();

            DB::commit();

            return back()->with('message', 'Usuário desativado');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withErrors(['page' => 'Não foi possível concluir esta ação']);
        }
    }
}
