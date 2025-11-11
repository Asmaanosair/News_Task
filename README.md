# News Task Project

A Laravel project to fetch and manage articles from multiple news sources with filtering and search functionality.

---

## Quick Start

### 1. Clone and Configure
```bash
git clone git@github.com:Asmaanosair/News_Task.git
cd news_task
```
### 2. Run with Docker
```bash
docker-compose up -d --build
```

**That's it!** This command automatically:
- Installs dependencies
- Sets up database
- Generates API documentation
- Starts background workers
- Fetches initial articles

---

## Access

- **Application**: http://localhost:9090
- **API Docs (Swagger)**: http://localhost:9090/api/documentation

---

## API Usage

### Get Articles
```
GET /api/articles
```

**Parameters:**
- `category` - Filter by category (e.g., Technology)
- `source` - Filter by source (news_api, news_cred, open_news)
- `author` - Filter by author
- `date` - Filter by date (YYYY-MM-DD)
- `keyword` - Search in title/content
- `orderBy` - Sort by (published_at, title, created_at)
- `direction` - Sort direction (asc, desc)
- `perPage` - Items per page (default: 20)

**Example:**
```bash
curl "http://localhost:9090/api/articles?category=Technology&perPage=10"
```

---

## Background Jobs

The following processes run automatically in the background:

### 1. Queue Workers
Handles asynchronous jobs like article processing and notifications.
```bash
# Already running inside Docker container
php artisan queue:work
```

### 2. Scheduled Tasks (Cron)
Automatically fetches new articles periodically.
```bash
# Already running inside Docker container
php artisan schedule:work
php artisan app:fetch-articles
```
# Run all tests
php artisan test

### 3. Manual Article Fetch
If you need to manually fetch articles:
```bash
docker exec -it news_task php artisan app:fetch-articles
```

---

## Tech Stack

- **Backend**: Laravel 11.x
- **Database**: SQLite (configurable)
- **Web Server**: Nginx
- **PHP**: 8.3-FPM
- **Container**: Docker & Docker Compose
- **API Documentation**: Swagger/OpenAPI


**Full documentation available at**: http://localhost:9090/api/documentation
