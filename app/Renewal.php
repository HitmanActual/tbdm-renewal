<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Renewal extends Model
{
    
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subscription_fees', 'start_date','end_date','remaining_days','user_id',
    ];

    public function getRemainingDaysAttribute()
    {

        if ($this->end_date) {
            $remaining_days = Carbon::now()->diffInDays(Carbon::parse($this->end_date));
        } else {
            //--don't forget to deactivate trhe user :D
            $remaining_days = 0;
        }

        
        return $remaining_days;
    }

}