<?php

namespace App\Features\Client\Controllers;

use App\Features\Client\Requests\UpClientrequest;
use App\Features\Client\Services\ClientService;
use App\Features\Client\Transformers\ClientCollection;
use App\Features\Client\Transformers\ClientResource;
use Graphicode\Standard\Facades\TDOFacade;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    use ApiResponses;


    /**
        * Inject your service in constructor
        */
    public function __construct(
        private ClientService $clientService
    ) {}

    /**
        * Display a listing of the resource.
        */
    public function index()
    {
        $result = $this->clientService->getClients();
        if(is_string($result)){
            return $this->badResponse($result);
        }
        return $this->okResponse(
           ClientCollection::make($result),
            "Success api call"
        );
    }

    /**
        * Display the specified resource.
        */
    public function show(string $id)
    {
        $result = $this->clientService->getClientById($id);
        if(is_string($result)){
            return $this->badResponse($result);
        }
        return $this->okResponse(
            ClientResource::make($result),
            "Success api call"
        );
    }

    /**
        * Update the specified resource in storage.
    */
    public function update(UpClientrequest $request, string $id)
    {
        $result = $this->clientService->updateClientById($id,TDOFacade::make($request));
        if(is_string($result)){
            return $this->badResponse($result);
        }
        return $this->okResponse(
            ClientResource::make($result),
            "Success api call"
        );
    }

    /**
        * Remove the specified resource from storage.
    */
    public function destroy(string $id)
    {
        $result = $this->clientService->deleteClientById($id);
        if(is_string($result)){
            return $this->badResponse($result);
        }
        return $this->okResponse(
            ClientResource::make($result),
            "Success api call"
        );
    }
}
