# Принудительное использование Nixpacks на Railway

## Проблема
Railway использует Railpack вместо Nixpacks и определяет проект как Node.js.

## Решение через веб-интерфейс Railway

1. Откройте проект на Railway
2. Перейдите в **Settings** → **Service** → **Build & Deploy**
3. Найдите раздел **"Builder"** или **"Build Settings"**
4. **ВАЖНО:** Выберите **"Nixpacks"** (не "Railpack" и не "Auto")
5. Если опции выбора билдера нет, добавьте переменную окружения:
   - Name: `RAILWAY_BUILDER`
   - Value: `nixpacks`
6. Сохраните изменения
7. **Очистите Build Cache** (если есть опция)
8. Перезапустите деплой: **Deployments** → выберите последний → **Redeploy**

## Альтернатива: Пересоздать сервис

1. Удалите текущий сервис полностью
2. Создайте новый: **"New"** → **"GitHub Repo"**
3. Выберите репозиторий `MeHartung/forsh2`
4. При создании Railway должен увидеть `composer.json` и автоматически выбрать Nixpacks

## Проверка

После правильной настройки в логах должно быть:
```
Using Nixpacks
Detected PHP
Installing composer dependencies
Starting PHP server...
```

Если все еще видите "Railpack" или "Detected Node" - значит билдер не переключился на Nixpacks.

