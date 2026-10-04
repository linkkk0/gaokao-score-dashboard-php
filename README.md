# 高三成绩趋势 · PHP + MySQL

<p align="center">
  <strong>一个基于 PHP + MySQL 的个人高三成绩可视化与数据管理系统。</strong>
</p>

<p align="center">
  保留原版简洁的成绩趋势页面，并将原来的 JSON 数据存储升级为 MySQL 动态数据管理。
</p>

<p align="center">
  <strong>PHP + MySQL + HTML + CSS + JavaScript + SVG</strong>
</p>

---

## ✨ 项目简介

本项目用于记录和查看个人高三期间的历次考试成绩。

每次考试包含：

- 考试日期
- 考试名称
- 总成绩
- 语文
- 数学
- 英语
- 物理
- 化学
- 生物

前台以折线图直观展示成绩变化趋势，后台通过 `/admin` 进行统一管理。

相比最初的纯静态 HTML + JSON 版本，PHP 版将成绩数据迁移到 **MySQL**，因此可以长期保存并持续添加考试记录。

## ✨ 主要特性

| 功能 | 说明 |
| --- | --- |
| 📈 成绩趋势 | 总成绩及六科成绩独立查看 |
| 🎯 动态纵轴 | 根据当前数据自动计算纵轴范围 |
| 💬 悬浮详情 | 鼠标移动到成绩节点查看考试详情 |
| 📅 考试日期 | 横轴按照考试日期展示 |
| ♾️ 无限追加 | MySQL 数据库持续保存考试记录 |
| 📝 后台管理 | 添加、修改、删除成绩 |
| 📥 JSON 导入 | 支持从原静态版 JSON 导入成绩 |
| 📤 JSON 导出 | 支持将数据库成绩导出为 JSON |
| 🔐 后台保护 | `/admin` 需要管理员登录 |
| 🔑 修改密码 | 后台可以修改管理员密码 |
| 🌓 深浅色模式 | 默认跟随系统，也支持手动切换 |
| 📱 响应式 | 支持桌面端和移动端 |
| 🎨 原版设计 | 尽量保留原静态版的视觉与交互体验 |

---

## 🖥️ 页面

### 前台

访问：

```text
/
```

用于查看：

- 总成绩趋势
- 语文趋势
- 数学趋势
- 英语趋势
- 物理趋势
- 化学趋势
- 生物趋势
- 考试次数
- 最近总分
- 悬浮成绩详情

### 后台

访问：

```text
/admin/
```

后台提供：

- 管理员登录
- 成绩列表
- 添加成绩
- 修改成绩
- 删除成绩
- JSON 导入
- JSON 导出
- 修改管理员密码
- 深浅色模式

---

## 📁 项目结构

```text
gaokao-score-dashboard-php/
├── index.php
├── admin/
│   ├── index.php
│   ├── login.php
│   ├── logout.php
│   ├── score_edit.php
│   ├── save.php
│   ├── delete.php
│   ├── import.php
│   ├── export.php
│   ├── settings.php
│   ├── includes/
│   └── assets/
├── api/
├── assets/
│   ├── css/
│   └── js/
├── config/
│   └── database.php
├── database/
│   └── install.sql
├── .gitignore
├── README.md
└── LICENSE
```

> 本 README 不单独介绍 License。

---

## 🚀 安装

### 1. 环境要求

推荐：

- PHP 8.0+
- MySQL 5.7+ / MySQL 8.0+
- Apache 或 Nginx
- PDO
- PDO_MySQL

宝塔、小皮 PHPStudy 等集成环境均可使用。

### 2. 下载项目

```bash
git clone https://github.com/linkkk0/gaokao-score-dashboard-php.git
```

或者直接下载 ZIP 并解压到网站根目录。

### 3. 创建数据库

项目提供：

```text
database/install.sql
```

使用 phpMyAdmin 导入，或者执行：

```bash
mysql -u root -p < database/install.sql
```

SQL 文件会自动创建：

```text
数据库：gaokao_score

数据表：
├── admins
└── exams
```

同时会写入一组示例成绩数据，安装后即可直接查看。

### 4. 配置数据库

默认配置位于：

```text
config/database.php
```

默认值：

```text
DB_HOST = 127.0.0.1
DB_NAME = gaokao_score
DB_USER = root
DB_PASS = 空
```

也支持环境变量：

```text
DB_HOST
DB_NAME
DB_USER
DB_PASS
```

如果服务器的 MySQL 用户名、密码或数据库名称不同，请修改对应配置。

### 5. 配置网站根目录

将项目设置为 PHP 网站根目录，例如：

```text
/www/wwwroot/gaokao-score-dashboard-php/
```

然后访问：

```text
http://你的域名/
```

---

## 🔐 默认后台账号

后台地址：

```text
http://你的域名/admin/
```

数据库初始化后的默认管理员：

| 项目 | 内容 |
| --- | --- |
| 用户名 | `admin` |
| 密码 | `password` |

**首次登录后请立即修改默认密码。**

修改密码：

```text
/admin/settings.php
```

新密码至少需要 8 位。

> 如果你准备将网站部署到公网，不建议长期使用默认账号密码。

---

## 📊 数据结构

数据库中的每一次考试对应 `exams` 表中的一条记录。

主要字段：

| 字段 | 说明 |
| --- | --- |
| `exam_date` | 考试日期 |
| `exam_name` | 考试名称 |
| `chinese` | 语文 |
| `math` | 数学 |
| `english` | 英语 |
| `physics` | 物理 |
| `chemistry` | 化学 |
| `biology` | 生物 |
| `total` | 总成绩 |

没有固定考试次数限制，可以持续添加新的考试。

---

## 📝 成绩管理

登录：

```text
/admin/
```

即可管理成绩。

### 添加

填写：

1. 考试日期
2. 考试名称
3. 六科成绩
4. 总成绩

保存后前台会直接读取最新数据库数据。

### 修改

在后台选择对应考试并进入编辑页面即可修改。

### 删除

选择考试记录执行删除即可。

> 删除操作会直接删除数据库中的对应记录，请谨慎操作。

---

## 📥 JSON 导入

如果你之前使用的是原来的静态版项目，可以直接将原来的 `data.json` 导入数据库。

后台提供 JSON 导入功能。

推荐格式：

```json
{
  "exams": [
    {
      "date": "2026-03-08",
      "exam": "高三第一次模拟考试",
      "scores": {
        "chinese": 118,
        "math": 126,
        "english": 121,
        "physics": 84,
        "chemistry": 88,
        "biology": 86
      },
      "total": 623
    }
  ]
}
```

导入后会转换为 MySQL 中的考试记录。

---

## 📤 JSON 导出

后台提供 JSON 导出功能，可以将当前数据库中的成绩导出。

导出的结构保持：

```json
{
  "exams": []
}
```

方便备份或迁移到其他版本。

---

## 🌓 深浅色模式

项目支持浅色 / 深色模式。

首次访问时会读取浏览器的：

```text
prefers-color-scheme
```

因此：

- 系统浅色 → 默认浅色
- 系统深色 → 默认深色

也可以通过页面按钮手动切换。

手动选择会保存在浏览器中。

---

## 📈 图表

项目继续使用原版的 SVG 折线图实现，不依赖大型图表库。

前端会：

- 读取数据库成绩
- 计算坐标
- 自动计算纵轴范围
- 生成纵轴刻度
- 根据考试日期生成横轴
- 绘制折线
- 绘制成绩节点
- 绑定悬浮成绩卡片
- 在窗口变化时重新计算图表

总成绩节点可以查看本次考试的六科成绩；单科节点则显示对应科目成绩。

---

## 🔄 从静态版迁移

如果你之前使用：

```text
gaokao-score-dashboard
```

静态版，只需要：

1. 部署 PHP + MySQL 环境
2. 执行 `database/install.sql`
3. 配置 `config/database.php`
4. 登录 `/admin/`
5. 使用 JSON 导入功能导入原来的 `data.json`
6. 后续通过后台维护成绩

数据即可从：

```text
data.json
```

迁移到：

```text
MySQL
```

---

## ⚠️ 部署注意

### GitHub Pages

本项目是 PHP + MySQL 动态网站，**不能直接部署到 GitHub Pages**。

需要支持 PHP 和 MySQL 的服务器。

### 默认密码

部署到公网后，请立即修改：

```text
admin / password
```

### 数据备份

成绩存储在 MySQL 中，建议定期备份数据库。

---

## 🛠️ 技术栈

- PHP
- MySQL
- PDO
- HTML5
- CSS3
- JavaScript
- SVG
- JSON

---

<p align="center">
  Made with PHP · MySQL · HTML · CSS · JavaScript · SVG
</p>
