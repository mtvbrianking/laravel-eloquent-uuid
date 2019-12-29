<?php

namespace Bmatovu\Uuid\Tests\Traits;

use Bmatovu\Uuid\Tests\Models\Dummy;
use Bmatovu\Uuid\Tests\TestCase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;

class HasUuidKeyTest extends TestCase
{
    use RefreshDatabase;

    public function test_key_type_is_string()
    {
        $model = new Dummy();
        $this->assertEquals('string', $model->getKeyType());
    }

    public function test_key_is_not_incrementing()
    {
        $model = new Dummy();
        $this->assertEquals(false, $model->getIncrementing());
    }

    public function test_can_auto_generate_and_set_key()
    {
        $model = factory(Dummy::class)->create();

        $this->assertInstanceOf(Dummy::class, $model);
    }

    public function test_can_set_explicit_key()
    {
        $uuid = '8fcbea42-fc95-4db2-9067-a2d93e6b249f';

        $model = factory(Dummy::class)->create([
            'id' => $uuid,
        ]);

        $this->assertInstanceOf(Dummy::class, $model);
        $this->assertEquals($uuid, $model->id);
    }

    public function test_fake_event_before_factory_fails()
    {
        $this->expectException(QueryException::class);
        $this->expectExceptionCode(23000);

        Event::fake();

        factory(Dummy::class)->create();
    }

    /**
     * @see https://stackoverflow.com/a/54817274/2732184
     */
    public function test_fake_event_after_factory_works()
    {
        factory(Dummy::class)->create();

        Event::fake();

        $this->addToAssertionCount(1);
    }

    /**
     * @see https://github.com/laravel/framework/issues/18066#issuecomment-342630971
     */
    public function test_fake_event_before_factory_hack_works()
    {
        $initialDispatcher = Event::getFacadeRoot();
        Event::fake();
        Model::setEventDispatcher($initialDispatcher);

        factory(Dummy::class)->create();

        $this->addToAssertionCount(1);
    }
}
