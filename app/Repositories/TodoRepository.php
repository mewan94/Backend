<?php
/**
 * Created by PhpStorm.
 * User: harsha
 * Date: 2/5/18
 * Time: 9:32 AM
 */

namespace App\Repositories;


use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;

class TodoRepository extends Repository
{
    public function model() {
        return 'App\Todo';
    }
}