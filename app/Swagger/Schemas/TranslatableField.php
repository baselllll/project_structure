<?php
/**
 * Created by PhpStorm.
 * User: rami
 * Date: 2/13/19
 * Time: 10:59 PM
 */

use OpenApi\Annotations as OA;

/**
 * Class TranslatableField
 *
 * @package App\Model
 *
 * @author  Rami Amr <rami.amro.ahmed@gmail.com>
 *
 * @OA\Schema(
 *     title="TranslatableField",
 *     description="An Object that contains translations for a field",
 *     schema="TranslatableField",
 *     @OA\Property(property="en",type="string"),
 *     @OA\Property(property="ar",type="string")
 * )
 */
