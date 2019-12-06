<?php

namespace App\Http\Services;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Helpers\Statics\UserRolesStatic;
use App\Entities\User;

class UserService {
    public function index($request)
    {
        $limit = $request->get('limit', 10);
        $query = User::query();
        $currentUser = auth()->user(); 
        if($currentUser->role == UserRolesStatic::AGENCY_MANAGER){
            $query->where('agency_id', $currentUser->agency_id);
        }

        $users = $query->paginate($limit)->toArray();
        foreach($users['data'] as &$user){
            $user['role_text'] = UserRolesStatic::getRoleText($user['role']);
        }

        return response()
            ->json($users); 
    }

    public function detail($id)
    {
        $query = User::query();
        $currentUser = auth()->user(); 
        if($currentUser->role == UserRolesStatic::AGENCY_MANAGER){
            $query->where('agency_id', $currentUser->agency_id);
        }
        $user = $query->where('id', $id)->first();
        $user['role_text'] = UserRolesStatic::getRoleText($user->role);

        return response()
            ->json($user);
    }

    public function create($request)
    {
        $currentUser = auth()->user(); 
        $data = $request->all();
        //$data['password'] = Hash::make($data['password']);
        
        if($currentUser->role == UserRolesStatic::AGENCY_MANAGER){
            $data['agency_id'] = $currentUser->agency_id; 
        }
        
        if($request->hasFile('image'))
        {
            $path = $this->upload($image);
            $data['avatar'] = $path;
        }
        
        $user = User::create($data);

        return response()
            ->json($user);
    }

    public function update($request)
    {
        $data = $request->all();
        if(isset($data['password']))
        {
            $data['password'] = Hash::make($data['password']);
        }

        $currentUser = auth()->user(); 
        $query = User::query();
        if($currentUser->role == UserRolesStatic::AGENCY_MANAGER){
            $query->where('agency_id', $currentUser->agency_id);
        }
        
        $user = $query->where('id', $request->id)->first();
        if ($user) {
            $user->update($data);
        }

        return response()
            ->json($user);
    }

    public function delete($id)
    {
        $currentUser = auth()->user(); 
        $query = User::query();
        if($currentUser->role == UserRolesStatic::AGENCY_MANAGER){
            $query->where('agency_id', $currentUser->agency_id);
        }
        
        $user = $query->where('id', $id)->delete();

        return response()
            ->json('Xóa thành công');
    }
}



?>