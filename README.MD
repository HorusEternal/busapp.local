# Расписание рейсовых автобусов

Это бэкенд приложение для просмотра и управления расписанием рейсовых автобусов. Сделан с использованием `Symfony 7`, `PHP 8`, `PostgreSQL 17`.

## Зависимости

Для запуска приложение нужно убедиться, что на машине установлены:

- Docker
- Docker Compose

## Начало

### Шаг 1: Склонируй репозиторий

```bash
https://github.com/HorusEternal/busapp.local.git
cd busapp.local
```

### Шаг 2: Сбилди образ и запусти контейнеры

```bash
docker compose up -d --build
```

### Шаг 3: Установи зависимости

```bash
docker compose exec app composer install
```

### Шаг 4: Выполни миграции в БД

```bash
docker compose exec app symfony console doctrine:migrations:migrate
```

### Шаг 5: Загрузи фикстуры в БД

```bash
docker compose exec app symfony console doctrine:fixtures:load
```

### Шаг 6: Выполни 


```bash
docker compose exec app symfony console doctrine:fixtures:load
```

Открыть swagger.yaml в любом OpenAPI клиенте и выполни запросы