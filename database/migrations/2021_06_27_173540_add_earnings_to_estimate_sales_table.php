<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEarningsToEstimateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('estimate_sales', function (Blueprint $table) {
            $table->date('fh_payment_date')->nullable()->after('final_payment_paid');
            $table->integer('fh_payment_amount')->nullable()->default(0)->after('fh_payment_date');
            $table->boolean('fh_payment_paid')->nullable()->default(0)->after('fh_payment_amount');
            $table->date('sh_payment_date')->nullable()->after('fh_payment_paid');
            $table->integer('sh_payment_amount')->nullable()->default(0)->after('sh_payment_date');
            $table->boolean('sh_payment_paid')->nullable()->default(0)->after('sh_payment_amount');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('estimate_sales', function (Blueprint $table) {
            $table->dropColumn('fh_payment_date');
            $table->dropColumn('fh_payment_amount');
            $table->dropColumn('fh_payment_paid');
            $table->dropColumn('sh_payment_date');
            $table->dropColumn('sh_payment_amount');
            $table->dropColumn('sh_payment_paid');
        });
    }
}
