# Исправление определения PHP на Railway

## Проблема
Railway/Nixpacks определяет проект как Node.js вместо PHP.

## Решение

### Вариант 1: Пересоздать сервис (рекомендуется)

1. В Railway удалите текущий сервис
2. Создайте новый сервис: "New" → "GitHub Repo"
3. Выберите репозиторий `MeHartung/forsh2`
4. Railway должен автоматически определить PHP через `composer.json` и `nixpacks.toml`

### Вариант 2: Очистить кэш и перезапустить

1. В настройках сервиса найдите "Clear Build Cache"
2. Очистите кэш
3. Перезапустите деплой (Redeploy)

### Вариант 3: Явно указать в настройках

1. Settings → Service → Build & Deploy
2. В "Build Command" укажите: `composer install --no-dev --optimize-autoloader`
3. В "Start Command" укажите: `php -S 0.0.0.0:$PORT -t public public/index.php`
4. Сохраните и перезапустите

## Проверка

После правильной настройки в логах должно быть:
- "Detected PHP"
- "Installing composer dependencies"
- "Starting PHP server on port..."

