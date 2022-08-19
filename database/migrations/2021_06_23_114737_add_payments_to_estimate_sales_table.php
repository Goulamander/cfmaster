<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentsToEstimateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('estimate_sales', function (Blueprint $table) {
            $table->date('initial_payment_date')->nullable()->after('entry_year');
            $table->integer('initial_payment_amount')->nullable()->default(0)->after('initial_payment_date');
            $table->boolean('initial_payment_paid')->nullable()->default(0)->after('initial_payment_amount');
            $table->date('final_payment_date')->nullable()->after('initial_payment_paid');
            $table->integer('final_payment_amount')->nullable()->default(0)->after('final_payment_date');
            $table->boolean('final_payment_paid')->nullable()->default(0)->after('final_payment_amount');
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
            $table->dropColumn('initial_payment_date');
            $table->dropColumn('initial_payment_amount');
            $table->dropColumn('initial_payment_paid');
            $table->dropColumn('final_payment_date');
            $table->dropColumn('final_payment_amount');
            $table->dropColumn('final_payment_paid');
        });
    }
}
