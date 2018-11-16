<?php
/**
 * Created by PhpStorm.
 * User: dalius
 * Date: 18.11.16
 * Time: 07.59
 */

namespace AppBundle\Service;

interface FileMover
{
    public function move($fromLocation, $toLocation);
}