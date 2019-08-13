<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BookRepository;
use App\Entities\Book;
use App\Validators\BookValidator;

/**
 * Class BookRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BookRepositoryEloquent extends BaseRepository implements BookRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Book::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return BookValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
