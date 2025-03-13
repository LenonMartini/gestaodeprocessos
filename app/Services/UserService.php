<?php

namespace App\Services;

use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserService
{
    public function findAll(){
        $response = User::where('tenant_id', auth()->user()->tenant_id)->get();
        return UserResource::collection($response)->toArray(request());
    }
    public function get(int $id){
        if(!$id){
            throw new \Exception('Parametro não informado');
        }
        $response = User::where('tenant_id', auth()->user()->tenant_id)->where('id', $id)->first();
        return new UserResource($response);
    }
    public function store(array $data){
        try {
            DB::beginTransaction();
            $data['tenant_id'] = auth()->user()->tenant_id;
            if(isset($data['password']) && !empty($data['password'])){
                $data['password'] = bcrypt($data['password']);
            }else{
                $data['password'] = bcrypt('123456');
            }

            $user = User::create($data);

            DB::Commit();
            return new UserResource($user);


        }catch (\Exception $e) {
            DB::rollBack();
            throw new \ErrorException($e->getMessage());
        }
    }
    public function update(array $data, int $id){
        try {
            if(!$id){ throw new \Exception('Parametro não informado');}
            DB::beginTransaction();
            unset($data['password_confirmation']);
            if(isset($data['password']) && !empty($data['password'])){
                $data['password'] = bcrypt($data['password']);

            }else{
                unset($data['password']);
            }

            User::where('tenant_id', auth()->user()->tenant_id)->where('id', $id)->update($data);
            DB::Commit();
            return new UserResource($this->get($id));
        }catch (\Exception $e) {
            DB::rollBack();
            throw new \ErrorException($e->getMessage());
        }
    }
    public function destroy(int $id)
    {
        try {
            if (!$id) {
                throw new \Exception('Parâmetro não informado');
            }

            // Inicia a transação
            DB::beginTransaction();

            // Obtém o registro para verificar se existe
            $data = $this->get($id);

            // Verifica se o registro existe
            if (!$data) {
                throw new \Exception('Nenhum registro encontrado');
            }

            // Tenta excluir o registro
            $data->delete();

            // Comita a transação se tudo ocorrer bem
            DB::commit();

            return [
                'message' => 'Registro deletado com sucesso',
            ];
        } catch (\Exception $e) {
            // Caso ocorra algum erro, faz o rollback
            DB::rollBack();

            // Lança a exceção com a mensagem de erro
            throw new \ErrorException('Erro ao deletar registro: ' . $e->getMessage());
        }
    }

}
