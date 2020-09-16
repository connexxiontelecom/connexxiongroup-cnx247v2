<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //fillable
    protected $fillable = [
        'company_name',
        'company_email',
        'company_phone',
        'company_address',
        'industry',
        'team_size',
        'first_name',
        'email_address',
        'position',
        'mobile_no',
        'comment',
        'tenant_id',
        'added_by',
        'slug'
    ];
    public function orderSupplier(){
        return $this->hasMany(PurchaseOrder::class, 'supplier_id');
    }
    public function supplierIndustry(){
        return $this->belongsTo(Industry::class, 'industry');
    }



/*     public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = substr(sha1(time()), 26,40);
    } */

/*     public function setAddedByAttribute($value)
    {
        $this->attributes['added_by'] = Auth::user()->id;
    }

    public function setTenantIdAttribute($value)
    {
        $this->attributes['tenant_id'] = Auth::user()->tenant_id;
    } */
}
