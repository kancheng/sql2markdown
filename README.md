
# sql2markdown

## Detail

該專案來源自 huangjun0808/sql2markdown 的 wowo-zZ 和 huangjun0808 進行修改，實際著專案功能的不斷增加，資料庫的結構也就越來越龐大。若資料庫在備助的部分寫得構詳細，那麼將 SQL 結構轉成 Markdown 表格，在文件撰寫上會省下不少工作量。


## Method

1. Clone 專案到本地後，進入本地的專案資料目錄，建立需要讀取 SQL 文件目錄與 Markdown 輸出的目錄。

```cmd
$ git clone git@github.com:kancheng/sql2markdown.git

$ cd [sql2markdown-project path]

$ composer update

$ composer install

```

2. 匯出 SQL 結構到檔案中，副檔名為 `*.sql`  隨後存到後面需要的 SQL 目錄 ，範例如下：

```sql
CREATE TABLE `info` (
  `id` int(11) NOT NULL DEFAULT '1000' COMMENT '編碼',
  `name` varchar(155) COLLATE utf8_unicode_ci NOT NULL COMMENT '姓名',
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '地址',
  `account_name` varchar(155) COLLATE utf8_unicode_ci NOT NULL COMMENT '帳戶名稱',
  `account_number` varchar(155) COLLATE utf8_unicode_ci NOT NULL COMMENT '帳戶編號',
  `swift_code` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'SWIFT 代碼',
  `comments` text COLLATE utf8_unicode_ci COMMENT '帳戶額外資訊'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
COMMIT;
```
3. 修改專案目錄下的 `convert.php` 檔案，將需要讀取 SQL 文件目錄與 Markdown 輸出目錄等路徑替換。

```convert-php
<?php

namespace s2d;

require_once "./vendor/autoload.php";

use s2d\formater\mysql\V57Formater;

/*
* $formater = new V57Formater('[sql-input-path].sql');
* $formater->formatOutput('[md-output-path].md');
*/
$formater = new V57Formater('./sql/init.sql');
$formater->splitSections();
$formater->geneTables();
$formater->formatOutput('./md/init.md');
```

4. 表頭可以選擇顯示的語系，預設為英文。

```

// English
$formater->formatOutput('./md/init.md', 'en');

// 简体中文
$formater->formatOutput('./md/init.md', 'sc');

// 繁體中文
$formater->formatOutput('./md/init.md', 'tc');

// Deutsch
$formater->formatOutput('./md/init.md', 'de');

// 日本語
$formater->formatOutput('./md/init.md', 'jp');


```

5. 在專案目錄下運行 `php convert.php` ，即可在指定的 Markdown 輸出目錄下看到產生的 Markdown 文件。

``` php-run
$ php convert.php
```

6. Demo

測試與產生的資料與檔案放於，`result` 目錄下，包含原 `huangjun0808/sql2markdown` 專案的 Demo 檔案與不同語言的表格抬頭。
