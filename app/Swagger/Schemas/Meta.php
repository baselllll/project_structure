<?php
/**
 * Created by PhpStorm.
 * User: rami
 * Date: 2/13/19
 * Time: 10:59 PM
 */

namespace App\Swagger\Schemas;

/**
 * Class Meta
 *
 * @package App\Model
 *
 * @author  Rami Amr <rami.amro.ahmed@gmail.com>
 *
 * @OA\Schema(
 *     title="Meta",
 *     description="An Object containing meta data about this resource pagination",
 *     schema="Meta",
 *     @OA\Property(property="current_page"),
 *     @OA\Property(property="from",type="integer"),
 *     @OA\Property(property="last_page",type="integer"),
 *     @OA\Property(property="path",type="string"),
 *     @OA\Property(property="per_page",type="integer"),
 *     @OA\Property(property="to",type="integer"),
 *     @OA\Property(property="total",type="integer")
 * )
 */
