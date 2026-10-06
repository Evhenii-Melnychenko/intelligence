# Обновления сборки client-dev

## [Текущий проект] - Тема futuretech - April 2026

### Изменения
- ✅ **Переключение проекта:** Сборка идет в `futuretech/assets`
- ✅ **Новая тема:** Создана WordPress тема futuretech для интерьер-дизайн агентства
- ✅ Путь обновлен в `gulp/config/path.js`

### Структура Темы futuretech
```
wp-content/themes/futuretech/
├── assets/          # → результат сборки из client-dev
├── template-parts/  # → переиспользуемые компоненты
├── inc/            # → функции темы
├── front-page.php  # → главная страница
├── page-*.php      # → шаблоны страниц
└── functions.php   # → основной файл темы
```

### Команды
```bash
npm run dev   # development режим для futuretech
npm run build # production сборка для futuretech
```

---

## Обновления сборки (предыдущие)

### 1. Структура проекта
- ✅ Создана модульная структура `gulp/config/` и `gulp/tasks/`
- ✅ Все задачи вынесены в отдельные файлы для удобства поддержки

### 2. Обновление технологий
- ✅ Переход на ES6 модули (import/export)
- ✅ Webpack обновлен с версии 4 до версии 5
- ✅ Обновлены все зависимости до актуальных версий
- ✅ Добавлен `"type": "module"` в package.json

### 3. Новые возможности
- ✅ Обработка ошибок через plumber/notify
- ✅ Автоматическая генерация WebP изображений
- ✅ Поддержка webp в CSS (автоматические .webp/.no-webp классы)
- ✅ Оптимизация изображений через gulp-imagemin
- ✅ Современный autoprefixer с поддержкой grid

### 4. Изменения в командах
**Старые команды:**
```bash
npm run dev   # --dev флаг
npm run build # --prod флаг
```

**Новые команды:**
```bash
npm run dev   # development режим (по умолчанию)
npm run build # production режим (флаг --build)
```

### 5. Файлы конфигурации

#### Новые файлы:
- `gulp/config/path.js` - все пути проекта
- `gulp/config/plugins.js` - плагины gulp
- `gulp/tasks/*.js` - отдельные задачи

#### Устаревшие файлы (можно удалить):
- `pathes.js` - заменен на `gulp/config/path.js`
- `webpack.config.js` - webpack теперь настроен в `gulp/tasks/js.js`

### 6. BrowserSync
- Настроен proxy вместо статического сервера
- Автоматическая перезагрузка браузера при изменениях
- Порт: 3000

## Установка и запуск

### Шаг 1: Удалить старые зависимости
```bash
rm -rf node_modules
rm package-lock.json
```

### Шаг 2: Установить новые зависимости
```bash
npm install
```

**Важно:** Требуется Node.js >= 18

### Шаг 3: Запустить development режим
```bash
npm run dev
```

### Шаг 4: Проверить результат
Откройте браузер на `http://localhost:3000`

## Совместимость

Все пути остались прежними:
- **Исходники:** `./app/src/`
- **Результат:** `../wp-content/themes/futuretech/assets/`

## Поддерживаемые файлы

### JavaScript
- main.js
- page.js
- home.js (собирается как page-home.js)

### SCSS
- main.scss
- home.scss
- page.scss
- blog.scss
- unsubscribe.scss
- courses.scss

## Решение проблем

### Ошибка "Cannot use import statement outside a module"
- Убедитесь, что в package.json добавлено `"type": "module"`
- Проверьте версию Node.js (должна быть >= 18)

### Ошибка при установке зависимостей
```bash
npm cache clean --force
npm install
```

### Ошибка с del или другими пакетами
- Проверьте версию Node.js
- Установите заново node_modules

## Преимущества новой сборки

1. **Производительность:** Webpack 5 работает быстрее
2. **Современность:** ES6 модули, актуальные зависимости
3. **Удобство:** Модульная структура, легко добавлять новые задачи
4. **Качество:** Лучшая обработка ошибок, sourcemaps
5. **Оптимизация:** WebP, минификация, автопрефиксер
