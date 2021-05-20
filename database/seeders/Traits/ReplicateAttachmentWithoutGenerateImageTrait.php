<?php

namespace Database\Seeders\Traits;

use App\Models\Attachment;
use Illuminate\Database\Eloquent\Collection;

trait ReplicateAttachmentWithoutGenerateImageTrait
{
    protected Collection $images;

    public function __construct()
    {
        $this->images = Attachment::factory(3)->create();
    }

    protected function getReplicatedAttachment()
    {
        return $this->images->random()->replicate();
    }

    protected function getRandomAttachmentId()
    {
        return $this->images->random()->id;
    }
}
