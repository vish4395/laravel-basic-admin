<?php
namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;
class StaffController extends Controller
{
    public function __construct() {
		$this->middleware('auth');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('Staff-section');
        $user=User::select('name','email','created_at','id')->where('id', '!=', 1);
        return Datatables::of($user)->editColumn('created_at', function ($user) {
            return $user->created_at->format('m/d/y');
        })->make(true);
    }
    
    public function frontend()
    {
        Gate::authorize('Staff-section');
        $data['roles']=Role::all();
        return view('staff.listing',$data);
    }

    public function edit_frontend($id)
    {
        Gate::authorize('Staff-edit');
        $data['roles']=Role::all();
        $data['staff'] = User::findOrFail($id);
        $data['staff_roles']=$data['staff']->getRoleNames()->toArray();
        return view('staff.edit',$data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        Gate::authorize('Staff-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('Staff-create');
         // validate
		$this->validate($request, [           
            'name'=>'required|max:255',
            'email'=>'required|email|max:255|unique:users',    
            'roles'=>'required',
            'password' => 'required|min:6|max:20',
            'confirm_password' => 'required|same:password',
		]);
		// create a new task based on user tasks relationship
		$user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
        
        foreach ($request->roles as $role) {
            $user->assignRole($role);
        }
		// return user
        return response()->json($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        Gate::authorize('Staff-section');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        Gate::authorize('Staff-edit');
        $user = User::findOrFail($id);
        $user['role_names']=$user->getRoleNames();
		return response()->json([
            'user' => $user
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Gate::authorize('Staff-edit');
        // validate
		$this->validate($request, [           
            'name'=>'required|max:255',
            'email'=>'required|email|max:255',
            'roles'=>'required',            
            'confirm_password' => 'same:password',
            ]);
            
        // $input = $request->all();
        $inp=[
            'name' => $request->name,
            'email' => $request->email,
        ];
        if($request->password){
            $inp['password']=Hash::make($request->password);
        }
        $staff = User::findOrFail($id);
        $staff->getRoleNames();
        $staff->update($inp);
        $staff->syncRoles($request->roles);
		return response()->json($staff->find($staff->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Gate::authorize('Staff-delete');
        return User::findOrFail($id)->delete();
    }
}
