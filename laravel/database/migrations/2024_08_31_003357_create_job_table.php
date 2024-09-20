<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('status')->nullable();

            $table->string('job_no')->nullable();
            $table->string('job_class')->nullable();
            $table->string('job_name')->nullable();
            $table->string('location')->nullable();
            $table->string('area')->nullable();
            $table->string('document')->nullable();

            $table->string('fungsional_name')->nullable();
            $table->string('fungsional_email')->nullable();
            $table->string('fungsional_nohp')->nullable();
            $table->string('hsse_name')->nullable();
            $table->string('hsse_email')->nullable();
            $table->string('hsse_area')->nullable();

            $table->string('start_work')->nullable();
            $table->string('end_work')->nullable();

            $table->string('meeting_date')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
