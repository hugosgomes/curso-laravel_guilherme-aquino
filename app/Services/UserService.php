<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Exception;
use Illuminate\Database\QueryException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class UserService
{

    private $repository;
    private $validator;

    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    public function store($data){
        try
        {

            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $usuario = $this->repository->create($data);

            return [
                'success'   => true,
                'messages'  => "Usuário cadastrado",
                'data'      => $usuario
            ];
        }
        catch (Exception $e)
        {
            switch (get_class($e)) {
                case ValidatorException::class  : return [
                    'success'   => false,
                    'messages'  => $e->getMessageBag()
                ];
                case QueryException::class      :
                case Exception::class           :
                default                         : return [
                    'success'   => false,
                    'messages'  => $e->getMessage()
                ];
            }
        }
    }

    public function update(){

    }

    public function delete($user_id){
        try
        {

            $this->repository->delete($user_id);

            return [
                'success'   => true,
                'messages'  => "Usuário Removido",
                'data'      => null
            ];
        }
        catch (Exception $e)
        {
            switch (get_class($e)) {
                case ValidatorException::class  : return [
                    'success'   => false,
                    'messages'  => $e->getMessageBag()
                ];
                case QueryException::class      :
                case Exception::class           :
                default                         : return [
                    'success'   => false,
                    'messages'  => $e->getMessage()
                ];
            }
        }
    }
}
