<?php

namespace App\Features\ContactMessage\Controllers;

use App\Features\ContactMessage\Requests\StContactMessageRequest;
use App\Features\ContactMessage\Services\ContactMessageService;
use App\Features\ContactMessage\Transformers\ContactMessageResource;
use Graphicode\Standard\Facades\TDOFacade;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    use ApiResponses;


    /**
        * Inject your service in constructor
        */
    public function __construct(
        private ContactMessageService $contactMessageService
    ) {}

    /**
        * Display a listing of the resource.
        */
    public function index()
    {
        $result = $this->contactMessageService->getContactMessages();

        return $this->okResponse(
            ContactMessageResource::collection($result) ,
            "Success api call"
        );
    }

    /**
        * Store a newly created resource in storage.
        */
    public function store(StContactMessageRequest $request)
    {
        $result = $this->contactMessageService->storeContactMessage(TDOFacade::make($request));

        return $this->okResponse(
            ContactMessageResource::make($result) ,
            "Success api call"
        );
    }

    /**
        * Display the specified resource.
        */
    public function show(string $id)
    {
        $result = $this->contactMessageService->getContactMessageById($id);

        return $this->okResponse(
            ContactMessageResource::make($result) ,
            "Success api call"
        );
    }


    /**
        * Remove the specified resource from storage.
        */
    public function destroy(string $id)
    {
        $result = $this->contactMessageService->deleteContactMessageById($id);

        return $this->okResponse(
            ContactMessageResource::make($result) ,
            "Success api call"
        );
    }

    public function readAt($id)
    {
        $result = $this->contactMessageService->readAtContactMessage($id);

        return $this->okResponse(
            ContactMessageResource::make($result) ,
            "Success api call"
        );
    }
}
