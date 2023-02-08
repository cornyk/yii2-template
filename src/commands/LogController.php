<?php

namespace app\commands;

use yii\console\ExitCode;
use yii\helpers\FileHelper;

class LogController extends BaseController
{
    /**
     * 迁移日志至指定的日志备份文件夹
     * @return int
     */
    public function actionMigrate()
    {
        $logDir = __DIR__ . '/../../runtime/logs';
        $logBackupDir = env('LOG_BACKUP_PATH', __DIR__ . '/../../runtime/backup_logs');

        $dateNow = date('Ymd');
        $files = FileHelper::findFiles($logDir, [
            'only' => ['*.log'],
        ]);

        foreach ($files as $file) {
            $logDate = substr($file, -12, 8);
            if ($logDate == $dateNow) {
                continue;
            }
            $fileInfo = explode(DIRECTORY_SEPARATOR, $file);
            $fileName = $fileInfo[count($fileInfo) - 1] ?? '';
            if ($fileName == '') {
                continue;
            }

            if (!@is_dir($logBackupDir . DIRECTORY_SEPARATOR . $logDate)) {
                @mkdir($logBackupDir . DIRECTORY_SEPARATOR . $logDate, 0755, true);
            }
            $moveFileResult = rename($file, $logBackupDir . DIRECTORY_SEPARATOR . $logDate . DIRECTORY_SEPARATOR . $fileName);
            if (!$moveFileResult) {
                echo "日志{$fileName}迁移失败.\n";
                continue;
            }
            echo "日志{$fileName}迁移已完成...\n";
        }
        echo "\n全部日志迁移已完成！\n";
        return ExitCode::OK;
    }
}
