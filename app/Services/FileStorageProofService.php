<?php

namespace App\Services;

use App\InsiderUser;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use RuntimeException;
use Storage;
use Illuminate\Http\Request;

class FileStorageProofService
{
    private static $PROOF_DIR = 'proof/';

    /**
     * @param InsiderUser $user
     * @param Request $request
     * @param string $fileName
     * @return bool
     * @throws FileNotFoundException
     */
    public static function putUserProofFile(InsiderUser $user, Request $request, string $fileName): bool
    {
        $proofPath = self::$PROOF_DIR . $user->id . '/';

        try {
            Storage::disk('s3')->put($proofPath . $fileName . '.jpg', $request->file($fileName)->get());
        } catch (RuntimeException $exception) {
            return false;
        }

        return true;
    }

    public static function getUserProofFile(InsiderUser $user, string $fileName)
    {
        $proofPath = self::$PROOF_DIR . $user->id . '/';

        try {
            return Storage::disk('s3')->get($proofPath . $fileName . '.jpg');
        } catch (FileNotFoundException $exception) {
            return false;
        }
    }
}
