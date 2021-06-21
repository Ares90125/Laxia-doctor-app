<?php

namespace App\Observers;

use App\Models\Diary;

class DiaryObserver
{
    /**
     * Handle the diary "created" event.
     *
     * @param  \App\Models\Diary  $diary
     * @return void
     */
    public function created(Diary $diary)
    {
        $clinic = $diary->clinic;
        $stuff = $diary->doctor;
        if (isset($clinic)) {
            $i = 0; $sum = 0;
            foreach ($clinic->diaries()->get() as $diary)
            {
                if ($diary->ave_rate) {
                    $i++;
                    $sum += $diary->ave_rate;
                }
            }
            if ($i == 0) {
                $clinic->update(['ave_diaries_rate' => null]);
            } else {
                $clinic->update(['ave_diaries_rate' => round($sum/$i, 1)]);
            }
        }
        if (isset($stuff)) {
            $i = 0; $sum = 0;
            foreach ($stuff->diaries()->get() as $diary)
            {
                if ($diary->ave_rate) {
                    $i++;
                    $sum += $diary->ave_rate;
                }
            }
            if ($i == 0) {
                $stuff->update(['ave_diaries_rate' => null]);
            } else {
                $stuff->update(['ave_diaries_rate' => round($sum/$i, 1)]);
            }
        }
    }

    /**
     * Handle the diary "updated" event.
     *
     * @param  \App\Models\Diary  $diary
     * @return void
     */
    public function updated(Diary $diary)
    {
        $clinic = $diary->clinic;
        $stuff = $diary->doctor;
        if (isset($clinic)) {
            $i = 0; $sum = 0;
            foreach ($clinic->diaries()->get() as $diary)
            {
                if ($diary->ave_rate) {
                    $i++;
                    $sum += $diary->ave_rate;
                }
            }
            if ($i == 0) {
                $clinic->update(['ave_diaries_rate' => null]);
            } else {
                $clinic->update(['ave_diaries_rate' => round($sum/$i, 1)]);
            }
        }
        if (isset($stuff)) {
            $i = 0; $sum = 0;
            foreach ($stuff->diaries()->get() as $diary)
            {
                if ($diary->ave_rate) {
                    $i++;
                    $sum += $diary->ave_rate;
                }
            }
            if ($i == 0) {
                $stuff->update(['ave_diaries_rate' => null]);
            } else {
                $stuff->update(['ave_diaries_rate' => round($sum/$i, 1)]);
            }
        }
    }

    /**
     * Handle the diary "deleted" event.
     *
     * @param  \App\Diary  $diary
     * @return void
     */
    public function deleted(Diary $diary)
    {
        //
    }

    /**
     * Handle the diary "restored" event.
     *
     * @param  \App\Diary  $diary
     * @return void
     */
    public function restored(Diary $diary)
    {
        //
    }

    /**
     * Handle the diary "force deleted" event.
     *
     * @param  \App\Diary  $diary
     * @return void
     */
    public function forceDeleted(Diary $diary)
    {
        //
    }
}
