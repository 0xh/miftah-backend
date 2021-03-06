<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @author Ibrahim Samad <naatogma@gmail.com>
 */
class Organization extends Model
{

    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'active' => 'boolean'
    ];

    /**
     * Filter active organizations
     *
     * @param [type] $query
     * @return void
     */
    public function scopeActive(Builder $query)
    {
        return $query->where('active', true);
    }
    /**
     * Who created the organization
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Organization donations
     *@return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    /**
     * Undocumented function
     *
     * @return int
     */
    public function donationSum()
    {
        return $this->donations()->sum('amount');
    }

    /**
     * Admins of the organization
     *@return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function admins()
    {
        return $this->belongsToMany(User::class, 'organization_admin', 'organization_id', 'user_id')
                ->withTimestamps()
                ->withPivot('membership');
    }
}
