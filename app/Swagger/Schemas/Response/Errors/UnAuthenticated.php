<?php

namespace App\Swagger\Schemas\Response\Errors;

/**
 * Class UnAuthenticated
 *
 * @package App\Model
 *
 * @author  Rami Amr <rami.amro.ahmed@gmail.com>
 *
 * @OA\Schema(
 *     title="UnAuthenticated",
 *     description="Authentication Error, Provided Token might by expired/invalid or not supplied",
 *     schema="UnAuthenticated",
 *     @OA\Property(property="status",type="string",default="error"),
 *     @OA\Property(property="code",type="integer",default=401),
 *     @OA\Property(property="message",type="string")
 * )
 */
