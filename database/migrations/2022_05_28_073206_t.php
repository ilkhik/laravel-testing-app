<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('login')->unique();
            $table->string('password');
            $table->string('role')->default('USER');
            $table->date('signup_date');
            $table->integer('test_passed_number')->default(0);
            $table->integer('score_sum')->default(0);
            $table->integer('score_max_sum')->default(0);
        });
        
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->integer('max_scores');
        });
        
        Schema::create('questions', function (Blueprint $table) {
            $table->integer('number');
            $table->unsignedBigInteger('test_id');
            $table->foreign('test_id')->references('id')->on('tests');
            $table->index(['number', 'test_id']);
            $table->string('question_kind');
            $table->string('text');
        });
        
        Schema::create('answers', function (Blueprint $table) {
            $table->integer('number');
            $table->unsignedBigInteger('test_id');
            $table->foreign('test_id')->references('id')->on('tests');
            $table->integer('question_number');
            $table->foreign('question_number')->references('number')->on('questions');
            $table->index(['number','test_id', 'question_number']);
            $table->boolean('is_correct');
            $table->string('text');
        });
        
        Schema::create('taked_tests', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('test_id');
            $table->foreign('test_id')->references('id')->on('tests');
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->integer('score');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
