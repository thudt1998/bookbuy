<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\BookAuthorCreateRequest;
use App\Http\Requests\BookAuthorUpdateRequest;
use App\Repositories\BookAuthorRepository;
use App\Validators\BookAuthorValidator;

/**
 * Class BookAuthorsController.
 *
 * @package namespace App\Http\Controllers;
 */
class BookAuthorsController extends Controller
{
    /**
     * @var BookAuthorRepository
     */
    protected $repository;

    /**
     * @var BookAuthorValidator
     */
    protected $validator;

    /**
     * BookAuthorsController constructor.
     *
     * @param BookAuthorRepository $repository
     * @param BookAuthorValidator $validator
     */
    public function __construct(BookAuthorRepository $repository, BookAuthorValidator $validator)
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
        $bookAuthors = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $bookAuthors,
            ]);
        }

        return view('bookAuthors.index', compact('bookAuthors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BookAuthorCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(BookAuthorCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $bookAuthor = $this->repository->create($request->all());

            $response = [
                'message' => 'BookAuthor created.',
                'data'    => $bookAuthor->toArray(),
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
        $bookAuthor = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $bookAuthor,
            ]);
        }

        return view('bookAuthors.show', compact('bookAuthor'));
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
        $bookAuthor = $this->repository->find($id);

        return view('bookAuthors.edit', compact('bookAuthor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BookAuthorUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(BookAuthorUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $bookAuthor = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'BookAuthor updated.',
                'data'    => $bookAuthor->toArray(),
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
                'message' => 'BookAuthor deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'BookAuthor deleted.');
    }
}
