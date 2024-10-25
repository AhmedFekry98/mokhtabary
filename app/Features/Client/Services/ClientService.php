<?php

namespace App\Features\Client\Services;

use Graphicode\Standard\TDO\TDO;
use App\Features\Client\Models\Client;
use App\Features\User\Models\User;

class ClientService
{
    private static $model = User::class;

    /**
     * Get All
     */
    public function getClients()
    {
        try {
            $clients =  self::$model::whereHas('roles', function ($query)  {
                $query->where('name','client');
            })->paginate(10);

            return $clients;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get One By Id
     */
    public function getClientById(string $clientId)
    {
        try {
            $client =self::$model::whereHas('roles', function ($query)  {
                $query->where('name','client');
            })->find($clientId);

            if (! $client) return "No model with id $clientId";
            return $client;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update One By Id
     */
    public function updateClientById(string $clientId, TDO $tdo)
    {
        try {
            $updateData = collect(
                $tdo->all(true)
            )->except([
               'img'
            ])->toArray();

            $client =  $this->getClientById($clientId);
            if (is_string($client)) return $client;

            $client->update($updateData);

            $client->clientDetail()->update($updateData);

            $img = $tdo->img;
            if($img){
                $client->addMedia($img)->toMediaCollection('users');
            }

            return $client;

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Delete One By Id
     */
    public function deleteClientById(string $clientId)
    {
        try {

            // get model to delete by id
            $client =  $this->getClientById($clientId);
            if (is_string($client)) return $client;
            $deleted = $client->delete();

            return $client;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
