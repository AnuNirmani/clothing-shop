<?php

namespace App\Models;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
    ];

    public static function getValue(string $key, ?string $default = null): ?string
    {
        return static::where('key', $key)->value('value') ?? $default;
    }

    public static function setValue(string $key, ?string $value): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }

    public static function saveHeroMedia(?UploadedFile $heroImage, ?UploadedFile $heroVideo, ?int $userId = null): void
    {
        DB::transaction(function () use ($heroImage, $heroVideo, $userId) {
            if ($heroImage) {
                $imagePath = $heroImage->store('site', 'public');

                static::setValue('home_hero_image', $imagePath);

                SiteMedia::where('media_type', 'image')
                    ->where('is_active', true)
                    ->update(['is_active' => false]);

                SiteMedia::create([
                    'media_type' => 'image',
                    'media_path' => $imagePath,
                    'is_active' => true,
                    'uploaded_by' => $userId,
                ]);
            }

            if ($heroVideo) {
                $videoPath = $heroVideo->store('site', 'public');

                static::setValue('home_hero_video', $videoPath);

                SiteMedia::where('media_type', 'video')
                    ->where('is_active', true)
                    ->update(['is_active' => false]);

                SiteMedia::create([
                    'media_type' => 'video',
                    'media_path' => $videoPath,
                    'is_active' => true,
                    'uploaded_by' => $userId,
                ]);
            }
        });
    }
}
