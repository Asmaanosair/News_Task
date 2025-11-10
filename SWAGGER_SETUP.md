# Swagger API Documentation Setup

## 📚 Overview

This project uses **L5-Swagger** to generate interactive API documentation.

## 🚀 Installation

The package has been installed and configured.

```bash
composer require darkaonline/l5-swagger
php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"
```

## 📖 Accessing Documentation

After running the application, you can access the Swagger UI at:

```
http://localhost:8000/api/documentation
```

Or in development:
```
http://127.0.0.1:8000/api/documentation
```

## 🔄 Generating Documentation

To regenerate the Swagger documentation after making changes to annotations:

```bash
php artisan l5-swagger:generate
```

## 📝 Available Endpoints

### Articles API

#### GET `/api/articles`

Get paginated list of articles with optional filters.

**Query Parameters:**
- `category` (string, optional) - Filter by category (e.g., "Technology")
- `source` (string, optional) - Filter by source: `news_api`, `news_cred`, `open_news`
- `author` (string, optional) - Filter by author name
- `date` (string, optional) - Filter by date (YYYY-MM-DD format)
- `keyword` (string, optional) - Search in title or content
- `orderBy` (string, optional) - Sort by: `published_at`, `title`, `created_at`
- `direction` (string, optional) - Sort direction: `asc` or `desc` (default: `desc`)
- `perPage` (integer, optional) - Items per page (default: 20)

**Example Requests:**

```bash
# Get all articles
curl http://localhost:8000/api/articles

# Filter by source and category
curl http://localhost:8000/api/articles?source=news_api&category=Technology

# Search with keyword
curl http://localhost:8000/api/articles?keyword=AI&perPage=50

# Multiple filters
curl http://localhost:8000/api/articles?source=news_api&category=Technology&orderBy=published_at&direction=desc
```

**Response Format:**

```json
{
  "data": [
    {
      "id": 1,
      "title": "Breaking News Title",
      "snippet": "This is a short snippet...",
      "content": "Full article content...",
      "image": "https://example.com/image.jpg",
      "source": "news_api",
      "source_id": "abc123",
      "author": "John Doe",
      "category": "Technology",
      "published_at": "2025-11-09T12:00:00Z",
      "created_at": "2025-11-09T12:00:00Z",
      "updated_at": "2025-11-09T12:00:00Z"
    }
  ],
  "links": {
    "first": "http://localhost/api/articles?page=1",
    "last": "http://localhost/api/articles?page=10",
    "prev": null,
    "next": "http://localhost/api/articles?page=2"
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 10,
    "per_page": 20,
    "to": 20,
    "total": 200
  }
}
```

## 🛠️ Configuration

Main configuration file: `config/l5-swagger.php`

- **Documentation Route**: `/api/documentation`
- **JSON File**: `storage/api-docs/api-docs.json`
- **Annotations Path**: `app/` directory

## 📦 Annotations Location

Swagger annotations are added to:
- `app/Http/Controllers/Controller.php` - Base API info
- `app/Http/Controllers/Api/ArticleController.php` - Article endpoints

## 🔧 Development

When you add or modify endpoints:

1. Add Swagger annotations to your controller methods
2. Run: `php artisan l5-swagger:generate`
3. Refresh the Swagger UI in your browser

## 📚 Documentation

- [L5-Swagger GitHub](https://github.com/DarkaOnLine/L5-Swagger)
- [OpenAPI Specification](https://swagger.io/specification/)
- [Swagger Annotations Guide](https://zircote.github.io/swagger-php/)

