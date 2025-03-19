<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TransactionFileStoreRequest;
use App\Http\Requests\Api\TransactionFileUpdateRequest;
use App\Http\Resources\Api\TransactionFileCollection;
use App\Http\Resources\Api\TransactionFileResource;
use App\Models\TransactionFile;
use Illuminate\Http\Request;

class TransactionFileController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Api\TransactionFileCollection
     */
    public function index(Request $request)
    {
        $transactionFiles = TransactionFile::all();

        return new TransactionFileCollection($transactionFiles);
    }

    /**
     * @param \App\Http\Requests\Api\TransactionFileStoreRequest $request
     * @return \App\Http\Resources\Api\TransactionFileResource
     */
    public function store(TransactionFileStoreRequest $request)
    {
        $transactionFile = TransactionFile::create($request->validated());

        return new TransactionFileResource($transactionFile);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TransactionFile $transactionFile
     * @return \App\Http\Resources\Api\TransactionFileResource
     */
    public function show(Request $request, TransactionFile $transactionFile)
    {
        return new TransactionFileResource($transactionFile);
    }

    /**
     * @param \App\Http\Requests\Api\TransactionFileUpdateRequest $request
     * @param \App\Models\TransactionFile $transactionFile
     * @return \App\Http\Resources\Api\TransactionFileResource
     */
    public function update(TransactionFileUpdateRequest $request, TransactionFile $transactionFile)
    {
        $transactionFile->update($request->validated());

        return new TransactionFileResource($transactionFile);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TransactionFile $transactionFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TransactionFile $transactionFile)
    {
        $transactionFile->delete();

        return response()->noContent();
    }
}
