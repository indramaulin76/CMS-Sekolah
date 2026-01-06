<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt');
            $table->longText('content');
            $table->string('thumbnail')->nullable();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('type')->default('article');
            $table->string('status')->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->unsignedInteger('views_count')->default(0);
            $table->timestamps();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('location')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->string('status')->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });

        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->json('images')->nullable();
            $table->string('status')->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });

        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('status')->default('draft');
            $table->timestamps();
        });

        Schema::create('headmasters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('photo')->nullable();
            $table->longText('greeting')->nullable();
            $table->date('period_start')->nullable();
            $table->date('period_end')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('ppdb_periods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('academic_year');
            $table->dateTime('registration_start');
            $table->dateTime('registration_end');
            $table->dateTime('announcement_date')->nullable();
            $table->unsignedInteger('quota')->default(0);
            $table->string('status')->default('draft');
            $table->text('description')->nullable();
            $table->json('requirements')->nullable();
            $table->timestamps();
        });

        Schema::create('ppdb_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ppdb_period_id')->constrained()->onDelete('cascade');
            $table->string('registration_code')->unique();
            $table->string('full_name');
            $table->string('nickname')->nullable();
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('gender');
            $table->string('religion');
            $table->text('address');
            $table->string('phone');
            $table->string('email');
            $table->string('previous_school');
            $table->string('nisn');
            $table->string('parent_name');
            $table->string('parent_phone');
            $table->string('parent_occupation');
            $table->string('photo')->nullable();
            $table->json('documents')->nullable();
            $table->string('status')->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ppdb_registrations');
        Schema::dropIfExists('ppdb_periods');
        Schema::dropIfExists('headmasters');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('events');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('categories');
    }
};
