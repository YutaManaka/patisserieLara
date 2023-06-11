<?php

namespace Tests\Feature\Actions\Category;

use App\Actions\Category\StoreCategoryImage;
use App\Models\Category;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Tests\WithDb;

class StoreCategoryImageTest extends TestCase
{
    use WithDb;

    protected $action;
    protected $uploadedFile;

    public function setUp(): void
    {
        parent::setUp();

        // Storage::fake('s3');
        $this->action       = app(StoreCategoryImage::class);
        $this->uploadedFile = UploadedFile::fake()->image('dummy.jpg');
    }

    public function testUploadFile()
    {
        $category = Category::create([
            'name' => 'カテゴリ名',
        ]);

        $image   = $this->action->execute($category, $this->uploadedFile);
        $img_url = str_replace('/storage', 'public', $image->img_url);
        Storage::assertExists($img_url);
    }

    // img_url がすでにある場合は削除して、新しいurlが入っているかの確認
    public function testWhenFileExists()
    {
        $category = Category::create([
            'name'    => 'カテゴリ名',
            'img_url' => '/storage/images/dummy.jpg',
        ]);

        $image   = $this->action->execute($category, $this->uploadedFile);
        $img_url = str_replace('/storage', 'public', $image->img_url);
        $this->assertDatabaseMissing('categories', [
            'img_url' => '/storage/images/dummy.jpg',
        ]);
        Storage::assertExists($img_url);
    }
}
