<?php

namespace App\Swagger\Schemas\Response\Errors;

/**
 * Class ServerError
 *
 * @package App\Model
 *
 * @author  Rami Amr <rami.amro.ahmed@gmail.com>
 *
 * @OA\Schema(
 *     title="ServerError",
 *     description="An Unexpected server error while trying to process the request ",
 *     schema="ServerError",
 *     @OA\Property(property="status",type="string",default="error"),
 *     @OA\Property(property="code",type="integer", default=500),
 *     @OA\Property(property="message",type="string")
 * )
 */
