<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AccessType;
use App\Models\Gender;
use App\Models\UserModel;
use App\Models\Deleteduser;
use Illuminate\Validation\Rule;


class AdminController extends Controller
{
    // To View Admin Dashboard
    public function admindashboardview(){
        return view('adminside.dashboard');
    }
    public function employeeDashboard(){
        return view('adminside.employeedash');
    }

    //To display data from users table to HTML Table
    public function usersTable()
    {
        $users = UserModel::join('genders as g', 'g.gender_id', '=', 'users.gender_id')
                          ->join('access_type as a', 'a.user_access_id', '=', 'users.user_access_id')
                          ->select('users.*', 'g.gender as gender_name', 'a.user_access_type as access_type')
                          ->get();
    
        return view('adminside.usertable', compact('users'));
    }

    //To View a selected Data in Table
    public function userTableview($id){
        $user = UserModel::join('genders as g', 'g.gender_id', '=', 'users.gender_id')
                        ->join('access_type as a', 'a.user_access_id', '=', 'users.user_access_id')
                        ->select('users.*', 'g.gender as gender_name', 'a.user_access_type as access_type')
                        ->where('users.user_id', $id)
                        ->first();

        return view('usersblade.viewuser', compact('user'));
    }


    //To view the Edituser Page
    public function editUser($id){
        $user = UserModel::join('genders as g', 'g.gender_id', '=', 'users.gender_id')
        ->join('access_type as a', 'a.user_access_id', '=', 'users.user_access_id')
        ->select('users.*', 'g.gender as gender_name', 'a.user_access_type as access_type')
        ->where('users.user_id', $id)
        ->first();

        $genders = Gender::all();
        $accesstypes=AccessType::all();

        return view('usersblade.edituser', compact('user','genders','accesstypes'));
    }

    //Update function to Update the data in Database
    public function updateUser(Request $request, $id)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'max:155'],
            'gender_id' => ['required'],
            'user_access_id'=>['required'],
            'address' => ['required', 'max:55'],
            'contact_number' => ['required', 'max:55'],
            'username' => ['required', Rule::unique('users', 'username')->ignore($id, 'user_id')],
            'password' => ['nullable'], // No 'confirmed' rule since there's no confirmation field
        ], [
            'gender_id.required' => 'The gender field is required.',
            'user_access_id.required' => 'The gender field is required.'
        ]);
    
        // Hash the password if it is provided
        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            // Remove the password key if it is not provided to avoid overwriting the existing password with null
            unset($validated['password']);
        }
    
        // Update the user with validated data
        UserModel::where('user_id', $id)->update($validated);
    
        return redirect('/userstable')->with('message_success', 'User updated successfully');
    }

    //To view delete user Page
    public function deleteUser($id){
        $user = UserModel::join('genders as g', 'g.gender_id', '=', 'users.gender_id')
        ->join('access_type as a', 'a.user_access_id', '=', 'users.user_access_id')
        ->select('users.*', 'g.gender as gender_name', 'a.user_access_type as access_type')
        ->where('users.user_id', $id)
        ->first();

        return view('usersblade.deleteuser', compact('user'));
    }

    public function destroy(UserModel $user)
    {
        // Save user data to deleted_users table
        Deleteduser::create([
            'full_name' => $user->full_name,
            'gender_id' => $user->gender_id,
            'address' => $user->address,
            'contact_number' => $user->contact_number,
            'username' => $user->username,
            'password' => $user->password,
            'user_access_id' => $user->user_access_id,
        ]);
    
        // Delete the user from the users table
        $user->delete();
    
        // Redirect with success message
        return redirect('/userstable')->with('message_success', 'User successfully deleted.');
    }
    
    
    //For Deleted User
    public function deletedindex() {
        $delusers = Deleteduser::join('genders as g', 'g.gender_id', '=', 'deleted_users.gender_id')
                          ->join('access_type as a', 'a.user_access_id', '=', 'deleted_users.user_access_id')
                          ->select('deleted_users.*', 'g.gender as gender_name', 'a.user_access_type as access_type')
                          ->get();
    
        return view('adminside.deleteduser', compact('delusers'));
    }

    public function restore($id)
    {
        // Find the deleted user by id
        $deletedUser = Deleteduser::find($id);

        // Create a new user record with the data from the deleted user
        UserModel::create([
            'full_name' => $deletedUser->full_name,
            'gender_id' => $deletedUser->gender_id,
            'address' => $deletedUser->address,
            'contact_number' => $deletedUser->contact_number,
            'username' => $deletedUser->username,
            'password' => $deletedUser->password,
            'user_access_id' => $deletedUser->user_access_id
        ]);

        // Redirect back to the list of deleted users with a success message
        return redirect('/delusers')->with('message_success', 'User restored successfully.');
    }

    public function delete($id)
    {
        // Find the user by id and delete it
        Deleteduser::find($id)->delete();

        // Redirect back to the list of users with a success message
        return redirect('/delusers')->with('message_success', 'User deleted successfully.');
    }

    public function searchUser(Request $request)
    {
        $search = $request->input('search');

        $users = UserModel::when($search, function($query, $search) {
            return $query->where('full_name', 'like', "%{$search}%");
        })->get();

        return view('adminside.usertable', compact('users', 'search'));
    }
    
    
    
    
    
}
