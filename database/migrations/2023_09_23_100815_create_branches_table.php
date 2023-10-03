<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       
        Schema::create('hospitalBranch', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('hospitalId')->unsigned();
            $table->string('branchName')->unique();
            $table->string('address');
            $table->string('phoneNo');
            $table->string('email');
            $table->string('contactPerson');
            $table->string('contactPersonPhNo');
            $table->boolean('isSubscribed')->default(0);
            $table->boolean('is_active')->default(1);
            $table->timestamp('created_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->bigInteger('created_by')->unsigned();
            $table->timestamp('updated_at')->default(DB::raw('NULL ON UPDATE CURRENT_TIMESTAMP'))->nullable();
            $table->bigInteger('updated_by')->unsigned()->nullable();

            $table->foreign('hospitalId')->references('id')->on('hospitalsettings');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospitalBranch');
    }
};
