<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;

class TestDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            DB::statement('CREATE TABLE IF NOT EXISTS test_table (id INT)');
            DB::table('test_table')->insert(['id' => 1]);
            $this->info('✅ Escritura en DB exitosa');
        } catch (\Exception $e) {
            $this->error('❌ Error: '.$e->getMessage());
        }
    }
}
