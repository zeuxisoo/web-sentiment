<?php
use Dingo\Api\Routing\ControllerTrait;

class BaseAPIController extends BaseController {

    use ControllerTrait;

    public function sendMessage($message='ok', $status=200, $data=[]) {
        $reply = [
            'message'     => $message,
            'status_code' => $status,
        ];

        if (empty($data) === false) {
            $reply['data'] = $data;
        }

        return $this->response->array($reply)->setStatusCode($status);
    }

    public function sendError($message, $status=500) {
        return $this->sendMessage($message, $status);
    }

    public function sendOK($message, $status=200) {
        return $this->sendMessage($message, $status);
    }

}
