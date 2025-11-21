# Настройка Railway

## Вариант 1: Через веб-интерфейс (рекомендуется)

1. Перейдите на https://railway.app
2. Войдите через GitHub (если еще не вошли)
3. Нажмите "New Project"
4. Выберите "Deploy from GitHub repo"
5. Найдите репозиторий `MeHartung/forsh2`
6. Нажмите "Deploy Now"

Railway автоматически:
- Определит PHP проект
- Установит зависимости
- Запустит сервер

## Вариант 2: Через CLI

Если хотите использовать командную строку:

```bash
# Авторизация (откроет браузер)
npx @railway/cli login

# Инициализация проекта
npx @railway/cli init

# Деплой
npx @railway/cli up
```

## Переменные окружения

После создания проекта добавьте в Railway → Variables:

```
APP_ENV=prod
APP_DEBUG=0
APP_SECRET=<сгенерируйте через: php -r "echo bin2hex(random_bytes(32));">
```

## Получение URL

После деплоя Railway создаст публичный URL вида:
`https://forsh2-production-xxxx.up.railway.app`

Этот URL можно показать клиенту для просмотра сайта в реальном времени.

