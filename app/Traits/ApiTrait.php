<?php

namespace App\Traits;

trait ApiTrait {

    public function parseEndpoint($arrData, $intStatus) {
        return response()->json([
            ['status' => $intStatus],
            $arrData
        ],$intStatus);
    }

    public function parseValidatorResponse($arrMessages) {
        return $this->parseEndpoint([
            'type' => 'errors',
            $arrMessages
        ],400);
    }

    public function catchException(\Exception $e) {
        error_log($e->getMessage());
        error_log($e->getTraceAsString());
        return $this->parseEndpoint([
            'type' => 'danger',
            'message' => $e->getMessage()
        ],500);
    }
}
