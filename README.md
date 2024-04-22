# 自製電子商務網站

### 成果網站
<a href="https://chun-hung.idv.tw" target="_blank">自製電子商務網站</a>

### 安裝需求
1. Linux(RedHat Enterprise Linux)
2. Apache 2.4.29
3. MySQL 5.6
4. PHP 8.0.9

### 安裝步驟
1. 下載此專案程式
```bash
git clone git@github.com:guiguzi19971006/store.git
```
2. 安裝此專案所需的 Composer 套件
```bash
composer install
```
3. 將 .env.example 複製為 .env
```bash
cp .env.example .env
```
4. 填入所需屬性值至 .env
```
PROJECT_NAME=

# 資料庫設定值
DB_HOST=
DB_PORT=
DB_NAME=
DB_USER=
DB_PASSWORD=
DB_CHARSET=
DB_COLLATE=
```