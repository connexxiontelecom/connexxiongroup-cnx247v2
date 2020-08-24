<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
class PlanFeature extends Model
{
    //role or plan - plan-features relationship
    public function planName(){
        return $this->belongsTo(Role::class, 'plan_id');
    }

    /*
    *Currency - plan-features relationship
    */
    public function currency(){
        return $this->belongsTo(Currency::class, 'currency_id');
    }
}
