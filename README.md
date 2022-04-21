# bulletin 簡易布告欄
## 基本資訊&使用說明
````
預設網址為：http://127.0.0.1/bulletin/index.php/Homepage/index
資料庫名稱：bulletin

需要先創建名為"bulletin"的資料庫，之後匯入"bulletin.sql"的sql檔案
如果有設定host，請修改app->config->database.php->$config['base_url']為你的網址
資料庫的帳號密碼與資料庫名稱設定在app->config->config.php(如下圖)
	'username' => 資料庫帳號
	'password' => 資料庫密碼
	'database' => 資料庫名稱
此專案是用codeigniter3開發，前後端的收發大部分採用AJAX完成
````
![image](https://user-images.githubusercontent.com/72376358/164365200-829c36f0-ff2c-43c1-8829-ea125eafe670.png)
## 新增公告
````
API url：Api/add
API呼叫方式：post
````
|Body參數|格式|必填|說明|
| ------------ | ------------ | ------------ | ------------ |
|title|string|required|公告的標題(最多5個字元)|
|content|string|required|公告的內容(最多500個字元)|

Response
```json
// 成功
{
  "status": true,
  "reload": 1,
  "msg": "\\u65b0\\u589e\\u5b8c\\u6210"
}
// 失敗
{
    "status": false,
    "msg": "<p>\u8981\u6c42\u542b\u6709 \u6a19\u984c \u6b04\u4f4d<\/p>\n<p>\u8981\u6c42\u542b\u6709 \u516c\u544a\u5167\u5bb9 \u6b04\u4f4d<\/p>\n"
}
```
## 編輯查詢公告
````
API url：Api/edit
API呼叫方式：post
````
|Body參數|格式|必填|說明|
| ------------ | ------------ | ------------ | ------------ |
|id|int|required|公告的id|

Response
```json
// 成功
{
  "data": [
    {
      "id": "15",
      "status": "1",
      "title": "9999",
      "content": "12316545341",
      "create_date": "2022-04-20 17:36:30",
      "update_date": "2022-04-20 17:36:30"
    }
  ],
  "status": true,
  "msg": "\\u8b80\\u53d6\\u5b8c\\u6210"
}
// 失敗
{
    "status": false,
    "msg": "<p>\u8cc7\u6599\u5eab\u4e0d\u5b58\u5728 \u4f60\u9078\u64c7\u7684\u516c\u544a<\/p>\n"
}
```
## 更新公告
````
API url：Api/update
API呼叫方式：post
````
|Body參數|格式|必填|說明|
| ------------ | ------------ | ------------ | ------------ |
|id|int|required|公告的id|
|title|string|required|公告的標題(最多5個字元)|
|content|string|required|公告的內容(最多500個字元)|

Response
```json
// 成功
{
  "status": true,
  "msg": "\\u4fee\\u6539\\u5b8c\\u6210"
}
// 失敗
{
    "status": false,
    "msg": "<p>\u8981\u6c42\u542b\u6709 \u6a19\u984c \u6b04\u4f4d<\/p>\n"
}
```
## 啟用公告
````
API url：Api/on
API呼叫方式：post
````
|Body參數|格式|必填|說明|
| ------------ | ------------ | ------------ | ------------ |
|ids|array|required|公告的id|

Response
```json
// 成功
{
  "status": true,
  "reload": 1,
  "msg": "\\u555f\\u7528\\u6210\\u529f"
}
// 失敗
{
    "status": false,
    "msg": "<p>\u8cc7\u6599\u5eab\u4e0d\u5b58\u5728 \u4f60\u9078\u64c7\u7684\u516c\u544a<\/p>\n"
}
```
## 停用公告
````
API url：Api/off
API呼叫方式：post
````
|Body參數|格式|必填|說明|
| ------------ | ------------ | ------------ | ------------ |
|ids|array|required|公告的id|

Response
```json
// 成功
{
  "status": true,
  "reload": 1,
  "msg": "\\u505c\\u7528\\u6210\\u529f"
}
// 失敗
{
    "status": false,
    "msg": "<p>\u8cc7\u6599\u5eab\u4e0d\u5b58\u5728 \u4f60\u9078\u64c7\u7684\u516c\u544a<\/p>\n"
}
```
## 刪除公告
````
API url：Api/del
API呼叫方式：post
````
|Body參數|格式|必填|說明|
| ------------ | ------------ | ------------ | ------------ |
|ids|array|required|公告的id|

Response
```json
// 成功
{
  "status": true,
  "reload": 1,
  "msg": "\\u522a\\u9664\\u6210\\u529f"
}
// 失敗
{
    "status": false,
    "msg": "<p>\u8cc7\u6599\u5eab\u4e0d\u5b58\u5728 \u4f60\u9078\u64c7\u7684\u516c\u544a<\/p>\n"
}
```
