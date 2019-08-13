<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BookImageRepository;
use App\Entities\BookImage;
use App\Validators\BookImageValidator;

/**
 * Class BookImageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BookImageRepositoryEloquent extends BaseRepository implements BookImageRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BookImage::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
