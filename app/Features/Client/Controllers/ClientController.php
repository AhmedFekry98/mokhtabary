<?php

namespace App\Features\Client\Controllers;

use App\Features\Client\Requests\UpClientrequest;
use App\Features\Client\Services\ClientService;
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
        return $this->okResponse(
           ClientResource::collection($result),
            "Success api call"
        );
    }

    /**
        * Display the specified resource.
        */
    public function show(string $id)
    {
        $result = $this->clientService->getClientById($id);
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
        return $this->okResponse(
            ClientResource::make($result),
            "Success api call"
        );
    }
}
