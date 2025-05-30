<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Services\Students\StudentsService;

use App\Http\Requests\Students\ShowRequest;
use App\Http\Requests\Students\IndexRequest;
use App\Http\Requests\Students\StoreRequest;
use App\Http\Requests\Students\UpdateRequest;
use App\Http\Requests\Students\DestroyRequest;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class StudentsController extends Controller
{
    public function __construct(public StudentsService $service)
    {
    }

    public function index(IndexRequest $request)
    {
        try {
            // $this->authorize('index', User::class);
            $admin = $this->service->index($request);
            DB::commit();
            return rp_response($admin, __('DataFetchedSuccessfully'), Response::HTTP_OK);
            // } catch (AuthorizationException $e) {
            //     return rp_response([], __('NotAcess'), Response::HTTP_FORBIDDEN);
        } catch (\Exception $ex) {
            return rp_response([], __('FailureProcess'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StoreRequest $request)
    {
        DB::beginTransaction();
        try {
            // $this->authorize('store', User::class);
            $admin = $this->service->store($request);
            DB::commit();
            return rp_response($admin, __('DataStoredSuccessfully'), Response::HTTP_CREATED);
            // } catch (AuthorizationException $e) {
            //     return rp_response([], __('NotAcess'), Response::HTTP_FORBIDDEN);
        } catch (\Exception $ex) {
            DB::rollback();
            return rp_response([], __('FailureProcess'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(ShowRequest $request)
    {
        try {
            // $this->authorize('show', User::class);
            $admin = $this->service->show($request);
            DB::commit();
            return rp_response($admin, __('DataFetchedSuccessfully'), Response::HTTP_OK);
            // } catch (AuthorizationException $e) {
            //     return rp_response([], __('NotAcess'), Response::HTTP_FORBIDDEN);
        } catch (\Exception $ex) {
            return rp_response([], __('FailureProcess'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            // $this->authorize('update', User::class);
            $admin = $this->service->update($request);
            DB::commit();
            return rp_response($admin, __('DataUpdatedSuccessfully'), Response::HTTP_OK);
            // } catch (AuthorizationException $e) {
            //     return rp_response([], __('NotAcess'), Response::HTTP_FORBIDDEN);
        } catch (\Exception $ex) {
            DB::rollback();
            return rp_response([], __('FailureProcess'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(DestroyRequest $request)
    {
        DB::beginTransaction();
        try {
            // $this->authorize('destroy', User::class);
            $admin = $this->service->destroy($request);
            DB::commit();
            return rp_response($admin, __('DataDeletedSuccessfully'), Response::HTTP_OK);
            // } catch (AuthorizationException $e) {
            //     return rp_response([], __('NotAcess'), Response::HTTP_FORBIDDEN);
        } catch (\Exception $ex) {
            DB::rollback();
            return rp_response([], __('FailureProcess'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
