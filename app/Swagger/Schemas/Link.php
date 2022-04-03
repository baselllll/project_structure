<?php
/**
 * Created by PhpStorm.
 * User: rami
 * Date: 2/13/19
 * Time: 10:59 PM
 */

namespace App\Swagger\Schemas;

/**
 * Class Link
 *
 * @package App\Model
 *
 * @author  Rami Amr <rami.amro.ahmed@gmail.com>
 *
 * @OA\Schema(
 *     title="Link",
 *     description="An object containing urls to first,last,prev,next urls for resource pagination",
 *     schema="Link",
 *     @OA\Property(property="first",type="string"),
 *     @OA\Property(property="last",type="string"),
 *     @OA\Property(property="prev",type="string"),
 *     @OA\Property(property="next",type="string")
 * )
 */
