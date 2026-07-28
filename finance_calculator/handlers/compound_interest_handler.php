<?php

class CompoundInterestHandler {

    public function calculate() {


        $params = json_decode(file_get_contents('php://input'), true);


        $errors = Validator::validateAll([
            ['principal', null, ['required', 'number', 'positive']],
            ['rate',      null, ['required', 'number', 'positive']],
            ['time',      null, ['required', 'number', 'positive']],
        ], $params);

        if (!empty($errors)) {
            $response->fail($errors);
        }


        $result = FinanceService::compoundInterest(
            $params['principal'],
            $params['rate'],
            $params['time']
        );

        (new Response())->success($result);;
    }
}
