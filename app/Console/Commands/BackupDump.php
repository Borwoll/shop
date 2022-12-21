<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class BackupDump extends Command {
    protected $signature = 'db:backup
                            {filename? : Имя файла резервной копии}
                            {--connection=mysql : Укажите имя подключения к базе данных}
                            ';

    protected $description = 'Экспорт базы данных в файл';
    protected $connection;
    protected $filename;
    protected $localDisk;
    protected $localPath;
    protected $cloudSync;
    protected $cloudDisk;
    protected $cloudPath;
    protected $keepLocal;

    public function __construct() {
        parent::__construct();
        $this->localDisk = config('backup.mysql.local-storage.disk', 'local');
        $this->localPath = config('backup.mysql.local-storage.path', null);
        $this->cloudSync = config('backup.mysql.cloud-storage.enabled', false);
        $this->cloudDisk = config('backup.mysql.cloud-storage.disk', null);
        $this->cloudPath = config('backup.mysql.cloud-storage.path', null);
        $this->keepLocal = config('backup.mysql.cloud-storage.keep-local', true);
    }

    public function handle() {
        $this->handleOptions();
        $this->dumpDatabase();
    }

    protected function handleOptions() {
        $this->validateAndSetConnection($this->option('connection'));
        $this->setFilename();
    }

    protected function validateAndSetConnection($connection) {
        if (is_array($connectionData = config("database.connections.{$connection}"))) {
            if ($connectionData['driver'] == 'mysql') {
                $this->connection = [
                    'host'     => $connectionData['host'],
                    'database' => $connectionData['database'],
                    'port'     => $connectionData['port'],
                    'username' => $connectionData['username'],
                    'password' => $connectionData['password'],
                ];
            } else {
                $this->error("Соединение '{$connection}' должно использовать драйвер MySQL!");
                exit();
            }
        } else {
            $this->error("Соединение '{$connection}' не существует!");
            exit();
        }
    }

    protected function setFilename() {
        $filename = trim($this->argument('filename'));
        if (empty($filename))
            $filename = $this->connection['database'].'_'.\Carbon\Carbon::now()->format('YmdHis');
        $filename = explode('.', $filename)[0];
        $this->filename = $filename.'.sql';
    }

    protected function getFilePath() {
        $localPath = $this->cleanPath($this->localPath);
        return $localPath.DIRECTORY_SEPARATOR.$this->filename;
    }

    protected function getFileCloudPath() {
        $cloudPath = $this->cleanPath($this->cloudPath);
        return $cloudPath.DIRECTORY_SEPARATOR.$this->filename;
    }

    protected function isPathAbsolute($path) {
        return starts_with($path, DIRECTORY_SEPARATOR);
    }

    protected function cleanPath($path) {
        return ltrim(rtrim($path, DIRECTORY_SEPARATOR), DIRECTORY_SEPARATOR);
    }

    protected function storeDumpFile($data) {
        if ($this->keepLocal)
            Storage::disk($this->localDisk)->put($this->getFilePath(), $data);
        $this->info("База данных '{$this->connection['database']}' экспортирована успешно");
        if ($this->cloudSync) {
            Storage::disk($this->cloudDisk)->put($this->getFileCloudPath(), $data);
            $this->info("Дамп базы данных '{$this->filename}' успешно синхронизирован с диском '{$this->cloudDisk}'");
        }
    }

    protected function dumpDatabase() {
        $hostname = escapeshellarg($this->connection['host']);
        $port = $this->connection['port'];
        $database = $this->connection['database'];
        $username = escapeshellarg($this->connection['username']);
        $password = $this->connection['password'];

        $databaseArg = escapeshellarg($database);
        $portArg = !empty($port) ? '-P '.escapeshellarg($port) : '';
        $passwordArg = !empty($password) ? '-p'.escapeshellarg($password) : '';

        $dumpCommand = "mysqldump -C -h {$hostname} {$portArg} -u{$username} {$passwordArg} --single-transaction --skip-lock-tables --quick {$databaseArg}";

        exec($dumpCommand, $dumpResult, $result);
        if ($result == 0) {
            $dumpResult = implode(PHP_EOL, $dumpResult);
            $this->storeDumpFile($dumpResult);
        } else
            $this->error("База данных '{$database}' не может быть экспортирована");
    }
}
