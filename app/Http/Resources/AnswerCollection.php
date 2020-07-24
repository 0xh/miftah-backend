<?php

namespace App\Http\Resources;

use App\Http\Resources\Detail\AnswerResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @author Ibrahim Samad <naatogma@gmail.com>
 */
class AnswerCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => AnswerResource::collection($this->collection),
        ];
    }
}
