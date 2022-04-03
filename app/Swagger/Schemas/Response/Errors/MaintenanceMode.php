<?php
/**
 * Created by PhpStorm.
 * User: rami
 * Date: 2/13/19
 * Time: 10:59 PM
 */

namespace App\Swagger\Schemas\Response\Errors;

/**
 * Class MaintenanceMode
 *
 * @package App\Model
 *
 * @author  Rami Amr <rami.amro.ahmed@gmail.com>
 *
 * @OA\Schema(
 *      title="MaintenanceMode",
 *      description="Server is currently in maintenance mode/updating",
 *      schema="MaintenanceMode",
 *      @OA\Property(property="status",type="string",default="error"),
 *      @OA\Property(property="code",type="integer",default=503),
 *      @OA\Property(property="message",type="string"),
 * )
 */
