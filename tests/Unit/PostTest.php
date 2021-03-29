<?php

namespace Tests\Unit;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_post() : void
    {
        Post::factory()->create();

        // saving、creating、created、saved
        collect(['saving', 'crating', 'created', 'saved'])
            ->every(function ($action) {
                $this->assertStringContainsString("${action} event is fired", $this->getActualOutputForAssertion());
            });
    }

    /** @test */
    public function it_can_destroy_post() : void
    {
        $post = Post::factory()->create();

        Post::destroy($post->id);
        // deleting、deleted
        collect(['deleting', 'deleted'])
            ->every(function ($action) {
                $this->assertStringContainsString("${action} event is fired", $this->getActualOutputForAssertion());
            });
    }

    /** @test */
    public function it_can_restore_post() : void
    {
        $post = Post::factory()->create();

        Post::destroy($post->id);

        $post = Post::withTrashed()->latest()->first();

        $post->restore();

        // restoring、saving、updating、updated、saved、restored
        collect(['restoring', 'saving', 'updating', 'updated', 'saved', 'restored'])
            ->every(function ($action) {
                $this->assertStringContainsString("${action} event is fired", $this->getActualOutputForAssertion());
            });
    }

    /** @test */
    public function it_can_force_delete_post() : void
    {
        $post = Post::factory()->create();

        $post->forceDelete();

        // deleting、deleted
        collect(['deleting', 'deleted'])
            ->every(function ($action) {
                $this->assertStringContainsString("${action} event is fired", $this->getActualOutputForAssertion());
            });
    }

    /** @test */
    public function it_can_update_post() : void
    {
        $post = Post::factory()->create();

        $post->title = 'New Title';
        $post->save();

        // saving、updating、updated、saved
        collect(['saving', 'updating', 'updated', 'saved'])
            ->every(function ($action) {
                $this->assertStringContainsString("${action} event is fired", $this->getActualOutputForAssertion());
            });
    }

    /** @test */
    public function it_can_delete_post() : void
    {
        Post::withoutGlobalScopes();

        $post = Post::factory()->create();
        Post::destroy($post->id);

        // deleting、deleted
        collect(['deleting', 'deleted'])
            ->every(function ($action) {
                $this->assertStringContainsString("${action} event is fired", $this->getActualOutputForAssertion());
            });
    }

    /** @test */
    public function it_will_break_when_the_event_return_false(): void
    {
        Post::factory()->create(['title' => 'title']);

        // saving、creating
        collect(['saving', 'crating'])
            ->every(function ($action) {
                $this->assertStringContainsString("${action} event is fired", $this->getActualOutputForAssertion());
            });

        // created、saved
        collect(['created', 'saved'])
            ->every(function ($action) {
                $this->assertStringNotContainsString("${action} event is fired", $this->getActualOutputForAssertion());
            });
    }
}
