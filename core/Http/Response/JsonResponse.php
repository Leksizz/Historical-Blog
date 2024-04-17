<?php

namespace App\Core\Http\Response;

class JsonResponse extends Response
{
    private int $options;
    private int $code;

    public function __construct(array $data = null, int $code = 200, int $options = 0)
    {
        $this->options = $options;
        $this->code = $code;
        if ($data !== null) {
            $this->setJson($data);
        }

    }

    private function setJson(array $data): void
    {
        $this->setResponseCode($this->code);
        $this->setHeaders(['Content-Type' => 'application/json']);
        $this->update($data);
    }

    private function update(array $data): void
    {
        $json = json_encode($data, $this->options);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new \InvalidArgumentException(json_last_error_msg());
        }

        $this->setContent($json);
    }

}