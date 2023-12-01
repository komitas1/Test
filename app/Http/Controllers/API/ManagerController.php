<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeCreateRequest;
use App\Http\Resources\CreateEmployeeResource;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{
    /**
     * @param EmployeeCreateRequest $request
     * @return CreateEmployeeResource|Response
     */
    public function createEmployee(EmployeeCreateRequest $request): CreateEmployeeResource|Response
    {
        try {
          DB::beginTransaction();
            $user = User::query()->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'manager_id'=>Auth::user()->id,
                'role'=>User::USER_EMPLOYEE,
            ]);
            DB::commit();
            return new CreateEmployeeResource($user);
        }catch (\Exception $exception){
            DB::rollBack();
            return  response($exception);
        }
    }
}
