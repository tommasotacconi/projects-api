<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    public const ORDERED_NAMES = [
        'HTML',
        'CSS',
        'SCSS',
        'Javascript',
        'Vue',
        'React',
        'Node.js',
        'Express',
        'EJS',
        'PHP',
        'Laravel',
        'MySQL',
        'Kotlin',
        'Java',
        'React Native',
        'WordPress',
    ];

		protected $fillable = [
			'name',
		];

		public function scopeOrdered($query)
		{
			$orderCases = collect(self::ORDERED_NAMES)
				->map(fn ($technology, $index) => "WHEN '{$technology}' THEN {$index}")
				->implode(' ');

			return $query
				->orderByRaw("CASE technologies.name {$orderCases} ELSE 999 END")
				->orderBy('technologies.name');
		}

		public function projects() {
			return $this->belongsToMany(Project::class);
		}
}
