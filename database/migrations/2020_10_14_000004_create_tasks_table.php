<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->enum('type', ['graphics', 'design', 'implement_frontend', 'implement_backend', 'other'])->default('other');
            $table->text('task_description');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('order');
            $table->enum('status', ['queued', 'on_going', 'completed'])->default('queued');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';

            $table->index('project_id');
            $table->index('user_id');
            $table->index('order');
            $table->index(['project_id', 'type', 'user_id', 'status']);

            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
