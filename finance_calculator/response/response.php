<?php

class Response {

    public function json($status, $data = null, $message = null, $code = 200) {
        http_response_code($code);

        echo json_encode([
            'status'  => $status,
            'data'    => $data,
            'message' => $message
        ]);

        exit();
    }

    public function success($data) {
        $this->json('success', $data);
    }

    public function fail(array $message) {
        $this->json('fail', null, $message, 400);
    }

    public function notFound($message) {
        $this->json('fail', null, $message, 400);
    }

    public function methodNotAllowed($message) {
        $this->json('fail', null, $message, 400);
    }
}

echo "Hello";