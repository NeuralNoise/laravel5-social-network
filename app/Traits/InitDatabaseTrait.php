<?php

namespace App\Traits;

use DatabaseSeeder;

trait InitDatabaseTrait
{
    protected static $backupExtension = '.dusk.bak';

    /**
     * Creates an empty database for testing, but backups the current dev one first.
     */
    public function backupDatabase()
    {
        if (!$this->app) {
            $this->refreshApplication();
        }

        $db = $this->app->make('db')->connection();
        if (!file_exists($db->getDatabaseName())) {
            touch($db->getDatabaseName());
        }

        copy($db->getDatabaseName(), $db->getDatabaseName() . static::$backupExtension);

        $this->unlinkDatabase($db);

        touch($db->getDatabaseName());

        $this->artisan('migrate');
        $this->seed(DatabaseSeeder::class);

        $this->beforeApplicationDestroyed([$this, 'restoreDatabase']);
    }

    public function unlinkDatabase($db)
    {
        if (file_exists($db->getDatabaseName())) {
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                var_dump( $db->getDatabaseName() );
                chmod($db->getDatabaseName(), 0777);
                unlink(basename($db->getDatabaseName()));
            } else {
                chmod($db->getDatabaseName(), 0777);
                unlink($db->getDatabaseName());
            }
        }
    }

    /**
     * Paired with backupDatabase to restore the dev database to its original form.
     */
    public function restoreDatabase()
    {
        // restore the test db file
        if (!$this->app) {
            $this->refreshApplication();
        }
        $db = $this->app->make('db')->connection();

        copy($db->getDatabaseName() . static::$backupExtension,
            $db->getDatabaseName());
        unlink($db->getDatabaseName() . static::$backupExtension);
    }
}