<?php

namespace App\Features\User\Services;

use App\Features\User\Models\User;
use Exception;
use Graphicode\Standard\TDO\TDO;
use Illuminate\Support\Facades\DB;

class RegisterService
{
    private static $model = User::class;



    public function register(TDO $tdo, string $guard)
    {
        $craeteData = $tdo->all();

        try {
           // Here you can add the logic to register the user based on the guard
        switch ($guard) {
            case 'client':
                return $this->registerClient($craeteData,$guard);
            case 'lab':
                case 'labBranch':
                return $this->registerLab($craeteData,$guard);
            case 'radiology':
            case 'radiologyBranch':
                return $this->registerRadiology($craeteData,$guard);
            default:
                throw new \InvalidArgumentException("Invalid guard type provided");
        }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    private function registerClient(array $craeteData,string $guard)
    {
        try{
            DB::beginTransaction();
            $credential = self::$model::create($craeteData);
            $credential->clientDetail()->create($craeteData);
            $credential->assignRole($guard);
            $img = $craeteData['img'] ?? null;
            if($img){
                $credential->addMedia($img)->toMediaCollection('users');
            }
            DB::commit();
            return $credential;
        }catch(Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }

    }

    private function registerLab(array $craeteData,string $guard)
    {
        try{
            DB::beginTransaction();

            // it send lab id and get it to find fron users table and get id from labDetails to make self relation by perant_id
            if($guard == 'labBranch'){
                $labDetailId = self::$model::find($craeteData['parent_id'])->labDetail()->first()->id ?? null;
                $craeteData['parent_id'] =$labDetailId;
            }

            $credential = self::$model::create($craeteData);
            $credential->labDetail()->create($craeteData);
            $credential->assignRole($guard);
            $img = $craeteData['img']??null;
            if($img){
                $credential->addMedia($img)->toMediaCollection('users');
            }
            DB::commit();
            return $credential;
        }catch(Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }

    }

    private function registerRadiology(array $craeteData,string $guard)
    {
        try{
            DB::beginTransaction();
            // it send radiology id and get it to find fron users table and get id from radiologyDetail to make self relation by perant_id
            if($guard == 'radiologyBranch'){
                $labDetailId = self::$model::find($craeteData['parent_id'])->radiologyDetail()->first()->id ?? null;
                $craeteData['parent_id'] =$labDetailId;
            }
            $credential = self::$model::create($craeteData);
            $credential->radiologyDetail()->create($craeteData);
            $credential->assignRole($guard);
            $img = $craeteData['img'] ??null;
            if($img){
                $credential->addMedia($img)->toMediaCollection('users');
            }
            DB::commit();
            return $credential;
        }catch(Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }


}
