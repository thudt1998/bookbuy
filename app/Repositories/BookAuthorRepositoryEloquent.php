<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BookAuthorRepository;
use App\Entities\BookAuthor;
use App\Validators\BookAuthorValidator;

/**
 * Class BookAuthorRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BookAuthorRepositoryEloquent extends BaseRepository implements BookAuthorRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BookAuthor::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
