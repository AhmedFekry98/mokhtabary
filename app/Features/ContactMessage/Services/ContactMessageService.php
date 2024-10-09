<?php

namespace App\Features\ContactMessage\Services;

use Graphicode\Standard\TDO\TDO;
use App\Features\ContactMessage\Models\ContactMessage;

class ContactMessageService
{
    private static $model = ContactMessage::class;

    /**
     * Get All
     */
    public function getContactMessages()
    {
        try {
            $contactMessages =  self::$model::get();

            return $contactMessages;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Create One
     */
    public function storeContactMessage(TDO $tdo)
    {
        try {
            $creationData = $tdo->all();

            // manobolate the data before creation?

            $contactMessage =  self::$model::create($creationData);

            //  check file to add it in media
            $file = $tdo->file ?? null;
            
            if ($file ) {
                $contactMessage->addMedia($file)->toMediaCollection('file');
            }

          

            return $this->getContactMessageById($contactMessage->id) ;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get One By Id
     */
    public function getContactMessageById(string $contactMessageId)
    {
        try {
            $contactMessage =  self::$model::find($contactMessageId);
            if (! $contactMessage) return "No model with id $contactMessageId";
            return $contactMessage;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Delete One By Id
     */
    public function deleteContactMessageById(string $contactMessageId)
    {
        try {
            
            // get model to delete by id
            $contactMessage =  $this->getContactMessageById($contactMessageId);
            if (is_string($contactMessage)) return $contactMessage;
            $deleted = $contactMessage->delete();

            return $contactMessage;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function readAtContactMessage(string $contactMessageId)
    {
        try {
            // get model to Read At by id
            $contactMessage =  $this->getContactMessageById($contactMessageId);
            if (is_string($contactMessage)) return $contactMessage;
            $contactMessage->read_at = now();
            $contactMessage->save();
            return $this->getContactMessageById($contactMessageId);
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
