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

    public function update($userId, Request $request)
    {
        $this->validate($request, [
            'group_id' => 'required|exists:groups,id',
            'studentID' => 'required|min:6|max:6',
        ]);

        $profile = User::findOrFail($userId)->universityProfile;

        $data = $request->only($profile->getFillable());

        $data['user_id'] = $userId;

        $profile->update($data);

        notificate(trans('Профиль обновлен'));

        return response()->json(true);
    }
}
