<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('topic', 100);
            $table->text('message');
            $table->boolean('closed')->default(false);
            $table->boolean('viewed')->default(false);
            $table->boolean('answered')->default(false);
            $table->tinyInteger('status')->default(0);
            $table->integer('id_creator');
            $table->integer('id_accepted')->nullable();                      
            $table->string('file_name', 100)->nullable(); ;
            $table->string('file_path', 100)->nullable(); ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
