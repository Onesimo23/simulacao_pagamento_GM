<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'payment_method',
        'amount',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relacionamento com User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scopes para filtrar por status
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    /**
     * Getter para exibir método de pagamento formatado
     */
    public function getPaymentMethodLabelAttribute()
    {
        $methods = [
            'visa' => 'Cartão Visa',
            'm_pesa' => 'M-Pesa',
            'e_mola' => 'E-mola',
        ];

        return $methods[$this->payment_method] ?? $this->payment_method;
    }

    /**
     * Getter para status formatado
     */
    public function getStatusLabelAttribute()
    {
        $statuses = [
            'pending' => 'Pendente',
            'completed' => 'Concluído',
            'failed' => 'Falhou',
            'cancelled' => 'Cancelado',
        ];

        return $statuses[$this->status] ?? $this->status;
    }

    /**
     * Getter para cor do status (Bootstrap)
     */
    public function getStatusColorAttribute()
    {
        $colors = [
            'pending' => 'warning',
            'completed' => 'success',
            'failed' => 'danger',
            'cancelled' => 'secondary',
        ];

        return $colors[$this->status] ?? 'secondary';
    }
}
