<?php

namespace App\Swagger\Schemas\Response\Errors;

/**
 * Class NotFound
 *
 * @package App\Model
 *
 * @author  Rami Amr <rami.amro.ahmed@gmail.com>
 *
 * @OA\Schema(
 *     title="NotFound",
 *     description="Resource Not Found",
 *     schema="NotFound",
 *     @OA\Property(property="status",type="string",default="error"),
 *     @OA\Property(property="code",type="integer", default="404"),
 *     @OA\Property(property="message",type="string")
 * )
 */
