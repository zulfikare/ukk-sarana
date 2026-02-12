<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SetDefaultStudentUsernames extends Seeder
{
    public function run(): void
    {
        // Set default usernames from NIS for existing records
        DB::statement("UPDATE siswas SET username = CONCAT('siswa_', nis) WHERE username IS NULL OR username = ''");
        
        $count = DB::table('siswas')->whereNotNull('username')->count();
        echo "Updated $count siswa usernames\n";
    }
}
