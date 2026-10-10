<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\RequestFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Request extends Model
{
    /** @use HasFactory<RequestFactory> */
    use HasFactory;

    /** @var list<string> */
    protected $fillable = [
        'title',
        'description',
        'quantity',
        'estimated_cost',
        'status',
        'approved_by',
        'decided_at',
        'request_date',
        'user_id',
        'category_id',
    ];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'request_date' => 'date',
            'decided_at' => 'datetime',
            'estimated_cost' => 'decimal:2',
            'quantity' => 'integer',
        ];
    }

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** @return BelongsTo<User, $this> */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /** @return BelongsTo<Category, $this> */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
