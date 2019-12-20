<?php
/**
 * Created by PhpStorm.
 * User: pazgalev
 * Date: 12/20/19
 * Time: 12:20 PM
 */

namespace App\Adapters;


interface StoreSpotRepositoryInterface
{
    /**
     * Get all of the input for the request.
     *
     * @see \Illuminate\Foundation\Http\FormRequest
     * @return array
     */
    public function all();
}