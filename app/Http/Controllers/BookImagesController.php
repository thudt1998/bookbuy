<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\BookImageCreateRequest;
use App\Http\Requests\BookImageUpdateRequest;
use App\Repositories\BookImageRepository;
use App\Validators\BookImageValidator;

/**
 * Class BookImagesController.
 *
 * @package namespace App\Http\Controllers;
 */
class BookImagesController extends Controller
{
    /**
     * @var BookImageRepository
     */
    protected $repository;

    /**
     * @var BookImageValidator
     */
    protected $validator;

    /**
     * BookImagesController constructor.
     *
     * @param BookImageRepository $repository
     * @param BookImageValidator $validator
     */
    public function __construct(BookImageRepository $repository, BookImageValidator $validator)
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
        $bookImages = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $bookImages,
            ]);
        }

        return view('bookImages.index', compact('bookImages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BookImageCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(BookImageCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $bookImage = $this->repository->create($request->all());

            $response = [
                'message' => 'BookImage created.',
                'data'    => $bookImage->toArray(),
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
        $bookImage = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $bookImage,
            ]);
        }

        return view('bookImages.show', compact('bookImage'));
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
        $bookImage = $this->repository->find($id);

        return view('bookImages.edit', compact('bookImage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BookImageUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(BookImageUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $bookImage = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'BookImage updated.',
                'data'    => $bookImage->toArray(),
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
                'message' => 'BookImage deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'BookImage deleted.');
    }
}
