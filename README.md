# casanva

# 安裝 cron 管理器套件
- composer require sidroberts/cron

# 工具使用設定(一)
- cli        . ./cmd/docker/cli
- composer   . ./cmd/docker/composer

# 工具使用設定(二)
- cd app
- cp phpcli.example phpcli
- cp composer.example composer
- 修改 phpcli 及 composer 裡的 containerName, projectName, tools參數
- ./phpcli cli.php [命令動作] [參數] (命令動作及參數包含 --help -h help 列出命令列表或命令幫助)

# 資料庫設定
- cd app/config
- cp config.ini.example config.ini
- 修改資料庫相關設定

# cli 排程設定說明
- 設定 app/Console/CliSetUp method scheduleSetting()
- 可用時間頻率請參考 app/cron/Helper/Frequencies.php

# docker cron 設定
- 在 docker-compose.yml cron volumes 加入底下範例(請依自身需求修改)
- "/home/${USER}/chroot/codes/php/micro/micro.sh:/cronJobs/micro.sh"
- 重新啟動 docker
