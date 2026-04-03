<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Platform;
use App\Models\Service;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Tạo Nền tảng
        $fb = Platform::create(['name' => 'Facebook', 'slug' => 'facebook', 'icon' => 'facebook-f', 'sort' => 1]);
        $tk = Platform::create(['name' => 'TikTok', 'slug' => 'tiktok', 'icon' => 'tiktok', 'sort' => 2]);

        // 2. Tạo Phân loại
        $fb_like = Category::create([
            'platform_id' => $fb->id,
            'name' => 'Tăng Like Bài Viết',
            'slug' => 'fb-like-post',
            'sort' => 1
        ]);
        
        $tk_follow = Category::create([
            'platform_id' => $tk->id,
            'name' => 'Tăng Follow TikTok',
            'slug' => 'tk-follow',
            'sort' => 1
        ]);

        // 3. Tạo Dịch vụ
        Service::create([
            'category_id' => $fb_like->id,
            'name' => 'Like Siêu Tốc - (Bảo hành 30 ngày)',
            'description' => 'Tốc độ 10k/ngày. Không tụt. Bảo hành vĩnh viễn.',
            'price' => 15000, // 15k / 1000 like
            'min' => 100,
            'max' => 50000,
            'sort' => 1
        ]);

        Service::create([
            'category_id' => $tk_follow->id,
            'name' => 'Follow Global - (Tốc độ cao)',
            'description' => 'Lên ngay sau 5 phút. Tối đa 1 triệu follow.',
            'price' => 45000, // 45k / 1000 follow
            'min' => 50,
            'max' => 1000000,
            'sort' => 1
        ]);
    }
}
