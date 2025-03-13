<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    protected $service;
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
    public function index()
    {

        // Buscar todos os usuários
        $users = $this->service->findAll();

        // Passar os usuários para a página via Inertia
        return Inertia::render('User/Index', [
            'users' => $users,
        ]);
    }
    public function create()
    {
        return Inertia::render('User/Create');
    }
    public function store(UserRequest $request){

        $validated = $request->validated();

        $response = $this->service->store($validated);
        return response()->json($response);

    }
    public function edit($id)
    {
        $response = $this->service->get($id);

        return Inertia::render('User/Update', ['user' => $response]);
    }
    public function update(UserRequest $request, $id)
    {
        $validated = $request->validated();
        $response = $this->service->update($validated, $id);
        return response()->json($response);
    }
    public function destroy( $id)
    {
        $response = $this->service->destroy( $id);
        return response()->json($response, 200);
    }

}
