<?php

namespace Tests\Feature\Actions\Item;

use App\Actions\Item\StoreItemImage;
use App\Models\Item;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Tests\WithDb;

class StoreItemImageTest extends TestCase
{
    use WithDb;

    protected $action;
    protected $uploadedFile;

    public function setUp(): void
    {
        parent::setUp();

        // Storage::fake('s3');
        $this->action       = app(StoreItemImage::class);
        $this->uploadedFile = UploadedFile::fake()->image('dummy.jpg');
    }

    public function testUploadFile()
    {
        $item = Item::factory()->create();

        $image   = $this->action->execute($item, $this->uploadedFile);
        $img_url = str_replace('/storage', 'public', $image->img_url);
        Storage::assertExists($img_url);
    }

    // img_url がすでにある場合は削除して、新しいurlが入っているかの確認
    public function testWhenFileExists()
    {
        $item = Item::factory()->create([
            'img_url' => '/storage/images/dummy.jpg',
        ]);

        $image   = $this->action->execute($item, $this->uploadedFile);
        $img_url = str_replace('/storage', 'public', $image->img_url);
        $this->assertDatabaseMissing('items', [
            'img_url' => '/storage/images/dummy.jpg',
        ]);
        Storage::assertExists($img_url);
    }
}
