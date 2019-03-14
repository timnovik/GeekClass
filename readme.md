# GeekClass
Платформа для организации онлайн-курсов

## Как запустить

Для запуска требуется `docker` и `docker-compose`

```bash
docker-compose up
```

## Выполнение команд в контейнере

Это полезно если вам нужно мигрировать базу данных, что в данном случае невозможно сделать на хост-машине

```bash
docker exec -it <имя контейнера php>
``` 
Имя контейнера можно посмотреть набрав `docker-compose ps`

Пример

```bash
docker exec -it geekclass_php_1
```

## Доступ к сайту
Сайт будет доступен по адресу `localhost:8050`

Adminer будет доступен по адресу `localhost:8080`

Порты можно настроить в `docker-compose.yml`, убедитесь что при перемене портов в контейнере с базой данных вы так-же меняете их в `.env` 

### Регистрация учителя
Создайте новое поле в таблице `providers` с помощью `Adminer` и введите в поле `invite` любое значение, затем используйте его на регистрации
