<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $notice;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    //構造関数
    public function __construct(\App\Notice $notice)
    {
        //
        $this->notice = $notice;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    //処理
    public function handle()
    {
        //ユーザーへ知らせる
        $users=\App\User::all();
        foreach ($users as $user){
            $user->addNotice($this->notice);
        }
    }
}
