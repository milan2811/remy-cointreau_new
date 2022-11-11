<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFieldsInEnquiryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->string('phone')->after('email');
            $table->string('bar_name')->after('phone')->nullable();
            $table->string('bar_address')->after('bar_name')->nullable();
            $table->string('bar_city')->after('bar_address')->nullable();
            $table->string('bar_country')->after('bar_city')->nullable();            
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('phone');
            $table->dropColumn('bar_name');
            $table->dropColumn('bar_address');
            $table->dropColumn('bar_city');
            $table->dropColumn('bar_country');
            $table->string('first_name')->after('id');
            $table->string('last_name')->after('first_name');
        });
    }
}
