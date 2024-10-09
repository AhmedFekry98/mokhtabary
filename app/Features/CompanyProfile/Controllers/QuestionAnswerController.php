<?php

namespace App\Features\CompanyProfile\Controllers;

use App\Features\CompanyProfile\Requests\StQuestionAnswerRequest;
use App\Features\CompanyProfile\Requests\UpQuestionAnswerRequest;
use App\Features\CompanyProfile\Services\QuestionAnswerService;
use Graphicode\Standard\Facades\TDOFacade;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class QuestionAnswerController extends Controller
{
    use ApiResponses;


    /**
        * Inject your service in constructor
        */
    public function __construct(
        private QuestionAnswerService $questionAnswerService
    ) {}

    /**
        * Display a listing of the resource.
        */
    public function index()
    {
        $result = $this->questionAnswerService->getQuestionAnswers();
        return $this->okResponse(
            $result,
            "Success api call"
        );
    }

    /**
        * Store a newly created resource in storage.
        */
    public function store(StQuestionAnswerRequest $request)
    {
        $result = $this->questionAnswerService->storeQuestionAnswer(TDOFacade::make($request));
        return $this->okResponse(
            $result,
            "Success api call"
        );
    }

    /**
        * Display the specified resource.
        */
    public function show(string $id)
    {
        $result = $this->questionAnswerService->getQuestionAnswerById($id);
        return $this->okResponse(
            $result,
            "Success api call"
        );
    }

    /**
        * Update the specified resource in storage.
        */
    public function update(UpQuestionAnswerRequest $request, string $id)
    {
        $result = $this->questionAnswerService->updateQuestionAnswerById($id,TDOFacade::make($request));
        return $this->okResponse(
            $result,
            "Success api call"
        );
    }

    /**
        * Remove the specified resource from storage.
        */
    public function destroy(string $id)
    {
        $result = $this->questionAnswerService->deleteQuestionAnswerById($id);
        return $this->okResponse(
            $result,
            "Success api call"
        );
    }
}
