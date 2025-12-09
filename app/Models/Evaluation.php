<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'judge_id',
        'project_id',
        'score_innovacion',
        'score_funcionalidad',
        'score_diseno',
        'score_presentacion',
        'total_score',
        'comments',
    ];

    protected $casts = [
        'score_innovacion' => 'decimal:2',
        'score_funcionalidad' => 'decimal:2',
        'score_diseno' => 'decimal:2',
        'score_presentacion' => 'decimal:2',
        'total_score' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($evaluation) {
            $evaluation->total_score = round((
                $evaluation->score_innovacion +
                $evaluation->score_funcionalidad +
                $evaluation->score_diseno +
                $evaluation->score_presentacion
            ) / 4, 2);
        });
    }

    public function judge()
    {
        return $this->belongsTo(User::class, 'judge_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function esExcelente()
    {
        return $this->total_score >= 9;
    }

    public function getCategoria()
    {
        if ($this->total_score >= 9) return 'Excelente';
        if ($this->total_score >= 7) return 'Bueno';
        if ($this->total_score >= 5) return 'Regular';
        return 'Deficiente';
    }
}