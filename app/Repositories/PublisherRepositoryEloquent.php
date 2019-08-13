<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PublisherRepository;
use App\Entities\Publisher;
use App\Validators\PublisherValidator;

/**
 * Class PublisherRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PublisherRepositoryEloquent extends BaseRepository implements PublisherRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Publisher::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
