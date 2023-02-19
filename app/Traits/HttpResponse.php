<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait HttpResponse
{
    /**
     * send200Response
     *
     * @param  mixed  $data
     */
    public function send200Response($data = null)
    {
        return $this->getResponse(Response::HTTP_OK, 'OK', $data);
    }

    /**
     * send201Response
     *
     * @param  mixed  $data
     */
    public function send201Response($data = null)
    {
        return $this->getResponse(Response::HTTP_CREATED, 'CREATED', $data);
    }

    /**
     * send202Response
     *
     * @param  mixed  $data
     */
    public function send202Response($data = null)
    {
        return $this->getResponse(Response::HTTP_ACCEPTED, 'ACCEPTED', $data);
    }

    /**
     * send400Response
     *
     * @param  mixed  $data
     */
    public function send400Response($data = null)
    {
        return $this->getResponse(Response::HTTP_BAD_REQUEST, 'BAD REQUEST', $data);
    }

    /**
     * send401Response
     *
     * @param  mixed  $data
     */
    public function send401Response($data = null)
    {
        return $this->getResponse(Response::HTTP_UNAUTHORIZED, 'UNAUTHORIZED', $data);
    }

    /**
     * send403Response
     *
     * @param  mixed  $data
     */
    public function send403Response($data = null)
    {
        return $this->getResponse(Response::HTTP_FORBIDDEN, 'FORBIDDEN', $data);
    }

    /**
     * send404Response
     *
     * @param  mixed  $data
     */
    public function send404Response($data = null)
    {
        return $this->getResponse(Response::HTTP_NOT_FOUND, 'NOT FOUND', $data);
    }

    /**
     * send404Response
     *
     * @param  mixed  $data
     */
    public function send409Response($data = null)
    {
        return $this->getResponse(Response::HTTP_CONFLICT, 'CONFLICT', $data);
    }

    /**
     * send422Response
     *
     * @param  mixed  $data
     */
    public function send422Response($data = null)
    {
        return $this->getResponse(Response::HTTP_UNPROCESSABLE_ENTITY, 'UNPROCESSABLE ENTITY', $data);
    }

    /**
     * getResponse
     *
     * @param  mixed  $code
     * @param  mixed  $message
     * @param  mixed  $data
     * @return JsonResponse
     */
    public function getResponse($code, string $message, $data = null)
    {
        if($code < 100 || $code > 599)
        {
            $code = Response::HTTP_UNPROCESSABLE_ENTITY;
            $message = 'UNPROCESSABLE ENTITY';
            $data = ['message' => 'Unexpected Eror'];
        }

        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public function Valid($model, $id, $msg)
    {
        $result = $model::where('id', $id)->get();
        if ($result->isEmpty()) {
            return $this->send400Response(['message' => $msg]);
        }else{
            return $this->send200Response("OK");
        }
    }
}
