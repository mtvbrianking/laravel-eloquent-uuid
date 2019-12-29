## Laravel Eloquent UUID.

[![Build Status](https://travis-ci.org/mtvbrianking/laravel-eloquent-uuid.svg?branch=master)](https://travis-ci.org/mtvbrianking/laravel-eloquent-uuid)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mtvbrianking/laravel-eloquent-uuid/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mtvbrianking/laravel-eloquent-uuid/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/mtvbrianking/laravel-eloquent-uuid/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/mtvbrianking/laravel-eloquent-uuid/?branch=master)
[![StyleCI](https://github.styleci.io/repos/230607368/shield?branch=master)](https://github.styleci.io/repos/230607368)
[![Documentation](https://img.shields.io/badge/Documentation-Blue)](https://mtvbrianking.github.io/laravel-eloquent-uuid)

### Installation

Install via Composer package manager:

```bash
composer require bmatovu/laravel-eloquent-uuid
```

### Usage

**Migration**:

```php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            // ...
            $table->timestamps();

            $table->primary('id');
        });
    }
}
```

**Model**:

```php
use Bmatovu\Uuid\Traits\HasUuidKey;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasUuidKey;
    
    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
}
```

### Testing

**Factories fail after faking events**: ([Issue #19952](https://github.com/laravel/framework/issues/19952))

After calling `Event::fake()`, no event listeners will be executed. So, if your tests use model factories that use the `HasUuidKey` trait; you should call Event::fake() after using your factories.
