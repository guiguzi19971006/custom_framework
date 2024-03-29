# 自製框架

### 功能特點
1. Helper Functions: 定義了許多方便且可能會經常被使用的 Functions。
2. 自動化錯誤/例外處理: 實現自動化錯誤/例外處理機制，自動偵測錯誤/例外，在錯誤/例外產生時，自動將錯誤/例外資訊寫入 Log 記錄檔。
3. Autoloader: class、interface、trait、enum 的 Namespace 採用 PSR-4 命名，搭配 Autoloader 則可在每次類別存取時，自動將所需檔案引入。
4. Routes: 讓開發者可根據需求自行定義所需路由。
5. Service Provider & Service Container: 自動綁定所需服務。