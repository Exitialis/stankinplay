<?php

namespace App\Http\Controllers\Api\User\Profiles;

use App\Models\UniversityProfile;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UniversityProfileController extends Controller
{
    public function lists()
    {
        $profiles = UniversityProfile::paginate(10);

        return response()->json($profiles);
    }

    /**
     * Получить профиль пользователя.
     *
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($userId)
    {
        $profile = User::findOrFail($userId)->universityProfile()->with(['group'])->first();

        return response()->json(compact('profile'));
    }
}
