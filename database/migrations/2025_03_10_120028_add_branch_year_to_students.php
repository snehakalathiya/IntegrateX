<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            if (!Schema::hasColumn('students', 'year')) {
                $table->string('year')->nullable()->after('githubuserid');
            }

            if (!Schema::hasColumn('students', 'branch_id')) {
                $table->unsignedBigInteger('branch_id')->nullable()->after('year');
                $table->foreign('branch_id')->references('id')->on('branches')->onDelete('set null');
            }
        });
    }

    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            if (Schema::hasColumn('students', 'year')) {
                $table->dropColumn('year');
            }

            if (Schema::hasColumn('students', 'branch_id')) {
                $table->dropForeign(['branch_id']);
                $table->dropColumn('branch_id');
            }
        });
    }
};
