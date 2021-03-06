<?php

/*
 * This file is part of Laravel Eloquent Flag.
 *
 * (c) Sivan Wolberg <sivan@wolberg.pro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Cog\Tests\Flag\Unit\Traits\Classic;

use Cog\Tests\Flag\Stubs\Models\Classic\EntityWithCommentAt;
use Cog\Tests\Flag\TestCase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;

final class HasCommentAtHelpersTest extends TestCase
{
    /** @test */
    public function it_casts_commentable_at_to_datetime(): void
    {
        $entity = factory(EntityWithCommentAt::class)->create([
            'commentable_at' => '1986-03-28 00:00:00',
        ]);

        $this->assertInstanceOf(Carbon::class, $entity->commentable_at);
        $this->assertSame('1986-03-28 00:00:00', $entity->commentable_at->format('Y-m-d H:i:s'));
    }

    /** @test */
    public function it_can_check_if_entity_is_commentable(): void
    {
        $commentEntity = factory(EntityWithCommentAt::class)->create([
            'commentable_at' => Date::now(),
        ]);

        $discommentEntity = factory(EntityWithCommentAt::class)->create([
            'commentable_at' => null,
        ]);

        $this->assertTrue($commentEntity->isComment());
        $this->assertFalse($discommentEntity->isComment());
    }

    /** @test */
    public function it_can_check_if_entity_is_not_comment(): void
    {
        $commentEntity = factory(EntityWithCommentAt::class)->create([
            'commentable_at' => Date::now(),
        ]);

        $discommentEntity = factory(EntityWithCommentAt::class)->create([
            'commentable_at' => null,
        ]);

        $this->assertFalse($commentEntity->isNotComment());
        $this->assertTrue($discommentEntity->isNotComment());
    }

    /** @test */
    public function it_can_comment(): void
    {
        $entity = factory(EntityWithCommentAt::class)->create([
            'commentable_at' => null,
        ]);

        $entity->comment();

        $this->assertNotNull($entity->commentable_at);
    }

    /** @test */
    public function it_can_undo_comment(): void
    {
        $entity = factory(EntityWithCommentAt::class)->create([
            'commentable_at' => Date::now(),
        ]);

        $entity->undoComment();

        $this->assertNull($entity->commentable_at);
    }
}
