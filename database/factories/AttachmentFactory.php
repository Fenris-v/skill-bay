<?php

namespace Database\Factories;

use App\Models\Attachment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttachmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Attachment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $year = (string)now()->year;

        $month = (string)now()->month;
        if (\Str::length($month) === 1) {
            $month = "0$month";
        }

        $day = (string)now()->day;
        if (\Str::length($day) === 1) {
            $day = "0$day";
        }

        $folderPath = storage_path("app/public/$year/$month/$day/");

        if (! is_dir($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        $image = $this->faker->image(
            $folderPath, 735, 434, null, false
        );

        $filePath = $folderPath . $image;

        return [
            'name' => pathinfo($image)['filename'],
            'original_name' => 'blob',
            'mime' => 'image/png',
            'extension' => 'png',
            'path' => "$year/$month/$day/",
            'user_id' => User::factory(),
            'size' => filesize($filePath),
            'hash' => sha1_file($filePath),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Attachment $attachment) {
            // FIX empty URL.
            $attachment->refresh();
        });
    }
}
