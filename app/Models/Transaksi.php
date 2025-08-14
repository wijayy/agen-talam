<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaksi extends Model
{
    /** @use HasFactory<\Database\Factories\TransaksiFactory> */
    use HasFactory, Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nomor_transaksi'
            ]
        ];
    }

    public function getRouteKeyName() {
        return 'slug';
    }

    protected $guarded = ['id'];

    public function review(): HasOne
    {
        return $this->hasOne(Review::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }

    public function scopeFilters(Builder $query, array $filters)
    {
        $query->when($filters["date"] ?? date('Y-m-d'), function ($query, $search) {
            return $query->whereDate('date', $search);
        });
    }

    public function names()
    {
        if ($this->name ?? false) {
            return $this->name;
        } else {
            return $this->user->name;
        }
    }
}
