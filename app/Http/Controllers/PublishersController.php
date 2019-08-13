<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PublisherCreateRequest;
use App\Http\Requests\PublisherUpdateRequest;
use App\Repositories\PublisherRepository;
use App\Validators\PublisherValidator;

/**
 * Class PublishersController.
 *
 * @package namespace App\Http\Controllers;
 */
class PublishersController extends Controller
{
    /**
     * @var PublisherRepository
     */
    protected $repository;

    /**
     * @var PublisherValidator
     */
    protected $validator;

    /**
     * PublishersController constructor.
     *
     * @param PublisherRepository $repository
     * @param PublisherValidator $validator
     */
    public function __construct(PublisherRepository $repository, PublisherValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $publishers = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $publishers,
            ]);
        }

        return view('publishers.index', compact('publishers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PublisherCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PublisherCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $publisher = $this->repository->create($request->all());

            $response = [
                'message' => 'Publisher created.',
                'data'    => $publisher->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $publisher = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $publisher,
            ]);
        }

        return view('publishers.show', compact('publisher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $publisher = $this->repository->find($id);

        return view('publishers.edit', compact('publisher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PublisherUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PublisherUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $publisher = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Publisher updated.',
                'data'    => $publisher->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Publisher deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Publisher deleted.');
    }
}
