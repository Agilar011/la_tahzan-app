<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, mixed>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'phone' => ['nullable', 'string', 'max:15'], // aturan validasi untuk nomor telepon
            'address' => ['nullable', 'string', 'max:255'], // aturan validasi untuk alamat
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        $userData = [
            'name' => $input['name'],
            'email' => $input['email'],
        ];

        if (isset($input['phone'])) {
            $userData['phone'] = $input['phone'];
        }

        if (isset($input['address'])) {
            $userData['address'] = $input['address'];
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill($userData)->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $userData = [
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ];

        if (isset($input['phone'])) {
            $userData['phone'] = $input['phone'];
        }

        if (isset($input['address'])) {
            $userData['address'] = $input['address'];
        }

        $user->forceFill($userData)->save();

        $user->sendEmailVerificationNotification();
    }
}
