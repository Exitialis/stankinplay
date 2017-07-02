<?php

use App\Models\InviteUserStatus;
use Illuminate\Database\Seeder;

class InviteStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ( ! InviteUserStatus::where('status', 'accepted')->first()) {
            $accepted = new InviteUserStatus();

            $accepted->status = 'accepted';
            $accepted->display_status = 'Приглашение принято';
            $accepted->save();
        }
        if ( ! InviteUserStatus::where('status', 'decline')->first()) {
            $decline = new InviteUserStatus();

            $decline->status = 'decline';
            $decline->display_status = 'Приглашение отклонено';
            $decline->save();
        }
        if ( ! InviteUserStatus::where('status', 'sended')->first()) {
            $sended = new InviteUserStatus();

            $sended->status = 'sended';
            $sended->display_status = 'Приглашение отправлено';
            $sended->save();
        }
    }
}
