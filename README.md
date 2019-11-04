# casanva

# 工具使用設定
- cd app
- cp phpcli.example phpcli
- cp composer.example composer
- 修改 phpcli 及 composer 裡的containerName, projectName, tools參數

# 資料庫設定
- cd app/config
- cp config.ini.example config.ini
- 修改資料庫相關設定

# 執行 cmd 命令
- cd app
- ./phpcli cli.php [命令動作] [參數] (命令動作及參數包含 --help -h help 列出命令列表或命令幫助)

# 安裝 cron 管理器套件
- composer require sidroberts/cron
