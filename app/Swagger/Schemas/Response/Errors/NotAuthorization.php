<?php

namespace App\Swagger\Schemas\Response\Errors;

/**
 * Class NotAuthorized
 *
 * @package App\Model
 *
 * @author  Rami Amr <rami.amro.ahmed@gmail.com>
 *
 * @OA\Schema(
 *     title="NotAuthorized",
 *     description="Not Authorization Error, Current user is not authorized to perform this action",
 *     schema="NotAuthorized",
 *     @OA\Property(property="status",type="string",default="error"),
 *     @OA\Property(property="code",type="integer",default="403"),
 *     @OA\Property(property="message",type="string"),
 * )
 */
