<?php

namespace App\Features\CompanyProfile\Services;

use Graphicode\Standard\TDO\TDO;
use App\Features\CompanyProfile\Models\QuestionAnswer;

class QuestionAnswerService
{
    private static $model = QuestionAnswer::class;

    /**
     * Get All
     */
    public function getQuestionAnswers()
    {
        try {
            $questionAnswers =  self::$model::get();

            return $questionAnswers;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Create One
     */
    public function storeQuestionAnswer(TDO $tdo)
    {
        try {
            $creationData = $tdo->all();

            // manobolate the data before creation?

            $questionAnswer =  self::$model::create($creationData);

            // write any logic after creation?

            return $questionAnswer;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get One By Id
     */
    public function getQuestionAnswerById(string $questionAnswerId)
    {
        try {
            $questionAnswer =  self::$model::find($questionAnswerId);
            if (! $questionAnswer) return "No model with id $questionAnswerId";
            return $questionAnswer;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update One By Id
     */
    public function updateQuestionAnswerById(string $questionAnswerId, TDO $tdo)
    {
        try {
            $updateData = $tdo->all();

            // manobolate the data before update?

            $questionAnswer =  $this->getQuestionAnswerById($questionAnswerId);
            if (is_string($questionAnswer)) return $questionAnswer;
            $questionAnswer->update($updateData);

            // write any logic after update?

            return $questionAnswer;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Delete One By Id
     */
    public function deleteQuestionAnswerById(string $questionAnswerId)
    {
        try {

            // get model to delete by id
            $questionAnswer =  $this->getQuestionAnswerById($questionAnswerId);
            if (is_string($questionAnswer)) return $questionAnswer;
            $deleted = $questionAnswer->delete();

            return $questionAnswer;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
