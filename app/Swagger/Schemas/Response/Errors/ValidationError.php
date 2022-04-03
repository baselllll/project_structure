<?php

namespace App\Swagger\Schemas\Response\Errors;

/**
 * Class ValidationError
 *
 * @package App\Model
 *
 * @author  Rami Amr <rami.amro.ahmed@gmail.com>
 *
 * @OA\Schema(
 *     title="ValidationError",
 *     description="Validation Error, one or more field has not passed validation",
 *     schema="ValidationError",
 *     @OA\Property(property="message",type="string"),
 *     @OA\Property(property="errors",type="array",@OA\Items(type="string"))
 * )
 */
