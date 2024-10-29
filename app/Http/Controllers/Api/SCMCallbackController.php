<?php

namespace App\Http\Controllers\Api;

use App\Http\Validators\Api\SCMCallbackValidator;
use App\Jobs\SCMCallback;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SCMCallbackController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function callback(Request $request): JsonResponse
    {
        // check keys
        if (!$request->hasHeader(config('api.scm.key')) || $request->headers->get(config('api.scm.key')) !== config('api.scm.value')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // check data
        $validateUserChange = new SCMCallbackValidator();
        $validator = $validateUserChange->validate($request);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // add2queue
        SCMCallback::dispatch($request->input('payload'))->onQueue('scm-callback');

        return response()->json(['success'], 200);
    }
}
